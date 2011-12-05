<h2>Названия столбцов товаров</h2>
<?php if(!empty($path)) { ?>
<div class="div-show-path ui-state-default ui-corner-all">
    <?php echo $common->getPathStr($path);?>
</div>
<?php } ?>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'ProductParamType.id'
        ),
        array(
            'header' => 'Название',
            'type' => 'edit',
            'path' => 'ProductParamType.name',
            'name' => 'name'
        ),
        array(
            'header' => 'Ед. измерения',
            'type' => 'edit',
            'path' => 'ProductParamType.postfix',
            'name' => 'postfix'
        )
    ),
    'model_name' => 'ProductParamType',
    'id_path' => 'ProductParamType.id',
    'link_save_url' => '/product_param_types/save_all',
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
), $product_param_types);
?>

<script type="text/javascript">
var product_param_types = <?php echo $javascript->object($product_param_types); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '500px',
    'model_name' => 'ProductParamType',
    'form_action' => 'add',
    'title' => 'Добавление названия',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Текст',
            'name' => 'data[name]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Ед. измерения',
            'name' => 'data[postfix]'
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
    'model_name' => 'ProductParamType',
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
    var page = product_param_types[row_id];
    dialog.find('.dialog-caption').html(page.ProductParamType.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<script type="text/javascript">
function go_to_values(row_id) {
    window.location = webroot+'product_det_param_values/index/'+row_id+'/<?php echo $product_id;?>';
}
</script>