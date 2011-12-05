<?php

class ArticlePagesController extends AppController {
    var $name = 'ArticlePages';
    var $uses = array(
        'Article',
        'ArticlePage',
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

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('index');
    }

    function index($article_id, $article_index = 1) {
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
        $this->pageTitle = $article['Article']['caption'];
        $this->set('article', $article);

        $article_type_lists = $this->ArticleTypeList->find('all', array(
            'conditions' => array(
                'ArticleTypeList.article_id' => $article_id
            ),
            'contain' => array(
                'ArticleType'
            )
        ));
        $this->set('article_type_lists', $article_type_lists);

        $article_page_cnt = $this->ArticlePage->find('count', array(
            'conditions' => array(
                'ArticlePage.article_id' => $article_id
            )
        ));
        $this->set('article_page_cnt', $article_page_cnt);
        if($article_index>$article_page_cnt) {
            $opts = array(
                'name' => 'Неверный номер страницы',
                'code' => 404,
                'message' => 'Данная страница отсутствует',
                'base' => $this->base
            );
            $this->cakeError('error', array($opts));
        }

        $article_page = $this->ArticlePage->find('first', array(
            'conditions' => array(
                'ArticlePage.article_id' => $article_id
            ),
            'page' => $article_index
        ));
        $this->set('article_page', $article_page);

        $this->set('article_index', $article_index);
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
        $this->pageTitle = "Страницы статьи '{$article['Article']['caption']}'";

        $article_pages = $this->ArticlePage->find('all', array(
            'conditions' => array(
                'ArticlePage.article_id' => $article_id
            ),
            'contain' => array()
        ));
        $article_pages = Set::combine($article_pages, '{n}.ArticlePage.id', '{n}');
        $this->set('article_pages', $article_pages);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->ArticlePage);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->ArticlePage);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->ArticlePage);
        die;
    }
}

?>
