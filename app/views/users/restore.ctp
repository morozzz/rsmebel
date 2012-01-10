<div class="div-form div-login-form">
    <?php
    echo $form->create('User', array(
        'action' => 'restore',
        'id' => 'user-restore-form'
    ));
    echo $html->tag('h1', 'Восстановление пароля');
    echo $form->input('email', array('label' => 'Введите ваш E-mail:'));
    echo "<font color = red>"; $session->flash(); echo "</font>";

    echo $form->submit('Восстановить');

    echo $form->end();?>

</div>
