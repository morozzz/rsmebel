<?php

class AlertsController extends AppController {
    var $name = 'Alerts';
    var $uses = array(
        'Alert'
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
        $this->pageTitle = 'Сообщения - редактирование';
        $alerts = $this->Alert->find('all', array(
            'contain' => array()
        ));
        $alerts = Set::combine($alerts, '{n}.Alert.id', '{n}');
        $this->set('alerts', $alerts);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->Alert);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->Alert);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->Alert);
        die;
    }

    function enable($id) {
        $this->Alert->updateAll(array(
            'Alert.enabled' => '0'
        ));

        $this->Alert->id = $id;
        $this->Alert->save(array(
            'id' => $id,
            'enabled' => '1'
        ));

        clearCache();
        $this->redirect($this->referer());
    }

    function disable($id) {
        $this->Alert->updateAll(array(
            'Alert.enabled' => '0'
        ), array(
            'Alert.id' => $id
        ));

        clearCache();
        $this->redirect($this->referer());
    }
}

?>
