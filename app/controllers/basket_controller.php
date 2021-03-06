<?php

class BasketController extends AppController {
    var $name = "Basket";
    var $uses = array(
        'Catalog',
        'CompanyType',
        'Custom',
        'CustomClientInfo',
        'CustomDet',
        'CustomStatus',
        'PayType',
        'Product',
        'ProductDet',
        'ProfilType',
        'TransportType'
    );
    var $components = array(
        "Cookie",
        "Basket"
    );
    var $actionJs = array(
        "jquery.dataTables.min",
        "jquery.form",
        "jquery.fumodal",
        "common"
    );

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('*');
    }
    
    function get() {
        if(isset($this->params['requested'])) {
            $basket = $this->Basket->get();
            return $basket;
        }
        $this->Session->setFlash('Неверная страница', 'error');
        $this->redirect($this->referer());
    }
    
    function index() {
        $this->pageTitle = 'Корзина';
        $this->set('breadcrumb', array(
            array('url'=>'/','label'=>'Главная'),
            array('url'=>array('controller'=>'basket','action'=>'index'),'label'=>'Корзина')
        ));
        
        if(!empty($this->data) && !empty($this->data['request_type'])) {
            if($this->data['request_type'] == 'basket_update') {
                $this->Basket->clear();
                if(!empty($this->data['Product'])) {
                    foreach($this->data['Product'] as $product_id => $count) {
                        $this->Basket->add($product_id, null, $count);
                    }
                }
                if(!empty($this->data['ProductDet'])) {
                    foreach($this->data['ProductDet'] as $product_det_id => $count) {
                        $this->Basket->add(null, $product_det_id, $count);
                    }
                }
            } else if($this->data['request_type'] == 'custom_order') {
                $is_ok = true;
                
                $basket = $this->Basket->get();
                if(empty($basket) || (empty($basket['products']) && empty($basket['product_dets']))) {
                    $this->Session->setFlash('Нельзя оформить заказ при пустой корзине');
                    $is_ok = false;
                }
                
                if($this->is_opt_price && empty($this->data['CustomClientInfo']['name'])) {
                    $this->CustomClientInfo->invalidate('name', 'Введите название фирмы');
                    $is_ok = false;
                }
                
                if(empty($this->data['CustomClientInfo']) || empty($this->data['CustomClientInfo']['fio'])) {
                    $this->CustomClientInfo->invalidate('fio', 'Введите ФИО');
                    $is_ok = false;
                }
                
                if(empty($this->data['CustomClientInfo']['phone'])) {
                    $this->CustomClientInfo->invalidate('phone', 'Введите телефон');
                    $is_ok = false;
                }
                
                if($is_ok) {
                    $user_id = null;
                    if(!empty($this->curUser['User']['id']))
                            $user_id = $this->curUser['User']['id'];
                    
                    $data = array(
                        'Custom' => array(
                            'user_id' => $user_id,
                            'custom_status_type_id' => 1
                        ),
                        'CustomClientInfo' => $this->data['CustomClientInfo'],
                        'CustomStatus' => array(
                            array(
                                'user_id' => $user_id,
                                'custom_status_type_id' => 1
                            )
                        ),
                        'CustomDet' => array()
                    );
                    
                    foreach(array_merge($basket['products'],$basket['product_dets']) as $product) {
                        $price = ($this->is_opt_price)?
                                $product['Product']['opt_price']:
                                $product['Product']['price'];
                        $name = $product['Product']['name'];
                        if(!empty($product['ProductDet'])) $name .= " ({$product['ProductDet']['name']})";
                        
                        $data['CustomDet'][] = array(
                            'product_id' => $product['Product']['id'],
                            'product_det_id' => (empty($product['ProductDet']))?null:$product['ProductDet']['id'],
                            'name' => $name,
                            'cnt' => $product['Basket']['cnt'],
                            'price' => $price
                        );
                    }
                    
                    $this->Custom->create();
                    if($this->Custom->saveall($data)) {
                        $this->Basket->clear();
                        $basket = $this->Basket->get();
                        $this->set('basket', $basket);

                        $this->pageTitle = 'Заказ успешно оформлен';
                        $this->render('order_finish');
                    }
                }
            }
        }
        
        $basket = $this->Basket->get();
        foreach($basket['products'] as &$product) {
            $product['Product']['url'] = $this->Product->get_url($product['Product']['id']);
            $product['Product']['catalog_breadcrumbs'] = $this->Catalog->get_breadcrumb(null, $product['Product']['catalog_id']);
            $price = ($this->is_opt_price)?$product['Product']['opt_price']:$product['Product']['price'];
            $product['Product']['cur_price'] = $price;
            $product['Product']['sum'] = $price*$product['Basket']['cnt'];
        }
        foreach($basket['product_dets'] as &$product_det) {
            $product_det['Product']['url'] = $this->Product->get_url($product_det['Product']['id']);
            $product_det['Product']['catalog_breadcrumbs'] = $this->Catalog->get_breadcrumb(null, $product_det['Product']['catalog_id']);
            $price = ($this->is_opt_price)?$product_det['ProductDet']['opt_price']:$product_det['ProductDet']['price'];
            $product_det['Product']['cur_price'] = $price;
            $product_det['Product']['sum'] = $price*$product_det['Basket']['cnt'];
        }
        $this->set('basket', $basket);
        
        if(!empty($this->curUser)) {
            $u_user = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $this->curUser['User']['id']
                ),
                'contain' => array(
                    'ClientInfo'
                )
            ));
            if(empty($this->data)) $this->data = $u_user;
            
            if(($company_types = Cache::read('company_types')) === false) {
                $company_types = $this->CompanyType->find('list');
                Cache::write('company_types', $company_types);
            }
            $this->set('companyTypes', $company_types);

            if(($profil_types = Cache::read('profil_types')) === false) {
                $profil_types = $this->ProfilType->find('list');
                Cache::write('profil_types', $profil_types);
            }
            $this->set('profilTypes', $profil_types);
        }
        
        $pay_type_list = $this->PayType->find('list');
        $this->set('payTypes', $pay_type_list);
        
        $transport_types = $this->TransportType->find('all');
        $transport_type_list = Set::combine($transport_types, '{n}.TransportType.id', '{n}.TransportType.name');
        $this->set('transportTypes', $transport_type_list);
        
        $transport_prices = Set::combine($transport_types, '{n}.TransportType.id', '{n}.TransportType.price');
        $this->set('transport_prices', $transport_prices);
    }
    
    function add() {
        if(empty($this->params['url']['count'])) $count = 1;
        else $count = $this->params['url']['count'];
        if($count<=0) $count=1;
        
        $product_det_id = null;
        if(!empty($this->params['url']['product_det_id']))
                $product_det_id = $this->params['url']['product_det_id'];
        
        $product_id = null;
        if(!empty($this->params['url']['product_id']))
                $product_id = $this->params['url']['product_id'];
        
        $this->Basket->add($product_id, $product_det_id, $count);
        
        if($this->params['isAjax'] == 1) {
            $this->layout = 'ajax';
            $this->set('basket', $this->Basket->get());
            $this->render('basket');
        } else {
            $this->redirect($this->referer());
        }
    }
    
    function clear() {
        $this->Basket->clear();
        
        if($this->params['isAjax'] == 1) {
            $this->layout = 'ajax';
            $this->set('basket', $this->Basket->get());
            $this->render('basket');
        } else {
            $this->redirect($this->referer());
        }
    }

//    function add() {
//        //добавить товар в корзину - ajax
//        if($this->params['isAjax'] == 1) {
//            $this->layout = 'ajax';
//
//            $data = $this->params['form'];
//            /* дата должна быть вида
//             *  array(
//             *      product_id => ###
//             *      cnt => ###
//             *  );
//             * или
//             *  array(
//             *      product_det_id => ###
//             *      cnt => ###
//             *  );
//             */
//            if(empty($data['cnt']) || $data['cnt']<=0) {
//                $this->set('error', 'Количество товара должно быть больше нуля');
//                return;
//            }
//
//            $basket = $this->Cookie->read('Basket');
//            if(empty($basket)) $basket = array();
//            $is_new_product = true;
//            $max_basket_id = 0;
//            foreach($basket as $basket_id => $product) {
//                if($basket_id > $max_basket_id) {
//                    $max_basket_id = $basket_id;
//                }
//                if(!empty($product['product_id']) &&
//                        !empty($data['product_id']) &&
//                        $product['product_id'] == $data['product_id']) {
//                    $cur_cnt = (empty($product['cnt']))?0:$product['cnt'];
//                    $new_cnt = $cur_cnt + $data['cnt'];
//                    $this->Cookie->write('Basket.'.$basket_id, array(
//                        'product_id' => $product['product_id'],
//                        'cnt' => $new_cnt
//                    ));
//                    $is_new_product = false;
//                    break;
//                } else if(!empty($product['product_det_id']) &&
//                        !empty($data['product_det_id']) &&
//                        $product['product_det_id'] == $data['product_det_id']) {
//                    $cur_cnt = (empty($product['cnt']))?0:$product['cnt'];
//                    $new_cnt = $cur_cnt + $data['cnt'];
//                    $this->Cookie->write('Basket.'.$basket_id, array(
//                        'product_det_id' => $product['product_det_id'],
//                        'cnt' => $new_cnt
//                    ));
//                    $is_new_product = false;
//                    break;
//                }
//            }
//            if($is_new_product) {
//                if(!empty($data['product_id'])) {
//                    $product = array(
//                        'product_id' => $data['product_id'],
//                        'cnt' => $data['cnt']
//                    );
//                    $this->Cookie->write('Basket.'.($max_basket_id + 1), $product);
//                } else if(!empty($data['product_det_id'])) {
//                    $product = array(
//                        'product_det_id' => $data['product_det_id'],
//                        'cnt' => $data['cnt']);
//                    $this->Cookie->write('Basket.'.($max_basket_id + 1), $product);
//                } else {
//                    $this->set('error', 'Не указан номер товара');
//                }
//            }
//
//            //подсчет количества товаров в корзине и их общей стоимости
//            //а заодно обновление стоимости товаров в куках
//            $basket = $this->Cookie->read('Basket');
//            $products_id = array();
//            $product_dets_id = array();
//            foreach($basket as $product) {
//                if(!empty($product['product_id'])) {
//                    $products_id[] = $product['product_id'];
//                } else if(!empty($product['product_det_id'])) {
//                    $product_dets_id[] = $product['product_det_id'];
//                }
//            }
//            $products = $this->Product->find('all', array(
//                'conditions' => array(
//                    'Product.id' => $products_id
//                ),
//                'recursive' => -1
//            ));
//            $products = Set::combine($products, '{n}.Product.id', '{n}.Product');
//            $product_dets = $this->ProductDet->find('all', array(
//                'conditions' => array(
//                    'ProductDet.id' => $product_dets_id
//                ),
//                'recursive' => -1
//            ));
//            $product_dets = Set::combine($product_dets, '{n}.ProductDet.id', '{n}.ProductDet');
//            $all_cnt = 0;
//            $all_price = 0;
//            foreach($basket as $basket_id => $product) {
//                $cur_cnt = $product['cnt'];
//                $all_cnt += $cur_cnt;
//                if(!empty($product['product_id'])) {
//                    $cur_price = $products[$product['product_id']]['price'];
//                    if($products[$product['product_id']]['cnt']<=0) $cur_price = 0;
//                    $all_price += $cur_price * $cur_cnt;
//
//                    $this->Cookie->write('Basket.'.$basket_id, array(
//                        'product_id' => $product['product_id'],
//                        'cnt' => $cur_cnt,
//                        'price' => $cur_price
//                    ));
//                } else if(!empty($product['product_det_id'])) {
//                    $cur_price = $product_dets[$product['product_det_id']]['price'];
//                    if($product_dets[$product['product_det_id']]['cnt']<=0) $cur_price = 0;
//                    $all_price += $cur_price * $cur_cnt;
//
//                    $this->Cookie->write('Basket.'.$basket_id, array(
//                        'product_det_id' => $product['product_det_id'],
//                        'cnt' => $cur_cnt,
//                        'price' => $cur_price
//                    ));
//                }
//            }
//            $this->set('all_cnt', $all_cnt);
//            $this->set('all_price', $all_price);
//        } else {
//            $this->set('error', 'Неверный ajax-запрос');
//            return;
//        }
//    }
//
//    function update() {
//        //обновить данные корзины - ajax
//        if($this->params['isAjax'] == 1 && !empty($this->data)) {
//            $this->layout = 'ajax';
//
//            $data = $this->data['Basket'];
//            $basket = $this->Cookie->read('Basket');
//            $updated_price = array();
//            $all_cnt = 0;
//            $all_price = 0;
//            foreach($basket as $basket_key=>$product) {
//                if(!empty($data[$basket_key]['cnt'])) {
//                    $product['cnt'] = $data[$basket_key]['cnt'];
//                }
//                $this->Cookie->write('Basket.'.$basket_key, $product);
//
//                $updated_price[$basket_key] = $product['price']*$product['cnt'];
//
//                $all_cnt += $product['cnt'];
//                $all_price += $product['price']*$product['cnt'];
//            }
//
//            $this->Set('updated_price', $updated_price);
//            $this->Set('all_cnt', $all_cnt);
//            $this->Set('all_price', $all_price);
//        }
//    }
//
//    function delete() {
//        //удалить товар из корзины - ajax
//        if($this->params['isAjax'] == 1) {
//            $this->layout = 'ajax';
//
//            $data = $this->params['form'];
//            $deleting_basket_key = $data['basket_key'];
//            $this->Cookie->del('Basket.'.$deleting_basket_key);
//
//            $basket = $this->Cookie->read('Basket');
//            $all_cnt = 0;
//            $all_price = 0;
//            foreach($basket as $basket_key => $product) {
//                $all_cnt += $product['cnt'];
//                $all_price += $product['price']*$product['cnt'];
//            }
//
//            $this->Set('all_cnt', $all_cnt);
//            $this->Set('all_price', $all_price);
//        }
//    }
//
//    function index() {
//        $basket_data = $this->Basket->prepareBasketData();
//        $this->set('basket_data', $basket_data);
//
//        $this->pageTitle = 'Корзина товаров';
//
//        $this->actionJs[] = 'jquery-ui-1.8.5.custom.min';
//    }
//
//    function user_info() {
//        if($this->Auth2->user()) {
//            $curUser = $this->Session->read('Auth');
//            if (isset($this->params['requested'])) {
//                return $curUser;
//            }
//        }
//    }
}

?>
