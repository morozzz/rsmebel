<h1>Спецпредложения</h1>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => '',
            'type' => 'checkbox',
            'value' => 0,
            'class' => 'chb-special-select',
            'saving_column' => false
        ),
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'Special.id'
        ),
        array(
            'header' => 'Товар',
            'type' => 'function',
            'path' => 'path',
            'function' => array(
                'object' => $common,
                'name' => 'getPathStr'
            )
        ),
        array(
            'header' => 'Дата с',
            'type' => 'date',
            'path' => 'Special.date1',
            'name' => 'date1'
        ),
        array(
            'header' => 'Дата по',
            'type' => 'date',
            'path' => 'Special.date2',
            'name' => 'date2'
        ),
        array(
            'header' => 'Вероятность',
            'type' => 'edit',
            'path' => 'Special.prob',
            'name' => 'prob'
        )
    ),
    'model_name' => 'Special',
    'id_path' => 'Special.id',
    'link_save_url' => '/specials/save_all',
    'actions' => array(
        'del' => 'Удалить'
    ),
    'buttons' => array(
        'Сохранить' => array(
            'type' => 'save'
        ),
        'Удалить' => array(
            'func_name' => 'delete_list'
        )
    )
), $specials);
?>

<script type="text/javascript">
var specials = <?php echo $javascript->object($specials); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-delete',
    'model_name' => 'Special',
    'form_action' => 'delete_row',
    'title' => 'Удаление спецпредложения',
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
    var page = specials[row_id];
    dialog.find('.dialog-caption').html(page.Special.id);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-delete-list',
    'model_name' => 'Special',
    'form_action' => 'delete_list',
    'form_class' => 'form-delete-list',
    'title' => 'Удаление спецпредложений',
    'ok_caption' => 'Удалить',
    'caption' => 'Удаление спецпредложений',
    'fields' => array(
    )
));
?>

<script type="text/javascript">
function delete_list() {
    var dlg = $('#dialog-delete-list');
    var form_concat = dlg.find('.form-delete-list:first');
    form_concat.find('.input-specials_id').remove();
    form_concat.find('.list-delete-specials').remove();

    var list = $("<ul style='margin:0;padding:0px 20px;'></ul>");
    $('input[type=checkbox].chb-special-select:checked').each(function() {
        var tr = $(this).parent().parent();
        var row_id = tr.attr('row_id');
        var page = specials[row_id];

        form_concat.append("<input class='input-specials_id' type='hidden' "+
            "name='data[rows_id][]' value='"+row_id+"'>");
        list.append("<li>"+row_id+": "+page.Special.name+"</li>");
    });
    var div = $("<div class='list-delete-specials'></div>");
    div.append("<h4 style='margin:0;padding:5px;'>Удаляемые спецпредложения:</h4>");
    div.append(list);

    form_concat.append(div);

    dlg.dialog('open');
}
</script>