<?php
echo $html->tag('h2', $catalog['Catalog']['name']);
$session->flash();

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
            'header' => 'Англ. название',
            'type' => 'edit_dialog',
            'path' => 'Product.eng_name',
            'name' => 'eng_name'
        ),
        array(
            'header' => 'Описание',
            'type' => 'text',
            'path' => 'Product.about',
            'name' => 'about'
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
            'header' => 'Розн. цена',
            'type' => 'edit',
            'path' => 'Product.price',
            'name' => 'price'
        ),
        array(
            'header' => 'Опт. цена',
            'type' => 'edit',
            'path' => 'Product.opt_price',
            'name' => 'opt_price'
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
    'sortable' => true,
    'link_save_url' => '/products/admin_save_all',
    'actions' => array(
        'move' => 'Сменить каталог',
        'go_to_det' => 'Детализация товара',
        'go_to_images' => 'Изображения товара',
        'del' => 'Удалить'
    ),
    'buttons' => array(
        'Перенести в другой каталог' => array(
            'func_name' => 'move_list'
        ),
        'Добавить' => array(
            'func_name' => 'add'
        ),
        'Сохранить' => array(
            'type' => 'save'
        )
    )
), $products);
?>

<script type="text/javascript">
var products = <?php echo $javascript->object($products); ?>;
$(function() {
    $('#chb-product').change(function() {
        var checked = $(this).is(":checked");
        $('.chb-product-select').attr('checked', checked);
    })
})
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'model_name' => 'Product',
    'form_action' => 'admin_add',
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
            'type' => 'edit',
            'label' => 'Англ. название',
            'name' => 'data[eng_name]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Розн. цена',
            'name' => 'data[price]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Опт. цена',
            'name' => 'data[opt_price]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Сортировка',
            'name' => 'data[sort_order]'
        )
    )
));
?>

<script type="text/javascript">
function add() {
    $('#dialog-add .input-clear').val('');
    $('#dialog-add').dialog('open');
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-move',
    'model_name' => 'Product',
    'form_action' => 'admin_move',
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
    'dialog_id' => 'dialog-move-list',
    'model_name' => 'Product',
    'form_action' => 'admin_move_list',
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
    'dialog_id' => 'dialog-delete',
    'model_name' => 'Product',
    'form_action' => 'admin_delete',
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
function del(row_id) {
    var dialog = $('#dialog-delete');
    var page = products[row_id];
    dialog.find('.dialog-caption').html(page.Product.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}

function go_to_det(row_id) {
    window.location = webroot+'product_dets/admin_index/'+row_id;
}

function go_to_images(row_id) {
    window.location = webroot+'product_images/admin_index/'+row_id;
}
</script>