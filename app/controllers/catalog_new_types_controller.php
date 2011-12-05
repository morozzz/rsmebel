<?php

class CatalogNewTypesController extends AppController {
    var $name = 'CatalogNewTypes';
    var $uses = array(
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

    function adm_index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Типы новостей ассортимента';
        $catalog_new_types = $this->CatalogNewType->find('all', array(
            'contain' => array()
        ));
        $catalog_new_types = Set::combine($catalog_new_types, '{n}.CatalogNewType.id', '{n}');
        $this->set('catalog_new_types', $catalog_new_types);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->CatalogNewType);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->CatalogNewType);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->CatalogNewType);
        die;
    }
}

?>
