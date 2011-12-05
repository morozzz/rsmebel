<?php

    echo $common->caption('РЕГИСТРАЦИЯ');

    echo $form->create('User', array(
        'action' => 'login',
        'id' => 'user-login-form'
    ));

    //echo "<hr color = '#A3A3D3'> </hr>";
    //echo "<div style = 'font-weight: bolder; font-size: 13px; text-align: left; margin-left: 10px; margin-top: 4px;'><h1>РЕГИСТРАЦИЯ</h1></div>";

    echo "<font color = red>"; $session->flash(); echo "</font>";

    echo "<div style = 'color: yellow; font-weight: bolder; font-size: 14px; text-align: left; margin-left: 20%;'>
             Вход для зарегистрированных пользователей и настройка персональных данных
          </div>";
    echo "<div style = 'font-size: 14px; text-align: left; margin-left: 20%; margin-top: 15px; width:620px;'>
             Введите, пожалуйста, Ваш логин и пароль для входа на закрытую часть сайта или редактирования Ваших персональных данных.
          </div>";
    echo "<div style = 'color: yellow; font-size: 14px; text-align: left; margin-left: 20%; margin-top: 15px; width:620px;'>
             <font color='white'> Если Вы забыли пароль, нажмите </font><a href=".$this->webroot."users/restore>Восстановление пароля</a>.
          </div>";

    echo "<div style = 'font-size: 14px; text-align: center; margin-left: 20%; margin-top: 15px; width:620px;'>";
       echo "<table width = 100%>";
       echo "<tr>";
       echo "<td align=right width = 80%>";
         echo $form->input('User.username', array('label' => 'Логин:   '));
         echo $form->input('User.password', array('label' => 'Пароль:   '));
       echo "</td>";
       echo "<td align=right width = 20%>";
       echo "</td>";
       echo "</tr>";
       echo "<tr>";
//       echo "<td align=right width = 80%>";
//           echo "<table width = 100%>";
//           echo "<tr>";
//           echo "<td align=right width = 100%>";
//              echo $form->submit('Войти');
//           echo "</td>";
//           echo "<td align=right>";
//              echo $form->button('Выслать пароль', array('onClick' => 'sendMail()', 'id' => 'btnSendMail'));
//           echo "</td>";
//           echo "</tr>";
//           echo "</table>";
//       echo "</td>";
       echo "<td align=right width = 20%>";
       echo $form->submit('Войти', array(
           'id' => 'user-login-form-submit'
       ));
       echo "</td>";
       echo "</tr>";       
       echo "</table>";
    echo "</div>";

    echo $form->end();

    echo "<div id='reg-new-user'>";
    echo "<div style = 'text-shadow:0 -2px 4px black;
                        color: yellow; font-weight: bolder; font-size: 14px; text-align: left; padding-left: 20%; background:none repeat scroll 0 0 #373637;'>
             Регистрация нового пользователя
          </div>";

    echo "<div style = 'text-shadow:0 -2px 4px black; color: white;
                        font-size: 14px; text-align: left;
                        padding-left: 20%; padding-top: 4px; padding-bottom: 10px;
                        background:none repeat scroll 0 0 #373637;'>
             Если Вы еще не регистрировались на нашем сайте";
    echo "<font color = red>"; echo $html->link(' Нажмите здесь', '/users/register/'); echo "</font>";
    echo "</div>";
    echo "</div>";

    echo "<font color = red>"; $session->flash('auth'); $session->flash('login'); echo "</font>";

?>