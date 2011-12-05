<?php

class CatalogNewsController extends AppController {
    var $name = 'CatalogNews';
    var $uses = array(
        'Catalog',
        'CatalogNew',
        'CatalogNewType'
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

        $this->Auth2->allow('index');
    }

    function index() {
        $this->pageTitle = 'Новости ассортимента';

        $catalog_news = $this->CatalogNew->find('all', array(
            'contain' => array(
                'CatalogNewType',
                'Catalog'
            )
        ));
        $this->set('catalog_news', $catalog_news);
    }

    function adm_index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Новости ассортимента';
        $catalog_news = $this->CatalogNew->find('all', array(
            'contain' => array()
        ));
        $catalog_news = Set::combine($catalog_news, '{n}.CatalogNew.id', '{n}');
        $this->set('catalog_news', $catalog_news);

        $catalog_list = $this->Catalog->get_list();
        $this->set('catalog_list', $catalog_list);

        $catalog_new_type_list = $this->CatalogNewType->find('list');
        $this->set('catalog_new_type_list', $catalog_new_type_list);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->CatalogNew);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->CatalogNew);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->CatalogNew);
        die;
    }
}

?>
