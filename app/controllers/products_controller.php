<?php

class ProductsController extends AppController {
    var $name = 'Products';
    var $uses = array(
        'Product',
        'Catalog',
        'Image',
        'Special',
        'ProductParam',
        'ProductDet',
        'ProductDetParam',
        'ProductParamType',
        'ProductDetParamValue'
    );
    var $components = array(
        'AdminCommon',
        'CatalogCommon',
        'ProductCommon',
        'Common'
    );
    var $helpers = array(
        'AdminCommon',
        'Javascript',
        'CatalogCommon',
        'ProductCommon'
    );
    var $actionJs = array(
        "jquery.treeview.min",
        "jquery.fumodal",
        "common",
        "jquery-ui-1.8.5.custom.min"
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

    function index($product_id = 0, $product_det_id = 0) {
        $this->actionCss = array('products', 'basket', 'catalog_path_tree');
        $this->actionJs[] = "products";
        if($product_id == 0) {
            $this->redirect($this->referer());
        }

        $product = $this->Product->find('first', array(
            'conditions' => array(
                'Product.id' => $product_id
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
        $this->ProductCommon->prepareProduct($product);
        $this->set('product', $product);

        $this->pageTitle = $product['Product']['name'];
        $catalog_id = $product['Product']['catalog_id'];
        
        $neighbors = $this->Product->find('neighbors', array(
            'conditions' => array(
                'Product.catalog_id' => $catalog_id
            ),
            'contain' => array(
                'SmallImage'
            ),
            'field' => 'Product.sort_order',
            'value' => $product['Product']['sort_order']
        ));
        if(empty($neighbors['prev'])) unset($neighbors['prev']);
        if(empty($neighbors['next'])) unset($neighbors['next']);
        $this->Common->repairImage($neighbors);
        $this->set('neighbors', $neighbors);

        $catalog_tree = $this->CatalogCommon->GetCatalogTree(false);
        $this->set('path_tree', $catalog_tree);

        $this->set('cur_catalog_id', $catalog_id);

        $path = $this->Product->getPathLink($product_id);
        $this->set('path', $path);

        if($product_det_id > 0) {
            $this->set('product_det_id', $product_det_id);
        }
    }
    
    function admin_get_products($catalog_id) {
        $this->layout = 'ajax';
        $products = $this->Product->find('all', array(
            'conditions' => array(
                'Product.catalog_id' => $catalog_id
            ),
            'contain' => array()
        ));
        $products = Set::combine($products, '{n}.Product.id', '{n}');
        $this->set('products', $products);
    }
    
    function admin_index($catalog_id) {
        $this->layout = 'admin';
        
        $catalog = $this->Catalog->find('first', array(
            'conditions' => array(
                'Catalog.id' => $catalog_id
            ),
            'contain' => array(
                'SmallImage',
                'BigImage'
            )
        ));
        $this->set('catalog', $catalog);
        $this->pageTitle = "Администрирование - {$catalog['Catalog']['name']} - товары";
        
        $catalog_list = $this->Catalog->get_list();
        $this->set('catalog_list', $catalog_list);
        
        $products = $this->Product->find('all', array(
            'conditions' => array(
                'Product.catalog_id' => $catalog_id
            ),
            'contain' => array(
                'SmallImage',
                'BigImage'
            )
        ));
        $products = Set::combine($products, '{n}.Product.id', '{n}');
        $this->set('products', $products);
    }

    function admin_save_all() {
        $this->AdminCommon->save_all($this->data, $this->Product);
        $this->redirect($this->referer());
        die;
    }

    function admin_add() {
        $this->AdminCommon->add($this->data, $this->Product);
        die;
    }

    function admin_delete() {
        $this->AdminCommon->delete($this->data, $this->Product);
        die;
    }

    function admin_move() {
        if(!empty($this->data)) {
            $product_id = $this->data['product_id'];
            $catalog_id = $this->data['catalog_id'];

            $this->Product->id = $product_id;
            $this->Product->changeCatalog($catalog_id);

            $this->AdminCommon->clearModelCache($this->Product);
        }
        die;
    }

    function admin_move_list() {
        if(!empty($this->data)) {
            $products_id = $this->data['products_id'];
            $catalog_id = $this->data['catalog_id'];

            foreach($products_id as $product_id) {
                $this->Product->id = $product_id;
                $this->Product->changeCatalog($catalog_id);
            }

            $this->AdminCommon->clearModelCache($this->Product);
        }
        die;
    }

    function concat_products() {
        if(!empty($this->data)) {
            $products_id = $this->data['products_id'];
            $products_to_move_name = $this->data['name'];
            $catalog_id = $this->data['catalog_id'];

            //создание общего товара
            $min_sort_order = $this->Product->getMinSortOrder(array(
                'Product.catalog_id' => $catalog_id
            ));

            $data = array(
                'catalog_id' => $catalog_id,
                'name' => $products_to_move_name,
                'sort_order' => $min_sort_order-1
            );
            $this->Product->create();
            $this->Product->save($data);

            $product_id = $this->Product->id;

            //создаем столбец Название
            $this->ProductParam->create();
            $this->ProductParam->save(array(
                'ProductParam' => array(
                    'product_id' => $product_id,
                    'product_param_type_name' => 'Название',
                    'product_param_show_type_id' => 1,
                    'sort_order' => 1
                )
            ));
            $product_param_id = $this->ProductParam->id;

            //перенос товаров в параметры общего товара
            foreach($products_id as $moving_product_id) {
                $product_det_id = $this->Product->move_to_param($moving_product_id, $product_id);
                
                //обновляем значения в колонке Название
                $product_det = $this->ProductDet->find('first', array(
                    'conditions' => array(
                        'ProductDet.id' => $product_det_id
                    ),
                    'contain' => array()
                ));
                $this->ProductDet->create();
                $this->ProductDetParam->save(array(
                    'product_det_id' => $product_det_id,
                    'product_param_id' => $product_param_id,
                    'value' => $product_det['ProductDet']['name']
                ));
            }

            $this->AdminCommon->clearModelCache($this->Product);
            $this->AdminCommon->clearModelCache($this->ProductDet);
            $this->AdminCommon->clearModelCache($this->ProductParam);
            $this->AdminCommon->clearModelCache($this->ProductDetParam);
        }
        die;
    }

    function move_to_param() {
        if(!empty($this->data)) {
            $moving_product_id = $this->data['moving_product_id'];
            $moving_product = $this->Product->find('first', array(
                'conditions' => array(
                    'Product.id' => $moving_product_id
                ),
                'contain' => array()
            ));
            $product_id = $this->data['product_id'];
            $product_det_id = $this->Product->move_to_param($moving_product_id, $product_id);

            //находим id столбца "Название"
            $product_param_type_id = $this->ProductParamType->getIdByName('Название');
            $product_param = $this->ProductParam->find('first', array(
                'conditions' => array(
                    'ProductParam.product_param_type_id' => $product_param_type_id,
                    'ProductParam.product_id' => $product_id
                )
            ));
            //если есть столбец "Название" у данного товара, то надо его заполнить
            if($product_param != null) {
                $this->ProductDetParam->save(array(
                    'ProductDetParam' => array(
                        'product_det_id' => $product_det_id,
                        'product_param_id' => $product_param['ProductParam']['id'],
                        'value' => $moving_product['Product']['name']
                    )
                ));
            }

            $this->AdminCommon->clearModelCache($this->Product);
        }
        die;
    }
}

?>
