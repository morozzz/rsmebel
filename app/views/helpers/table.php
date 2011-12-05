<?php
/**
 * Table Helper class file, which is reliant on the CakePHP Html helper.
 *
 * This helper simplifies the construction of an HTML table.  It provides two
 * public functions:
 *
 * 'generate', which takes a definition of the table and the raw data to be
 * displayed.  These are processed to produce the headers and cells and passes
 * these to:
 *
 * 'assemble', which takes an array of header data and an array of cell data.
 * These are passed to the relevant Html helper functions and brackets the results
 * with <table> tags
 *
 * @todo
 * -# Allow cells, especially static (action) ones to have multiple values, e.g.
 *    edit delete, etc.
 * -# Allow column headers to have links
 * -# Do something about format etc. for HTML helper calls
 *
 * @license     GNU General Public License
 */
class TableHelper extends Helper
{
/*************************************************************************
 * class-wide constants
 *************************************************************************/
    const delimit = ';';
    const data = 'data';
    const model = 'model';
    const field = 'field';
    const title = 'title';
    const staticTxt = 'static';
    const url = 'link';
    const controllerAction = 'controller_action';
    const flag = 'flag';
    const trueTxt = 'true';
    const falseTxt = 'false';


/*************************************************************************
 * Public variables
 *************************************************************************/
/**
 * Lists the other helpers, upon which this class is reliant
 *
 * @var array
 * @access public
 */
    var $helpers = array('Html');


/*************************************************************************
 * Private variables
 *************************************************************************/
/**
 * Holds the processed column definitions for the table
 *
 * @var	array
 * @access private
 */
    var $__columns = array();


/**
 * Generates an HTML table, given the definition of the required columns and the
 * raw data.
 *
 * The intended use is that raw data comes from, say, a model's 'findAll' call and
 * the fields to be shown, in columns of the table, are defined.
 *
 * The simplest column definition supported is a string: either 'field' or
 * 'model;field'.  In this case, the column's title (header) will be the humanised
 * field name and the cell's contents would be $tableData[$row]['model']['field'].
 *
 * More complex column definitions are supported and these require the definition
 * to be provided in an array; to duplicate the above example:
 *  array('data' => 'model;field')
 *
 * But things can be made more interesting by adding other elements to the column
 * definition array, e.g.:
 *
 * 'title' => 'a string' Specifies the column's heading
 *
 * 'static' => 'delete'  The cells contents may be static text, e.g. if you wish to
 *                       use the column for an action; in which case you may not
 *                       provide a 'data' element
 *
 * 'link' => 'a string'  Make the cell's contents a link, by specifying the url to
 * be followed.  The following 'link' string formats are supported:
 *      'controller/action' Note the use of the '/', you can have any combination
 *                          here, e.g. 'action'; '/controller/action'; even
 *                          '/controller/action/12'
 *      'controller/action;field' Which appends a '/' with the value of a field,
 *                                e.g. 'users/show;id'
 *      'controller/action;model;field' As above, but accessing a deeper layer in
 *                                      the raw data
 *
 * 'flag' => 'true text;false text'  Specifies the 'friendly' text to show for a
 *                                   boolean column, e.g. 'Yes;No'
 *
 * So, imagine a user and profile model, as per the CakePHP manual, within the
 * controller you might have:
 *
 *   function index()
 *   {
 *       $this->set('users', $this->User->findAll());
 *   }
 *
 * and then, in the corresponding view
 *
 * ...
 * $definition = array('User;first_name',
 *                     array('data' => 'User;last_name', 'link' => 'show;User;id'),
 *                     array('title' => 'Profile', 'data' => 'Profile;name'),
 *                     array('title' => 'Action', 'static' => 'delete',
 *                           'link' => 'delete;User;id'));
 * $this->table->generate($definition, $users);
 * ...
 *
 * This will produce a 4 column table.  Column 1 shows the user's first name,
 * column 2 is their last name, liked to the users/show action, column 3 is
 * the name of their profile and the 4th column is an action link to delete
 * the user.
 *
 * @param  array   $columnDefinitions Definition of the required columns
 * @param  array   $tableData         The raw data to be shown in the table
 * @param  boolean $return  If true return the table; if false, whether the table
 *                          is returned or output depends on AUTO_OUTPUT
 * @return mixed	Either string or boolean value, depends on AUTO_OUTPUT and
 *                  $return
 */
    function generate($columnDefinitions, $tableData, $return = false)
    {
        $this->__ensureArray($columnDefinitions);

        $headers = $this->__preProcess($columnDefinitions);
        $cells = $this->__parseTableData($tableData);

        return $this->assemble($headers, $cells, $return);
    }


/**
 * Assembles an HTML table, given the contents of the header row and the cells
 *
 * @param  array   $headers The text to be shown in the header row
 * @param  array   $cells   The contents of the cells, by column and by row
 * @param  boolean $return  If true return the table; if false, whether the table
 *                          is returned or output depends on AUTO_OUTPUT
 * @return mixed	Either string or boolean value, depends on AUTO_OUTPUT and
 *                  $return
 */
    function assemble($headers, $cells, $return = false)
    {
        $table = "<table>";
        $table .= $this->Html->tableHeaders($headers, null, null, true);
        $table .= $this->Html->tableCells($cells, null,
                                          array('class' => 'altRow'), true);
        $table .= "</table>";

        return $this->output($table, $return);
    }


/**
 * Decodes the definition of the required columns, empty columns are skipped
 *
 * @access private
 * @param  array   $columnDefinitions Definition of the required columns
 * @return array	An array of the column headers
 */
    private function __preProcess($columnDefinitions)
    {
        $this->__columns = array();
        $headers = array();

        foreach ($columnDefinitions as $columnDefinition) {
            //Match a string column definition to a plain data source
            $this->__ensureArray($columnDefinition, self::data);

            if (false !== ($column = $this->__decodeColumnDefinition($columnDefinition))) {
                //Column definition is understood, so store it
                $this->__columns[] = $column;
                $headers[] = $column[self::title];
            }
        }

        return $headers;
    }


/**
 * Decodes the definition of a column:
 *
 * 1. The content of the column's cells must be specified, either the data source,
 *    or the static text;
 * 2. The title (header) for the column may be explicitly specified, or the field
 *    name of the data source is used, or, failing that, the static text;
 * 3. The column's cells may be made into a hyperlink, by specifying a url and
 *    a parameter; and
 * 4. A boolean (1/0) column may be made 'friendly', by specifying the text to be
 *    shown if the value is true and if it is false.
 *
 * @access private
 * @param  array   $columnDefinition Definition for a columns in the table
 * @return mixed	Either an array of the decoded column definition, or false on
 *                  failure
 */
    private function __decodeColumnDefinition($columnDefinition)
    {
        $column = array();

        //Decode the data source for this column
        if (!$this->__explodeDefinition(self::data, $columnDefinition,
                                        array(1 => self::field,
                                              2 => self::model.self::delimit.
                                                   self::field),
                                        $column)) {
            if (array_key_exists(self::staticTxt, $columnDefinition)) {
                $column[self::staticTxt] = $columnDefinition[self::staticTxt];
            }
            else {
                //Nothing specified for the cell's contents...
                trigger_error("Skipping blank column", E_USER_WARNING);
                return false;
            }
        }

        //Specify the title for this column
        if (array_key_exists(self::title, $columnDefinition)) {
            $column[self::title] = $columnDefinition[self::title];
        }
        else {
            //No title, so default to the field's name
            if (array_key_exists(self::field, $column[self::data])) {
                $column[self::title] =
                        Inflector::humanize($column[self::data][self::field]);
            }
            else {
                //or, the action
                $column[self::title] =
                        Inflector::humanize($column[self::staticTxt]);
            }
        }

        //Decode any link for this column
        $this->__explodeDefinition(self::url, $columnDefinition,
                                   array(1 => self::controllerAction,
                                         2 => self::controllerAction.self::delimit.
                                              self::field,
                                         3 => self::controllerAction.self::delimit.
                                              self::model.self::delimit.self::field),
                                   $column);

        //Set up a friendly flag column
        $this->__explodeDefinition(self::flag, $columnDefinition,
                                 array(2 => self::trueTxt.';'.self::falseTxt),
                                 $column);

        return $column;
    }


/**
 * Processes the raw table data, to produce the cells' contents for the specified
 * table
 *
 * @access private
 * @param  array   $tableData The raw table data
 * @return mixed	An array of the table's cells' contents
 */
    private function __parseTableData($tableData)
    {
        $this->__ensureArray($tableData);

        foreach ($tableData as $rawRow) {
            $cells[] = $this->__parseRowData($rawRow);
        }

        return $cells;
    }


/**
 * Processes a single row of raw table data.  For each column in the table, the
 * cell's content, either static or dynamic, is determined and, optionally,
 * the dynamic content is made 'friendly'.  Then, if the cell's contents are linked
 * the required url is processed and the contents updated to reflect the link
 *
 * @access private
 * @param  array   $tableData The raw table data
 * @return mixed	An array of the row's cells' contents
 */
    private function __parseRowData($rowData)
    {
        foreach ($this->__columns as $column) {
            //Look up the 'vanilla' text to show in the cell
            if (array_key_exists(self::staticTxt, $column)) {
                $cellContents = $column[self::staticTxt];
            }
            else {
                if (array_key_exists(self::model, $column[self::data])) {
                    $cellContents = $rowData[$column[self::data][self::model]]
                                            [$column[self::data][self::field]];
                }
                else {
                    $cellContents = $rowData[$column[self::data][self::field]];
                }

                //If this is a friendly flag column, make the contents friendly
                if (array_key_exists(self::flag, $column)) {
                    $index = ($cellContents) ? self::trueTxt : self::falseTxt;
                    $cellContents = $column[self::flag][$index];
                }
            }

            //If this is a linked column, make the contents an html link
            if (array_key_exists(self::url, $column)) {
                $link = $column[self::url];
                $url = array($link[self::controllerAction]);

                if (array_key_exists(self::model, $link)) {
                    $url[] = $rowData[$link[self::model]]
                                     [$link[self::field]];
                }
                else {
                    $url[] = $rowData[$link[self::field]];
                }

                $cellContents = $this->Html->link($cellContents,
                                                  implode('/', $url));
            }

            $row[] = $cellContents;
        }

        return $row;
    }


/**
 * Force a variable to be an array
 *
 * @access private
 * @param mixed $variable Reference to the variable to be made an array
 * @param mixed  Optional index into the array for the original scalar
 */
    private function __ensureArray(&$variable, $key=0)
    {
        if (!is_array($variable)) {
            $variable = array($key => $variable);
        }

    }


/**
 * This function supports decoding column definitions, by splitting a delimited
 * string and mapping the resultant pieces to elements of the column definition,
 * where the mapping (format) is prescribed by the number of pieces in the string.
 *
 * Breaks a delimited string, held at a specified index in a source array, into
 * array pieces that are stored at the corresponding index in a target array,
 * according to the prescribed format.
 *
 * @access private
 * @param mixed $key The index to the source array that holds the delimited string
 * @param array $source Optional index into the array for the original scalar
 * @param array $formats Defines the supported options, number of pieces, for the
 *                       delimited string
 * @param array $target Reference to the target array
 * @return boolean  True on success
 */
    private function __explodeDefinition($key, $source, $formats, &$target)
    {
         if (array_key_exists($key, $source)) {
            $fI = count($pieces = explode(self::delimit, $source[$key]));

            if (array_key_exists($fI, $formats)) {
                foreach (explode(self::delimit, $formats[$fI]) as $pI => $tI) {
                    $temp[$tI] = $pieces[$pI];
                }

                $target[$key] = $temp;
                return true;
            }
        }

        return false;
    }

}

?>