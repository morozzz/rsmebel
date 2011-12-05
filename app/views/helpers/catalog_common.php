<?php

class CatalogCommonHelper extends AppHelper {
    var $helpers = array(
        'Html'
    );
    
    function getCatalogTreeStr($catalog_tree, $path, $cur_catalog_id, $action='adm_catalog') {
        $catalog_tree_str = '';

        $catalog_tree_str .= "";

        if($action=='adm_catalog')
            $catalog_tree_str .= "<ul id=\"catalog-list\" class=\"ui-state-default ui-corner-all\">";
        else
            $catalog_tree_str .= "<ul id=\"catalog-list\">";

            foreach($catalog_tree as $catalog_id=>$catalog_node) {

                $catalog_class = '';
                if($catalog_id == $cur_catalog_id)
                    $catalog_class = 'catalog-tree-selected ';
                if((!empty($path[$catalog_id]) || $catalog_node['level']==0) && ($action!='adm_catalog') )
                    $catalog_class .= 'open ';
                if(!$catalog_node['hasChild']) {
                    $catalog_class .= 'li-square';
                }

                $catalog_tree_str .= "<li class='$catalog_class'>";
                if(!$catalog_node['hasChild']) {
                    $catalog_tree_str .= "<div class='div-li-square'></div>";
                }
                if($catalog_node['hasChild'])
                    $catalog_tree_str .= "<span class=\"catalog-tree-sign\"></span>";
                $catalog_tree_str .= "<div class=\"catalog-tree-name-level".$catalog_node['level']."\" style=\"display: inline;\">";
                $catalog_tree_str .= $this->Html->link($catalog_node['Catalog']['name'], array(
                    'controller' => 'catalogs',
                    'action' => $action,
                    $catalog_id
                ), array(
                    'class' => 'text-shadow'
                ));
                $catalog_tree_str .= "</div>";
                if($catalog_node['hasChild']) {
                    if($catalog_node['level']==0) {
                        $catalog_tree_str .= "<ul style=\"display: block; min-height: 40px; position: relative; padding-left: 40px;\">";
                        $catalog_tree_str .= "<img src=\"".$this->webroot."img/".$catalog_node['SmallImage']['url']."\" class=\"image-level-0\">";
                    } else {
                        $catalog_tree_str .= "<ul>";
                    }
                }
                else
                    $catalog_tree_str .= "</li>";
                for($i=0; $i<$catalog_node['finishBlock']; $i++) {
                    $catalog_tree_str .= "</ul></li>";
                }
            }
        $catalog_tree_str .= "</ul>";

        $catalog_tree_str .= "<script type='text/javascript'>";
        $catalog_tree_str .= "
            $(document).ready(function() {
                $('#catalog-list').treeview({
                    'animated' : 'fast',
                    'collapsed' : true,
                    'toggle' : function() {
                        if($(this).hasClass('collapsable')) {
                            $(this).find('.catalog-tree-sign:first').html('-');
                        } else {
                            $(this).find('.catalog-tree-sign:first').html('+');
                        }
                    }
                });

                $('li.expandable').find('span.catalog-tree-sign:first').html('+');
                $('li.collapsable').find('span.catalog-tree-sign:first').html('-');
                if($.browser.msie) {
                    $('.image-level-0').css('left', '-40px');
                }
            });";
        $catalog_tree_str .= "</script>";
        return $catalog_tree_str;
    }

    function getCatalogPathStr($path, $action='index') {
        $path_str = $this->Html->link('Анжелика - Торговое Оборудование >> ', array(
            'controller' => 'catalogs',
            'action' => $action
        ));
        if(!empty($path)) {
            foreach($path as $path_id => $path_name) {
                $path_str .= $this->Html->link($path_name . ' >> ', array(
                    'controller' => 'catalogs',
                    'action' => $action,
                    $path_id
                ));
            }
        }
        return $path_str;
        //return  $this->Html->div('show-path', $path_str);
    }
}

?>
