<h2>Новости ассортимента</h2>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'CatalogNew.id'
        ),
        array(
            'header' => 'Тип новости',
            'type' => 'autocomplete',
            'path' => 'CatalogNew.catalog_new_type_id',
            'name' => 'catalog_new_type_name',
            'list' => $catalog_new_type_list,
            'js_list_name' => "js_catalog_new_type_name"
        ),
        array(
            'header' => 'Каталог',
            'type' => 'combo',
            'path' => 'CatalogNew.catalog_id',
            'name' => 'catalog_id',
            'list' => $catalog_list
        ),
        array(
            'header' => 'Дата',
            'type' => 'date',
            'path' => 'CatalogNew.stamp',
            'name' => 'stamp'
        ),
        array(
            'header' => 'Сортировка',
            'type' => 'edit',
            'path' => 'CatalogNew.sort_order',
            'name' => 'sort_order',
            'sort_column' => true
        )
    ),
    'model_name' => 'CatalogNew',
    'id_path' => 'CatalogNew.id',
    'link_save_url' => '/catalog_news/save_all',
    'sortable' => true,
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
), $catalog_news);
?>

<script type="text/javascript">
var catalog_news = <?php echo $javascript->object($catalog_news); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '500px',
    'model_name' => 'CatalogNew',
    'form_action' => 'add',
    'title' => 'Добавление новости',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'autocomplete',
            'label' => 'Тип новости',
            'name' => 'data[catalog_new_type_name]',
            'list' => $catalog_new_type_list,
            'js_list_name' => "d_js_catalog_new_type_name"
        ),
        array(
            'type' => 'combo',
            'label' => 'Каталог',
            'name' => 'data[catalog_id]',
            'list' => $catalog_list
        ),
        array(
            'type' => 'date',
            'label' => 'Дата',
            'name' => 'data[stamp]'
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
    'model_name' => 'CatalogNew',
    'form_action' => 'delete',
    'title' => 'Удаление новости',
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
    var page = catalog_news[row_id];
    dialog.find('.dialog-caption').html(page.CatalogNew.id);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>