<?php

class ArticleTypeListsController extends AppController {
    var $name = 'ArticleTypeLists';
    var $uses = array(
        'Article',
        'ArticleType',
        'ArticleTypeList'
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

    function adm_index($article_id) {
        $this->layout = 'admin';
        $article = $this->Article->find('first', array(
            'conditions' => array(
                'Article.id' => $article_id
            ),
            'contain' => array()
        ));
        if(empty($article)) {
            $opts = array(
                'name' => 'Неверный номер статьи',
                'code' => 404,
                'message' => 'Данная статья отсутствует',
                'base' => $this->base
            );
            $this->cakeError('error', array($opts));
        }
        $this->set('article', $article);
        $this->pageTitle = "Тематики статьи '{$article['Article']['caption']}'";

        $article_type_lists = $this->ArticleTypeList->find('all', array(
            'conditions' => array(
                'ArticleTypeList.article_id' => $article_id
            ),
            'contain' => array(
                'ArticleType'
            )
        ));
        $article_type_lists = Set::combine($article_type_lists, '{n}.ArticleTypeList.id', '{n}');
        $this->set('article_type_lists', $article_type_lists);

        $article_type_list = $this->ArticleType->find('list');
        $this->set('article_type_list', $article_type_list);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->ArticleTypeList);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->ArticleTypeList);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->ArticleTypeList);
        die;
    }
}

?>
