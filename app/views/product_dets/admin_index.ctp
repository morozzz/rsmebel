<?php
echo $html->tag('h2', $current_product['Product']['name']);
$session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'ProductDet.id'
        ),
        array(
            'header' => '1С-код',
            'type' => 'label',
            'path' => 'ProductDet.code_1c'
        ),
        array(
            'header' => '1С-назв.',
            'type' => 'label',
            'path' => 'ProductDet.name_1c'
        ),
        array(
            'header' => 'Название',
            'type' => 'edit',
            'path' => 'ProductDet.name',
            'name' => 'name'
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
            'path' => 'ProductDet.price',
            'name' => 'price'
        ),
        array(
            'header' => 'Опт. цена',
            'type' => 'edit',
            'path' => 'ProductDet.opt_price',
            'name' => 'opt_price'
        ),
        array(
            'header' => 'Сорт-ка',
            'type' => 'edit',
            'path' => 'ProductDet.sort_order',
            'name' => 'sort_order',
            'sort_column' => true
        )
    ),
    'model_name' => 'ProductDet',
    'id_path' => 'ProductDet.id',
    'sortable' => true,
    'link_save_url' => '/product_dets/admin_save_all',
    'actions' => array(
        'del' => 'Удалить'
    ),
    'buttons' => array(
        'Добавить' => array(
            'func_name' => 'add'
        ),
        'Сохранить' => array(
            'type' => 'save'
        )
    )
), $product_dets);
?>

<script type="text/javascript">
var product_dets = <?php echo $javascript->object($product_dets); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'model_name' => 'ProductDet',
    'form_action' => 'admin_add',
    'title' => 'Добавление детализации',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'hidden',
            'name' => 'data[product_id]',
            'value' => $current_product['Product']['id'],
            'clear_class' => ''
        ),
        array(
            'type' => 'edit',
            'label' => 'Название',
            'name' => 'data[name]'
        ),
//        array(
//            'type' => 'edit',
//            'label' => 'Розн. цена',
//            'name' => 'data[price]'
//        ),
//        array(
//            'type' => 'edit',
//            'label' => 'Опт. цена',
//            'name' => 'data[opt_price]'
//        ),
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
    'dialog_id' => 'dialog-delete',
    'model_name' => 'ProductDet',
    'form_action' => 'admin_delete',
    'title' => 'Удаление детализации',
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
    var page = product_dets[row_id];
    dialog.find('.dialog-caption').html(page.ProductDet.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>