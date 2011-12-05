<?php
echo "<div id = 'question-form-dlg'>";
echo "<div align=\"center\" class=\"form form-cke\">";
echo $form->create('Question', array(
    'action' => 'add',
    'id' => 'question-add-form-dlg',
    'type' => 'file'
));

echo $form->inputs(array(
      'legend' => '',
      'Question.question_body' => array(
      'label'       => 'Ваш вопрос/сообщение:',
      'type' => 'textarea',
      'id' => 'question_body-dlg'
      ),
      'Question.user_name' => array(
      'label'      => 'Ваше имя:',
      'id' => 'question_user_name-dlg'
      ),
      'Question.phone' => array(
      'label'      => 'Телефон:',
      'id' => 'question_phone-dlg'
      ),
      'Question.email' => array(
      'label'      => 'E-mail:',
      'id' => 'question_email-dlg'
      ),
      'Question.urgent' => array(
      'label'      => 'Прошу ответить мне срочно',
      'type' => 'checkbox',
      'id' => 'question_urgent-dlg',
      'style' => 'float: left;'
      )
));

echo $form->submit('Отправить', array('id' => 'QuestionSubmit-dlg'));

echo $form->end();
echo "</div>";
echo "</div>";
?>