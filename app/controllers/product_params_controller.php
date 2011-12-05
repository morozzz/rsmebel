<?php

class ProductParamsController extends AppController {
    var $name = 'ProductParams';

    var $uses = array(
        'Product',
        'ProductParam',
        'ProductParamType',
        'ProductParamShowType'
    );

    var $components = array(
        'AdminCommon',
        'CatalogCommon'
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

        $product_params = $this->ProductParam->find('all', array(
            'conditions' => array(
                'ProductParam.product_id' => $product_id
            ),
            'contain' => array()
        ));
        $product_params = Set::combine($product_params, '{n}.ProductParam.id', '{n}');
        $this->set('product_params', $product_params);

        if(($product_param_type_list = Cache::read('product_param_type_list')) === false) {
            $product_param_type_list = $this->ProductParamType->find('list');
            Cache::write('product_param_type_list', $product_param_type_list);
        }
        $this->set('product_param_type_list', $product_param_type_list);

        if(($product_param_show_type_list = Cache::read('product_param_show_type_list')) === false) {
            $product_param_show_type_list = $this->ProductParamShowType->find('list');
            Cache::write('product_param_show_type_list', $product_param_show_type_list);
        }
        $this->set('product_param_show_type_list', $product_param_show_type_list);

        $path = $this->Product->getPathLink($product_id, 'admin', 'adm_catalog');
        $this->set('path', $path);

        $product = $this->Product->find('first', array(
            'conditions' => array(
                'Product.id' => $product_id
            ),
            'contain' => array()
        ));
        $this->set('product', $product);
        $this->pageTitle = "Столбцы товара \"{$product['Product']['name']}\"";
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->ProductParam);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->ProductParam);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->ProductParam);
        die;
    }

//    function adm_index($product_id) {
//        $this->layout = 'admin';
//
//        /*product*/
//        /*********************************************************/
//        $product = $this->Product->find('first', array(
//            'conditions' => array(
//                'Product.id' => $product_id
//            ),
//            'recursive' => -1
//        ));
//        $this->set('product', $product);
//        /*********************************************************/
//
//        $this->pageTitle = 'Столбцы товара "'.$product['Product']['name'].'"';
//
//        /*product params*/
//        /*********************************************************/
//        $this->ProductParam->unbindModel(array(
//            'belongsTo' => array(
//                'Product'
//            ),
//            'hasAndBelongsToMany' => array(
//                'ProductDet'
//            )
//        ));
//        $this->ProductParam->bindModel(array(
//            'belongsTo' => array(
//                'ProductParamShowType'
//            )
//        ));
//        $product_params = $this->ProductParam->find('all', array(
//            'conditions' => array(
//                'ProductParam.product_id' => $product_id
//            )
//        ));
//        $this->set('product_params', $product_params);
//        /*********************************************************/
//
//        $product_param_type_list = $this->ProductParamType->find('list');
//        $this->set('product_param_type_list', $product_param_type_list);
//
//        $product_param_show_type_list = $this->ProductParamShowType->find('list');
//        $this->set('product_param_show_type_list', $product_param_show_type_list);
//
//        /*path*/
//        $path = $this->Catalog->getpath($product['Product']['catalog_id']);
//        $path = Set::combine($path, '{n}.Catalog.id', '{n}.Catalog.name');
//        $this->set('path', $path);
//    }
//
//    function add($product_id = 0) {
//        if(!empty($this->data)) {
//            $product_id = $this->data['ProductParam']['product_id'];
//
//            /*get min sort order*/
//            /******************************************************/
//            $min_sort_order = $this->ProductParam->find('first', array(
//                'fields' => array(
//                    'min(sort_order) AS min_sort_order'
//                ),
//                'conditions' => array(
//                    'ProductParam.product_id' => $product_id
//                ),
//                'recursive' => -1
//            ));
//            $min_sort_order = $min_sort_order[0]['min_sort_order'];
//            /******************************************************/
//
//            /*product param save*/
//            /******************************************************/
//            $data = array(
//                'product_param_type_id' => $this->data['ProductParam']['product_param_type_id'],
//                'product_param_show_type_id' => $this->data['ProductParam']['product_param_show_type_id'],
//                'product_id' => $product_id,
//                'sort_order' => $min_sort_order-1
//            );
//            $this->ProductParam->create();
//            $this->ProductParam->save($data);
//            $product_param_id = $this->ProductParam->id;
//            /******************************************************/
//
//            /*product det param save*/
//            /******************************************************/
//            $product_dets = $this->ProductDet->find('all', array(
//                'conditions' => array(
//                    'ProductDet.product_id' => $product_id
//                ),
//                'recursive' => -1
//            ));
//            foreach($product_dets as $product_det) {
//                $product_det_id = $product_det['ProductDet']['id'];
//                $this->ProductDetParam->create();
//                $this->ProductDetParam->save(array(
//                    'product_det_id' => $product_det_id,
//                    'product_param_id' => $product_param_id
//                ));
//            }
//            /******************************************************/
//            clearCache();
//        }
//        $this->redirect($this->referer());
//    }
//
//    function delete($product_param_id = 0) {
//        if(!empty($this->data)) {
//            $product_param_id = $this->data['product_param_id'];
//
//            $this->ProductDetParam->deleteAll(array(
//                'product_param_id' => $product_param_id
//            ));
//            $this->ProductParam->delete($product_param_id, false);
//            clearCache();
//        }
//        $this->redirect($this->referer());
//    }
//
//    function save_list() {
//        if(!empty($this->data)) {
//            if(!empty($this->data['ProductParam'])) {
//                foreach($this->data['ProductParam'] as $product_param_id => $product_param) {
//                    $data = array();
//
//                    if(!empty($product_param['product_param_type_id'])) {
//                        $data['product_param_type_id'] = $product_param['product_param_type_id'];
//                    }
//
//                    if(!empty($product_param['product_param_show_type_id'])) {
//                        $data['product_param_show_type_id'] = $product_param['product_param_show_type_id'];
//                    }
//
//                    if(!empty($product_param['sort_order'])) {
//                        $data['sort_order'] = $product_param['sort_order'];
//                    }
//
//                    if(!empty($data)) {
//                        $data['id'] = $product_param_id;
//                        $this->ProductParam->id = $product_param_id;
//                        $this->ProductParam->save($data);
//                    }
//                }
//                clearCache();
//            }
//        }
//        $this->redirect($this->referer());
//    }
}

?>
