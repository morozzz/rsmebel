<h2>Данные товара "<?php echo $product['Product']['name'];?>"</h2>
<div class="div-show-path ui-state-default ui-corner-all">
    <?php echo $common->getPathStr($path);?>
</div>
<?php
$session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'ProductData.id'
        ),
        array(
            'header' => 'Название',
            'type' => 'autocomplete',
            'path' => 'ProductData.product_param_type_id',
            'name' => 'product_param_type_name',
            'list' => $product_param_type_list,
            'js_list_name' => 'product_param_type_list'
        ),
        array(
            'header' => 'Значение',
            'type' => 'autocomplete',
            'path' => 'ProductData.product_det_param_value_id',
            'name' => 'product_det_param_value_name',
            'list' => $product_det_param_value_list,
            'js_list_name' => 'product_det_param_value_list'
        ),
        array(
            'header' => 'Сортировка',
            'type' => 'edit',
            'path' => 'ProductData.sort_order',
            'name' => 'sort_order',
            'sort_column' => true
        )
    ),
    'model_name' => 'ProductData',
    'id_path' => 'ProductData.id',
    'sortable' => true,
    'link_save_url' => '/product_datas/save_all',
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
), $product_datas);
?>

<script type="text/javascript">
var product_datas = <?php echo $javascript->object($product_datas); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '500px',
    'model_name' => 'ProductData',
    'form_action' => 'add',
    'title' => 'Добавление данных',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'autocomplete',
            'label' => 'Название',
            'list' => $product_param_type_list,
            'name' => 'data[product_param_type_name]',
            'js_list_name' => 'd_product_param_type_list'
        ),
        array(
            'type' => 'autocomplete',
            'label' => 'Значение',
            'list' => $product_det_param_value_list,
            'name' => 'data[product_det_param_value_name]',
            'js_list_name' => 'd_product_det_param_value_list'
        ),
        array(
            'type' => 'edit',
            'label' => 'Сортировка',
            'name' => 'data[sort_order]'
        ),
        array(
            'type' => 'hidden',
            'name' => 'data[product_id]',
            'value' => $product['Product']['id'],
            'clear_class' => false
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
    'model_name' => 'ProductData',
    'form_action' => 'delete',
    'title' => 'Удаление данных',
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
    var page = product_datas[row_id];
    dialog.find('.dialog-caption').html(page.ProductData.id);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>