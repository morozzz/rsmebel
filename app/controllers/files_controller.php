<?php

class FilesController extends AppController {
    var $name = 'Files';
    var $uses = array(
        'FFile'
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
        $this->pageTitle = 'Файлы - редактирование';
        $this->FFile->webroot = 'http://'.$this->Session->host.$this->webroot;
        $files = $this->FFile->find('all', array(
            'contain' => array()
        ));
        $files = Set::combine($files, '{n}.FFile.id', '{n}');
        $this->set('files', $files);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->FFile);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->FFile);
        $this->redirect($this->referer());
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->FFile);
        die;
    }

    function upload() {
        $this->FFile->upload($this->data['row_id'], $this->data['file']);
        if(!empty($this->FFile->error)) {
            $this->Session->setFlash($this->FFile->error);
        }
        $this->redirect($this->referer());
        die;
    }
}

?>
