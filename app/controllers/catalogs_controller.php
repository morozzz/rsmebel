<?php

class CatalogsController extends AppController {
    var $name = 'Catalogs';
    var $uses = array(
        "Catalog",
        "CatalogNew",
        "Filter",
        "SmallImage",
        "BigImage",
        "Image",
        "Product",
        "ProductParam",
        "ProductParamType",
        "ProductDet",
        "ProductDetParam",
        "ProductDetParamValue",
        "Producer",
        "Project",
        "ProjectCatalog",
        "ProjectSlide",
        "ProjectSlideCatalog");
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
        'Common',
        'CatalogCommon',
        'ProductCommon',
        'Cookie'
    );
    var $actionJs = array(
        "jquery.treeview.min",
        "jquery.fumodal",
        "common"
    );

    var $cacheAction = array('index' => '1 week');

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

    function index($id = 0) {
        /*path-tree*/
        $catalog_tree = $this->CatalogCommon->GetCatalogTree(false);
        $this->set('path_tree', $catalog_tree);

        $this->set('cur_catalog_id', $id);
        $this->actionJs[] = "jquery-ui-1.8.5.custom.min";

        if($id == 0) {
            $this->pageTitle = 'Анжелика - заказ онлайн';

           if(($catalogs = Cache::read('catalogs')) === false) {

                $catalogs = $this->Catalog->find('all', array(
                    'conditions' => array(
                        'parent_id' => null,
                        'catalog_type_id' => 1
                    ),
                    'contain' => array()
                ));
                $catalogs = Set::combine($catalogs, '{n}.Catalog.id', '{n}');           


                $catalogs_id = Set::combine($catalogs, '{n}.Catalog.id', '{n}.Catalog.id');
                $catalogs2 = $this->Catalog->find('all', array(
                    'conditions' => array(
                        'parent_id' => $catalogs_id,
                        'catalog_type_id' => 1
                    ),
                    'contain' => array(
                        'SmallImage'
                    )
                ));
 
                foreach($catalogs as &$catalog) {
                    $catalog['Catalogs'] = array();
                }
                foreach($catalogs2 as $catalog2) {
                    $catalogs[$catalog2['Catalog']['parent_id']]['Catalogs'][] = $catalog2;
                }

              Cache::write('catalogs', $catalogs);
            }
            $this->set('catalogs', $catalogs);

            $path = array();
            $this->set('path', $path);

            $catalog_news = $this->CatalogNew->find('all', array(
                'contain' => array(
                    'CatalogNewType',
                    'Catalog'
                ),
                'limit' => 5
            ));
//            foreach($catalog_news as &$catalog_new) {
//                $catalog_new['catalog_path'] = $this->Catalog->getPathLink(
//                        $catalog_new['CatalogNew']['catalog_id']);
//            }
            $this->set('catalog_news', $catalog_news);

            $this->actionCss = array('catalogs/catalogs0', 'catalog_path_tree', 'basket');
            $this->render('catalogs0');
        } else {
            $path = $this->Catalog->getPathLink($id);
            $this->set('path', $path);

            $catalog = $this->Catalog->find('first', array(
                'conditions' => array(
                    'Catalog.id' => $id,
                    'Catalog.catalog_type_id' => 1
                ),
                'contain' => array(
                    'SmallImage',
                    'BigImage'
                )
            ));
            $this->set('catalog', $catalog);
            $this->pageTitle = $catalog['Catalog']['name'];
            
            $catalogs2 = $this->Catalog->find('all', array(
                'conditions' => array(
                    'parent_id' => $id,
                    'catalog_type_id' => 1
                ),
                'contain' => array(
                    'SmallImage'
                )
            ));

            if(!empty($catalogs2)) {
                $catalogs[$id] = $catalog;
                $catalogs[$id]['Catalogs'] = $catalogs2;
                $this->set('catalogs', $catalogs);

                if($catalog_tree[$id]['level'] == 0) {
                    $catalog_news = $this->CatalogNew->find('all', array(
                        'contain' => array(
                            'CatalogNewType',
                            'Catalog'
                        ),
                        'limit' => 5
                    ));
                    $this->set('catalog_news', $catalog_news);

                    $this->actionCss = array('catalogs/catalogs0', 'catalog_path_tree', 'basket');
                    $this->render('catalogs0');
                } else {
                    $this->actionCss = array('catalogs/catalogs1', 'catalog_path_tree', 'basket');
                    $this->render('catalogs1');
                }
            } else {
                $projects = $this->ProjectCatalog->find('all', array(
                    'conditions' => array(
                        'ProjectCatalog.catalog_id' => $id
                    ),
                    'contain' => array(
                        'Project'
                    )
                ));
                $this->set('projects', $projects);

                $project_slides = $this->ProjectSlideCatalog->find('all', array(
                    'conditions' => array(
                        'ProjectSlideCatalog.catalog_id' => $id
                    ),
                    'contain' => array(
                        'ProjectSlide'
                    )
                ));
                $this->set('project_slides', $project_slides);

                $product_det_param_value_conditions = array(
                    'or' => array(
                        "ProductDetParamValue.id IN (".
                            "SELECT pdp.product_det_param_value_id ".
                            "FROM cake_product_det_params pdp, ".
                                "cake_product_dets pd, ".
                                "cake_products p ".
                            "WHERE pdp.product_det_id = pd.id AND ".
                                "pd.product_id = p.id AND ".
                                "p.catalog_id = $id)",
                        "ProductDetParamValue.id IN (".
                            "SELECT pd.product_det_param_value_id ".
                            "FROM cake_product_datas pd, ".
                                "cake_products p ".
                            "WHERE pd.product_id = p.id AND ".
                                "p.catalog_id = $id)"
                    )
                );
                $filters = $this->Filter->find('all', array(
                    'conditions' => array(
                        'Filter.catalog_id' => $id
                    ),
                    'contain' => array(
                        'ProductParamType' => array(
                            'ProductDetParamValue' => array(
                                'conditions' => $product_det_param_value_conditions,
                                'order' => 'ProductDetParamValue.name'
                            )
                        )
                    )
                ));

                $params = $this->params['named'];
                $filter_conditions = array();
                $price_conditions = array();
                foreach($filters as &$filter) {
                    $product_param_type_id = $filter['ProductParamType']['id'];
                    $cur_filter_conditions = array();
                    if($filter['Filter']['filter_type_id'] == 1) {
                        if(!empty($params['f_'.$product_param_type_id])) {
                            $value = $params['f_'.$product_param_type_id];
                            $cur_filter_conditions[] = ' AND pdpv.name>='.(int)$value;
                            $filter['from'] = $value;
                        }
                        if(!empty($params['t_'.$product_param_type_id])) {
                            $value = $params['t_'.$product_param_type_id];
                            $cur_filter_conditions[] = ' AND pdpv.name<='.(int)$value;
                            $filter['to'] = $value;
                        }
                    } else if($filter['Filter']['filter_type_id'] == 2) {
                        if(!empty($params['e_'.$product_param_type_id])) {
                            $value = $params['e_'.$product_param_type_id];
                            $equals = explode('_', $value);

                            $filter['ProductParamType']['ProductDetParamValue'] =
                                Set::combine($filter['ProductParamType']['ProductDetParamValue'], '{n}.id', '{n}');
                            foreach($equals as $equal) {
                                if(!empty($filter['ProductParamType']['ProductDetParamValue'][$equal]))
                                    $filter['ProductParamType']['ProductDetParamValue'][$equal]['checked'] = true;
                            }
                            $cur_filter_conditions[] = ' AND pdpv.id IN ('.implode(',', $equals).')';
                        }
                    } else if($filter['Filter']['filter_type_id'] == 3) {
                        if(!empty($params['f_price'])) {
                            $value = $params['f_price'];
                            $price_conditions['from'] = (int)$value;
                            $filter['from'] = $value;
                        }
                        if(!empty($params['t_price'])) {
                            $value = $params['t_price'];
                            $price_conditions['to'] = (int)$value;
                            $filter['to'] = $value;
                        }
                    }
                    if(!empty($cur_filter_conditions))
                        $filter_conditions[$product_param_type_id] = $cur_filter_conditions;
                }
                $this->set('filters', $filters);
                $conditions = array();
                foreach($filter_conditions as $product_param_type_id => $cur_filter_conditions) {
                    $conditions[] = array(
                        'or' => array(
                            "Product.id IN (SELECT pd.product_id
                                         FROM cake_product_det_params pdp,
                                              cake_product_params pp,
                                              cake_product_dets pd,
                                              cake_product_det_param_values pdpv
                                         WHERE pdp.product_param_id = pp.id
                                           AND pdp.product_det_id = pd.id
                                           AND pdp.product_det_param_value_id = pdpv.id
                                           AND pp.product_param_type_id = $product_param_type_id".
                                        implode("", $cur_filter_conditions).")",
                            "Product.id IN (SELECT pd.product_id
                                         FROM cake_product_datas pd,
                                              cake_product_det_param_values pdpv
                                         WHERE pd.product_det_param_value_id = pdpv.id
                                           AND pd.product_param_type_id = $product_param_type_id".
                                        implode("", $cur_filter_conditions).")"
                        )
                    );
                }
                if(!empty($price_conditions['from'])) {
                    $price_from = $price_conditions['from'];
                    $conditions[] = array(
                        'or' => array(
                            "Product.price >= $price_from",
                            "EXISTS(SELECT * FROM cake_product_dets pd
                                WHERE pd.product_id = Product.id
                                AND pd.price >= $price_from)"
                        )
                    );
                }
                if(!empty($price_conditions['to'])) {
                    $price_to = $price_conditions['to'];
                    $conditions[] = array(
                        'or' => array(
                            "Product.price <= $price_to",
                            "EXISTS(SELECT * FROM cake_product_dets pd
                                WHERE pd.product_id = Product.id
                                AND pd.price <= $price_to)"
                        )
                    );
                }
                $conditions['Product.catalog_id'] = $id;

                $this->paginate = array(
                    'Product' => array(
                        'conditions' => $conditions,
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
                    )
                );

                $products = $this->paginate('Product');
                foreach($products as &$product) {
                    $this->ProductCommon->prepareProduct($product);
                }
                $this->set('products', $products);

                $this->actionCss = array('catalogs/products', 'products', 'catalog_path_tree', 'basket');
                //$this->actionJs[] = "jquery-ui-1.8.4.custom.tabs.min";
                $this->actionJs[] = "products";
                $this->render('products');
                /*****************************************/
            }
        }
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

    function adm_catalog($parent_id = null) {
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
            $this->render('adm_products2');
        } else {
            $this->set('catalogs', $catalogs);
            //$this->actionCss = array('catalogs/adm_catalogs');
            $this->render('adm_catalogs2');
        }
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->Catalog);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->Catalog);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->Catalog);
        die;
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

    function test_excel() {
        App::import('Vendor', '/phpexcel/PHPExcel', array('file' => 'PHPExcel.php'));
        $objPHPExcel = new PHPExcel();
        //$objPHPExcel = PHPExcel_IOFactory::load('xls/template.xls');
        $this->set('objPHPExcel', $objPHPExcel);

        $data = array(
            1,
            'fdsfsd',
            3,
            4,
            'fff',
            6,
            7,
            'ddd'
        );
        $this->set('data', $data);
        $this->layout = 'test_excel';
    }

//    function pdf() {
//        if(($catalogs = Cache::read('all_catalogs')) === false) {
//            $catalogs = $this->Catalog->find('all', array(
//                'conditions' => array(
//                    'Catalog.catalog_type_id' => 1
//                ),
//                'contain' => array(
//                    'Product' => array(
//                        'ProductParam' => array(
//                            'ProductDetParam' => array(
//                                'ProductDetParamValue'
//                            ),
//                            'order' => 'ProductParam.sort_order'
//                        ),
//                        'ProductDet' => array(
//                            'ProductDetParam' => array(
//                                'ProductParam' => array(
//                                    'ProductParamType',
//                                    'ProductParamShowType'
//                                ),
//                                'ProductDetParamValue'
//                            ),
//                            'SmallImage',
//                            'BigImage',
//                            'Producer',
//                            'Special',
//                            'order' => 'ProductDet.sort_order'
//                        ),
//                        'ProductData' => array(
//                            'ProductParamType',
//                            'ProductDetParamValue',
//                            'order' => 'ProductData.sort_order'
//                        ),
//                        'SmallImage',
//                        'BigImage',
//                        'Producer',
//                        'Special'
//                    )
//                )
//            ));
//            foreach($catalogs as &$catalog) {
//                foreach($catalog['Product'] as &$product) {
//                    if(empty($product['Special']) || empty($product['Special']['id'])) {
//                        $product['is_special'] = 0;
//                    } else {
//                        $product['is_special'] = 1;
//                    }
//
//                    $this->ProductCommon->prepareProduct($product);
//                }
//            }
//            Cache::write('all_catalogs', $catalogs);
//        }
//        $this->set('catalogs', $catalogs);
//
//        $this->set('url_to_image', 'http://'.$this->Session->host.$this->webroot.'img/');
//
//        $this->layout = 'pdf';
//        $this->set('filename', 'angelika.pdf');
//        set_time_limit(600);
//        $this->render();
//    }
//
//    function test_png() {
//        //$this->layout = 'print';
//    }
//
//    function test_pdf() {
//        $this->layout = 'pdf';
//        $this->set('filename', 'test_pdf.pdf');
//        $this->render();
//    }

    function eng_name_migr() {
        $catalogs = $this->Catalog->find('all', array(
            'contain' => array()
        ));
        foreach($catalogs as $catalog) {
            if($catalog['Catalog']['name'] != '') {
                $this->Catalog->id = $catalog['Catalog']['id'];
                $this->Catalog->save(array(
                    'id' => $catalog['Catalog']['id'],
                    'eng_name' => $this->translit($catalog['Catalog']['name'])
                ));
            }
        }
        echo 'success';
        die;
    }
}

?>
