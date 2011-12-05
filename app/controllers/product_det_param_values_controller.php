<?php

class ProductDetParamValuesController extends AppController {
    var $name = 'ProductDetParamValues';
    var $uses = array(
        'ProductParamType',
        'ProductDetParamValue',
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

    function index($product_param_type_id, $product_id=null) {
        $this->layout = 'admin';

        $product_det_param_values = $this->ProductDetParamValue->find('all', array(
            'conditions' => array(
                'ProductDetParamValue.product_param_type_id' => $product_param_type_id
            ),
            'contain' => array()
        ));
        $product_det_param_values = Set::combine($product_det_param_values, '{n}.ProductDetParamValue.id', '{n}');
        $this->set('product_det_param_values', $product_det_param_values);

        $product_param_type = $this->ProductParamType->find('first', array(
            'conditions' => array(
                'ProductParamType.id' => $product_param_type_id
            ),
            'contain' => array()
        ));
        $this->set('product_param_type', $product_param_type);
        $this->pageTitle = "Значения колонки \"{$product_param_type['ProductParamType']['name']}\"";

        $path = $this->Product->getPathLink($product_id, 'admin', 'adm_catalog');
        $this->set('product_id', $product_id);
        $this->set('path', $path);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->ProductDetParamValue);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->ProductDetParamValue);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->ProductDetParamValue);
        die;
    }
}

?>