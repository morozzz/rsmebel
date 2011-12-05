<?php

class ExportController extends AppController {
    var $name = 'Export';
    var $uses = array(
        'Product'
    );
    
    function novosibirsk_rosfirm_ru_images($limit=20) {
        $this->layout = 'print';
        $this->pageTitle = 'Картинки для novosibirsk.rosfirm.ru';
        $products = $this->Product->query("select Product.id
                from cake_products Product,
                (select product_id, count(*) cnt 
                   from cake_custom_dets
                   where custom_id in 
                         (select id from cake_customs
                          where custom_status_type_id = 7)
                   group by product_id having count(*)>3) t
                where Product.id = t.product_id
                order by t.cnt desc, Product.price desc limit $limit");
        $products_id = Set::combine($products, '{n}.Product.id', '{n}.Product.id');
        $products = $this->Product->find('all', array(
            'contain' => array(
                'SmallImage'
            ),
            'conditions' => array(
                'Product.id' => $products_id
            )
        ));
        $this->set('products', $products);
    }
    
    function novosibirsk_rosfirm_ru_excel($limit=20) {
//        $this->layout = 'print';
        $this->layout = 'excel';
        set_time_limit(600);
        App::import('Vendor', '/phpexcel/PHPExcel', array('file' => 'PHPExcel.php'));
        $objPHPExcel = new PHPExcel();
        $this->set('objPHPExcel', $objPHPExcel);
        $this->set('url_to_image', 'http://'.$this->Session->host.$this->webroot.'img/');
        
        $this->pageTitle = 'Картинки для novosibirsk.rosfirm.ru';
        $products = $this->Product->query("select Product.id
                from cake_products Product,
                (select product_id, count(*) cnt 
                   from cake_custom_dets
                   where custom_id in 
                         (select id from cake_customs
                          where custom_status_type_id = 7)
                   group by product_id having count(*)>3) t
                where Product.id = t.product_id
                order by t.cnt desc, Product.price desc limit $limit");
        $products_id = Set::combine($products, '{n}.Product.id', '{n}.Product.id');
        $products = $this->Product->find('all', array(
            'contain' => array(
                'SmallImage'
            ),
            'conditions' => array(
                'Product.id' => $products_id
            )
        ));
        $this->set('products', $products);
    }
}

?>
