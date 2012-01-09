<?php

class CatalogsController extends AppController {
    var $name = 'Catalogs';
    var $uses = array(
        "Catalog",
        "SmallImage",
        "BigImage",
        "Image",
        "Product",
        "ProductDet",);
    var $helpers = array(
        'AdminCommon',
        'Javascript',
        'CatalogCommon',
        'ProductCommon',
        'paginator',
        'Cache',
        'Csv'
    );
    var $components = array(
        'AdminCommon',
        'Cookie'
    );
    var $actionJs = array(
        "jquery.treeview.min",
        "jquery.fumodal",
        "common"
    );

//    var $cacheAction = array('index' => '1 week');

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('index');
        $this->Auth2->allow('get_excel');
        $this->Auth2->allow('excel_all');
        $this->Auth2->allow('get_print');
        $this->Auth2->allow('get_basket');
        $this->Auth2->allow('project_slides');
        $this->Auth2->allow('pdf');
        $this->Auth2->allow('test_png');
        $this->Auth2->allow('test_pdf');
        $this->Auth2->allow('test_excel');
        
        $this->Auth2->allow('get_catalogs');
    }

    function get_basket() {
        //подсчет количества товаров в корзине и их общей стоимости
        $basket = $this->Cookie->read('Basket');
        if(empty($basket)) $basket = array();
        $basket_cnt = 0;
        $basket_price = 0;
        if($basket) {
            foreach($basket as $product) {
                $basket_cnt += $product['cnt'];
                $basket_price += $product['cnt']*$product['price'];
            }
        }

        $basket_info['basket_cnt'] = $basket_cnt;
        $basket_info['basket_price'] = $basket_price;

          if (isset($this->params['requested'])) {
            return $basket_info;
          } else {
            $this->set(compact('basket_info'));
          }
    }
    
    function get_catalogs($catalog_id = null) {
        $catalogs = $this->Catalog->find('all', array(
            'conditions' => array(
                'Catalog.catalog_type_id' => 1,
                'Catalog.parent_id' => $catalog_id
            ),
            'contain' => array()
        ));
        foreach($catalogs as &$catalog) {
            $catalog['Catalog']['url'] = $this->Catalog->get_url($catalog);
            
            $catalogs_id = $this->Catalog->find('all', array(
                'conditions' => array(
                    'Catalog.lft >=' => $catalog['Catalog']['lft'],
                    'Catalog.rght <=' => $catalog['Catalog']['rght']
                ),
                'contain' => array()
            ));
            $catalogs_id = Set::combine($catalogs_id, '{n}.Catalog.id', '{n}.Catalog.id');
            
            $products = $this->Product->find('all', array(
                'conditions' => array(
                    'Product.catalog_id' => $catalogs_id
                ),
                'contain' => array(
                    'SmallImage',
                    'BigImage'
                ),
                'limit' => 3
            ));
            foreach($products as &$product) {
                $product['Product']['url'] = $this->Product->get_url($product['Product']['id']);
            }
            $catalog['Product'] = $products;
            
            $products_cnt = $this->Product->find('count', array(
                'conditions' => array(
                    'Product.catalog_id' => $catalogs_id
                )
            ));
            $catalog['Catalog']['products_cnt'] = $products_cnt;
        }

        if (isset($this->params['requested'])) {
            return $catalogs;
        }
    }

    function index() {
        //получаем текущий каталог по входящим параметрам
        $catalog_args = func_get_args();
        $current_catalog = array(
            'Catalog' => array(
                'name' => 'Каталог',
                'id' => null
            )
        );
        foreach($catalog_args as $catalog_name) {
            $current_catalog = $this->Catalog->find('first', array(
                'conditions' => array(
                    'Catalog.catalog_type_id' => 1,
                    'Catalog.parent_id' => $current_catalog['Catalog']['id'],
                    'Catalog.eng_name' => $catalog_name
                ),
                'contain' => array()
            ));
            if(empty($current_catalog)) {
                $this->http_error('Неверный путь к каталогу', 404, 'Данный каталог отсутствует');
            }
        }
        $this->set('current_catalog', $current_catalog);
        
        //title, current_menu, breadcrumb
        $this->pageTitle = $current_catalog['Catalog']['name'];
        $this->set('current_menu_name', 'catalog');
        $breadcrumb = array(
            array('url'=>'/','label'=>'Главная'),
            array('url'=>array('controller'=>'catalogs','action'=>'index'),'label'=>'Каталог')
        );
        if(!empty($current_catalog['Catalog']['id'])) {
            $breadcrumb = array_merge($breadcrumb, $this->Catalog->get_breadcrumb($current_catalog));
        }
        $this->set('breadcrumb', $breadcrumb);
        
        $catalogs_cnt = $this->Catalog->find('count', array(
            'conditions' => array(
                'Catalog.catalog_type_id' => 1,
                'Catalog.parent_id' => $current_catalog['Catalog']['id']
            ),
            'contain' => array()
        ));
        if($catalogs_cnt>0) {
            $this->render('index_catalogs');
        } else {
            $products = $this->Product->find('all', array(
                'conditions' => array(
                    'Product.catalog_id' => $current_catalog['Catalog']['id']
                ),
                'contain' => array(
                    'SmallImage',
                    'BigImage',
                    'ProductDet'
                )
            ));
            foreach($products as &$product) {
                $product['Product']['url'] = $this->Product->get_url($product['Product']['id']);
                if(!empty($product['ProductDet'])) {
                    $product['Product']['product_det_list'] = array();
                    foreach($product['ProductDet'] as $product_det) {
                        $product['Product']['product_det_list'][$product_det['id']] = $product_det['name'];
                    }
                }
            }
            $this->set('products', $products);
            $this->render('index_products');
        }
//        $catalogs = $this->Catalog->find('all', array(
//            'conditions' => array(
//                'Catalog.catalog_type_id' => 1,
//                'Catalog.parent_id' => null
//            ),
//            'contain' => array()
//        ));
//        foreach($catalogs as &$catalog) {
//            $catalogs_id = $this->Catalog->find('all', array(
//                'conditions' => array(
//                    'Catalog.lft >=' => $catalog['Catalog']['lft'],
//                    'Catalog.rght <=' => $catalog['Catalog']['rght']
//                ),
//                'contain' => array()
//            ));
//            $catalogs_id = Set::combine($catalogs_id, '{n}.Catalog.id', '{n}.Catalog.id');
//            
//            $products = $this->Product->find('all', array(
//                'conditions' => array(
//                    'Product.catalog_id' => $catalogs_id
//                ),
//                'contain' => array(
//                    'SmallImage',
//                    'BigImage'
//                ),
//                'limit' => 3
//            ));
//            $catalog['Product'] = $products;
//            
//            $products_cnt = $this->Product->find('count', array(
//                'conditions' => array(
//                    'Product.catalog_id' => $catalogs_id
//                )
//            ));
//            $catalog['Catalog']['products_cnt'] = $products_cnt;
//        }
//        $this->set('catalogs', $catalogs);
    }

    function project_slides($catalog_id) {
        $catalog_tree = $this->CatalogCommon->GetCatalogTree(false);
        $this->set('path_tree', $catalog_tree);

        $path = $this->Catalog->getPathLink($catalog_id);
        $this->set('path', $path);

        $this->set('cur_catalog_id', $catalog_id);
        
        $catalog = $this->Catalog->find('first', array(
            'conditions' => array(
                'Catalog.id' => $catalog_id
            ),
            'contain' => array()
        ));
        $this->set('catalog', $catalog);

        $project_slides = $this->ProjectSlideCatalog->find('all', array(
            'conditions' => array(
                'ProjectSlideCatalog.catalog_id' => $catalog_id
            ),
            'contain' => array(
                'ProjectSlide' => array(
                    'Project',
                    'SmallImage'
                )
            )
        ));
        $this->set('project_slides', $project_slides);

        $this->pageTitle = $catalog['Catalog']['name'].' (иллюстрации из проектов)';
        $this->actionCss = array('catalog_path_tree', 'basket');
    }
    
    function admin_index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Администрирование - каталог';
        
        $catalog_list = $this->Catalog->get_list();
        $this->set('catalog_list', $catalog_list);
        
        $catalogs = $this->Catalog->find('all', array(
            'contain' => array()
        ));
        $catalogs = Set::combine($catalogs, '{n}.Catalog.id', '{n}');
        $this->set('catalogs', $catalogs);
    }

    function admin_save_all() {
        $this->AdminCommon->save_all($this->data, $this->Catalog);
        $this->redirect($this->referer());
        die;
    }

    function admin_add() {
        $this->AdminCommon->add($this->data, $this->Catalog);
        die;
    }

    function admin_delete() {
        $this->AdminCommon->delete($this->data, $this->Catalog);
        die;
    }

    function admin_index2($parent_id = null) {
        $this->layout = 'admin';

        $catalog_list = $this->Catalog->get_list();
        $this->set('catalog_list', $catalog_list);

        $producer_list = array(
            0 => 'Не указан'
        );
        $producer_list += $this->Producer->get_list();
        $this->set('producer_list', $producer_list);

        $catalog_tree = $this->CatalogCommon->GetCatalogTree();
        $this->set('path_tree', $catalog_tree);

        if($parent_id == null)
            $this->pageTitle = 'Анжелика - редактирование каталога';
        else
            $this->pageTitle = 'Редактирование - '.$catalog_list[$parent_id]['name'];

        if($parent_id != null) {
            $catalog = $this->Catalog->find('first', array(
                'conditions' => array('id' => $parent_id),
                'contain' => array()));
        } else {
            $catalog = array('Catalog' => array('id' => 0,'name' => 'Корень'));
        }
        $this->set('catalog', $catalog);
        
        $path = $this->Catalog->getPathLink($parent_id, 'adm_catalog');
        $this->set('path', $path);

        $catalogs = $this->Catalog->find('all', array(
            'conditions' => array(
                'Catalog.parent_id' => $parent_id
            ),
            'contain' => array(
                'SmallImage',
                'BigImage'
            )
        ));
        $catalogs = Set::combine($catalogs, '{n}.Catalog.id', '{n}');

        if(count($catalogs) == 0) {
            $this->paginate = array(
                'Product' => array(
                    'conditions' => array(
                        'Product.catalog_id' => $parent_id
                    ),
                    'contain' => array(
                        'SmallImage',
                        'BigImage',
                        'Special'
                    )
                )
            );
            $products = $this->paginate('Product');
            $products = Set::combine($products, '{n}.Product.id', '{n}');
            $this->set('products', $products);

            $product_list = $this->Product->find('list', array(
                'conditions' => array(
                    'Product.catalog_id' => $parent_id
                )
            ));
            $this->set('product_list', $product_list);

//            $this->actionCss = array('catalogs/adm_products');
            $this->render('admin_index_product');
        } else {
            $this->set('catalogs', $catalogs);
            //$this->actionCss = array('catalogs/adm_catalogs');
            $this->render('admin_index');
        }
    }

    function change_catalog() {
        if(!empty($this->data['catalog_id']) &&
                !empty($this->data['parent_id'])) {
            $this->Catalog->id = $this->data['catalog_id'];
            $this->Catalog->changeCatalog($this->data['parent_id']);
            $this->AdminCommon->clearModelCache($this->Catalog);
        }
        die;
    }

    function recover() {
        $this->Catalog->recover("parent");
        $this->AdminCommon->clearModelCache($this->Catalog);
        die;
    }

    function reorder() {
        set_time_limit(600);
        $this->Catalog->reorder(array(
            'id' => null,
            'field' => 'sort_order'
        ));
        $this->AdminCommon->clearModelCache($this->Catalog);
        die;
    }

    function clear_cache() {
        $this->AdminCommon->clearModelCache($this->Catalog);
        $this->redirect($this->referer());
    }

    function get_csv($id = 0) {
        $this->layout = 'csv';
        $conditions = array(
            'Catalog.catalog_type_id' => 1
        );
        $parent_code_1c = null;
        if($id != 0) {
            $this->Catalog->recursive = -1;
            $catalog = $this->Catalog->findById($id);
            $conditions += array(
                'Catalog.lft >=' => $catalog['Catalog']['lft'],
                'Catalog.rght <=' => $catalog['Catalog']['rght']
            );

            if(!empty($catalog['Catalog']['parent_id'])) {
                $parent = $this->Catalog->findById($catalog['Catalog']['parent_id']);
                $parent_code_1c = $parent['Catalog']['code_1c'];
            }

            $this->set('filename', $catalog['Catalog']['id']);
        } else {
            $this->set('filename', 'catalog');
        }

        $catalogs = $this->Catalog->find('all', array(
            'conditions' => $conditions,
            'recursive' => -1
        ));
        $catalogs = Set::combine($catalogs, '{n}.Catalog.id', '{n}');
        if($parent_code_1c != null) {
            $catalogs[$id]['Catalog']['parent_code_1c'] = $parent_code_1c;
        }

        $catalogs_id = Set::combine($catalogs, '{n}.Catalog.id', '{n}.Catalog.id');
        $products = $this->Product->find('all', array(
            'conditions' => array(
                'Product.catalog_id' => $catalogs_id
            ),
            'recursive' => -1
        ));
        $products = Set::combine($products, '{n}.Product.id', '{n}');

        $products_id = Set::combine($products, '{n}.Product.id', '{n}.Product.id');
        $product_dets = $this->ProductDet->find('all', array(
            'conditions' => array(
                'ProductDet.product_id' => $products_id
            ),
            'recursive' => -1
        ));
        
        foreach($product_dets as &$product_det) {
            $product_id = $product_det['ProductDet']['product_id'];
            $products[$product_id]['ProductDet'][] = $product_det;
        }
        foreach($products as &$product) {
            $catalog_id = $product['Product']['catalog_id'];
            $catalogs[$catalog_id]['Product'][] = $product;
        }
        foreach($catalogs as &$catalog) {
            if(empty($catalog['Catalog']['parent_id'])) {
                $catalog['Catalog']['parent_code_1c'] = '';
            } else if(empty($catalog['Catalog']['parent_code_1c'])) {
                $parent_id = $catalog['Catalog']['parent_id'];
                $parent = $catalogs[$parent_id];
                $parent_code_1c = $parent['Catalog']['code_1c'];
                $catalog['Catalog']['parent_code_1c'] = $parent_code_1c;
            }
        }

        $list = array();
        foreach($catalogs as $catalog) {
            $list[] = array(
                'type' => 1,
                'parent' => $catalog['Catalog']['parent_code_1c'],
                'code_1c' => $catalog['Catalog']['code_1c'],
                'name' => $catalog['Catalog']['name'],
                'price' => '',
                'cnt' => ''
            );

            if(empty($catalog['Product'])) continue;
            foreach($catalog['Product'] as $product) {
                $list[] = array(
                    'type' => 0,
                    'parent' => $catalog['Catalog']['code_1c'],
                    'code_1c' => $product['Product']['code_1c'],
                    'name' => $product['Product']['name'],
                    'price' => $product['Product']['price'],
                    'cnt' => $product['Product']['cnt']
                );

                if(empty($product['ProductDet'])) continue;
                foreach($product['ProductDet'] as $product_det) {
                    $list[] = array(
                        'type' => 0,
                        'parent' => $catalog['Catalog']['code_1c'],
                        'code_1c' => $product_det['ProductDet']['code_1c'],
                        'name' => '',
                        'price' => $product_det['ProductDet']['price'],
                        'cnt' => $product_det['ProductDet']['cnt']
                    );
                }
            }
        }
        $this->set('list', $list);
    }

    function get_print($id) {
        $this->Catalog->recursive = -1;
        $catalog = $this->Catalog->findById($id);
        $this->set('catalog', $catalog);

        $this->pageTitle = $catalog['Catalog']['name'];

        $products = $this->Product->find('all', array(
            'conditions' => array(
                'Product.catalog_id' => $id
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
        }
        $this->set('products', $products);

        $this->render('print', 'print');
    }

    function get_excel($id) {
        $catalog = $this->Catalog->find('first', array(
            'conditions' => array(
                'Catalog.id' => $id
            ),
            'contain' => array()
        ));
        if(empty($catalog)) {
            die;
        }
        $file_name = $catalog['Catalog']['eng_name'];

        if(file_exists('xls/'.$file_name.'.xls')) {
            $this->redirect('/xls/'.$file_name.'.xls');
        }
        
        set_time_limit(600);
        App::import('Vendor', '/phpexcel/PHPExcel', array('file' => 'PHPExcel.php'));
        $objPHPExcel = new PHPExcel();
        $this->set('objPHPExcel', $objPHPExcel);

        $this->Catalog->recursive = -1;
        $catalog = $this->Catalog->findById($id);
        $this->set('catalog', $catalog);
        $this->set('file_name', $file_name);

        $products = $this->Product->find('all', array(
            'conditions' => array(
                'Product.catalog_id' => $id
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
        }
        $this->set('products', $products);

        $this->render('export_xls','excel');
    }

    function excel_all($type = 'pic') {
        if(file_exists('xls/catalog-'.$type.'.xls')) {
            $this->redirect('/xls/catalog-'.$type.'.xls');
        }
        set_time_limit(600);
        App::import('Vendor', '/phpexcel/PHPExcel', array('file' => 'PHPExcel.php'));
        $objPHPExcel = new PHPExcel();
        $this->set('objPHPExcel', $objPHPExcel);

        $this->set('file_name', 'catalog-'.$type);

        if(($catalogs = Cache::read('all_catalogs')) === false) {
            $catalogs = $this->Catalog->find('all', array(
                'conditions' => array(
                    'Catalog.catalog_type_id' => 1
                ),
                'contain' => array(
                    'Product' => array(
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
                )
            ));
            foreach($catalogs as &$catalog) {
                foreach($catalog['Product'] as &$product) {
                    $this->ProductCommon->prepareProduct($product);
                }
            }
            Cache::write('all_catalogs', $catalogs);
        }
        $this->set('catalogs', $catalogs);

        $this->set('url_to_image', 'http://'.$this->Session->host.$this->webroot.'img/');

        if($type == 'pic')
            $this->render('excel_all_pic', 'excel');
        else
            $this->render('excel_all_nopic', 'excel');
    }
}

?>
