<?php

class ProductDetsController extends AppController {
    var $name = 'ProductDets';

    var $uses = array(
        'ProductDet',
        'Catalog',
        'Product',
        'Producer',
        'Image',
        'ProductParam',
        'ProductDetParam',
        'ProductParamType',
        'ProductDetParamValue',
        'Special'
    );

    var $components = array(
        'AdminCommon',
        'CatalogCommon',
        'ProductCommon',
        'Common'
    );

    var $helpers = array(
        'AdminCommon',
        'CatalogCommon'
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

    function index($product_id) {
        $this->layout = 'admin';
        
        $product_dets = $this->ProductDet->find('all', array(
            'conditions' => array(
                'ProductDet.product_id' => $product_id
            ),
            'contain' => array(
                'Special',
                'SmallImage',
                'BigImage',
                'ProductDetParam' => array(
                    'ProductDetParamValue',
                    'ProductParam' => array(
                        'ProductParamType'
                    )
                )
            )
        ));
        $product_dets = Set::combine($product_dets, '{n}.ProductDet.id', '{n}');
        foreach($product_dets as &$product_det) {
            $product_det['ProductDetParam'] = Set::combine($product_det['ProductDetParam'], '{n}.ProductParam.id', '{n}');
        }
        $this->set('product_dets', $product_dets);

        $product_params = $this->ProductParam->find('all', array(
            'conditions' => array(
                'ProductParam.product_id' => $product_id
            ),
            'contain' => array(
                'ProductParamType' => array(
                    'ProductDetParamValue'
                )
            )
        ));
        $this->set('product_params', $product_params);

        $path = $this->Product->getPathLink($product_id, 'admin', 'adm_catalog');
        $this->set('path', $path);

        $producer_list = array(
            0 => 'Не указан'
        );
        $producer_list += $this->Producer->get_list();
        $this->set('producer_list', $producer_list);

        $catalog_list = $this->Catalog->get_list();
        $this->set('catalog_list', $catalog_list);

        $product = $this->Product->find('first', array(
            'conditions' => array(
                'Product.id' => $product_id
            ),
            'contain' => array()
        ));
        $this->set('product', $product);
        $this->pageTitle = "Детализация товара \"{$product['Product']['name']}\"";
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->ProductDet);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->ProductDet);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->ProductDet);
        die;
    }

    function move_to_product() {
        if(!empty($this->data)) {
            $product_det_id = $this->data['product_det_id'];
            $catalog_id = $this->data['catalog_id'];
            $this->ProductDet->move_to_product($product_det_id, $catalog_id);

            $this->AdminCommon->clearModelCache($this->Product);
            $this->AdminCommon->clearModelCache($this->ProductDet);
            $this->AdminCommon->clearModelCache($this->ProductDetParam);
        }
        die;
    }

    function move_all_to_product() {
        if(!empty($this->data)) {
            $product_id = $this->data['product_id'];
            $catalog_id = $this->data['catalog_id'];

            $this->ProductDet->recursive = -1;
            $product_dets = $this->ProductDet->findAllByProductId($product_id);
            foreach($product_dets as $product_det) {
                $this->ProductDet->move_to_product($product_det['ProductDet']['id'], $catalog_id);
            }

            $this->AdminCommon->clearModelCache($this->Product);
            $this->AdminCommon->clearModelCache($this->ProductDet);
            $this->AdminCommon->clearModelCache($this->ProductDetParam);
        }
        die;
    }
}

?>
