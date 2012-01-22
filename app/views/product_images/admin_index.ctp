<?php
echo $html->tag('h2', $product['Product']['name']);
$session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'ProductImage.id'
        ),
        array(
            'header' => 'Название',
            'type' => 'edit',
            'path' => 'ProductImage.name',
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
            'header' => 'Сорт-ка',
            'type' => 'edit',
            'path' => 'ProductImage.sort_order',
            'name' => 'sort_order',
            'sort_column' => true
        )
    ),
    'model_name' => 'ProductImage',
    'id_path' => 'ProductImage.id',
    'sortable' => true,
    'link_save_url' => '/product_images/admin_save_all',
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
), $product_images);
?>

<script type="text/javascript">
var product_images = <?php echo $javascript->object($product_images); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'model_name' => 'ProductImage',
    'form_action' => 'admin_add',
    'title' => 'Добавление изображения',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'hidden',
            'name' => 'data[product_id]',
            'value' => $product['Product']['id'],
            'clear_class' => false
        ),
        array(
            'type' => 'edit',
            'label' => 'Название',
            'name' => 'data[name]'
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
    'dialog_id' => 'dialog-delete',
    'model_name' => 'ProductImage',
    'form_action' => 'admin_delete',
    'title' => 'Удаление изображения',
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
    var page = product_images[row_id];
    dialog.find('.dialog-caption').html(page.ProductImage.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>