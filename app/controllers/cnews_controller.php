<?php

class CnewsController extends AppController {
    var $name = 'Cnews';
    var $uses = array(
        "Cnew"
    );
    var $components = array(
        'AdminCommon'
    );
    var $helpers = array(
        'AdminCommon'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return ($this->curUser['User']['role_id'] == 2 ||
                    $this->curUser['User']['role_id'] == 3);
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('index');
        $this->Auth2->allow('view');
        $this->Auth2->allow('get_cnews');
    }
    
    function admin_index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Администрирование - новости';
        
        $cnews = $this->Cnew->find('all', array(
            'conditions' => array(),
            'contain' => array()
        ));
        $cnews = Set::combine($cnews, '{n}.Cnew.id', '{n}');
        $this->set('cnews', $cnews);
    }

    function admin_save_all() {
        $this->AdminCommon->save_all($this->data, $this->Cnew);
        $this->redirect($this->referer());
        die;
    }

    function admin_add() {
        $this->AdminCommon->add($this->data, $this->Cnew);
        die;
    }

    function admin_delete() {
        $this->AdminCommon->delete($this->data, $this->Cnew);
        die;
    }
    
    function get_cnews() {
        $cnews = $this->Cnew->find('all', array(
            'conditions' => array(
                'Cnew.enabled' => 1
            ),
            'contain' => array()
        ));
        
        if(isset($this->params['requested'])) {
            return $cnews;
        }
    }
    
    function index() {
        $this->pageTitle = 'Новости';
        $this->set('breadcrumb', array(
            array('url'=>'/','label'=>'Главная'),
            array('url'=>array('controller'=>'cnews','action'=>'index'),'label'=>'Новости')
        ));
        
        $this->paginate = array(
            'Cnew' => array(
                'conditions' => array(
                    'Cnew.enabled' => 1
                ),
                'contain' => array()
            )
        );
        $cnews = $this->paginate('Cnew');
        $this->set('cnews', $cnews);
    }
    
    function view($name) {
        $cnew = $this->Cnew->find('first', array(
            'conditions' => array(
                'Cnew.enabled' => 1,
                'Cnew.eng_name' => $name
            ),
            'contain' => array()
        ));
        if(empty($cnew)) {
            $this->cakeError('error', array(
                array(
                    'name' => 'Страница не найдена',
                    'code' => 404,
                    'message' => 'Страница не найдена',
                    'base' => $this->base
                )
            ));
        }
        $this->set('cnew', $cnew);
        
        $this->pageTitle = $cnew['Cnew']['caption'];
        $this->set('breadcrumb', array(
            array('url'=>'/','label'=>'Главная'),
            array('url'=>array('controller'=>'cnews','action'=>'index'),'label'=>'Новости'),
            array('url'=>array('controller'=>'cnews','action'=>'view',$cnew['Cnew']['eng_name']),'label'=>'Новость за '.$cnew['Cnew']['stamp'])
        ));
    }
}
?>