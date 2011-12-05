<?php

class ArticleTypesController extends AppController {
    var $name = 'ArticleTypes';
    var $uses = array(
        'ArticleType'
    );
    var $helpers = array(
        'AdminCommon'
    );
    var $components = array(
        'AdminCommon'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return ($this->curUser['User']['role_id'] == 2 ||
                    $this->curUser['User']['role_id'] == 3);
        }
        return true;
    }

    function adm_index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Тематика статей';
        $article_types = $this->ArticleType->find('all', array(
            'contain' => array()
        ));
        $article_types = Set::combine($article_types, '{n}.ArticleType.id', '{n}');
        $this->set('article_types', $article_types);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->ArticleType);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->ArticleType);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->ArticleType);
        die;
    }
}

?>
