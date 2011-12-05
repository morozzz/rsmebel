<?php

    echo $common->caption('ОБРАТНАЯ СВЯЗЬ');

    echo "<div id = 'question-form'>";
    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('Question', array(
        'action' => 'add',
        'id' => 'question-add-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => '',
          'Question.question_body' => array(
          'label'       => 'Ваш вопрос/сообщение:',
          'type' => 'textarea',
          'id' => 'question_body'
          ),
          'Question.user_name' => array(
          'label'      => 'Ваше имя:'
          ),
          'Question.phone' => array(
          'label'      => 'Телефон:'
          ),
          'Question.email' => array(
          'label'      => 'E-mail:'
          ),
          'Question.urgent' => array(
          'label'      => 'Прошу ответить мне срочно',
          'type' => 'checkbox'
          )
    ));

    echo $form->hidden('Question.id');

    echo $form->submit('Отправить', array('id' => 'QuestionSubmit'));

    echo $form->end();
    echo "</div>";
    echo "</div>";

    echo "<div>";
      $session->flash();
    echo "</div>";

?>