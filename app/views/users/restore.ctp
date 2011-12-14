
<?php

    echo $common->caption('ВОССТАНОВЛЕНИЕ ПАРОЛЯ');

    echo $form->create('User', array(
        'action' => 'restore',
        'id' => 'user-register-form'
    ));

    echo "<div class='form'>";

    echo "<div>";
        echo "<div class=\"body-input\">";
          echo $form->input('email', array('label' => 'Введите ваш E-mail:'));
//          echo $form->error('User/captcha');
//          echo $html->link('сменить код на картинке', '#', array(
//              'class' => 'link-change-captcha',
//              'onclick' => 'return false;'
//          ));
//          echo "<img id='img-captcha' src='".$html->url('/users/captcha')."'>";
//          echo $form->input('User.captcha', array('label' => 'Код на картинке:'));
        echo "</div>";
    echo "</div>";

    echo "<hr color = '#A3A3D3'> </hr>";
    echo $form->submit('Восстановить');

    echo "<div> ";
    echo "<font color = yellow>";
      $session->flash();
    echo "</font>";
    echo "</div>";

    echo $form->end();
    echo "</div>";

?>

<script type="text/javascript">
    var captcha_index = 0;
    jQuery(document).ready(function() {
        jQuery('.link-change-captcha').click(function() {
            var img = jQuery('#img-captcha');
            img.attr('src', '');
            img.attr('src', webroot+'/users/captcha/'+captcha_index);
            captcha_index++;
        })
    });
</script>