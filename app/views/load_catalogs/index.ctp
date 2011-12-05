<?php

    echo $html->div('table-caption', 'Список загрузок каталога');

    echo $html->div('action',
            $html->link('Добавить загрузку', array(
                'controller' => 'load_catalogs',
                'action' => 'add'
            ))
    );
    echo "<table class=\"data-table tree-table\" id=\"load-catalog-list-table\">";
    echo "<thead>";
    echo $html->tableHeaders(array(
        $html->div('catalog_header', 'ID'),
        $html->div('catalog_header', 'Дата'),
        $html->div('catalog_header', 'Комментарий'),
        $html->div('catalog_header', 'Файл'),
        $html->div('catalog_header', 'Создатель'),
        $html->div('catalog_header', 'Статус'),
        $html->div('catalog_header', 'Кол-во записей'),
        $html->div('catalog_header', 'Кол-во обр. записей'),
        $html->div('catalog_header', 'Кол-во ошибок'),
        '', '', '', '', ''
    ));
    echo "</thead>";

    echo "<tbody>";
    foreach($l_catalogs as $lcat) {

        if ($lcat['LoadCatalog']['status_id'] == 0) {

            echo $html->tableCells(array(
                $lcat['LoadCatalog']['id'],
                $lcat['0']['created'],
                $lcat['LoadCatalog']['note'],
                $lcat['LoadCatalog']['file_name'],
                $lcat['User']['username'],
                $lcat['LoadCatalog']['status_name'],
                $lcat['LoadCatalog']['cnt'],
                $lcat['LoadCatalog']['proc_cnt'],
                $lcat['LoadCatalog']['err_cnt'],

                $html->div('action',
                        $html->link('удалить', array(
                            'controller' => 'load_catalogs',
                            'action' => 'delete',
                            $lcat['LoadCatalog']['id']
                        ))
                ),
                '',
                $html->div('link-load-file', $html->link('залить файл', '#')),
                ''
                ));
        }
        else if ($lcat['LoadCatalog']['status_id'] == 1){
            echo $html->tableCells(array(
                $lcat['LoadCatalog']['id'],
                $lcat['0']['created'],
                $lcat['LoadCatalog']['note'],
                $lcat['LoadCatalog']['file_name'],
                $lcat['User']['username'],
                $lcat['LoadCatalog']['status_name'],
                $lcat['LoadCatalog']['cnt'],
                $lcat['LoadCatalog']['proc_cnt'],
                $lcat['LoadCatalog']['err_cnt'],
                $html->div('action',
                        $html->link('удалить', array(
                            'controller' => 'load_catalogs',
                            'action' => 'delete',
                            $lcat['LoadCatalog']['id']
                        ))
                ),
                $html->div('action',
                $html->link('просмотр', array(
                    'controller' => 'load_catalogs',
                    'action' => 'show',
                    $lcat['LoadCatalog']['id']
                ))
                ),
                '',
                $html->div('link-load-catalogs', $html->link('загрузить в каталог', '#'))
            ));
        }
        else if ($lcat['LoadCatalog']['status_id'] == 2){
            echo $html->tableCells(array(
                $lcat['LoadCatalog']['id'],
                $lcat['0']['created'],
                $lcat['LoadCatalog']['note'],
                $lcat['LoadCatalog']['file_name'],
                $lcat['User']['username'],
                $lcat['LoadCatalog']['status_name'],
                $lcat['LoadCatalog']['cnt'],
                $lcat['LoadCatalog']['proc_cnt'],
                $lcat['LoadCatalog']['err_cnt'],
                $html->div('action',
                        $html->link('удалить', array(
                            'controller' => 'load_catalogs',
                            'action' => 'delete',
                            $lcat['LoadCatalog']['id']
                        ))
                ),
                $html->div('action',
                $html->link('просмотр', array(
                    'controller' => 'load_catalogs',
                    'action' => 'show',
                    $lcat['LoadCatalog']['id']
                ))
                ),
                '',
                $html->div('link-load-catalogs', $html->link('загрузить в каталог', '#'))
            ));
        }
    }
    echo "</tbody>";
    echo "</table>";

?>

<script type="text/javascript">

    var load_catalog_list_table;
    var webroot = "<?php echo $this->webroot; ?>"

    $(document).ready(function() {

        enable_ajax_waiting();

        load_catalog_list_table = $('#load-catalog-list-table').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": false,
            "bInfo": false,
            "bAutoWidth": false,
            "oLanguage" : {
                "sZeroRecords":  ""
            },
            'aoColumns': [
//                {
//                    'bVisible': false
//                },
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null
            ]
        });

        $('.link-load-file').click(function() {
          var tr = $(this).parent().parent().get(0);
          var catalog_id = load_catalog_list_table.fnGetData(tr)[0];
          var file_name = load_catalog_list_table.fnGetData(tr)[3];
    
            $.ajax({
                url: webroot+'load_catalogs/load_file',
                data: {
                      id: catalog_id,
                      file_name: file_name
                },
                type: 'post',
                success: function(responseText) {
                    var obj = eval(responseText);
                }
            });
         });

        $('.link-load-catalogs').click(function() {
          var tr = $(this).parent().parent().get(0);
          var catalog_id = load_catalog_list_table.fnGetData(tr)[0];

            $.ajax({
                url: webroot+'load_catalogs/load',
                data: {
                      id: catalog_id
                },
                type: 'post',
                success: function(responseText) {
                    var obj = eval(responseText);
                }
            });
         });

                    
    });
</script>
