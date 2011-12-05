<?php

class PayTypesController extends AppController {
    var $name = 'PayTypes';
    var $uses = array(
        'PayType'
    );
    var $helpers = array(
        'AdminCommon'
    );
    var $components = array(
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
    }

    function adm_index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Способы оплаты - редактирование';
        $pay_types = $this->PayType->find('all', array(
            'contain' => array()
        ));
        $pay_types = Set::combine($pay_types, '{n}.PayType.id', '{n}');
        $this->set('pay_types', $pay_types);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->PayType);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->PayType);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->PayType);
        die;
    }
}

?>
