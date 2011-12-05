<?php

class SpecialsController extends AppController {
    var $name = 'Specials';

    var $uses = array(
        'Special',
        'Catalog',
        'Product',
        'ProductDet',
        'ProductParam',
        'Image'
    );

    var $components = array(
        'AdminCommon',
        'ProductCommon'
    );

    var $helpers = array(
        'AdminCommon',
        'CatalogCommon',
        'ProductCommon'
    );
    var $actionJs = array(
        "jquery.fumodal",
        "common"
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('index');
    }

    function adm_index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Управление спецпредложениями';

        $specials = $this->Special->find('all', array(
          'contain' => array(
              'Product',
              'ProductDet' => array(
                  'Product'
              )
          )
        ));
        $specials = Set::combine($specials, '{n}.Special.id', '{n}');
        if(!empty($specials)) {
            foreach($specials as &$special) {
                $catalog_id = 0;
                $product_id = 0;
                $name = '';
                if(empty($special['Special']['product_id'])) {
                    $special['path'] = array($this->ProductDet->getPathLink(
                            $special['Special']['product_det_id'], 'index', 'admin', 'adm_catalog'));
                } else {
                    $special['path'] = array($this->Product->getPathLink(
                            $special['Special']['product_id'], 'admin', 'adm_catalog'));
                }

                if(empty($special['Product']['id'])) {
                    $special['Special']['name'] = $special['ProductDet']['Product']['name'];
                } else {
                    $special['Special']['name'] = $special['Product']['name'];
                }
            }
        }
        $this->set('specials', $specials);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->Special);
        $this->redirect($this->referer());
        die;
    }

    function delete_row() {
        $this->AdminCommon->delete($this->data, $this->Special);
        die;
    }

    function delete_list() {
        $this->AdminCommon->delete_list($this->data, $this->Special);
        die;
    }

    function add() {
        if($this->params['isAjax'] == 1) {
            $data = array();
            $cnt = 1;
            if(isset($this->params['named']['product_id'])) {
                $product_id = $this->params['named']['product_id'];
                $data['product_id'] = $product_id;
                $cnt = $this->Special->find('count', array(
                    'conditions' => array(
                        'Special.product_id' => $product_id
                    )
                ));
            } else if(isset($this->params['named']['product_det_id'])) {
                $product_det_id = $this->params['named']['product_det_id'];
                $data['product_det_id'] = $product_det_id;
                $cnt = $this->Special->find('count', array(
                    'conditions' => array(
                        'Special.product_det_id' => $product_det_id
                    )
                ));
            }
            if($cnt<=0) {
                $data['date1'] = date('Y.m.d');
                $this->Special->create();
                $this->Special->save($data);
                $special_id = $this->Special->id;
                echo $special_id;

                $this->AdminCommon->clearModelCache($this->Special);
            }
            die;
        }
    }

    function delete() {
        if($this->params['isAjax'] == 1) {
            $conditions = array();
            $cnt = 0;
            if(isset($this->params['named']['product_id'])) {
                $product_id = $this->params['named']['product_id'];
                $cnt = $this->Special->find('count', array(
                    'conditions' => array(
                        'Special.product_id' => $product_id
                    )
                ));
                $conditions['Special.product_id'] = $product_id;
            } else if(isset($this->params['named']['product_det_id'])) {
                $product_det_id = $this->params['named']['product_det_id'];
                $cnt = $this->Special->find('count', array(
                    'conditions' => array(
                        'Special.product_det_id' => $product_det_id
                    )
                ));
                $conditions['Special.product_det_id'] = $product_det_id;
            }

            if($cnt>0) {
                $this->Special->deleteAll($conditions);
                $this->AdminCommon->clearModelCache($this->Special);
            }
        } else {
            if(!empty($this->data['special_id'])) {
                $this->Special->delete($this->data['special_id']);
                $this->AdminCommon->clearModelCache($this->Special);
                $this->redirect($this->referer());
            }
        }
    }

    function index() {
        $this->pageTitle = 'Спецпредложения';

        $this->paginate = array(
            'Special' => array(
                'conditions' => array(
                    array(
                        'or' => array(
                            'Special.date2 >= ' => date('Y.m.d'),
                            'Special.date2' => null
                        )
                    ),
                    array(
                        'or' => array(
                            'Special.date1 <= ' => date('Y.m.d'),
                            'Special.date1' => null
                        )
                    )
                ),
                'contain' => array(
                    'ProductDet'
                ),
                'limit' => 9
            )
        );
        $specials = $this->paginate('Special');

        $products_id = array();
        foreach($specials as $special) {
            if(!empty($special['Special']['product_id']))
                $products_id[] = $special['Special']['product_id'];
            if(!empty($special['Special']['product_det_id'])) {
                $products_id[] = $special['ProductDet']['product_id'];
            }
        }

        $products = $this->Product->find('all', array(
            'conditions' => array(
                'Product.id' => $products_id
            ),
            'contain' => array(
                'ProductParam' => array(
                    'ProductDetParam' => array(
                        'ProductDetParamValue'
                    ),
                    'order' => 'ProductParam.sort_order'
                ),
                'ProductDet' => array(
                    'ProductDetParam' => array(
                        'ProductParam' => array(
                            'ProductParamType',
                            'ProductParamShowType'
                        ),
                        'ProductDetParamValue'
                    ),
                    'SmallImage',
                    'BigImage',
                    'Producer',
                    'Special',
                    'order' => 'ProductDet.sort_order'
                ),
                'ProductData' => array(
                    'ProductParamType',
                    'ProductDetParamValue',
                    'order' => 'ProductData.sort_order'
                ),
                'SmallImage',
                'BigImage',
                'Producer',
                'Special'
            )
        ));
        foreach($products as &$product) {
            $this->ProductCommon->prepareProduct($product);
            $product['path'] = $this->Catalog->getPathLink($product['Product']['catalog_id']);
        }
        $this->set('products', $products);
        
//        $limit_array = $this->params['named'];
//        $limit = (empty($limit_array['limit']))?9:$limit_array['limit'];
//        $this->set('limit', $limit);

        $this->actionCss = array('products', 'basket');
        $this->actionJs[] = "jquery-ui-1.8.5.custom.min";
        $this->actionJs[] = "products";
    }
}

?>
