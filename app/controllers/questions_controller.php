<?php

class QuestionsController extends AppController {
    var $name = 'Questions';
    var $uses = array("Question");
    var $components = array('Email', 'SendEmail');
    var $actionJs = array("ckeditor_3.3.1/ckeditor");

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return ($this->curUser['User']['role_id'] == 2 ||
                    $this->curUser['User']['role_id'] == 3);
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('add');
        $this->Auth2->allow('end');
        $this->Auth2->allow('form');
    }
    
    function form() {
        if($this->params['isAjax'] == 1) {
        } else {
            die;
        }
    }

    function end() {
      $this->pageTitle = 'Ваше мнения и вопросы / Торговое оборудование - Анжелика';
    }

    function add() {
      $this->pageTitle = 'Ваше мнения и вопросы / Торговое оборудование - Анжелика';

      if(!empty($this->data)) {

        if(!$this->Question->save($this->data))
          return;
        //Cache::delete('cnews');

        $this->redirect(array(
                    'controller' => 'questions',
                    'action' => 'end'
                ));
      }
    }

    function adm_index() {
      $this->pageTitle = 'Cписок сообщений';
      $this->layout = 'admin';

      $this->set('cur_role_id', $this->curUser['User']['role_id']);
      
      $questions = $this->Question->find('all', array('fields' => array('date_format(Question.created, "%d.%m.%Y") AS stamp',
                                                                              'Question.id',
                                                                              'Question.question_body',
                                                                              'Question.user_name',
                                                                              'Question.phone',
                                                                              'Question.email',
                                                                              'Question.urgent',
                                                                              'Question.q_status'),
                                              'order' => array('stamp DESC, Question.q_status, Question.urgent DESC')
       ));

      $i = 0;
      foreach ($questions as $question) {

        if ($questions[$i]['Question']['urgent'] == 1) {
           $questions[$i]['Question']['urgent'] = "<img src='".$this->webroot."img/exclamation.png'>";
        }
        else {
           $questions[$i]['Question']['urgent'] = "";
        }

        if ($questions[$i]['Question']['q_status'] == 0) {
           $questions[$i]['Question']['q_status_name'] = "Без ответа";
        }
        else if ($questions[$i]['Question']['q_status'] == 1) {
           $questions[$i]['Question']['q_status_name'] = "Ответ по E-mail";
        }
        else if ($questions[$i]['Question']['q_status'] == 2) {
           $questions[$i]['Question']['q_status_name'] = "Ответ по телефону";
        }
        $i++;
      }

      $this->set('questions', $questions);
  
    }

    function change_status($id, $q_status) {

      if (!empty($id)) {

        $this->Question->id = $id;
        
        if (!empty($q_status)) {
            $this->data['Question']['q_status'] = $q_status;
            $this->Question->save($this->data, $fieldList = array('q_status'));
        }
        $this->redirect(array(
                           'controller' => 'questions',
                           'action' => 'adm_index'
                         ));
      }

   }

   function answer_send($id, $to) {
     $this->pageTitle = 'Отправка сообщения пользователю';
     $this->layout = 'admin';

     $this->set('id', $id);
     $this->set('to', $to);

     if (!empty($to)) {

         if (!empty($this->data)) {
                $subject = $this->data['Question']['answer_header'];
                $body    = $this->data['Question']['answer_body'];

                // пробуем отправить
                if(!$this->SendEmail->send($to, $subject, $body))
                {
                  $this->Dispatch->rollback();
                  $this->Session->setFlash('Ошибка сервера. Невозможно отправить сообщение.', 'default', array('class' => 'info-message'));
                  return;
                }

            $this->redirect(array(
                               'controller' => 'questions',
                               'action' => 'change_status/'.$id."/1"
                             ));
         }
     }
   }

  function delete() {
    
    if ($this->curUser['User']['role_id'] == 3) {
        foreach ($this->data['QuestionChk'] as $id => $question){
          $this->Question->id = $id;
          $this->Question->delete();
        }
    }

    $this->redirect(array(
            'controller' => 'questions',
            'action' => 'adm_index'
        ));
  }
}
?>