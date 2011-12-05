<h2>Фотографии альбома "<?php echo $album['Album']['name'];?>"</h2>
<div class="div-show-path ui-state-default ui-corner-all">
    <a href="<?php echo $html->url('/albums/adm_index/');?>">Фотоальбомы >> </a>
</div>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'AlbumPhoto.id'
        ),
        array(
            'header' => 'Краткое описание',
            'type' => 'text',
            'path' => 'AlbumPhoto.short_about',
            'name' => 'short_note'
        ),
        array(
            'header' => 'Полное описание',
            'type' => 'text',
            'path' => 'AlbumPhoto.long_about',
            'name' => 'short_note'
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
            'header' => 'Сортировка',
            'type' => 'edit',
            'path' => 'AlbumPhoto.sort_order',
            'name' => 'sort_order',
            'sort_column' => 'true'
        )
    ),
    'model_name' => 'AlbumPhoto',
    'id_path' => 'AlbumPhoto.id',
    'link_save_url' => '/album_photos/save_all',
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
), $album_photos);
?>

<script type="text/javascript">
var album_photos = <?php echo $javascript->object($album_photos); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '1000px',
    'model_name' => 'AlbumPhoto',
    'form_action' => 'add',
    'title' => 'Добавление фотографии',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'hidden',
            'name' => 'data[album_id]',
            'value' => $album['Album']['id'],
            'clear_class' => false
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
    'model_name' => 'AlbumPhoto',
    'form_action' => 'delete',
    'title' => 'Удаление фотографии',
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
    var page = album_photos[row_id];
    dialog.find('.dialog-caption').html(page.AlbumPhoto.id);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>