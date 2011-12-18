<h2>Каталог</h2>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'Catalog.id'
        ),
        array(
            'header' => 'Название',
            'type' => 'edit_dialog',
            'path' => 'Catalog.name',
            'name' => 'name'
        ),
        array(
            'header' => 'Англ. название',
            'type' => 'edit_dialog',
            'path' => 'Catalog.eng_name',
            'name' => 'eng_name'
        ),
        array(
            'header' => 'Родитель',
            'type' => 'combo',
            'path' => 'Catalog.parent_id',
            'name' => 'parent_id',
            'list' => $catalog_list
        ),
        array(
            'header' => 'Код 1С',
            'type' => 'edit',
            'path' => 'Catalog.code_1c',
            'name' => 'code_1c'
        ),
        array(
            'header' => 'Назавние 1С',
            'type' => 'edit',
            'path' => 'Catalog.name_1c',
            'name' => 'name_1c'
        ),
        array(
            'header' => 'Сортировка',
            'type' => 'edit',
            'path' => 'Catalog.sort_order',
            'name' => 'sort_order',
            'sort_column' => 'true'
        )
    ),
    'model_name' => 'Catalog',
    'id_path' => 'Catalog.id',
    'link_save_url' => '/catalogs/admin_save_all',
    'sortable' => true,
    'actions' => array(
        'go_to_products' => 'Перейти к товарам',
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
), $catalogs);
?>

<script type="text/javascript">
var catalogs = <?php echo $javascript->object($catalogs); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'model_name' => 'Catalog',
    'form_action' => 'admin_add',
    'title' => 'Добавление каталога',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Заголовок',
            'name' => 'data[name]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Англ. название',
            'name' => 'data[eng_name]'
        ),
        array(
            'type' => 'combo',
            'label' => 'Родитель',
            'name' => 'data[parent_id]',
            'list' => $catalog_list
        ),
        array(
            'type' => 'edit',
            'label' => 'Код 1С',
            'name' => 'data[code_1c]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Название 1С',
            'name' => 'data[name_1c]'
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
    'model_name' => 'Catalog',
    'form_action' => 'admin_delete',
    'title' => 'Удаление каталога',
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
    var page = catalogs[row_id];
    dialog.find('.dialog-caption').html(page.Catalog.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<script type="text/javascript">
function go_to_products(row_id) {
    window.location = "<?php echo $html->url(array(
        'controller' => 'products',
        'action' => 'admin_index'
    ));?>/"+row_id;
}
</script>