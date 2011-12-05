<?php

class ShortLinksController extends AppController {
    var $name = 'ShortLink';
    var $uses = array(
        'ShortLink'
    );
    var $components = array(
        'AdminCommon'
    );
    var $helpers = array(
        'AdminCommon'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Быстрые ссылки';

        $short_links = $this->ShortLink->find('all');
        $short_links = Set::combine($short_links, '{n}.ShortLink.id', '{n}');
        $this->set('short_links', $short_links);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->ShortLink);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->ShortLink);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->ShortLink);
        die;
    }
}

?>