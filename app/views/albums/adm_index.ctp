<h2>Фотоальбомы</h2>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'Album.id'
        ),
        array(
            'header' => 'Название',
            'type' => 'edit',
            'path' => 'Album.name',
            'name' => 'name'
        ),
        array(
            'header' => 'Краткое описание',
            'type' => 'text',
            'path' => 'Album.short_about',
            'name' => 'short_about'
        ),
        array(
            'header' => 'Полное описание',
            'type' => 'text',
            'path' => 'Album.long_about',
            'name' => 'long_about'
        ),
        array(
            'header' => 'Изображение',
            'type' => 'image',
            'path' => 'SmallImage.url',
            'name' => 'SmallImage'
        ),
        array(
            'header' => 'Дата',
            'type' => 'date',
            'path' => 'Album.stamp',
            'name' => 'stamp'
        ),
        array(
            'header' => 'Сортировка',
            'type' => 'edit',
            'path' => 'Album.sort_order',
            'name' => 'sort_order',
            'sort_column' => 'true'
        )
    ),
    'model_name' => 'Album',
    'id_path' => 'Album.id',
    'link_save_url' => '/albums/save_all',
    'sortable' => true,
    'actions' => array(
        'go_to_photos' => 'Перейти к фотографиям',
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
), $albums);
?>

<script type="text/javascript">
var albums = <?php echo $javascript->object($albums); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '1000px',
    'model_name' => 'Album',
    'form_action' => 'add',
    'title' => 'Добавление фотоальбома',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Название',
            'name' => 'data[name]'
        ),
//        array(
//            'type' => 'file',
//            'label' => 'Изображение',
//            'name' => 'data[SmallImage]'
//        ),
        array(
            'type' => 'date',
            'label' => 'Дата',
            'name' => 'data[stamp]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Сортировка',
            'name' => 'data[sort_order]'
        ),
        array(
            'type' => 'text',
            'lable' => 'Краткое описание',
            'name' => 'data[short_about]'
        ),
        array(
            'type' => 'text',
            'lable' => 'Полное описание',
            'name' => 'data[long_about]'
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
    'model_name' => 'Album',
    'form_action' => 'delete',
    'title' => 'Удаление фотоальбома',
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
    var page = albums[row_id];
    dialog.find('.dialog-caption').html(page.Album.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<script type="text/javascript">
function go_to_photos(row_id) {
    window.location = webroot+'album_photos/adm_index/'+row_id;
}
</script>