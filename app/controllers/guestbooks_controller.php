<?php

class GuestbooksController extends AppController {
    var $name = 'Guestbooks';
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
        $this->Auth2->allow('add');
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
    
    function index() {
        $this->set('current_menu_name', 'guestbook');
        $this->pageTitle = 'Гостевая книга';
        $this->set('breadcrumb', array(
            array('url'=>'/','label'=>'Главная'),
            array('url'=>array('controller'=>'guestbooks','action'=>'index'),'label'=>'Гостевая книга')
        ));
        
        $this->paginate = array(
            'Guestbook' => array(
                'conditions' => array(
                    'Guestbook.enabled' => 1
                ),
                'contain' => array(),
                'limit' => 10
            )
        );
        $guestbooks = $this->paginate('Guestbook');
        $this->set('guestbooks', $guestbooks);
    }
    
    function add() {
        if(!empty($this->data) && !empty($this->data['Guestbook'])) {
            $data = array_merge(array(
                'name'=>'','city'=>'','email'=>'','phone'=>'','text'=>''
            ), $this->data['Guestbook']);
            $this->Guestbook->create();
            $this->Guestbook->save(array(
                'name' => htmlspecialchars($data['name']),
                'city' => htmlspecialchars($data['city']),
                'email' => htmlspecialchars($data['email']),
                'phone' => htmlspecialchars($data['phone']),
                'text' => htmlspecialchars($data['text'])
            ));
            $this->Session->setFlash('Ваше сообщение успешно отправлено и будет опубликовано на сайте после проверки администратором', 'message');
        }
        $this->redirect($this->referer());
    }
}

?>
