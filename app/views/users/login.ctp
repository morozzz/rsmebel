<div class="div-form div-login-form">
    <?php
    echo $form->create('User', array(
        'action' => 'login',
        'id' => 'user-login-form'
    ));
    echo $html->tag('h1', 'Авторизация');
    echo $form->input('username', array(
        'label' => 'Логин'
    ));
    echo $form->input('password', array(
        'label' => 'Пароль'
    ));
    echo $html->div('div-users-links', 
            $html->link('регистрация', array(
                'controller' => 'users',
                'action' => 'register'
            )).
            ' / '.
            $html->link('забыли пароль?', array(
                'controller' => 'users',
                'action' => 'restore'
            ))
        );
    echo "<font color = red>"; $session->flash(); echo "</font>";
    echo "<font color = red>"; $session->flash('auth'); $session->flash('login'); echo "</font>";

    echo $form->submit('Войти');
    
    echo $form->end();?>
</div>