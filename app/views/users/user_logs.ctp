<h2>Лог пользователя "<?php echo $u_user['User']['username'];?>"</h2>
<div class="div-show-path ui-state-default ui-corner-all">
    <?php echo $html->link('Список пользователей', '/users/adm_index');?>
</div>
<?php
echo $session->flash();


echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'UserLog.id'
        ),
        array(
            'header' => 'Тип логирования',
            'type' => 'label',
            'path' => 'UserLogType.name'
        ),
        array(
            'header' => 'IP адрес',
            'type' => 'label',
            'path' => 'UserLog.ip_addr'
        ),
        array(
            'header' => 'Дата',
            'type' => 'label',
            'path' => 'UserLog.stamp'
        )
    ),
    'model_name' => 'UserLog',
    'id_path' => 'UserLog.id',
    //'link_save_url' => '/users/save_all',
    'sortable' => false,
    'actions' => array(
//        'change_password' => 'Сменить пароль',
//        'go_to_filial' => 'Филиалы',
//        'del' => 'Удалить'
    ),
    'buttons' => array(
//        'Добавить' => array(
//            'func_name' => 'add'
//        ),
//        'Сохранить' => array(
//            'type' => 'save'
//        )
    )
), $user_logs);
?>