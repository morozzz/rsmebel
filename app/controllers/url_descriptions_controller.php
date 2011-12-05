<?php

class UrlDescriptionsController extends AppController {
    var $name = 'UrlDescriptions';
    var $uses = array(
        'UrlDescription'
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

    function adm_index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Управление descriptions';

        $url_descriptions = $this->UrlDescription->get_all();

        $this->set('url_descriptions', $url_descriptions);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->UrlDescription);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->UrlDescription);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->UrlDescription);
        die;
    }
}

?>
