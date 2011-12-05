<style type="text/css">
input.sort-order-input {
    width: 50px;
    text-align: right;
}

.table-image {
    cursor: pointer;
}

.load-image {
    display: none;
}
</style>

<?php
    echo $html->div('table-caption', 'Список каталогов');
    echo $form->create('Catalog', array(
        'action' => 'save_list',
        'id' => 'catalog-save-list-form',
        'type' => 'file'
    ));
    echo "<table class=\"data-table tree-table\" id=\"catalog-tree-table\">";
    echo "<thead>";
    echo $html->tableHeaders(array(
        $html->div('tree-node', 'Название'),
        $html->div('tree-node', '1С-код'),
        $html->div('tree-node', 'М. изображение'),
        $html->div('tree-node', 'Б. изображение'),
        $html->div('tree-node', 'Сортировка'),
        '', '', '', ''
    ));
    echo "</thead>";

    echo "<tbody>";
    foreach($tree as $id => $node) {
        $small_image_url = (empty($node['SmallImage']['url']))?'nopic.gif':$node['SmallImage']['url'];
        $big_image_url = (empty($node['BigImage']['url']))?'nopic.gif':$node['BigImage']['url'];

        echo $html->tableCells(array(
            $html->div('tree-node',
                    $html->link($node['Catalog']['name'], array(
                        'controller' => 'products',
                        'action' => 'show_list',
                        $id
                    ), null, null, false)),
            $node['Catalog']['code_1c'],

            $html->image($small_image_url, array(
                'class' => 'table-image',
                'id' => 'small-image-'.$id,
                'onclick' => 'show_image("small-image-'.$id.'");'
            )).
            $html->div('load-image-link', $html->link('загрузить', '#', array(
                'onclick' => 'show_load_image_div("small", '.$id.');return false;'
            )), array(
                'id' => 'div-load-small-image-link-'.$id
            )).
            $html->div('load-image', $form->file('', array(
                'name' => 'data[catalogs]['.$id.'][small_image_file]',
                'size' => 10
            )), array(
                'id' => 'div-load-small-image-'.$id
            )),

            $html->image($big_image_url, array(
                'class' => 'table-image',
                'id' => 'big-image-'.$id,
                'onclick' => 'show_image("big-image-'.$id.'");'
            )).
            $html->div('load-image-link', $html->link('загрузить', '#', array(
                'onclick' => 'show_load_image_div("big", '.$id.');return false;'
            )), array(
                'id' => 'div-load-big-image-link-'.$id
            )).
            $html->div('load-image', $form->file('', array(
                'name' => 'data[catalogs]['.$id.'][big_image_file]',
                'size' => 10
            )), array(
                'id' => 'div-load-big-image-'.$id
            )),

//            $html->image($node['SmallImage']['url'], array(
//                'class' => 'table-image'
//            )),
//            $html->image($node['BigImage']['url'], array(
//                'class' => 'table-image'
//            )),
            "<input type='text' ".
                "name='data[catalogs][$id][sort_order]' ".
                "value='".$node['Catalog']['sort_order']."' ".
                "class='sort-order-input textbox-int'>",
            $html->div('action',
                    $html->link('нов', array(
                        'controller' => 'catalogs',
                        'action' => 'add',
                        $id
                    ))
            ),
            $html->div('action',
                    $html->link('ред', array(
                        'controller' => 'catalogs',
                        'action' => 'edit',
                        $id
                    ))
            ),
            $html->div('action',
                    $html->link('удал', array(
                        'controller' => 'catalogs',
                        'action' => 'delete',
                        $id
                    ))
            ),
            $html->div('action',
                $html->link('доб. товар', array(
                    'controller' => 'products',
                    'action' => 'add',
                    $id
                )))
            ) );
    }
    echo "</tbody>";
    echo "</table>";

    echo $html->div('action add-link', $html->link('Добавить', array(
        'controller' => 'catalogs',
        'action' => 'add'
    )));
    echo $html->div('action', $html->link('Цвета', array(
        'controller' => 'product_det_param_values',
        'action' => 'index'
    )));
    echo $form->submit('Сохранить');
    echo $form->end();
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