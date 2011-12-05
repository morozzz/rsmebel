<?php

class BasketController extends AppController {
    var $name = "Basket";
    var $uses = array(
        'Catalog',
        'Product',
        'ProductDet',
        'ProductParamType',
        'ProductDetParamValue'
    );
    var $components = array(
        "Cookie",
        "Basket"
    );
    var $helpers = array(
        'basket'
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

    function add() {
        //добавить товар в корзину - ajax
        if($this->params['isAjax'] == 1) {
            $this->layout = 'ajax';

            $data = $this->params['form'];
            /* дата должна быть вида
             *  array(
             *      product_id => ###
             *      cnt => ###
             *  );
             * или
             *  array(
             *      product_det_id => ###
             *      cnt => ###
             *  );
             */
            if(empty($data['cnt']) || $data['cnt']<=0) {
                $this->set('error', 'Количество товара должно быть больше нуля');
                return;
            }

            $basket = $this->Cookie->read('Basket');
            if(empty($basket)) $basket = array();
            $is_new_product = true;
            $max_basket_id = 0;
            foreach($basket as $basket_id => $product) {
                if($basket_id > $max_basket_id) {
                    $max_basket_id = $basket_id;
                }
                if(!empty($product['product_id']) &&
                        !empty($data['product_id']) &&
                        $product['product_id'] == $data['product_id']) {
                    $cur_cnt = (empty($product['cnt']))?0:$product['cnt'];
                    $new_cnt = $cur_cnt + $data['cnt'];
                    $this->Cookie->write('Basket.'.$basket_id, array(
                        'product_id' => $product['product_id'],
                        'cnt' => $new_cnt
                    ));
                    $is_new_product = false;
                    break;
                } else if(!empty($product['product_det_id']) &&
                        !empty($data['product_det_id']) &&
                        $product['product_det_id'] == $data['product_det_id']) {
                    $cur_cnt = (empty($product['cnt']))?0:$product['cnt'];
                    $new_cnt = $cur_cnt + $data['cnt'];
                    $this->Cookie->write('Basket.'.$basket_id, array(
                        'product_det_id' => $product['product_det_id'],
                        'cnt' => $new_cnt
                    ));
                    $is_new_product = false;
                    break;
                }
            }
            if($is_new_product) {
                if(!empty($data['product_id'])) {
                    $product = array(
                        'product_id' => $data['product_id'],
                        'cnt' => $data['cnt']
                    );
                    $this->Cookie->write('Basket.'.($max_basket_id + 1), $product);
                } else if(!empty($data['product_det_id'])) {
                    $product = array(
                        'product_det_id' => $data['product_det_id'],
                        'cnt' => $data['cnt']);
                    $this->Cookie->write('Basket.'.($max_basket_id + 1), $product);
                } else {
                    $this->set('error', 'Не указан номер товара');
                }
            }

            //подсчет количества товаров в корзине и их общей стоимости
            //а заодно обновление стоимости товаров в куках
            $basket = $this->Cookie->read('Basket');
            $products_id = array();
            $product_dets_id = array();
            foreach($basket as $product) {
                if(!empty($product['product_id'])) {
                    $products_id[] = $product['product_id'];
                } else if(!empty($product['product_det_id'])) {
                    $product_dets_id[] = $product['product_det_id'];
                }
            }
            $products = $this->Product->find('all', array(
                'conditions' => array(
                    'Product.id' => $products_id
                ),
                'recursive' => -1
            ));
            $products = Set::combine($products, '{n}.Product.id', '{n}.Product');
            $product_dets = $this->ProductDet->find('all', array(
                'conditions' => array(
                    'ProductDet.id' => $product_dets_id
                ),
                'recursive' => -1
            ));
            $product_dets = Set::combine($product_dets, '{n}.ProductDet.id', '{n}.ProductDet');
            $all_cnt = 0;
            $all_price = 0;
            foreach($basket as $basket_id => $product) {
                $cur_cnt = $product['cnt'];
                $all_cnt += $cur_cnt;
                if(!empty($product['product_id'])) {
                    $cur_price = $products[$product['product_id']]['price'];
                    if($products[$product['product_id']]['cnt']<=0) $cur_price = 0;
                    $all_price += $cur_price * $cur_cnt;

                    $this->Cookie->write('Basket.'.$basket_id, array(
                        'product_id' => $product['product_id'],
                        'cnt' => $cur_cnt,
                        'price' => $cur_price
                    ));
                } else if(!empty($product['product_det_id'])) {
                    $cur_price = $product_dets[$product['product_det_id']]['price'];
                    if($product_dets[$product['product_det_id']]['cnt']<=0) $cur_price = 0;
                    $all_price += $cur_price * $cur_cnt;

                    $this->Cookie->write('Basket.'.$basket_id, array(
                        'product_det_id' => $product['product_det_id'],
                        'cnt' => $cur_cnt,
                        'price' => $cur_price
                    ));
                }
            }
            $this->set('all_cnt', $all_cnt);
            $this->set('all_price', $all_price);
        } else {
            $this->set('error', 'Неверный ajax-запрос');
            return;
        }
    }

    function update() {
        //обновить данные корзины - ajax
        if($this->params['isAjax'] == 1 && !empty($this->data)) {
            $this->layout = 'ajax';

            $data = $this->data['Basket'];
            $basket = $this->Cookie->read('Basket');
            $updated_price = array();
            $all_cnt = 0;
            $all_price = 0;
            foreach($basket as $basket_key=>$product) {
                if(!empty($data[$basket_key]['cnt'])) {
                    $product['cnt'] = $data[$basket_key]['cnt'];
                }
                $this->Cookie->write('Basket.'.$basket_key, $product);

                $updated_price[$basket_key] = $product['price']*$product['cnt'];

                $all_cnt += $product['cnt'];
                $all_price += $product['price']*$product['cnt'];
            }

            $this->Set('updated_price', $updated_price);
            $this->Set('all_cnt', $all_cnt);
            $this->Set('all_price', $all_price);
        }
    }

    function delete() {
        //удалить товар из корзины - ajax
        if($this->params['isAjax'] == 1) {
            $this->layout = 'ajax';

            $data = $this->params['form'];
            $deleting_basket_key = $data['basket_key'];
            $this->Cookie->del('Basket.'.$deleting_basket_key);

            $basket = $this->Cookie->read('Basket');
            $all_cnt = 0;
            $all_price = 0;
            foreach($basket as $basket_key => $product) {
                $all_cnt += $product['cnt'];
                $all_price += $product['price']*$product['cnt'];
            }

            $this->Set('all_cnt', $all_cnt);
            $this->Set('all_price', $all_price);
        }
    }

    function index() {
        $basket_data = $this->Basket->prepareBasketData();
        $this->set('basket_data', $basket_data);

        $this->pageTitle = 'Корзина товаров';

        $this->actionJs[] = 'jquery-ui-1.8.5.custom.min';
    }

    function user_info() {
        if($this->Auth2->user()) {
            $curUser = $this->Session->read('Auth');
            if (isset($this->params['requested'])) {
                return $curUser;
            }
        }
    }
}

?>
