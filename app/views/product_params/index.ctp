<h2>Столбцы товара "<?php echo $product['Product']['name'];?>"</h2>
<div class="div-show-path ui-state-default ui-corner-all">
    <?php echo $common->getPathStr($path);?>
</div>
<div class="div-show-path ui-state-default ui-corner-all">
    <a href="<?php echo $html->url('/product_dets/index/'.$product['Product']['id']);?>">Строки >> </a>
    <a href="<?php echo $html->url('/product_param_types/index/'.$product['Product']['id']);?>">Названия столбцов >> </a>
</div>
<?php
$session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'ProductParam.id'
        ),
        array(
            'header' => 'Название',
            'type' => 'autocomplete',
            'path' => 'ProductParam.product_param_type_id',
            'name' => 'product_param_type_name',
            'list' => $product_param_type_list,
            'js_list_name' => 'js_product_param_type_name_list'
        ),
        array(
            'header' => 'Тип',
            'type' => 'combo',
            'path' => 'ProductParam.product_param_show_type_id',
            'name' => 'product_param_show_type_id',
            'list' => $product_param_show_type_list
        ),
        array(
            'header' => 'Сортировка',
            'type' => 'edit',
            'path' => 'ProductParam.sort_order',
            'name' => 'sort_order',
            'sort_column' => true
        )
    ),
    'model_name' => 'ProductParam',
    'id_path' => 'ProductParam.id',
    'sortable' => true,
    'link_save_url' => '/product_params/save_all',
    'actions' => array(
        'go_to_values' => 'Перейти к значениям',
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
), $product_params);
?>

<script type="text/javascript">
var product_params = <?php echo $javascript->object($product_params); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '500px',
    'model_name' => 'ProductParam',
    'form_action' => 'add',
    'title' => 'Добавление столбца',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'autocomplete',
            'label' => 'Название',
            'name' => 'data[product_param_type_name]',
            'list' => $product_param_type_list,
            'js_list_name' => 'd_js_product_param_type_name_list'
        ),
        array(
            'type' => 'combo',
            'label' => 'Тип',
            'name' => 'data[product_param_show_type_id]',
            'list' => $product_param_show_type_list
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
    'model_name' => 'ProductParam',
    'form_action' => 'delete',
    'title' => 'Удаление названия',
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
    var page = product_params[row_id];
    dialog.find('.dialog-caption').html(page.ProductParam.id);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}

function go_to_values(row_id) {
    var page = product_params[row_id];
    var product_param_type_id = page.ProductParam.product_param_type_id
    window.location = webroot+'product_det_param_values/index/'+
        product_param_type_id+'/'+<?php echo $product['Product']['id'];?>;
}
</script>