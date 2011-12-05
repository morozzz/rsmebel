<?php

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('Question', array(
        'action' => 'answer_send/'.$id.'/'.$to,
        'id' => 'question-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Отправка сообщения пользователю',

          'answer_header' => array(
            'label'       => 'Тема',
            'value' => ''
          ),
          'answer_body' => array(
            'label'       => 'Ответ',
            'value' => '',
            'id' => 'answer_body',
            'type' => 'textarea'
          )
    ));

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
        CKEDITOR.replace('answer_body');
    }

    enable_validation();

</script>