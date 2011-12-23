<?php

class GuestbooksController extends AppController {
    var $name = 'Guestbook';
    var $uses = array(
        'Guestbook'
    );
    var $helpers = array(
        'AdminCommon'
    );
    var $components = array(
        'AdminCommon'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth2->allow('index');
    }
    
    function admin_index() {
        $this->pageTitle = 'Администрирование - гостевая';
        $this->layout = 'admin';
        
        $guestbooks = $this->Guestbook->find('all', array(
            'contain' => array()
        ));
        $guestbooks = Set::combine($guestbooks, '{n}.Guestbook.id', '{n}');
        $this->set('guestbooks', $guestbooks);
    }

    function admin_save_all() {
        $this->AdminCommon->save_all($this->data, $this->Guestbook);
        $this->redirect($this->referer());
        die;
    }

    function admin_add() {
        $this->AdminCommon->add($this->data, $this->Guestbook);
        die;
    }

    function admin_delete() {
        $this->AdminCommon->delete($this->data, $this->Guestbook);
        die;
    }
}

?>
