<?php

class DilerController extends AppController {
    var $name = 'Diler';
    var $uses = array(
        'DilerInfo'
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

        $this->Auth2->allow('add');
    }

    function add() {
        if(!empty($this->data)) {
            $required_fileds = array(
                'fio',
                'workpost',
                'email',
                'phone',
                'city'
            );
            foreach($required_fileds as $require_field) {
                if(empty($this->data[$require_field]) ||
                        $this->data[$require_field]=='') {
                    $this->Session->setFlash('Ошибка! Не все поля заполнены корректно');
                    $this->redirect($this->referer());
                }
            }
            $this->AdminCommon->add($this->data, $this->DilerInfo);
            $this->Session->setFlash('Ваше сообщение успешно отправлено');
        } else {
            $this->Session->setFlash('Ошибка отправки сообщение. Попробуйте повторить позже.');
        }
        $this->redirect($this->referer());
    }

    function index() {
        $diler_infos = $this->DilerInfo->find('all', array(
            'contain' => array()
        ));
        $diler_infos = Set::combine($diler_infos, '{n}.DilerInfo.id', '{n}');
        foreach($diler_infos as &$diler_info) {
            if($diler_info['DilerInfo']['is_new']==1)
                $diler_info['new-class'] = 'tr-diler-new';
            else
                $diler_info['new-class'] = '';
        }
        $this->set('diler_infos', $diler_infos);

        $this->layout = 'admin';
        $this->pageTitle = 'Заявки от поставщиков';
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->DilerInfo);
        die;
    }

    function mark_looked($id) {
        $this->DilerInfo->id = $id;
        $this->DilerInfo->saveField('is_new', 0);
        die;
    }

    function view($id) {
        $this->DilerInfo->id = $id;
        $this->DilerInfo->saveField('is_new', 0);

        $diler_info = $this->DilerInfo->find('first', array(
            'conditions' => array(
                'DilerInfo.id' => $id
            ),
            'contain' => array()
        ));
        $this->set('diler_info', $diler_info);
        
        $this->layout = 'admin';
        $this->pageTitle = 'Заявка от поставщица';
    }
}
?>