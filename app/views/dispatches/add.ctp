<?php

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('Dispatch', array(
        'action' => 'add',
        'id' => 'dispatch-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Рассылки - добавить',

          'dispatch_header' => array(
            'label'       => 'Тема',
            'value' => ''
          ),
          'dispatch_body' => array(
            'label'       => 'Содержание рассылки',
            'value' => '',
            'id' => 'dispatch_body',
            'type' => 'textarea'
          )
    ));

    echo "<hr color = '#A3A3D3'> </hr>";

   // echo "<fieldset>";
    echo "<legend> <h4> Выберете адресатов </h4><legend>";
    echo "<div id = 'list_user'>";
    $i = 0;
    foreach($u_users as $u_user) {
        echo "<p>";
        echo "<input type='checkbox' value='".$u_user['User']['email']."' name='data[UserData][".$i."]' class = 'chkUser' checked>";

        $user_name = $u_user['User']['username'];
        if (!empty($u_user['ClientInfo']['fio'])) {
          $user_name = $user_name." - ".$u_user['ClientInfo']['fio'];
        }
        if (!empty($u_user['ClientInfo']['name'])) {
          $user_name = $user_name." - ".$u_user['ClientInfo']['name'];
        }
        echo $user_name;
        echo "</p>";
        $i++;
    }
    echo "</div>";
    echo $form->button('Пометить всех', array('id' => 'btnAllCheck'));
    echo $form->button('Снять отметки', array('id' => 'btnCancelCheck'));
    //echo "</fieldset>";

    echo $form->hidden('id');

    echo "<hr color = '#A3A3D3'> </hr>";

    echo $form->submit('Отправить');

    echo $form->end();
    echo "</div>";
    
    echo "<div> ";
      $session->flash();
    echo "</div>";

?>

<script type="text/javascript">
    window.onload = function()
    {
        CKEDITOR.replace('dispatch_body');
    }

    enable_validation();

   $('#btnAllCheck').click( function(){
     $('.chkUser').attr('checked', 'true');
   });

   $('#btnCancelCheck').click( function(){
     $('.chkUser').attr('checked', '');
   });


</script>