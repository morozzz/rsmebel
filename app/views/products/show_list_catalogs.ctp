<style type="text/css">

span.catalog-tree-sign {
    padding-right: 5px;
    font-size: 14px;
}

.catalog-tree-name-level0 {
    font-size: 14px;
    font-weight: bold;
}

.catalog-tree-name-level1 {
    font-size: 12px;
    font-weight: normal;
}

.catalog-tree-name-level2 {
    font-size: 11px;
    font-weight: normal;
}

.catalog-tree-selected {
    background-color: #E0E0EB;
}

#catalog-list {
    font-size: 12px;
    font-weight: bold;
}

#catalog-list a {
    color: black;
}

#catalog-list a:hover {
    color: red;
}

input.price-input,
input.cnt-input,
input.sort-order-input {
    width: 40px;
    text-align: right;
}

.change-parent-div {
    padding: 3px 0px;
}

.table-image {
    cursor: pointer;
}

.load-image {
    display: none;
}
</style>

<?php
    echo "<table class=\"align-table\"><tr>";
    echo "<td width='25%'>";
        echo "<ul id=\"catalog-list\">";
            foreach($path_tree as $catalog_id=>$catalog_node) {

                $catalog_class = '';
                if($catalog_id == $catalog['Catalog']['id'])
                    $catalog_class = 'catalog-tree-selected ';
                if(!empty($path[$catalog_id]))
                    $catalog_class .= 'open';

                echo "<li class='$catalog_class'>";
                if($catalog_node['hasChild'])
                    echo "<span class=\"catalog-tree-sign\"></span>";
                echo "<div class=\"catalog-tree-name-level".$catalog_node['level']."\" style=\"display: inline;\">";
                echo $html->link($catalog_node['Catalog']['name'], array(
                    'controller' => 'products',
                    'action' => 'show_list',
                    $catalog_id
                ));
                echo "</div>";
                if($catalog_node['hasChild'])
                    echo "<ul>";
                else
                    echo "</li>";
                for($i=0; $i<$catalog_node['finishBlock']; $i++) {
                    echo "</ul></li>";
                }
            }
        echo "</ul>";
    echo "</td>";

    echo "<td width='75%' style='border-left: 1px dotted #CCCCDD;'>";
        $path_str = '';
        foreach($path as $path_id => $path_name) {
            $path_str .= $html->link($path_name . ' >> ', array(
                'controller' => 'catalogs',
                'action' => 'show',
                $path_id
            ));
        }
        echo $html->div('show-path', $path_str);

        echo $html->div('catalog-caption', $catalog['Catalog']['name']);

        echo "<div class='change-parent-div'>";
        echo $form->create('Catalog', array(
            'action' => 'change_parent',
            'id' => 'change_parent_form'
        ));
        echo "Нахождение: ";
        echo $form->select('parent_id', $catalogs, $catalog['Catalog']['parent_id'], array(
            'style' => 'margin-left: 5px;'
        ), false);
        echo $form->submit('Сменить', array(
            'style' => 'margin-left: 5px;',
            'div' => false
        ));
        echo $form->hidden('id', array(
            'value' => $catalog['Catalog']['id']
        ));
        echo $form->end();
        echo "</div>";

        echo $form->create('Catalog', array(
            'id' => 'catalog-form',
            'action' => 'save_list',
            'type' => 'file'
        ));

        echo "<table class=\"data-table\" id=\"catalog-table\">";

        echo "<thead>";
        echo $html->tableHeaders(array(
            'Название',
            '1С-код',
            'М. изображение',
            'Б. изображение',
            'Сортировка',
            '',
            '',
            '',
            ''
        ));
        echo "</thead>";

        echo "<tbody>";
        foreach($childs as $child) {
            $child_id = $child['Catalog']['id'];
            $small_image_url = (empty($child['SmallImage']['url']))?'nopic.gif':$child['SmallImage']['url'];
            $big_image_url = (empty($child['BigImage']['url']))?'nopic.gif':$child['BigImage']['url'];
            
            echo $html->tableCells(array(
                $child['Catalog']['name'],
                $child['Catalog']['code_1c'],

                $html->image($small_image_url, array(
                    'class' => 'table-image',
                    'id' => 'small-image-'.$child_id,
                    'onclick' => 'show_image("small-image-'.$child_id.'");'
                )).
                $html->div('load-image-link', $html->link('загрузить', '#', array(
                    'onclick' => 'show_load_image_div("small", '.$child_id.');return false;'
                )), array(
                    'id' => 'div-load-small-image-link-'.$child_id
                )).
                $html->div('load-image', $form->file('', array(
                    'name' => 'data[catalogs]['.$child_id.'][small_image_file]',
                    'size' => 10
                )), array(
                    'id' => 'div-load-small-image-'.$child_id
                )),

                $html->image($big_image_url, array(
                    'class' => 'table-image',
                    'id' => 'big-image-'.$child_id,
                    'onclick' => 'show_image("big-image-'.$child_id.'");'
                )).
                $html->div('load-image-link', $html->link('загрузить', '#', array(
                    'onclick' => 'show_load_image_div("big", '.$child_id.');return false;'
                )), array(
                    'id' => 'div-load-big-image-link-'.$child_id
                )).
                $html->div('load-image', $form->file('', array(
                    'name' => 'data[catalogs]['.$child_id.'][big_image_file]',
                    'size' => 10
                )), array(
                    'id' => 'div-load-big-image-'.$child_id
                )),

                "<input type='text' ".
                    "name='data[catalogs][".$child_id."][sort_order]' ".
                    "value='".$child['Catalog']['sort_order']."' ".
                    "class='sort-order-input textbox-int'>",
                $html->div('action',
                        $html->link('нов', array(
                            'controller' => 'catalogs',
                            'action' => 'add',
                            $child_id
                        ))
                ),
                $html->div('action',
                        $html->link('ред', array(
                            'controller' => 'catalogs',
                            'action' => 'edit',
                            $child_id
                        ))
                ),
                $html->div('action',
                        $html->link('удал', array(
                            'controller' => 'catalogs',
                            'action' => 'delete',
                            $child_id
                        ))
                ),
                $html->div('action',
                    $html->link('доб. товар', array(
                        'controller' => 'products',
                        'action' => 'add',
                        $child_id
                    )))
            ) );
        }
        echo "</tbody>";

        echo "</table>";

        echo $html->div('action add-link',
            $html->link('Добавить', array(
                'controller' => 'catalogs',
                'action' => 'add',
                $catalog['Catalog']['id']
            )), array(
                'id' => 'product-add-link'
            )
        );

        echo $form->submit('Сохранить');
        echo $form->end();

    echo "</td>";
    echo "</tr></table>";
?>

<script type="text/javascript">
    enable_validation();

    var webroot = '<?php echo $this->webroot; ?>';

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
    });

    function show_image(image_name) {
        var url = document.getElementById(image_name).src;

        var image = new Image();
        image.src = url;
        $.fumodal({
            'width' : image.width,
            'height' : image.height,
            'style' : false,
            'overlayColor' : '#555599',
            'overlayOpacity' : 0.8,
            'content' : '<img src="' + url + '" title="Нажмите, чтобы закрыть" style="cursor:pointer;" onClick="$.fumodal_close()"/>'
        });
    }

    function show_load_image_div(type, catalog_id) {
        var div_load_small_image_link_id = '#div-load-'+type+'-image-link-'+catalog_id;
        var div_load_small_image_id = '#div-load-'+type+'-image-'+catalog_id;

        $(div_load_small_image_link_id).hide();
        $(div_load_small_image_id).show('blind');
    }
</script>