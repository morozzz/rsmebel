<h2>Пользователи</h2>
<?php
echo $session->flash();

//echo "<div>Количество активных пользователей: <b>$cnt_active</b></div>";
//echo "<div>Количество неактивных пользователей: <b>$cnt_inactive</b></div>";
?>

<div class="div-filter ui-widget ui-corner-all ui-widget-content">
    <h3>Фильтр</h3>
    <?php echo $form->create('Filter', array(
        'url' => '/users/adm_index'
    ));?>
    <div class="ui-widget ui-corner-all ui-widget-content">
        <div class="div-filter-row">
            <div class="div-filter-label">Тип пользователей</div>
            <div class="div-filter-input">
                <?php
                echo $form->select('role_id', $filter_role_list, $filter['role_id'], array(), false)
                ?>
            </div>
        </div>
        <div class="div-filter-row" style="display: none;">
            <div class="div-filter-label">Активность</div>
            <div class="div-filter-input">
                <?php
                echo $form->select('is_active', $is_active_list, $filter['is_active'], array(), false)
                ?>
            </div>
        </div>
        <div class="div-filter-row" style="display: none;">
            <div class="div-filter-label">IP</div>
            <div class="div-filter-input">
                <?php
                echo $form->text('ip_addr', array(
                    'id' => 'input-filter-ip-addr',
                    'value' => $filter['ip_addr']
                ));
                ?>
            </div>
        </div>
        <?php echo $form->submit('Применить');?>
    </div>
    <?php echo $form->end();?>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#input-filter-ip-addr").autocomplete({
            minLength: 0,
            source: <?php echo $javascript->object($ip_addrs);?>
        });
    })
</script>

<?php
echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => '',
            'type' => 'checkbox',
            'value' => 0,
            'class' => 'chb-user-select',
            'saving_column' => false
        ),
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'User.id'
        ),
        array(
            'header' => 'Логин',
            'type' => 'edit',
            'path' => 'User.username',
            'name' => 'username'
        ),
        array(
            'header' => 'Email',
            'type' => 'edit',
            'path' => 'User.email',
            'name' => 'email'
        ),
        array(
            'header' => 'Тип',
            'type' => 'combo',
            'path' => 'User.role_id',
            'name' => 'role_id',
            'list' => $role_list
        ),
        array(
            'header' => 'Активность',
            'type' => 'checkbox',
            'path' => 'User.is_active',
            'name' => 'is_active'
        ),
//        array(
//            'header' => 'IP',
//            'type' => 'label',
//            'path' => 'User.ip_addr'
//        ),
        array(
            'header' => 'Создан',
            'type' => 'label',
            'path' => 'User.created'
        )
    ),
    'model_name' => 'User',
    'id_path' => 'User.id',
    'link_save_url' => '/users/save_all',
    'sortable' => false,
    'actions' => array(
        'change_password' => 'Сменить пароль',
//        'go_to_log' => 'Показать логи',
        'del' => 'Удалить'
    ),
    'buttons' => array(
        'Добавить' => array(
            'func_name' => 'add'
        ),
        'Сохранить' => array(
            'type' => 'save'
        ),
        'Удалить' => array(
            'func_name' => 'delete_list'
        )
    )
), $u_users);
?>

<script type="text/javascript">
var u_users = <?php echo $javascript->object($u_users); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '400px',
    'model_name' => 'User',
    'form_action' => 'add',
    'title' => 'Добавление пользователя',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'combo',
            'label' => 'Тип',
            'name' => 'data[role_id]',
            'list' => $role_list
        ),
        array(
            'type' => 'edit',
            'label' => 'Логин',
            'name' => 'data[username]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Пароль',
            'name' => 'data[password]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Email',
            'name' => 'data[email]'
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
    'model_name' => 'User',
    'form_action' => 'delete',
    'title' => 'Удаление пользователя',
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
    var page = u_users[row_id];
    dialog.find('.dialog-caption').html(page.User.username);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-change-password',
    'model_name' => 'User',
    'form_action' => 'change_password',
    'title' => 'Смена пароля',
    'ok_caption' => 'Сменить',
    'caption' => ' ',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Новый пароль',
            'name' => 'data[password]'
        ),
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
function change_password(row_id) {
    var dialog = $('#dialog-change-password');
    var page = u_users[row_id];
    dialog.find('.dialog-caption').html(page.User.username);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-delete-list',
    'model_name' => 'User',
    'form_action' => 'delete_list',
    'form_class' => 'form-delete-list',
    'title' => 'Удаление пользователей',
    'ok_caption' => 'Удалить',
    'caption' => 'Удаление пользователей',
    'fields' => array(
    )
));
?>

<script type="text/javascript">
function delete_list() {
    var dlg = $('#dialog-delete-list');
    var form_concat = dlg.find('.form-delete-list:first');
    form_concat.find('.input-users_id').remove();
    form_concat.find('.list-delete-users').remove();

    var list = $("<ul style='margin:0;padding:0px 20px;'></ul>");
    $('input[type=checkbox].chb-user-select:checked').each(function() {
        var tr = $(this).parent().parent();
        var row_id = tr.attr('row_id');
        var page = u_users[row_id];

        form_concat.append("<input class='input-users_id' type='hidden' "+
            "name='data[rows_id][]' value='"+row_id+"'>");
        list.append("<li>"+row_id+": "+page.User.username+"</li>");
    });
    var div = $("<div class='list-delete-users'></div>");
    div.append("<h4 style='margin:0;padding:5px;'>Удаляемые пользователи:</h4>");
    div.append(list);

    form_concat.append(div);

    dlg.dialog('open');
}

function go_to_log(row_id) {
    window.location = webroot+'users/user_logs/'+row_id;
}
</script>