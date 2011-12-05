<?php

class UrlKeywordsController extends AppController {
    var $name = 'UrlKeywords';
    var $uses = array(
        'UrlKeyword'
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
        $this->pageTitle = 'Управление keywords';

        $url_keywords = $this->UrlKeyword->get_all();

        $this->set('url_keywords', $url_keywords);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->UrlKeyword);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->UrlKeyword);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->UrlKeyword);
        die;
    }
}

?>
