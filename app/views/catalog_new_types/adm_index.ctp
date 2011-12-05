<h2>Типы новостей ассортимента</h2>
<div class="div-show-path ui-state-default ui-corner-all">
    <a href="<?php echo $html->url('/catalog_news/adm_index/');?>">Новости >> </a>
</div>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'CatalogNewType.id'
        ),
        array(
            'header' => 'Название',
            'type' => 'edit',
            'path' => 'CatalogNewType.name',
            'name' => 'name'
        )
    ),
    'model_name' => 'CatalogNewType',
    'id_path' => 'CatalogNewType.id',
    'link_save_url' => '/catalog_new_types/save_all',
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
), $catalog_new_types);
?>

<script type="text/javascript">
var catalog_new_types = <?php echo $javascript->object($catalog_new_types); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '500px',
    'model_name' => 'CatalogNewType',
    'form_action' => 'add',
    'title' => 'Добавление типа',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Название',
            'name' => 'data[name]'
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
    'model_name' => 'CatalogNewType',
    'form_action' => 'delete',
    'title' => 'Удаление типа',
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
    var page = catalog_new_types[row_id];
    dialog.find('.dialog-caption').html(page.CatalogNewType.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>