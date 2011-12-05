<h2>
    Значения колонки "<?php echo $product_param_type['ProductParamType']['name'];?>"
</h2>
<?php if(!empty($path)) { ?>
<div class="div-show-path ui-state-default ui-corner-all">
    <?php echo $common->getPathStr($path);?>
</div>
<?php } ?>
<div class="div-show-path ui-state-default ui-corner-all">
    <a href="<?php echo $html->url('/product_param_types/index/'.$product_id);?>"
       class="link-navigation">
        К списку колонок
    </a>
</div>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'ProductDetParamValue.id'
        ),
        array(
            'header' => 'Название',
            'type' => 'edit',
            'path' => 'ProductDetParamValue.name',
            'name' => 'name'
        )
    ),
    'model_name' => 'ProductDetParamValue',
    'id_path' => 'ProductDetParamValue.id',
    'link_save_url' => '/product_det_param_values/save_all',
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
), $product_det_param_values);
?>

<script type="text/javascript">
var product_det_param_values = <?php echo $javascript->object($product_det_param_values); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '500px',
    'model_name' => 'ProductDetParamValue',
    'form_action' => 'add',
    'title' => 'Добавление значения',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Текст',
            'name' => 'data[name]'
        ),
        array(
            'type' => 'hidden',
            'name' => 'data[product_param_type_id]',
            'value' => $product_param_type['ProductParamType']['id'],
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
    'model_name' => 'ProductDetParamValue',
    'form_action' => 'delete',
    'title' => 'Удаление значения',
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
    var page = product_det_param_values[row_id];
    dialog.find('.dialog-caption').html(page.ProductDetParamValue.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>