<?php if(empty($curUser)) {
    echo $html->link('вход', array(
        'controller' => 'users',
        'action' => 'login'
    ), array(
        'class' => 'link-top-login'
    ));
    echo " / ";
    echo $html->link('регистрация', array(
        'controller' => 'users',
        'action' => 'register'
    ), array(
        'class' => 'link-top-register'
    ));
} else { ?>
<div class="div-top-user-menu">
    <?php echo $html->link($curUser['User']['username'], '#', array('class' => 'link-top-user-menu'));?>
    <div class="div-top-menu-items">
        <?php
        echo $html->link('Персональные данные', array(
            'controller' => 'users',
            'action' => 'register'
        ));
        echo $html->link('Список заказов', array(
            'controller' => 'customs',
            'action' => 'index'
        ));
        echo $html->link('Выход', array(
            'controller' => 'users',
            'action' => 'logout'
        ));
        ?>
    </div>
</div>
<?php }?>