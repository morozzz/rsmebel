<?php

class ProductDetImagesController extends AppController {
    var $name = 'ProductDetImages';
    var $uses = array(
        'Catalog',
        'Image',
        'Product',
        'ProductDet',
        'ProductImage',
        'ProductDetImage',
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
    
    function admin_index($product_det_id) {
        $this->layout = 'admin';
        
        $product_det = $this->ProductDet->find('first', array(
            'conditions' => array(
                'ProductDet.id' => $product_det_id
            ),
            'contain' => array(
                'Product'
            )
        ));
        
        $this->set('product_det', $product_det);
        $this->pageTitle = "Администрирование - {$product_det['Product']['name']} - {$product_det['ProductDet']['name']} - изображения";

        $product_det_images = $this->ProductDetImage->find('all', array(
            'conditions' => array(
                'ProductDetImage.product_det_id' => $product_det_id
            ),
            'contain' => array(
                'SmallImage',
                'BigImage'
            )
        ));
        $product_det_images = Set::combine($product_det_images, '{n}.ProductDetImage.id', '{n}');
        $this->set('product_det_images', $product_det_images);
    }

    function admin_save_all() {
        $this->AdminCommon->save_all($this->data, $this->ProductDetImage);
        $this->redirect($this->referer());
        die;
    }

    function admin_add() {
        $this->AdminCommon->add($this->data, $this->ProductDetImage);
        die;
    }

    function admin_delete() {
        $this->AdminCommon->delete($this->data, $this->ProductDetImage);
        die;
    }
}

?>
