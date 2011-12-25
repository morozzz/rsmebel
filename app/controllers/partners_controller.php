<?php

class PartnersController extends AppController {
    var $name = 'Partners';
    var $uses = array(
        'Partner'
    );
    var $components = array(
        'AdminCommon'
    );
    var $helpers = array(
        'AdminCommon'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return ($this->curUser['User']['role_id'] == 3);
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('index');
    }
    
    function admin_index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Администрирование - партнеры';
        
        $partners = $this->Partner->find('all', array(
            'conditions' => array(),
            'contain' => array(
                'Image'
            )
        ));
        $partners = Set::combine($partners, '{n}.Partner.id', '{n}');
        $this->set('partners', $partners);
    }

    function admin_save_all() {
        $this->AdminCommon->save_all($this->data, $this->Partner);
        $this->redirect($this->referer());
        die;
    }

    function admin_add() {
        $this->AdminCommon->add($this->data, $this->Partner);
        die;
    }

    function admin_delete() {
        $this->AdminCommon->delete($this->data, $this->Partner);
        die;
    }
    
    function index() {
        $this->set('current_menu_name', 'partners');
        $this->pageTitle = 'Партнеры';
        $this->set('breadcrumb', array(
            array('url'=>'/','label'=>'Главная'),
            array('url'=>array('controller'=>'partners','action'=>'index'),'label'=>'Партнеры')
        ));
        
        $this->paginate = array(
            'Partner' => array(
                'conditions' => array(
                    'Partner.enabled' => 1
                ),
                'contain' => array(
                    'Image'
                ),
                'limit' => 10
            )
        );
        $partners = $this->paginate('Partner');
        $this->set('partners', $partners);
    }
}

?>
