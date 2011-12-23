<h2>Информация о компании</h2>
<?php
echo $session->flash();

//Configure::write('debug', 2);
//debug($company_infos);
echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'CompanyInfo.id'
        ),
        array(
            'header' => 'Вкл.',
            'type' => 'checkbox',
            'path' => 'CompanyInfo.enabled',
            'name' => 'enabled'
        ),
        array(
            'header' => 'Англ. название',
            'type' => 'edit',
            'path' => 'CompanyInfo.eng_name',
            'name' => 'eng_name'
        ),
        array(
            'header' => 'Заголовок',
            'type' => 'edit',
            'path' => 'CompanyInfo.caption',
            'name' => 'caption'
        ),
        array(
            'header' => 'Текст',
            'type' => 'text',
            'path' => 'CompanyInfo.text',
            'name' => 'text'
        ),
        array(
            'header' => 'Сортировка',
            'type' => 'edit',
            'path' => 'CompanyInfo.sort_order',
            'name' => 'sort_order',
            'sort_column' => true
        )
    ),
    'model_name' => 'CompanyInfo',
    'id_path' => 'CompanyInfo.id',
    'link_save_url' => '/company_infos/admin_save_all',
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
), $company_infos);
?>

<script type="text/javascript">
var company_infos = <?php echo $javascript->object($company_infos); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '600px',
    'model_name' => 'CompanyInfo',
    'form_action' => 'admin_add',
    'title' => 'Добавление информации',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Англ. название',
            'name' => 'data[eng_name]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Заголовок',
            'name' => 'data[caption]'
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
    'model_name' => 'CompanyInfo',
    'form_action' => 'admin_delete',
    'title' => 'Удаление информации',
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
    var page = company_infos[row_id];
    dialog.find('.dialog-caption').html(page.CompanyInfo.caption);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>