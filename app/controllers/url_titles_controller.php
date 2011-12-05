<?php

class UrlTitlesController extends AppController {
    var $name = 'UrlTitles';
    var $uses = array(
        'UrlTitle'
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
        $this->pageTitle = 'Управление titles';

        $url_titles = $this->UrlTitle->get_all();

        $this->set('url_titles', $url_titles);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->UrlTitle);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->UrlTitle);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->UrlTitle);
        die;
    }
}

?>
