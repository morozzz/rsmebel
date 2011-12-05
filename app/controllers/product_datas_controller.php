<?php

class ProductDatasController extends AppController {
    var $name = 'ProductDatas';
    var $uses = array(
        'Product',
        'ProductData',
        'ProductParamType',
        'ProductDetParamValue'
    );
    var $helpers = array(
        'AdminCommon'
    );
    var $components = array(
        'AdminCommon'
    );

    function index($product_id) {
        $this->layout = 'admin';
        $product = $this->Product->find('first', array(
            'conditions' => array(
                'Product.id' => $product_id
            ),
            'contain' => array()
        ));
        $this->set('product', $product);
        $this->pageTitle = "Данные товара '{$product['Product']['name']}'";

        $path = $this->Product->getPathLink($product_id, 'admin', 'adm_catalog');
        $this->set('path', $path);

        $product_datas = $this->ProductData->find('all', array(
            'conditions' => array(
                'ProductData.product_id' => $product_id
            ),
            'contain' => array(
            )
        ));
        $product_datas = Set::combine($product_datas, '{n}.ProductData.id', '{n}');
        $this->set('product_datas', $product_datas);

        $product_param_type_list = $this->ProductParamType->find('list');
        $this->set('product_param_type_list', $product_param_type_list);

        $product_det_param_value_list = $this->ProductDetParamValue->find('list');
        $this->set('product_det_param_value_list', $product_det_param_value_list);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->ProductData);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->ProductData);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->ProductData);
        die;
    }
}
?>
