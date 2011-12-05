<h1>Заявки от поставщиков</h1>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'DilerInfo.id'
        ),
        array(
            'header' => 'Дата',
            'type' => 'label',
            'path' => 'DilerInfo.stamp'
        ),
        array(
            'header' => 'ФИО',
            'type' => 'label',
            'path' => 'DilerInfo.fio'
        ),
        array(
            'header' => 'Должность',
            'type' => 'label',
            'path' => 'DilerInfo.workpost'
        ),
        array(
            'header' => 'E-mail',
            'type' => 'label',
            'path' => 'DilerInfo.email'
        ),
        array(
            'header' => 'Телефон',
            'type' => 'label',
            'path' => 'DilerInfo.phone'
        ),
        array(
            'header' => 'Факс',
            'type' => 'label',
            'path' => 'DilerInfo.fax'
        ),
        array(
            'header' => 'Название компании',
            'type' => 'label',
            'path' => 'DilerInfo.company_name'
        ),
        array(
            'header' => 'Город',
            'type' => 'label',
            'path' => 'DilerInfo.city'
        ),
        array(
            'header' => 'Сообщение',
            'type' => 'text',
            'path' => 'DilerInfo.note',
            'name' => 'note'
        )
    ),
    'model_name' => 'DilerInfo',
    'id_path' => 'DilerInfo.id',
    'tr_class_path' => 'new-class',
    'actions' => array(
        'mark_looked' => 'Пометить прочитанным',
        'del' => 'Удалить'
    ),
    'buttons' => array(
    )
), $diler_infos);
?>

<script type="text/javascript">
var diler_infos = <?php echo $javascript->object($diler_infos); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-delete',
    'model_name' => 'DilerInfo',
    'form_url' => '/diler/delete',
    'title' => 'Удаление заявки',
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
    var page = diler_infos[row_id];
    dialog.find('.dialog-caption').html(page.DilerInfo.id);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<script type="text/javascript">
function mark_looked(row_id) {
    $.ajax({
        url: webroot+'diler/mark_looked/'+row_id,
        context: $('#tr'+row_id),
        success: function(data) {
            $(this).removeClass('tr-diler-new');
        }
    });
}
</script>