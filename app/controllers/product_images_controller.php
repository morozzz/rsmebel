<?php

class ProductImagesController extends AppController {
    var $name = 'ProductImages';
    var $uses = array(
        'Catalog',
        'Image',
        'Product',
        'ProductDet',
        'ProductImage',
        'Special'
    );
    var $components = array(
        'AdminCommon'
    );
    var $helpers = array(
        'AdminCommon'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();
    }
    
    function admin_index($product_id) {
        $this->layout = 'admin';
        
        $product = $this->Product->find('first', array(
            'conditions' => array(
                'Product.id' => $product_id
            ),
            'contain' => array()
        ));
        
        $this->set('product', $product);
        $this->pageTitle = "Администрирование - {$product['Product']['name']} - изображения";
        
        $product_images = $this->ProductImage->find('all', array(
            'conditions' => array(
                'ProductImage.product_id' => $product_id
            ),
            'contain' => array(
                'SmallImage',
                'BigImage'
            )
        ));
        $product_images = Set::combine($product_images, '{n}.ProductImage.id', '{n}');
        $this->set('product_images', $product_images);
    }

    function admin_save_all() {
        $this->AdminCommon->save_all($this->data, $this->ProductImage);
        $this->redirect($this->referer());
        die;
    }

    function admin_add() {
        $this->AdminCommon->add($this->data, $this->ProductImage);
        die;
    }

    function admin_delete() {
        $this->AdminCommon->delete($this->data, $this->ProductImage);
        die;
    }
}

?>
