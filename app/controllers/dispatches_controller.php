<?php

class DispatchesController extends AppController {
    var $name = 'Dispatches';
    var $uses = array("Dispatch", "User");
    var $components = array('Email', 'SendEmail');

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return ($this->curUser['User']['role_id'] == 2 ||
                    $this->curUser['User']['role_id'] == 3);
        }
        return true;
    }

	function list_dispatches() {
      $this->layout = 'admin';
      $this->pageTitle = 'Рассылки - Отправка';

      if(($dispatches = Cache::read('dispatches')) === false) {
          $dispatches = $this->Dispatch->find('all', array('fields' => array('date_format(Dispatch.created, "%d.%m.%Y") AS stamp',
                                                                                  'Dispatch.id',
                                                                                  'Dispatch.address',
                                                                                  'Dispatch.dispatch_header',
                                                                                  'Dispatch.dispatch_body'),
                                                  'order' => array('Dispatch.created DESC')
           ));
         Cache::write('dispatches', $dispatches);
      }
      $this->set('dispatches', $dispatches);
      
    }

    function add() {
      $this->layout = 'admin';
      $this->pageTitle = 'Рассылки - добавить';

//      $this->User->unbindModel(array(
//          'hasOne' => array('ClientInfo')
//      ));

      $u_users = $this->User->find('all', array('conditions' => array('role_id <> ' => 3)));
      $this->set('u_users', $u_users);

      if(!empty($this->data)) {

          $this->data['Dispatch']['address'] = '';
          foreach($this->data['UserData'] as $u_user_data) {
            $this->data['Dispatch']['address'] = $this->data['Dispatch']['address']."<br>".$u_user_data;
          }

            // формируем список получателей
//            $to = '';
//            foreach($this->data['UserData'] as $u_user_data) {
//              $to  = $to.$u_user_data . ', ';
//            }

            $subject = $this->data['Dispatch']['dispatch_header'];
            $body    = $this->data['Dispatch']['dispatch_body'];
            
            // пробуем отправить
            foreach($this->data['UserData'] as $u_user_data) {
                if(!$this->SendEmail->send_img($u_user_data, $subject, $body))
                {
                  $this->Dispatch->rollback();
                  $this->Session->setFlash('Ошибка сервера. Невозможно отправить сообщение.', 'default', array('class' => 'info-message'));
                  return;
                }
            }

//            if(!$this->_sendEmail('From: info@avto-guide.com',
//                                  $u_user_data,
//                                  $this->data['Dispatch']['dispatch_header'],
//                                  strip_tags($this->data['Dispatch']['dispatch_body'])))
//            {
//              $this->Dispatch->rollback();
//              $this->Session->setFlash('Ошибка сервера. Невозможно отправить сообщение.', 'default', array('class' => 'info-message'));
//              return;
//            }
//            }
      
        $this->Dispatch->create();
        if(!$this->Dispatch->save($this->data))
          return;    
          
        $this->Dispatch->commit();
        Cache::delete('dispatches');
        
        $this->redirect(array(
                'controller' => 'dispatches',
                'action' => 'list_dispatches'
            ));
      
      }
    }

  function delete() {

    if(!empty($this->data)) {
        foreach ($this->data['DispatchChk'] as $id => $dispatch){
          $this->Dispatch->id = $id;
          $this->Dispatch->delete();
        }

      Cache::delete('dispatches');
    }
    $this->redirect(array(
            'controller' => 'dispatches',
            'action' => 'list_dispatches'
        ));
  }


//	function _sendEmail($from, $to, $subj, $body) {
//		$this->Email->to   = $to;
//		$this->Email->from = $from;
//		$this->Email->subject = $subj;
//
//        /* SMTP Options */
//        include("email_config.php");
//
//        $this->Email->smtpOptions = $email_config;
//
//        #  /* Set delivery method */
//        $this->Email->delivery = 'smtp';
//
//		// Attention! Message body going to be wrapped!!!!!	Damn you email component!!!!
//		$this->Email->lineLength = strlen($body);
//		// If want to you templates - dig it yourself
//		return $this->Email->send($body);
//	}

}
?>