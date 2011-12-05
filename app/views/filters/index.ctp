<h2>Фильтр каталога "<?php echo $catalog['Catalog']['name'];?>"</h2>
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
            'path' => 'Filter.id'
        ),
        array(
            'header' => 'Тип столбца',
            'type' => 'combo',
            'path' => 'Filter.product_param_type_id',
            'name' => 'product_param_type_id',
            'list' => $product_param_type_list
        ),
        array(
            'header' => 'Тип фильтра',
            'type' => 'combo',
            'path' => 'Filter.filter_type_id',
            'name' => 'filter_type_id',
            'list' => $filter_type_list
        ),
        array(
            'header' => 'Сортировка',
            'type' => 'edit',
            'path' => 'Filter.sort_order',
            'name' => 'sort_order',
            'sort_column' => true
        )
    ),
    'model_name' => 'Filter',
    'id_path' => 'Filter.id',
    'sortable' => true,
    'link_save_url' => '/filters/save_all',
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
), $filters);
?>

<script type="text/javascript">
var filters = <?php echo $javascript->object($filters); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '500px',
    'model_name' => 'Filter',
    'form_action' => 'add',
    'title' => 'Добавление фильтра',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'combo',
            'label' => 'Тип столбца',
            'name' => 'data[product_param_type_id]',
            'list' => $product_param_type_list
        ),
        array(
            'type' => 'combo',
            'label' => 'Тип фильтра',
            'name' => 'data[filter_type_id]',
            'list' => $filter_type_list
        ),
        array(
            'type' => 'edit',
            'label' => 'Сортировка',
            'name' => 'data[sort_order]'
        ),
        array(
            'type' => 'hidden',
            'name' => 'data[catalog_id]',
            'value' => $catalog['Catalog']['id'],
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
    'model_name' => 'Filter',
    'form_action' => 'delete',
    'title' => 'Удаление фильтра',
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
    var page = filters[row_id];
    dialog.find('.dialog-caption').html(page.Filter.id);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>