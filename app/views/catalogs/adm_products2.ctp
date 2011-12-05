<table class="align-table"><tr><td width="200px">
    <?php echo $catalogCommon->getCatalogTreeStr($path_tree, $path, $catalog['Catalog']['id']);?>
</td><td>
    <h1><?php echo $catalog['Catalog']['name'];?></h1>
    <div class="div-show-path ui-state-default ui-corner-all">
        <?php echo $common->getPathStr($path);?>
    </div>
    <?php
    $session->flash();

    if(empty($products)) {
        $buttons = array(
            'Добавить Товар' => array(
                'func_name' => 'add'
            ),
            'Добавить Каталог' => array(
                'func_name' => 'add_catalog'
            )
        );
    } else {
        $buttons = array(
            'Перенести в другой каталог' => array(
                'func_name' => 'move_list'
            ),
            'Объединить' => array(
                'func_name' => 'concat'
            ),
            'Добавить' => array(
                'func_name' => 'add'
            ),
            '.CSV' => array(
                'func_name' => 'get_csv'
            ),
            'Фильтр' => array(
                'func_name' => 'go_to_filter'
            ),
            'Сохранить' => array(
                'type' => 'save'
            )
        );
    }

    echo $adminCommon->table(array(
        'columns' => array(
            array(
                'header' => '<input type="checkbox" id="chb-product"/>',
                'type' => 'checkbox',
                'value' => 0,
                'class' => 'chb-product-select',
                'saving_column' => false
            ),
            array(
                'header' => 'ID',
                'type' => 'label',
                'path' => 'Product.id'
            ),
            array(
                'header' => '1С-код',
                'type' => 'label',
                'path' => 'Product.code_1c'
            ),
            array(
                'header' => '1С-назв.',
                'type' => 'label',
                'path' => 'Product.name_1c'
            ),
            array(
                'header' => 'Название',
                'type' => 'edit_dialog',
                'path' => 'Product.name',
                'name' => 'name'
            ),
            array(
                'header' => 'Краткое описание',
                'type' => 'text',
                'path' => 'Product.short_about',
                'name' => 'short_about'
            ),
            array(
                'header' => 'Полное описание',
                'type' => 'text',
                'path' => 'Product.long_about',
                'name' => 'long_about'
            ),
            array(
                'header' => 'Мал. изобр-е',
                'type' => 'image',
                'path' => 'SmallImage.url',
                'name' => 'SmallImage'
            ),
            array(
                'header' => 'Бол. изобр-е',
                'type' => 'image',
                'path' => 'BigImage.url',
                'name' => 'BigImage'
            ),
            array(
                'header' => 'Производитель',
                'type' => 'combo',
                'path' => 'Product.producer_id',
                'name' => 'producer_id',
                'list' => $producer_list
            ),
            array(
                'header' => 'Артикул',
                'type' => 'edit',
                'path' => 'Product.article',
                'name' => 'article'
            ),
            array(
                'header' => 'Фикс. цену',
                'type' => 'checkbox',
                'path' => 'Product.fix_price',
                'name' => 'fix_price'
            ),
            array(
                'header' => 'Фикс. кол-во',
                'type' => 'checkbox',
                'path' => 'Product.fix_cnt',
                'name' => 'fix_cnt'
            ),
            array(
                'header' => 'Цена',
                'type' => 'edit',
                'path' => 'Product.price',
                'name' => 'price'
            ),
            array(
                'header' => 'Кол-во',
                'type' => 'edit',
                'path' => 'Product.cnt',
                'name' => 'cnt'
            ),
            array(
                'header' => 'Сорт-ка',
                'type' => 'edit',
                'path' => 'Product.sort_order',
                'name' => 'sort_order',
                'sort_column' => true
            )
        ),
        'model_name' => 'Product',
        'id_path' => 'Product.id',
        'tr_class_path' => 'special_class',
        'sortable' => true,
        'link_save_url' => '/products/save_all',
        'top_paginator' => $paginator,
        'actions' => array(
            'go_to_data' => 'Данные для поиска',
            'go_to_param' => 'К параметрам',
            'move' => 'Сменить каталог',
            'product_to_param' => 'Товар в параметры',
            'params_to_products' => 'Параметры в товары',
            'add_to_special' => 'Добавить в спецпредложения',
            'del' => 'Удалить'
        ),
        'buttons' => $buttons
    ), $products);
    ?>
</td></tr></table>

<script type="text/javascript">
var products = <?php echo $javascript->object($products); ?>;
$(function() {
    $('#chb-product').change(function() {
        var checked = $(this).is(":checked");
        console.log(checked);
        $('.chb-product-select').attr('checked', checked);
    })
})
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '1000px',
    'model_name' => 'Product',
    'form_action' => 'add',
    'title' => 'Добавление товара',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'combo',
            'label' => 'Добавить в',
            'list' => $catalog_list,
            'name' => 'data[catalog_id]',
            'value' => $catalog['Catalog']['id']
        ),
        array(
            'type' => 'edit',
            'label' => 'Название',
            'name' => 'data[name]'
        ),
        array(
            'type' => 'file',
            'label' => 'Мал. изображение',
            'name' => 'data[SmallImage]'
        ),
        array(
            'type' => 'file',
            'label' => 'Бол. изображение',
            'name' => 'data[BigImage]'
        ),
        array(
            'type' => 'combo',
            'label' => 'Производитель',
            'list' => $producer_list,
            'name' => 'data[producer_id]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Артикул',
            'name' => 'data[article]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Цена',
            'name' => 'data[price]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Количество',
            'name' => 'data[cnt]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Сортировка',
            'name' => 'data[sort_order]'
        ),
        array(
            'type' => 'text',
            'label' => 'Краткое описание',
            'name' => 'data[short_about]',
            'height' => '70'
        ),
        array(
            'type' => 'text',
            'label' => 'Полное описание',
            'name' => 'data[long_about]',
            'height' => '70'
        )
    ),
    'form_type' => 'file'
));
?>

<script type="text/javascript">
function add() {
    $('#dialog-add .input-clear').val('');
    $('#dialog-add').dialog('open');
}
</script>

<script type="text/javascript">
function get_csv() {
    var catalog_id = <?php echo $catalog['Catalog']['id'];?>;
    window.open(webroot+'catalogs/get_csv/'+catalog_id);
}

function go_to_filter() {
    var catalog_id = <?php echo $catalog['Catalog']['id'];?>;
    window.location = webroot+'filters/index/'+catalog_id;
}
</script>

<script type="text/javascript">
function go_to_data(row_id) {
    window.location = webroot+'product_datas/index/'+row_id;
}

function go_to_param(row_id) {
    window.location = webroot+'product_dets/index/'+row_id;
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-move',
    'model_name' => 'Product',
    'form_action' => 'change_catalog',
    'title' => 'Перемещение товара',
    'ok_caption' => 'Перенести',
    'caption' => ' ',
    'fields' => array(
        array(
            'type' => 'combo',
            'label' => 'Перенести в',
            'name' => 'data[catalog_id]',
            'list' => $catalog_list,
            'value' => $catalog['Catalog']['id']
        ),
        array(
            'type' => 'hidden',
            'name' => 'data[product_id]',
            'input_class' => 'input-row-id',
            'clear_class' => false
        )
    )
))
?>

<script type="text/javascript">
function move(row_id) {
    var dialog = $('#dialog-move');
    var page = products[row_id];
    dialog.find('.dialog-caption').html(page.Product.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-product-to-param',
    'model_name' => 'Product',
    'form_action' => 'move_to_param',
    'title' => 'Перемещение товара в параметры другого товара',
    'ok_caption' => 'Перенести',
    'caption' => ' ',
    'fields' => array(
        array(
            'type' => 'combo',
            'label' => 'Перенести в',
            'name' => 'data[product_id]',
            'list' => $product_list
        ),
        array(
            'type' => 'hidden',
            'name' => 'data[moving_product_id]',
            'input_class' => 'input-row-id',
            'clear_class' => false
        )
    )
))
?>

<script type="text/javascript">
function product_to_param(row_id) {
    var dialog = $('#dialog-product-to-param');
    var page = products[row_id];
    dialog.find('.dialog-caption').html(page.Product.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-params-to-products',
    'model_name' => 'ProductDet',
    'form_action' => 'move_all_to_product',
    'title' => 'Перемещение параметров товара в товары',
    'ok_caption' => 'Перенести',
    'caption' => ' ',
    'fields' => array(
        array(
            'type' => 'combo',
            'label' => 'Перенести в',
            'name' => 'data[catalog_id]',
            'list' => $catalog_list,
            'value' => $catalog['Catalog']['id']
        ),
        array(
            'type' => 'hidden',
            'name' => 'data[product_id]',
            'input_class' => 'input-row-id',
            'clear_class' => false
        )
    )
))
?>

<script type="text/javascript">
function params_to_products(row_id) {
    var dialog = $('#dialog-params-to-products');
    var page = products[row_id];
    dialog.find('.dialog-caption').html(page.Product.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-delete',
    'model_name' => 'Product',
    'form_action' => 'delete',
    'title' => 'Удаление товара',
    'ok_caption' => 'Удалить',
    'caption' => ' ',
    'fields' => array(
        array(
            'type' => 'hidden',
            'name' => 'data[row_id]',
            'input_class' => 'input-row-id',
            'clear_class' => false
        )
    )
));
?>

<script type="text/javascript">
$(document).ready(function() {
    $('tr.tr-special select.select-action-admin option[value=add_to_special]').each(function() {
        $(this).val('delete_from_special');
        $(this).html('Удалить из спецпредложений');
    })
});

function add_to_special(row_id) {
    $.ajax({
        url: webroot+'specials/add/product_id:'+row_id,
        context: $('#tr'+row_id),
        success: function(data) {
            $(this).addClass('tr-special');
            $(this).find('select.select-action-admin option[value=add_to_special]').each(function() {
                $(this).attr('value', 'delete_from_special');
                $(this).html('Удалить из спецпредложений');
            });
        }
    });
}

function delete_from_special(row_id) {
    $.ajax({
        url: webroot+'specials/delete/product_id:'+row_id,
        context: $('#tr'+row_id),
        success: function(data) {
            $(this).removeClass('tr-special');
            $(this).find('select.select-action-admin option[value=delete_from_special]').each(function() {
                $(this).attr('value', 'add_to_special');
                $(this).html('Добавить в спецпредложения');
            });
        }
    });
    var tr = $('#tr'+row_id);
    tr.removeClass('tr-special');
    tr.find('select.select-action-admin option[value=delete_from_special]').each(function() {
        $(this).val('add_to_special');
        $(this).html('Добавить в спецпредложения');
    });
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-move-list',
    'model_name' => 'Product',
    'form_action' => 'move_list',
    'form_class' => 'form-move-list',
    'title' => 'Перенос списка товаров в другой каталог',
    'ok_caption' => 'Перенести',
    'caption' => 'Перенос списка товаров в другой каталог',
    'fields' => array(
        array(
            'type' => 'combo',
            'label' => 'Переместить в',
            'name' => 'data[catalog_id]',
            'list' => $catalog_list,
            'value' => $catalog['Catalog']['id']
        )
    )
));
?>

<script type="text/javascript">
function move_list() {
    var dlg = $('#dialog-move-list');
    var form_move_list = dlg.find('.form-move-list:first');
    form_move_list.find('.input-products_id').remove();
    form_move_list.find('.list-concat-products').remove();

    var list = $("<ul style='margin:0;padding:0px 20px;'></ul>");
    $('input[type=checkbox].chb-product-select:checked').each(function() {
        var tr = $(this).parent().parent();
        var row_id = tr.attr('row_id');
        var page = products[row_id];

        form_move_list.append("<input class='input-products_id' type='hidden' "+
            "name='data[products_id][]' value='"+row_id+"'>");
        list.append("<li>"+row_id+": "+page.Product.name+"</li>");
    });
    var div = $("<div class='list-concat-products'></div>");
    div.append("<h4 style='margin:0;padding:5px;'>Объединяемые товары:</h4>");
    div.append(list);

    form_move_list.append(div);

    dlg.dialog('open');
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-concat',
    'model_name' => 'Product',
    'form_action' => 'concat_products',
    'form_class' => 'form-concat',
    'title' => 'Объединение товаров',
    'ok_caption' => 'Объединить',
    'caption' => 'Объединение товаров',
    'fields' => array(
        array(
            'type' => 'combo',
            'label' => 'Поместить в',
            'name' => 'data[catalog_id]',
            'list' => $catalog_list,
            'value' => $catalog['Catalog']['id']
        ),
        array(
            'type' => 'edit',
            'label' => 'Название',
            'name' => 'data[name]',
            'value' => ''
        )
    )
));
?>

<script type="text/javascript">
function concat() {
    var dlg = $('#dialog-concat');
    var form_concat = dlg.find('.form-concat:first');
    form_concat.find('.input-products_id').remove();
    form_concat.find('.list-concat-products').remove();

    var list = $("<ul style='margin:0;padding:0px 20px;'></ul>");
    $('input[type=checkbox].chb-product-select:checked').each(function() {
        var tr = $(this).parent().parent();
        var row_id = tr.attr('row_id');
        var page = products[row_id];

        form_concat.append("<input class='input-products_id' type='hidden' "+
            "name='data[products_id][]' value='"+row_id+"'>");
        list.append("<li>"+row_id+": "+page.Product.name+"</li>");
    });
    var div = $("<div class='list-concat-products'></div>");
    div.append("<h4 style='margin:0;padding:5px;'>Объединяемые товары:</h4>");
    div.append(list);

    form_concat.append(div);

    dlg.dialog('open');
}
</script>

<script type="text/javascript">
function del(row_id) {
    var dialog = $('#dialog-delete');
    var page = products[row_id];
    dialog.find('.dialog-caption').html(page.Product.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<?php if(empty($products)) {
        echo $adminCommon->dialog_form(array(
            'dialog_id' => 'dialog-add-catalog',
            'width' => '1000px',
            'model_name' => 'Catalog',
            'form_action' => 'add',
            'title' => 'Добавление каталога',
            'ok_caption' => 'Добавить',
            'fields' => array(
                array(
                    'type' => 'combo',
                    'label' => 'Добавить в',
                    'list' => $catalog_list,
                    'name' => 'data[parent_id]',
                    'value' => $catalog['Catalog']['id']
                ),
                array(
                    'type' => 'edit',
                    'label' => 'Название',
                    'name' => 'data[name]'
                ),
                array(
                    'type' => 'file',
                    'label' => 'Мал. изображение',
                    'name' => 'data[SmallImage]'
                ),
                array(
                    'type' => 'file',
                    'label' => 'Бол. изображение',
                    'name' => 'data[BigImage]'
                ),
                array(
                    'type' => 'combo',
                    'label' => 'Производитель',
                    'list' => $producer_list,
                    'name' => 'data[producer_id]'
                ),
                array(
                    'type' => 'edit',
                    'label' => 'Сортировка',
                    'name' => 'data[sort_order]'
                ),
                array(
                    'type' => 'text',
                    'label' => 'Краткое описание',
                    'name' => 'data[short_about_catalog]',
                    'height' => '70'
                ),
                array(
                    'type' => 'text',
                    'label' => 'Полное описание',
                    'name' => 'data[long_about_catalog]',
                    'height' => '70'
                )
            ),
            'form_type' => 'file'
        ));
?>

<script type="text/javascript">
function add_catalog() {
    $('#dialog-add-catalog .input-clear').val('');
    $('#dialog-add-catalog').dialog('open');
}
</script>
<?php } ?>