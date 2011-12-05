<?php

class AdminCommonHelper extends AppHelper {
    var $helpers = array(
        'Html',
        'Form',
        'Javascript'
    );

    function table($config, $data) {
        $config = array_merge(array(
            'columns' => array(),
            'id_path' => '',
            'model_name' => '',
            'sortable' => false,

            'top_paginator' => null,
            'bottom_paginator' => null,

            'table_id' => 'table-admin-id',
            'tr_id_template' => 'tr%row_id%',
            'table_class' => 'table-admin',
            'thead_class' => 'thead-admin ui-widget-header',
            'tbody_class' => 'tbody-admin ui-widget-content',
            'tr_class' => 'tr-admin',
            'tr_class_path' => '',
            'th_class' => 'th-admin',
            'td_class' => 'td-admin ui-state-default',
            'tr_odd_class' => 'tr-odd-admin',
            'tr_even_class' => 'tr-even-admin',

            'th_action_class' => 'th-action-admin',
            'td_action_class' => 'td-action-admin',
            'select_action_class' => '',
            'th_action_text' => 'Действие',
            'select_action_default_text' => 'Выберите действие',

            'link_save_class' => '',
            'link_save_name' => 'Сохранить',
            'link_save_url' => '#',

            'link_button_class' => 'button',
            'buttons' => array(
                'Сохранить' => array(
                    'type' => 'save'
                )
            ),
            'actions' => array(),
            'div_button_bottom_class' => 'div-button-bottom',

            'text_dialog' => -1,
            'edit_dialog' => -1,
            'file_dialog' => -1
        ), $config);
        extract($config);
        $link_save_class .= ' link-save-admin button';
        $link_save_url = $this->Html->url($link_save_url);
        $select_action_class .= ' select-action-admin';

        $str = "<script type='text/javascript' src='".$this->webroot.
                "js/admin_table.js'></script>";

        if(!empty($top_paginator)) {
            $str .= $this->paginate_table($top_paginator, $model_name);
        }

        $str .= "<table class='$table_class' id='$table_id'>";

        $str .= "<thead class='$thead_class'>";
        $str .= "<tr class='$tr_class'>";

        $js_str = "";

        foreach($columns as &$column) {
            $column = array_merge(array(
                'type' => 'label',
                'name' => '',
                'js_list_name' => '',
                'list' => '',
                'header' => '',
                'header_class' => '',
                'column_class' => '',
                'saving_column' => true
            ), $column);
            extract($column);

            $str .= "<th class='$th_class $header_class $column_class'>";
            $str .= $header;
            $str .= "</th>";

            if($column['type'] == 'autocomplete') {
                if($js_list_name == '') {
                    $js_list_name = "js_list_$name";
                    $column['js_list_name'] = $js_list_name;
                }
                $js_list = array();
                foreach($list as $item) $js_list[] = $item;
                $js_str .= "var $js_list_name = ".$this->Javascript->object($js_list).";";
            }
        }
        if(!empty($actions)) {
            $str .= "<th class='$th_class $th_action_class'>$th_action_text</th>";
        }

        $str .= "</tr>";
        $str .= "</thead>";

        if($sortable) $tbody_class .= ' sortable';
        
        $str .= "<tbody class='$tbody_class'>";
        $tr_odd = true;
        foreach($data as $row) {
            $odd_even_class = ($tr_odd)?$tr_odd_class:$tr_even_class;
            $tr_odd = !$tr_odd;

            $row_id = Set::classicExtract($row, $id_path);
            $tr_id = str_replace('%row_id%', $row_id, $tr_id_template);
            $tr_class_path_value = '';
            if(!empty($tr_class_path)) {
                $tr_class_path_value = Set::classicExtract($row, $tr_class_path);
            }
            $str .= "<tr id='$tr_id' class='$tr_class $tr_class_path_value $odd_even_class' row_id='$row_id'>";

            foreach($columns as &$column) {
                $column = array_merge(array(
                    'type' => 'label',
                    'path' => '',
                    'value' => null,
                    'cell_class' => '',
                    'column_class' => '',
                    'sort_column' => false,

//                    'edit_name' => '',
//                    'edit_class' => '',
//
//                    'select_name' => '',
//                    'select_class' => '',
                    'name' => '',
                    'fullname' => '',
                    'class' => '',
                    'list' => array(),
                    'js_list_name' => '',

                    'checkbox_name' => '',
                    'checkbox_class' => '',

                    'function' => array(
                        'object' => null,
                        'name' => ''
                    )
                ), $column);
                extract($column);

                $sort_class = ($sort_column)?'sort-column':'';
                $str .= "<td class='$td_class $cell_class $column_class $sort_class'>";

                if(empty($value)) $value = Set::classicExtract($row, $path);
                $name = ($fullname=='')?"[$name]":$fullname;

                if($type=='label') {
                    $str .= "<div class='td-label'>$value</div>";
                } else if($type=='link') {
                    $str .= "<div class='td-link'>".$this->Html->link($value)."</div>";
                } else if($type=='edit') {
                    if($saving_column) $class .= ' input-edit-admin';
                    $str .= "<input type='text' class='$class' ".
                    "name='data[$model_name][$row_id]$name' ".
                    "value='$value'/>";
                } else if($type=='date') {
                    if($saving_column) $class .= ' input-edit-admin';
                    $str .= "<input type='text' class='input-date $class' ".
                    "name='data[$model_name][$row_id]$name' ".
                    "value='$value'/>";
                } else if($type=='edit_dialog') {
                    if($saving_column) $class .= ' input-edit-admin';
                    $str .= "<input readonly type='text' class='input-edit-dialog $class' ".
                    "name='data[$model_name][$row_id]$name' ".
                    "value='$value'/>";
                    if($edit_dialog == -1) $edit_dialog = true;
                } else if($type=='text') {
                    if($saving_column) $class .= ' input-edit-admin';
                    $str .= "<input readonly type='text' class='editor $class' ".
                    "name='data[$model_name][$row_id]$name' ".
                    "value='$value'/>";
                    if($text_dialog == -1) $text_dialog = true;
                } else if($type=='combo') {
                    if($saving_column) $class .= ' select-edit-admin';
                    $str .= $this->Form->select('', $list, $value, array(
                        'name' => "data[$model_name][$row_id]$name",
                        'class' => $class,
                        'empty' => false
                    ), false);
                } else if($type=='autocomplete') {
                    if($saving_column) $class .= ' input-edit-admin';
                    $str .= "<input type='text' class='autocomplete-edit-admin $class' ".
                    "name='data[$model_name][$row_id]$name' ".
                    "value='{$list[$value]}' list_name='$js_list_name'/>";
                } else if($type=='checkbox') {
                    if($saving_column) $class .= ' checkbox-edit-admin';;
                    $str .= "<input type='checkbox' class='$class'".
                    "name='data[$model_name][$row_id]$name' ".
                    (($value==1)?"checked":"")."/>";
                } else if($type=='image') {
                    $str .= $this->Html->image($value, array(
                        'class' => 'show-image',
                        'height' => 30
                    ));

                    $str .= "<div class='div-file-dialog' ".
                        "name='data[$model_name][$row_id]$name'>загр.</div>";
                    if($file_dialog == -1) $file_dialog = true;
                } else if($type=='function') {
                    $str .= "<div>";
                    $str .= call_user_method_array($function['name'],
                            $function['object'], $value);
                    $str .= "</div>";
                }
                $str .= "</td>";
            }

            if(!empty($actions)) {
                $str .= "<td class='$td_class $td_action_class'>";
                $str .= "<select row_id='$row_id' class='$select_action_class'>";
                $str .= "<option selected='selected' value='0'>".
                    $select_action_default_text."</option>";
                foreach($actions as $value => $text) {
                    $str .= "<option value='$value'>$text</option>";
                }
                $str .= "</select>";
                $str .= "</td>";
            }

            $str .= "</tr>";
        }
        $str .= "</tbody>";

        $str .= "</table>";

        if(!empty($bottom_paginator)) {
            $str .= $this->paginate_table($bottom_paginator, $model_name);
        }

        $str .= "<div class='$div_button_bottom_class'>";
        foreach($buttons as $button_text => $button) {
            $button = array_merge(array(
                'type' => 'btn',
                'func_name' => '',
                'class' => ''
            ), $button);
            extract($button);
            if($type == 'save') {
                $str .= "<a href='#' onclick='return false;' ".
                "class='$link_save_class' table_id='$table_id' ".
                "save_url='$link_save_url'>$link_save_name</a>";
            } else if($type == 'btn') {
                $str .= "<a href='#' onclick='return false;' ".
                "class='$link_button_class $class' func_name='$func_name'>".
                "$button_text</a>";
            }
        }
        $str .= "</div>";


        /*text dialog*/
        /**********************************************************************/
        if($text_dialog) {
            $str .= "<div class='text-dialog' style='display:none;'>";
            $str .= "<textarea></textarea>";
            $str .= "</div>";
        }
        if($edit_dialog) {
            $str .= "<div class='edit-dialog' style='display:none;'>";
            $str .= "<input type='text' style='width:100%;'>";
            $str .= "</div>";
        }
        if($file_dialog) {
            $str .= "<div class='file-dialog' style='display:none;'>";
            $str .= "</div>";
        }

        $str .= "<script type='text/javascript'>$js_str</script>";
        /**********************************************************************/
        return $str;
    }

    function dialog_form($config) {
        $config = array_merge(array(
            'dialog_id' => '',
            'dialog_class' => '',
            'model_name' => '',
            'form_action' => '',
            'form_type' => 'post',
            'form_url' => '',
            'form_class' => '',
            'title' => '',
            'caption' => false,
            'ok_caption' => 'OK',
            'cancel_caption' => 'Отмена',
            'caption_class' => 'dialog-caption',
            'height' => 'auto',
            'width' => 'auto',
            'fields' => array()
        ), $config);
        extract($config);
        $dialog_class .= ' dialog-form';
        $form_class .= ' form';

        $str = "";
        $js_str = "";

        $str .= "<div id='$dialog_id' class='$dialog_class' d_title='$title' ".
        "d_height='$height' d_width='$width' ".
        "ok_caption='$ok_caption' cancel_caption='$cancel_caption'>";
        $str .= $this->Form->create($model_name, array(
            'action' => $form_action,
            'url' => $form_url,
            'class' => $form_class,
            'type' => $form_type
        ));

        if($caption) {
            $str .= "<h3 class='$caption_class'>$caption</h3>";
        }

        foreach($fields as $field) {
            $field = array_merge(array(
                'type' => 'edit',
                'label' => '',
                'name' => '',
                'value' => '',
                'list' => array(),
                'div_row_class' => 'dialog-div-row ui-corner-all',
                'label_class' => 'dialog-label',
                'div_input_class' => 'dialog-div-input',
                'label_text_class' => 'dialog-label-text',
                'div_text_class' => 'dialog-div-text',
                'input_class' => '',
                'clear_class' => 'input-clear',
                'height' => '',
                'js_list_name' => ''
            ), $field);
            extract($field);
            $input_class .= " dialog-input";
            if($clear_class) $input_class .= " $clear_class";

            if($type=='edit') {
                $str .= "<div class='$div_row_class'>";
                $str .= "<div class='$label_class'>$label</div>";
                $str .= "<div class='$div_input_class'>";
                $str .= "<input type='text' class='$input_class' name='$name' value='$value'/>";
                $str .= "</div>";
                $str .= "</div>";
            } else if($type=='date') {
                $str .= "<div class='$div_row_class'>";
                $str .= "<div class='$label_class'>$label</div>";
                $str .= "<div class='$div_input_class'>";
                $str .= "<input type='text' class='input-date $input_class' name='$name' value='$value'/>";
                $str .= "</div>";
                $str .= "</div>";
            } else if($type=='text') {
                $str .= "<div class='$div_row_class'>";
                $str .= "<div class='$label_text_class'>$label</div>";
//                $str .= "</div>";
//                $str .= "<div class='$div_row_class'>";
                //$str .= "<div class='$div_input_class'>";
                $str .= "<div class='$div_text_class'>";
                $str .= "<textarea ed_height='$height' class='$input_class dialog-editor' name='$name'>$value</textarea>";
                $str .= "</div>";
                $str .= "</div>";
            } else if($type=='hidden') {
                $str .= "<input type='hidden' class='$input_class' name='$name' value='$value'/>";
            } else if($type=='combo') {
                $str .= "<div class='$div_row_class'>";
                $str .= "<div class='$label_class'>$label</div>";
                $str .= "<div class='$div_input_class'>";
                $str .= $this->Form->select('', $list, $value, array(
                    'name' => $name,
                    'class' => $input_class,
                    'empty' => false
                ), false);
                $str .= "</div>";
                $str .= "</div>";
            } else if($type=='checkbox') {
                $str .= "<div class='$div_row_class'>";
                $str .= "<div class='$label_class'>$label</div>";
                $str .= "<div class='$div_input_class'>";
                $str .= "<input type='checkbox' class='$input_class'".
                "name='$name' ".(($value)?'checked':'')."/>";
                $str .= "</div>";
                $str .= "</div>";
            } else if($type=='autocomplete') {
                $str .= "<div class='$div_row_class'>";
                $str .= "<div class='$label_class'>$label</div>";
                $str .= "<div class='$div_input_class'>";
                $str .= "<input type='text' class='$input_class autocomplete-edit-admin' ".
                "name='$name' value='$value' list_name='$js_list_name'/>";
                $str .= "</div>";
                $str .= "</div>";

                $js_list = array();
                foreach($list as $item) $js_list[] = $item;
                $js_str .= "var $js_list_name = ".$this->Javascript->object($js_list).";";
            } else if($type=='file') {
                $str .= "<div class='$div_row_class'>";
                $str .= "<div class='$label_class'>$label</div>";
                $str .= "<div class='$div_input_class'>";
                $str .= "<input type='file' class='$input_class' name='$name'/>";
                $str .= "</div>";
                $str .= "</div>";
            }
        }

        $str .= $this->Form->end();
        $str .= "</div>";

        $str .= "<script type='text/javascript'>$js_str</script>";

        return $str;
    }

    function paginate_table($paginator, $model_name) {
        $paginator->options(array('url' => $this->params['pass']));
        $count = $paginator->params['paging'][$model_name]['count'];
        $limit = $paginator->params['paging'][$model_name]['options']['limit'];
        $str = "";

        $str .= "<table class='admin-pagination' width='100%'><tbody><tr>";

        $str .= "<td class='admin-pagination-count' width='40%'>";
        $str .= $paginator->counter('Всего %count% '.
                $paginator->link('(Показать все)', array(
                    'limit' => $count,
                    'page' => 1
                ), array(
                    'escape' => false
                )).', показано с %start% по %end%');
        $str .= "</td>";

        $str .= "<td class='admin-pagination-prev' width='10%'>";
        $str .= $paginator->prev("<<< Назад");
        $str .= "</td>";

        $str .= "<td class='admin-pagination-pages' width='20%'>";
        $str .= $paginator->numbers(array(
            'before' => 'Страницы ',
            'modulus' => 0,
            'separator' => ' '
        ));
        $str .= "</td>";

        $str .= "<td class='admin-pagination-next' width='10%'>";
        $str .= $paginator->next("Вперед >>>");
        $str .= "</td>";

        $str .= "<td class='admin-pagination-limit' width='20%'>";
        $str .= "Количество на странице<br>";
        $str .= $this->Form->select('', array(
            6 => '6',
            10 => '10',
            20 => '20',
            30 => '30',
            $count => 'Все'
        ), $limit, array(
            'class' => 'admin-pagination-limit-select',
            'base_url' => $paginator->url(array_merge((array)$paginator->options['url'], array('limit' => null, 'page' => null)))
        ), false);
        $str .= "</td>";

        $str .= "</tr></tbody></table>";
        return $str;
    }
}

?>