<script type="text/javascript">

   function setAddress() {
     jQuery("#ClientInfoJurIndex").attr('value', jQuery("#ClientInfoPostIndex").attr('value'));
     jQuery("#ClientInfoJurRegion").attr('value', jQuery("#ClientInfoPostRegion").attr('value'));
     jQuery("#ClientInfoJurCity").attr('value', jQuery("#ClientInfoPostCity").attr('value'));
     jQuery("#ClientInfoJurStreet").attr('value', jQuery("#ClientInfoPostStreet").attr('value'));
     jQuery("#ClientInfoJurHnumber").attr('value', jQuery("#ClientInfoPostHnumber").attr('value'));
     jQuery("#ClientInfoJurOffice").attr('value', jQuery("#ClientInfoPostOffice").attr('value'));
   }
</script>

<?php

    echo $html->tag('h1', mb_strtoupper($pageTitle));

    echo "<div style = 'text-align: center;'>";
    echo "<font color=red size=5> * </font><b> Поля, отмеченные звездочкой, обязательны для заполнения </b>";
    echo "</div>";

    echo $form->create('User', array(
        'action' => 'register',
        'id' => 'user-register-form'
    ));

    echo "<div style = 'text-align: center;'> ";
    echo "<font color=red>";
      $session->flash();
    echo "</font>";
    echo "</div>";

    $userid = $session->read('Auth.User.id');
    if (empty($userid)) { $userid = -1; }

    echo $form->hidden('User.id');
    echo $form->hidden('ClientInfo.id');

    echo "<div class=\"div-form div-client-type-form\">";
      echo $html->tag('h2', 'КЛИЕНТ');
      echo $form->input('ClientInfo.client_type_id', array('label' => 'Тип клиента:'));
      echo $form->input('ClientInfo.on_news', array('label' => 'Подписаться на новости', 'type' => 'checkbox', 'checked' => 'true'));
    echo "</div>";

    echo "<div class=\"div-form div-data-for-login-form\">";
      echo $html->tag('h2', 'ДАННЫЕ ДЛЯ АВТОРИЗАЦИИ');
      echo $form->input('username', array('label' => 'Логин <font size=4 color = red> * </font>:'));
      echo $form->input('email', array('label' => 'E-mail<font size=4 color = red> * </font>:', 'style' => 'width: 200px;'));
      echo $form->input('password', array('label' => 'Пароль<font size=4 color = red> * </font>:'));
      echo $form->input('password_confirm', array('label' => 'Подтверждение пароля<font size=4 color = red> * </font>:', 'type' => 'password'));
    echo "</div>";

    echo "<div class=\"div-form div-personal-info-form\">";
      echo $html->tag('h2', 'ПЕРСОНАЛЬНАЯ ИНФОРМАЦИЯ');
      echo $form->input('ClientInfo.fio', array('label' => 'ФИО:'));

      echo "<table width = 100%> <tr>";
      echo "<td width = 30%> Телефон: </td>";
      echo "<td width = 10%>";
        echo $form->input('ClientInfo.phone_kod', array('label' => ''));
      echo "</td>";
      echo "<td>";
        echo $form->input('ClientInfo.phone', array('label' => ''));
      echo "</td>";
      echo "</table>";      

      echo "<table width = 100%>";
      echo "<tr>";
          echo "<td width = 30%> Почтовый адрес: </td>";
          echo "<td>";
            echo $form->input('ClientInfo.post_index', array('label' => 'Индекс:'));
          echo "</td>";
          echo "<td>";
            echo $form->input('ClientInfo.post_region', array('label' => 'Регион:'));
          echo "</td>";
      echo "</tr>";
      echo "<tr>";
          echo "<td width = 30%>  </td>";
          echo "<td>";
            echo $form->input('ClientInfo.post_city', array('label' => 'Город:'));
          echo "</td>";
          echo "<td>";
            echo $form->input('ClientInfo.post_street', array('label' => 'Улица:'));
          echo "</td>";
      echo "</tr>";
      echo "<tr>";
          echo "<td width = 30%>  </td>";
          echo "<td>";
            echo $form->input('ClientInfo.post_hnumber', array('label' => 'Дом:'));
          echo "</td>";
          echo "<td>";
            echo $form->input('ClientInfo.post_office', array('label' => 'Кв./Офис'));
          echo "</td>";
      echo "</tr>";
      echo "</table>";

    echo "</div>";

    echo "<div class=\"div-form div-info-form\" id=\"register-opt-client\">";
      echo $html->tag('h2', 'ИНФОРМАЦИЯ О ФИРМЕ ДЛЯ ЗАКАЗОВ В ИНТЕРНЕТ-МАГАЗИНЕ');
        echo $form->input('ClientInfo.company_type_id', array('label' => 'Орг. правовая форма:', 'empty' => 'Выберете из списка'));
        echo $form->input('ClientInfo.profil_type_id', array('label' => 'Профиль деятельности:', 'empty' => 'Выберете из списка'));

        echo $form->input('ClientInfo.name', array('label' => 'Название фирмы<font size=4 color = red> * </font>:', 'size' => '50', 'div' => 'input text div-required'));
        echo $form->input('ClientInfo.reg_num', array('label' => 'Регистрационный номер(ИП):'));
        echo $form->input('ClientInfo.INN', array('label' => 'ИНН:'));
        echo $form->input('ClientInfo.KPP', array('label' => 'КПП(кроме ИП):'));
        echo $form->input('ClientInfo.operating_account', array('label' => 'Расчетный счет:'));
        echo $form->input('ClientInfo.bank', array('label' => 'Банк:'));
        echo $form->input('ClientInfo.correspondent_account', array('label' => 'Корреспондентский счет:'));
        echo $form->input('ClientInfo.BIK', array('label' => 'БИК:'));
        echo $form->input('ClientInfo.OKPO', array('label' => 'ОКПО:'));
        echo $form->input('ClientInfo.OKVED', array('label' => 'ОКВЭД(ОКОНХ):'));

        echo "<table width = 100%> <tr>";
        echo "<td width = 30%> Факс: </td>";
        echo "<td width = 10%>";
          echo $form->input('ClientInfo.fax_kod', array('label' => ''));
        echo "</td>";
        echo "<td>";
          echo $form->input('ClientInfo.fax', array('label' => ''));
        echo "</td>";
        echo "</table>";      

          echo "<table width = 100%>";
          echo "<tr>";
              echo "<td width = 30%> Юр. адрес: </td>";
              echo "<td>";
                echo $form->input('ClientInfo.jur_index', array('label' => 'Индекс:'));
              echo "</td>";
              echo "<td>";
                echo $form->input('ClientInfo.jur_region', array('label' => 'Регион:'));
              echo "</td>";
          echo "</tr>";
          echo "<tr>";
              echo "<td width = 30%>";
                  echo $form->button('=почтовый адрес', array('style' => 'height: 30px; width:135px; font-size: 12px;', 'onClick' => 'setAddress()', 'id' => 'btnPost'));
              echo "</td>";
              echo "<td>";
                echo $form->input('ClientInfo.jur_city', array('label' => 'Город:'));
              echo "</td>";
              echo "<td>";
                echo $form->input('ClientInfo.jur_street', array('label' => 'Улица:'));
              echo "</td>";
          echo "</tr>";
          echo "<tr>";
              echo "<td width = 30%>  </td>";
              echo "<td>";
                echo $form->input('ClientInfo.jur_hnumber', array('label' => 'Дом:'));
              echo "</td>";
              echo "<td>";
                echo $form->input('ClientInfo.jur_office', array('label' => 'Кв./Офис'));
              echo "</td>";
          echo "</tr>";
          echo "</table>";
    echo "</div>";

    echo "<div class='div-register-button'>";
        if($userid <> -1) {
          echo $form->submit('Сохранить изменения');
        }
        else {
          echo $form->submit('Регистрация');
        };
    echo "</div>";

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
       jQuery("#ClientInfoCompanyTypeId").attr('value', null);
       jQuery("#ClientInfoProfilTypeId").attr('value', null);
       jQuery("#ClientInfoName").attr('value', '');
       jQuery("#ClientInfoRegNum").attr('value', '');
       jQuery("#ClientInfoINN").attr('value', '');
       jQuery("#ClientInfoOperatingAccount").attr('value', '');
       jQuery("#ClientInfoBank").attr('value', '');
       jQuery("#ClientInfoCorrespondentAccount").attr('value', '');
       jQuery("#ClientInfoBIK").attr('value', '');
       jQuery("#ClientInfoOKPO").attr('value', '');
       jQuery("#ClientInfoOKVED").attr('value', '');
       jQuery("#ClientInfoFaxKod").attr('value', '');
       jQuery("#ClientInfoFax").attr('value', '');
       jQuery("#ClientInfoJurIndex").attr('value', '');
       jQuery("#ClientInfoJurRegion").attr('value', '');
       jQuery("#ClientInfoJurCity").attr('value', '');
       jQuery("#ClientInfoJurStreet").attr('value', '');
       jQuery("#ClientInfoJurHnumber").attr('value', '');
       jQuery("#ClientInfoJurOffice").attr('value', '');
     }
     else {
       jQuery("#register-opt-client").show();
     }

   }).change();

    var webroot = "<?php echo $this->webroot;?>";
    var uuser_id = "<?php echo $userid;?>";

</script>
