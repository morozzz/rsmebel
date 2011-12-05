<?php

    echo $html->div('table-caption', 'Добавление/Редактирование пользователя');

    echo $form->create('User', array(
        'action' => 'adm_registr',
        'id' => 'user-add-form'
    ));

    echo $form->hidden('User.id');
    echo $form->hidden('ClientInfo.id');

    echo "<div> ";
      $session->flash();
    echo "</div>";

    echo "<div style = 'text-align: center;'>";
    echo "* Поля, отмеченные звездочкой, обязательны для заполнения";
    echo "</div>";

    echo "<div style = 'padding-bottom: 5px;'>";
      echo "<label for='UserRoleId' id='lbUserType'>ТИП ПОЛЬЗОВАТЕЛЯ:</label>";
      echo "<select id='UserRoleId' name='data[User][role_id]'>";
        foreach ($u_roles as $u_role) {
          echo "<option value='".$u_role['Role']['id']."'>".$u_role['Role']['role_name']."</option>";
        }
        echo "</select>";
    echo "</div>";

    echo "<div style = 'padding-bottom: 5px;'>";
      echo "<label for='UserIsActive' id='lbUserType'>АКТИВНОСТЬ:</label>";
      echo "<select id='UserIsActive' name='data[User][is_active]'>";
        echo "<option value='1'>Создать активным</option>";
        echo "<option value=''>Неактивен</option>";
      echo "</select>";
    echo "</div>";
    echo "<hr color = '#A3A3D3'> </hr>";


    echo "<div class=\"caption\" id=\"register-caption\">ДАННЫЕ ДЛЯ АВТОРИЗАЦИИ(обязательно для заполнения)</div>";

    echo "<div>";

        echo "<div class=\"body-input\">";
          echo $form->input('username', array('label' => 'Логин<font color = red> * </font>:'));
        echo "</div>";
        echo "<div class=\"body-input\">";
          echo "<table width = 100%>";
          echo "<tr>";
          echo "<td align = right>";
              echo $form->input('email', array('label' => 'E-mail<font color = red> * </font>:', 'style' => 'width: 200px;'));
          echo "</td>";
          echo "<td width = 193>";
              echo $form->input('ClientInfo.on_news', array('label' => '<font style="font-weight: normal; font-size: 12px;">Подписаться на новости </font>', 'type' => 'checkbox'));
          echo "</td>";
          echo "</tr>";
          echo "</table>";
        echo "</div>";
        echo "<div class=\"body-input\">";
            echo $form->input('password', array('label' => 'Пароль<font color = red> * </font>:'));
        echo "</div>";
        echo "<div class=\"body-input\">";
            echo $form->input('password_confirm', array('label' => 'Подтверждение пароля<font color = red> * </font>:', 'type' => 'password'));
        echo "</div>";
    echo "</div>";

    echo "<hr color = '#A3A3D3'> </hr>";

    echo "<div class=\"caption\" id=\"register-caption\">ПЕРСОНАЛЬНАЯ ИНФОРМАЦИЯ</div>";

        echo "<div>";
            echo "<div class=\"body-input\">";
                echo $form->input('ClientInfo.fio', array('label' => 'ФИО:'));
            echo "</div>";
            echo "<div class=\"body-input\">";
              echo "<table width = 100%> <tr>";
              echo "<td width = 128>";
                echo $form->label('PostLabel', 'Почтовый адрес:');
              echo "</td>";
              echo "<td>";
                echo "<table width = 100%> <tr>";
                  echo "<td width = 25%>";
                    echo $form->input('ClientInfo.post_index', array('label' => 'Индекс:', 'div' => 'address', 'style' => 'width: 50px;'));
                  echo "</td>";
                  echo "<td>";
                    echo $form->input('ClientInfo.post_region', array('label' => 'Регион:', 'div' => 'address', 'style' => 'width: 120px;'));
                  echo "</td>";
                  echo "<td>";
                    echo $form->input('ClientInfo.post_city', array('label' => 'Город:', 'div' => 'address', 'style' => 'width: 118px;'));
                  echo "</td>";
                  echo "</tr>";
                echo "</tr> </table>";
              echo "</td>";
              echo "</tr>";

              echo "<tr>";
                echo "<td width = 128>";
                echo "</td>";
                echo "<td>";
                echo "<table width = 100%> <tr>";
                  echo "<td width = 45%>";
                    echo $form->input('ClientInfo.post_street', array('label' => 'Улица:', 'div' => 'address', 'style' => 'width: 150px;'));
                  echo "</td>";
                  echo "<td>";
                    echo $form->input('ClientInfo.post_hnumber', array('label' => 'Дом:', 'div' => 'address', 'style' => 'width: 70px;'));
                  echo "</td>";
                  echo "<td>";
                    echo $form->input('ClientInfo.post_office', array('label' => 'Кв./Офис:', 'div' => 'address', 'style' => 'width: 70px;'));
                  echo "</td>";
                  echo "</tr>";
                echo "</tr> </table>";
                echo "</td>";

              echo "</tr>";

              echo "</table>";
            echo "</div>";
        echo "</div>";
        
    echo "<hr color = '#A3A3D3'> </hr>";

    echo $form->submit('Сохранить');
    echo "<div id = 'divCancel'>";
      echo $form->button('Отмена', array('id' => 'btnCancel'));
    echo "</div>";

    echo "</div>";

    echo "<hr color = '#A3A3D3'> </hr>";
    echo $form->end();
?>

<script type="text/javascript">

   var role_id = <?php if(empty($u_role_id)) { echo 'null'; } else { echo $u_role_id; } ?>;
   var is_active = <?php if(empty($is_active)) { echo 'null'; } else { echo $is_active; } ?>;

   jQuery('#UserRoleId').attr('value', role_id);
   jQuery('#UserIsActive').attr('value', is_active);
   
   <?php 
     if ($u_action == 'update') {
       echo "jQuery('#UserPassword').attr('disabled', 'true');";
       echo "jQuery('#UserPasswordConfirm').attr('disabled', 'true');";
     }
     else { 
       echo "jQuery('#UserPassword').attr('disabled', '');";
       echo "jQuery('#UserPasswordConfirm').attr('disabled', '');";
     }
   ?>

   jQuery('#UserPasswordConfirm').attr('value', jQuery('#UserPassword').val());

   jQuery('#btnCancel').click( function(){
     window.location = <?php echo "'".$this->webroot."users/adm_index'"; ?>;
   });


</script>

