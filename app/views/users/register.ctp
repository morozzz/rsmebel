<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery('#UserCaptcha').val('');
    });

   function setAddress() {
     jQuery("#ClientInfoJurIndex").attr('value', jQuery("#ClientInfoPostIndex").attr('value'));
     jQuery("#ClientInfoJurRegion").attr('value', jQuery("#ClientInfoPostRegion").attr('value'));
     jQuery("#ClientInfoJurCity").attr('value', jQuery("#ClientInfoPostCity").attr('value'));
     jQuery("#ClientInfoJurStreet").attr('value', jQuery("#ClientInfoPostStreet").attr('value'));
     jQuery("#ClientInfoJurHnumber").attr('value', jQuery("#ClientInfoPostHnumber").attr('value'));
     jQuery("#ClientInfoJurOffice").attr('value', jQuery("#ClientInfoPostOffice").attr('value'));
   }
</script>

<cake:nocache>
<div class="top-header hide-menu">
   <?php
     echo $this->element('basket_menu_box');
   ?>
</div>
</cake:nocache>

<?php

    echo $common->caption('ПЕРСОНАЛЬНЫЕ ДАННЫЕ');

    echo $form->create('User', array(
        'action' => 'register',
        'id' => 'user-register-form'
    ));

    $userid = $session->read('Auth.User.id');
    if (empty($userid)) { $userid = -1; }

    echo $form->hidden('User.id');
    echo $form->hidden('ClientInfo.id');

    echo "<div id='div-filial-edit'>";
    echo "</div>";

    echo "<div class='form'>";

    echo "<div> ";
      $session->flash();
    echo "</div>";

    echo "<div style = 'text-align: center;'>";
    echo "<font color=red size=5> * </font><font color=yellow><b> Поля, отмеченные звездочкой, обязательны для заполнения </b> </font>";
    echo "</div>";

    echo "<div class=\"caption\" id=\"register-caption\">КЛИЕНТ</div>";
    echo "<div>";

    echo "<div class=\"body-input div-input-registr\">";
      echo $form->input('ClientInfo.client_type_id', array('label' => 'Тип клиента:'));
    echo "</div>";

    echo "<div class=\"caption\" id=\"register-caption\">ДАННЫЕ ДЛЯ АВТОРИЗАЦИИ(обязательно для заполнения)</div>";

    echo "<div>";

        echo "<div class=\"body-input div-required\">";
          echo $form->input('username', array('label' => 'Логин <font style="font-weight: normal; font-size:12px;">(имя на английском)</font><font size=4 color = red> * </font>:'));
        echo "</div>";
        echo "<div class=\"body-input div-input-registr\">";
        echo "";
        echo "</div>";
        echo "<div class=\"body-input div-required\">";
          echo "<table width = 100%>";
          echo "<tr>";
          echo "<td align = right>";
              echo $form->input('email', array('label' => 'E-mail<font size=4 color = red> * </font>:', 'style' => 'width: 200px;'));
          echo "</td>";
          echo "<td width = 193>";
              echo $form->input('ClientInfo.on_news', array('label' => '<font style="color: white; font-weight: normal; font-size: 12px;">Подписаться на новости </font>', 'type' => 'checkbox', 'checked' => 'true'));
          echo "</td>";
          echo "</tr>";
          echo "</table>";
        echo "</div>";
        echo "<div class=\"body-input div-required\">";
            echo $form->input('password', array('label' => 'Пароль<font size=4 color = red> * </font>:'));
        echo "</div>";
        echo "<div class=\"body-input div-required\">";
            echo $form->input('password_confirm', array('label' => 'Подтверждение пароля<font size=4 color = red> * </font>:', 'type' => 'password'));
        echo "</div>";
    echo "</div>";

    echo "<hr color = '#A3A3D3'> </hr>";

    echo "<div class=\"caption\" id=\"register-caption\">ПЕРСОНАЛЬНАЯ ИНФОРМАЦИЯ</div>";

        echo "<div>";
            echo "<div class=\"body-input div-input-registr\">";
                echo $form->input('ClientInfo.fio', array('label' => 'ФИО:'));
            echo "</div>";
            echo "<div class=\"body-input div-input-registr\">";
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

    echo "<div id=\"register-opt-client\">";
    echo "<div class=\"caption\" id=\"register-caption\">ИНФОРМАЦИЯ О ФИРМЕ ДЛЯ ЗАКАЗОВ В ИНТЕРНЕТ-МАГАЗИНЕ</div>";

        echo "<div>";
            echo "<div class=\"body-input div-input-registr\">";
                echo $form->input('ClientInfo.company_type_id', array('label' => 'Орг. правовая форма:', 'empty' => 'Выберете из списка'));
                echo $form->input('ClientInfo.profil_type_id', array('label' => 'Профиль деятельности:', 'empty' => 'Выберете из списка'));

                echo $form->input('ClientInfo.name', array('label' => 'Название фирмы<font size=4 color = red> * </font>:', 'size' => '50', 'div' => 'input text div-required'));
                echo $form->input('ClientInfo.reg_num', array('label' => 'Регистрационный номер(ИП):', 'size' => '50'));
                echo $form->input('ClientInfo.INN', array('label' => 'ИНН:', 'size' => '50'));
                echo $form->input('ClientInfo.KPP', array('label' => 'КПП(кроме ИП):', 'size' => '50'));
                echo $form->input('ClientInfo.operating_account', array('label' => 'Расчетный счет:', 'size' => '50'));
                echo $form->input('ClientInfo.bank', array('label' => 'Банк:', 'size' => '50'));
                echo $form->input('ClientInfo.correspondent_account', array('label' => 'Корреспондентский счет:', 'size' => '50'));
                echo $form->input('ClientInfo.BIK', array('label' => 'БИК:', 'size' => '50'));
                echo $form->input('ClientInfo.OKPO', array('label' => 'ОКПО:', 'size' => '50'));
                echo $form->input('ClientInfo.OKVED', array('label' => 'ОКВЭД(ОКОНХ):', 'size' => '50'));
            echo "</div>";
            echo "<div class=\"body-input\">";
              echo "<table width = 100%> <tr>";
              echo "<td width = 45% align=right>";
                echo $form->input('ClientInfo.phone_kod', array('label' => 'Телефон:(', 'size' => '10', 'style' => 'width: 50px;', 'div' => 'div-phone-kod'));
              echo "</td>";
              echo "<td style='text-align: left;' valign = center>";
                echo "<div class = 'input text'>";
                  echo $form->label(')');
                echo "</div>";
              echo "</td>";
              echo "<td>";
                echo $form->input('ClientInfo.phone', array('label' => '', 'size' => '50'));
              echo "</td>";
              echo "</table>";
            echo "</div>";
            echo "<div class=\"body-input\">";
              echo "<table width = 100%> <tr>";
              echo "<td width = 45% align=right>";
                echo $form->input('ClientInfo.fax_kod', array('label' => 'Факс:(', 'size' => '10', 'style' => 'width: 50px; margin-left: 3px'));
              echo "</td>";
              echo "<td style='text-align: left'>";
                echo "<div class = 'input text'>";
                  echo $form->label(')');
                echo "</div>";
              echo "</td>";
              echo "<td>";
                echo $form->input('ClientInfo.fax', array('label' => '', 'size' => '50'));
              echo "</td>";
              echo "</table>";
            echo "</div>";
            echo "<div class=\"body-input\">";
              echo "<table width = 100%> <tr>";
              echo "<td width = 128>";
                echo $form->label('PostLabel', 'Юр. адрес:');
              echo "</td>";
              echo "<td>";
                echo "<table width = 100%> <tr>";
                  echo "<td width = 25%>";
                    echo $form->input('ClientInfo.jur_index', array('label' => 'Индекс:', 'div' => 'address', 'style' => 'width: 50px;'));
                  echo "</td>";
                  echo "<td>";
                    echo $form->input('ClientInfo.jur_region', array('label' => 'Регион:', 'div' => 'address', 'style' => 'width: 120px;'));
                  echo "</td>";
                  echo "<td>";
                    echo $form->input('ClientInfo.jur_city', array('label' => 'Город:', 'div' => 'address', 'style' => 'width: 118px;'));
                  echo "</td>";
                  echo "</tr>";
                echo "</tr> </table>";
              echo "</td>";
              echo "</tr>";

              echo "<tr>";
                echo "<td width = 128>";
                  echo $form->button('=почтовый адрес', array('style' => 'height: 30px; width:135px; font-size: 12px;', 'onClick' => 'setAddress()', 'id' => 'btnPost'));
                echo "</td>";
                echo "<td>";
                echo "<table width = 100%> <tr>";
                  echo "<td width = 45%>";
                    echo $form->input('ClientInfo.jur_street', array('label' => 'Улица:', 'div' => 'address', 'style' => 'width: 150px;'));
                  echo "</td>";
                  echo "<td>";
                    echo $form->input('ClientInfo.jur_hnumber', array('label' => 'Дом:', 'div' => 'address', 'style' => 'width: 70px;'));
                  echo "</td>";
                  echo "<td>";
                    echo $form->input('ClientInfo.jur_office', array('label' => 'Кв./Офис:', 'div' => 'address', 'style' => 'width: 70px;'));
                  echo "</td>";
                  echo "</tr>";
                echo "</tr> </table>";
                echo "</td>";

              echo "</tr>";

              echo "</table>";
            echo "</div>";
        echo "</div>";
    echo "</div>";
    echo "<hr color = '#A3A3D3'> </hr>";

    echo "<div class=\"caption\" id=\"register-caption\">ЗАЩИТА ОТ АВТОМАТИЧЕСКИХ РЕГИСТРАЦИЙ</div>";
      echo "<div>";    
            echo "<div class=\"body-input\">";
              echo $form->error('User/captcha');
              //echo "<a id = 'captcha_link' href='#'> сменить код на картинке </a>";
              echo "<br>";
             // echo $html->image($this->requestAction('/users/captcha'), array('id' => 'captcha_img'));
              //echo $ajax->link('сменить код на картинке', array('controller'=>'users','action'=>'captcha'), array('update' => 'captcha_img', 'id' => 'cap_link'));
              echo $html->link('сменить код на картинке', '#', array('id' => 'cap_link', 'onclick' => 'return false;'));
              echo $html->image('/users/captcha', array('id' => 'captcha_img'));
              //echo $html->link('dfgdsg', '#', array('id' => 'cap_link'));
              echo $form->input('User.captcha', array('label' => 'Введите код с картинки в это поле <font size=4 color = red> * </font>:', 'div' => 'input text div-required'));
            echo "</div>";
      echo "</div>";
        
    echo "<hr color = '#A3A3D3'> </hr>";

    if($userid <> -1) {
      echo $form->submit('Сохранить изменения');
    }
    else {
//      echo $form->submit('Регистрация');
        echo "<div class='div-register-button'>";
        echo $form->submit('Регистрация', array(
            'id' => 'btn-register'
        ));
        echo "</div>";
    };

    echo "</div>";
    echo "</div>";

    echo $form->hidden('role_id', array('value' => '1'));
    echo $form->end();
?>

<script type="text/javascript">

   jQuery("#UserPassword").attr('value', '');;
   jQuery("#UserPasswordConfirm").attr('value', '');

   jQuery('#ClientInfoCompanyTypeId').change(function(){
     if (jQuery('#ClientInfoCompanyTypeId').attr('value') == 4) {
       jQuery('#ClientInfoRegNum').attr('disabled', '');
       jQuery('#ClientInfoKPP').attr('disabled', 'true');
     }
     else {
       jQuery('#ClientInfoRegNum').attr('disabled', 'true');
       jQuery('#ClientInfoKPP').attr('disabled', '');
     }

   }).change();

   jQuery('#ClientInfoClientTypeId').change(function(){
     if (jQuery('#ClientInfoClientTypeId').attr('value') == 1) {
       jQuery("#register-opt-client").hide();
     }
     else {
       jQuery("#register-opt-client").show();
     }

   }).change();

    var webroot = "<?php echo $this->webroot;?>";
    var uuser_id = "<?php echo $userid;?>";



    jQuery('#captcha_link').click(function() {
        jQuery.ajax({
            url: webroot+'users/captcha',
            type: 'post',
            success: function(responseText) {
                //var obj = eval(responseText);
                jQuery('#captcha_img').attr('src', '');
                jQuery('#captcha_img').attr('src', webroot+'/users/captcha');
               // alert('111');
            }
        });
     });

     var captcha_index = 0;
    jQuery(document).ready(function() {
        jQuery('#cap_link').click(function() {
              jQuery('#captcha_img').attr('src', '');
              jQuery('#captcha_img').attr('src', webroot+'users/captcha/'+captcha_index);
              captcha_index++;
         });
    });

    jQuery('#user-register-form').submit(function() {
       var password = jQuery('#UserPassword').val();

       if(password != jQuery('#UserPasswordConfirm').val()) {
           jQuery('#UserPassword').focus();
           alert('Введенные пароль и подтверждение пароля не совпадают!');
           return false;
       }
       return true;
    });

</script>
