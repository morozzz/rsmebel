<h2>Файлы</h2>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'FFile.id'
        ),
        array(
            'header' => 'Имя файла',
            'type' => 'edit',
            'path' => 'FFile.filename',
            'name' => 'filename'
        ),
        array(
            'header' => 'Расширение',
            'type' => 'label',
            'path' => 'FFile.extension'
        ),
        array(
            'header' => 'Ссылка на файл',
            'type' => 'label',
            'path' => 'FFile.link'
        ),
        array(
            'header' => 'Дата',
            'type' => 'date',
            'path' => 'FFile.stamp',
            'name' => 'stamp'
        )
    ),
    'model_name' => 'FFile',
    'id_path' => 'FFile.id',
    'link_save_url' => '/files/save_all',
    'actions' => array(
        'download' => 'Открыть',
        'upload' => 'Закачать',
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
), $files);
?>

<script type="text/javascript">
var files = <?php echo $javascript->object($files); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'model_name' => 'FFile',
    'form_url' => '/files/add',
    'form_type' => 'file',
    'form_action' => 'add',
    'title' => 'Добавление файла',
    'ok_caption' => 'Добавить',
    'is_ajax' => false,
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Имя файла',
            'name' => 'data[filename]'
        ),
        array(
            'type' => 'file',
            'label' => 'Файл',
            'name' => 'data[file]'
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
    'model_name' => 'File',
    'form_url' => '/files/delete',
    'form_action' => 'delete',
    'title' => 'Удаление файла',
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
    var page = files[row_id];
    dialog.find('.dialog-caption').html(page.FFile.filename+'.'+page.FFile.extension);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}

function download(row_id) {
    window.location = files[row_id]['FFile']['link'];
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-upload',
    'model_name' => 'FFile',
    'form_url' => '/files/upload',
    'form_type' => 'file',
    'form_action' => 'upload',
    'title' => 'Закачка файла',
    'ok_caption' => 'Закачать',
    'is_ajax' => false,
    'fields' => array(
        array(
            'type' => 'hidden',
            'name' => 'data[row_id]',
            'input_class' => 'input-row-id',
            'clear_class' => false
        ),
        array(
            'type' => 'file',
            'label' => 'Файл',
            'name' => 'data[file]'
        )
    )
));
?>

<script type="text/javascript">
function upload(row_id) {
    var dialog = $('#dialog-upload');
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');

}
</script>