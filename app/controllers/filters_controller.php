<?php

class FiltersController extends AppController{
    var $name = 'Filters';

    var $uses = array(
        'Filter',
        'FilterType',
        'Catalog',
        'ProductParamType'
    );

    var $helpers = array(
        'AdminCommon',
        'Cache'
    );
    var $components = array(
        'AdminCommon',
        'Common'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function index($catalog_id) {
        $this->layout = 'admin';
        
        $catalog = $this->Catalog->find('first', array(
            'conditions' => array(
                'Catalog.id' => $catalog_id
            ),
            'contain' => array(
//                'Product' => array(
//                    'ProductParam' => array(
//                        'ProductParamType'
//                    )
//                )
            )
        ));
        $this->set('catalog', $catalog);
        $this->pageTitle = "Фильтры для каталога '{$catalog['Catalog']['name']}'";

        $path = $this->Catalog->getPathLink($catalog_id, 'adm_catalog');
        $this->set('path', $path);

        $filters = $this->Filter->find('all', array(
            'conditions' => array(
                'Filter.catalog_id' => $catalog_id
            ),
            'contain' => array()
        ));
        $filters = Set::combine($filters, '{n}.Filter.id', '{n}');
        $this->set('filters', $filters);

        $filter_type_list = $this->FilterType->find('list');
        $this->set('filter_type_list', $filter_type_list);

//        $product_param_type_list = array();
//        foreach($catalog['Product'] as $product) {
//            $product_param_type_list_temp = Set::combine($product['ProductParam'],
//                    '{n}.ProductParamType.id', '{n}.ProductParamType.name');
//            $product_param_type_list += $product_param_type_list_temp;
//        }
//        $this->set('product_param_type_list', $product_param_type_list);
        $product_param_type_list = $this->ProductParamType->find('list');
        $this->set('product_param_type_list', $product_param_type_list);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->Filter);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->Filter);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->Filter);
        die;
    }
}
?>
