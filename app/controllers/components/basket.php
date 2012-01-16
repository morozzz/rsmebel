<?php

class BasketComponent extends Object {
    var $components = array(
        'Cookie'
    );

    function initialize(&$controller) {
        $this->Product =& $controller->Product;
        $this->ProductDet =& $controller->ProductDet;
    }
    
    function get() {
        $basket_products = $this->Cookie->read('BasketProduct');
        if(empty($basket_products)) $basket_products = array();
        $basket_product_dets = $this->Cookie->read('BasketProductDet');
        if(empty($basket_product_dets)) $basket_product_dets = array();
        
        $products = $this->Product->find('all', array(
            'conditions' => array(
                'Product.id' => array_keys($basket_products)
            ),
            'contain' => array()
        ));
        foreach($products as &$product) {
            $product['Basket'] = $basket_products[$product['Product']['id']];
        }
        
        $product_dets = $this->ProductDet->find('all', array(
            'conditions' => array(
                'ProductDet.id' => array_keys($basket_product_dets)
            ),
            'contain' => array(
                'Product'
            )
        ));
        foreach($product_dets as &$product_det) {
            $product_det['Basket'] = $basket_product_dets[$product_det['ProductDet']['id']];
        }
        
        return array(
            'products' => $products,
            'product_dets' => $product_dets
        );
    }
    
    function add($product_id, $product_det_id, $count) {
        if(!empty($product_det_id)) {
            $basket = $this->Cookie->read('BasketProductDet');
            $cnt = 0;
            if(!empty($basket[$product_det_id])) {
                $cnt = $basket[$product_det_id]['cnt'];
                if($cnt<0) $cnt=0;
            }
            $cnt+=$count;
            if($cnt>0) {
                $this->Cookie->write("BasketProductDet.$product_det_id", array(
                    'cnt' => $cnt
                ));
            }
        } else if(!empty($product_id)) {
            $basket = $this->Cookie->read('BasketProduct');
            $cnt = 0;
            if(!empty($basket[$product_id])) {
                $cnt = $basket[$product_id]['cnt'];
                if($cnt<0) $cnt=0;
            }
            $cnt+=$count;
            if($cnt>0) {
                $this->Cookie->write("BasketProduct.$product_id", array(
                    'cnt' => $cnt
                ));
            }
        }
    }
    
    function clear() {
        $basket = $this->Cookie->read("BasketProduct");
        if(!empty($basket)) {
            foreach($basket as $product_id => $b) {
                $this->Cookie->del("BasketProduct.$product_id");
            }
        }
        $basket = $this->Cookie->read("BasketProductDet");
        if(!empty($basket)) {
            foreach($basket as $product_id => $b) {
                $this->Cookie->del("BasketProductDet.$product_id");
            }
        }
    }
}

?>
