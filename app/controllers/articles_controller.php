<?php

class ArticlesController extends AppController {
    var $name = 'Articles';
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

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('index');
    }

    function index($article_type_id = 0) {
        $this->pageTitle = 'Статьи';
        $conditions = array();
        if($article_type_id != 0) {
            $dbo = $this->ArticleTypeList->getDataSource();
            $subQuery = $dbo->buildStatement(array(
                'fields' => array(
                    'ArticleTypeList.article_id'
                ),
                'table' => $dbo->fullTableName($this->ArticleTypeList),
                'alias' => 'ArticleTypeList',
                'limit' => null,
                'conditions' => array(
                    'ArticleTypeList.article_type_id' => $article_type_id
                ),
                'order' => null,
                'group' => null
            ), $this->ArticleTypeList);
            $subQuery = "Article.id IN ($subQuery)";
            $conditions[] = $dbo->expression($subQuery);
        }
        $this->paginate = array(
            'Article' => array(
                'conditions' => $conditions,
                'contain' => array(
                    'SmallImage',
                    'ArticlePage' => array(
                        'limit' => 1,
                        'order' => 'ArticlePage.sort_order'
                    )
                ),
                'limit' => 5
            )
        );
        $articles = $this->paginate('Article');
        $this->set('articles', $articles);

        $article_type_list = array(0 => 'Все');
        $article_type_list += $this->ArticleType->find('list');
        $this->set('article_type_list', $article_type_list);

        $this->set('article_type_id', $article_type_id);
    }

    function adm_index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Статьи - редактирование';
        $articles = $this->Article->find('all', array(
            'contain' => array(
                'SmallImage'
            )
        ));
        $articles = Set::combine($articles, '{n}.Article.id', '{n}');
        $this->set('articles', $articles);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->Article);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->Article);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->Article);
        die;
    }
}

?>
