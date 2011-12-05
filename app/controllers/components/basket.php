<?php

class BasketComponent extends Object {
    var $components = array(
        "Cookie"
    );

    function prepareBasketData() {
        $basket_data = $this->Cookie->read('Basket');

        $this->Catalog =& new Catalog();
        $this->Product =& new Product();
        $this->ProductDet =& new ProductDet();
        $this->ProductParamType =& new ProductParamType();
        $this->ProductDetParamValue =& new ProductDetParamValue();

        if(empty($basket_data)) $basket_data = array();
        $products_id = array();
        $product_dets_id = array();
        foreach($basket_data as $product) {
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
            'contain' => array(
                'ProductData' => array(
                    'ProductParamType',
                    'ProductDetParamValue',
                    'order' => 'ProductData.sort_order'
                ),
                'SmallImage'
            )
        ));
        $products = Set::combine($products, '{n}.Product.id', '{n}');

        $product_dets = $this->ProductDet->find('all', array(
            'conditions' => array(
                'ProductDet.id' => $product_dets_id
            ),
            'contain' => array(
                'Product' => array(
                    'SmallImage'
                ),
                'SmallImage',
                'ProductDetParam' => array(
                    'ProductParam' => array(
                        'ProductParamType',
                        'order' => 'ProductParam.sort_order'
                    ),
                    'ProductDetParamValue'
                )
            )
        ));
        $product_dets = Set::combine($product_dets, '{n}.ProductDet.id', '{n}');

        foreach($basket_data as $basket_data_key => &$data) {
            if(!empty($data['product_id'])) {
                $product = $products[$data['product_id']];

                $data['name'] = $product['Product']['name'];
                $data['price'] = $product['Product']['price'];
                if($product['Product']['cnt']<=0) $data['price'] = 0;
                $data['total_price'] = $data['price']*$data['cnt'];
                $data['image_url'] = $product['SmallImage']['url'];
                $data['catalog_path'] = $this->Catalog->getPathLink($product['Product']['catalog_id']);

                $data['code_1c'] = $product['Product']['code_1c'];
                $data['name_1c'] = $product['Product']['name_1c'];

                $datas_text = "";
                foreach($product['ProductData'] as $product_data) {
                    $datas_text .= $product_data['ProductParamType']['name'].
                    ": ".$product_data['ProductDetParamValue']['name']."; ";
                }
                $data['short_about'] = $product['Product']['short_about'].$datas_text;

                $this->Cookie->write('Basket.'.$basket_data_key, array(
                    'product_id' => $data['product_id'],
                    'cnt' => $data['cnt'],
                    'price' => $data['price']
                ));
            } else if(!empty($data['product_det_id'])) {
                $product_det = $product_dets[$data['product_det_id']];

                $data['product_id'] = $product_det['ProductDet']['product_id'];
                $data['name'] = $product_det['Product']['name'];
                $data['price'] = $product_det['ProductDet']['price'];
                if($product_det['ProductDet']['cnt']<=0) $data['price'] = 0;
                $data['total_price'] = $data['price']*$data['cnt'];
                if(empty($product_det['ProductDet']['small_image_id']))
                    if(empty($product_det['Product']['SmallImage']))
                        $data['image_url'] = 'nopic.gif';
                    else
                        $data['image_url'] = $product_det['Product']['SmallImage']['url'];
                else
                    $data['image_url'] = $product_det['SmallImage']['url'];
                $data['catalog_path'] = $this->Catalog->getPathLink($product_det['Product']['catalog_id']);

                $data['code_1c'] = $product_det['ProductDet']['code_1c'];
                $data['name_1c'] = $product_det['ProductDet']['name_1c'];

                $short_about = $product_det['ProductDet']['short_about'];
                if(empty($short_about) || $short_about=="") {
                    $short_about = $product_det['Product']['short_about'];
                }
                $param_text = "";
                foreach($product_det['ProductDetParam'] as $product_det_param) {
                    $param_text .= $product_det_param['ProductParam']['ProductParamType']['name'].
                        ": ".$product_det_param['ProductDetParamValue']['name']."; ";
                }
                $data['short_about'] = $short_about.$param_text;

                $this->Cookie->write('Basket.'.$basket_data_key, array(
                    'product_det_id' => $data['product_det_id'],
                    'cnt' => $data['cnt'],
                    'price' => $data['price']
                ));
            }
        }

        return $basket_data;
    }

    function clear() {
        $this->Cookie->del('Basket');
    }
}

?>