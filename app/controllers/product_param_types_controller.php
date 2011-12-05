<?php

class ProductParamTypesController extends AppController {
    var $name = 'ProductParamTypes';
    var $uses = array(
        'ProductParamType',
        'Product'
    );
    var $components = array(
        'AdminCommon'
    );
    var $helpers = array(
        'AdminCommon'
    );

    var $cacheAction = array(
        'index' => '1 week'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }
    
    function index($product_id=null) {
        $this->layout = 'admin';
        $this->pageTitle = 'Названия столбцов товаров';

        if(($product_param_types = Cache::read('adm_product_param_types')) === false) {
            $product_param_types = $this->ProductParamType->find('all', array(
                'contain' => array()
            ));
            $product_param_types = Set::combine($product_param_types, '{n}.ProductParamType.id', '{n}');
            Cache::write('adm_product_param_types', $product_param_types);
        }
        $this->set('product_param_types', $product_param_types);

        $path = $this->Product->getPathLink($product_id, 'admin', 'adm_catalog');
        $this->set('product_id', $product_id);
        $this->set('path', $path);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->ProductParamType);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->ProductParamType);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->ProductParamType);
        die;
    }

//    function adm_index() {
//        $this->layout = 'admin';
//        $this->pageTitle = 'Названия колонок товаров';
//        $product_param_types = $this->ProductParamType->find('all', array(
//            'contain' => array()
//        ));
//        $this->set('product_param_types', $product_param_types);
//    }
//
//    function save() {
//        if(!empty($this->data)) {
//            //debug($this->data);die;\
//            if(!empty($this->data['ProductParamType'])) {
//                $real_product_param_types = $this->ProductParamType->find('all');
//                $product_param_types = Set::combine($real_product_param_types, '{n}.ProductParamType.id', '{n}.ProductParamType');
//                foreach($this->data['ProductParamType'] as $product_param_type_id => $product_param_type) {
//                    if(empty($product_param_types[$product_param_type_id])) continue;
//
//                    $real_product_param_type = $product_param_types[$product_param_type_id];
//
//                    if($real_product_param_type['name'] == $product_param_type['name']) continue;
//
//                    $data = array(
//                        'name' => $product_param_type['name']
//                    );
//                    $this->ProductParamType->id = $product_param_type_id;
//                    $this->ProductParamType->save($data);
//                }
//            }
//
//            if(!empty($this->data['ProductParamTypeNew'])) {
//                foreach($this->data['ProductParamTypeNew'] as $product_param_type) {
//                    $data = array(
//                        'name' => $product_param_type['name']
//                    );
//
//                    $this->ProductParamType->create();
//                    $this->ProductParamType->save($data);
//                }
//            }
//        }
//        $this->redirect($this->referer());
//    }
//
//    function delete($id) {
//        $this->ProductParamType->id = $id;
//        $this->ProductParamType->delete();
//
//        $this->redirect($this->referer());
//    }
}

?>