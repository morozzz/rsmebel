<?php

class QuestionProductsController extends AppController {
    var $name = 'QuestionProducts';
    var $uses = array(
        'QuestionProduct',
        'QuestionProductType'
    );
    var $helpers = array(
        'AdminCommon'
    );
    var $components = array(
        'AdminCommon'
    );

    function beforeFilter() {
        parent::beforeFilter();
    }

    function isAuthorized() {
        if(!empty($this->curUser)) {
            if($this->action == 'admin_index' || $this->action == 'save_all'
                    || $this->action == 'delete'
                    || $this->action == 'delete_list') {
                return $this->curUser['User']['role_id'] == 3;
            }
        }
        return false;
    }
    
    function admin_index() {
        Configure::write('debug', 2);
        $this->pageTitle = 'Вопросы по товарам';
        $this->layout = 'admin';
        
        $this->paginate = array(
            'QuestionProduct' => array(
                'contain' => array()
            )
        );
        $question_products = $this->paginate('QuestionProduct');
        $question_products = Set::combine($question_products, '{n}.QuestionProduct.id', '{n}');
        foreach($question_products as &$question_product) {
            $question_product['QuestionProduct']['product_link'] =
                '/products/index/'.
                $question_product['QuestionProduct']['product_id'];
        }
        $this->set('question_products', $question_products);
        
        $question_product_type_list = $this->QuestionProductType->find('list', array());
        $this->set('question_product_type_list', $question_product_type_list);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->QuestionProduct);
        $this->redirect($this->referer());
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->QuestionProduct);
        die;
    }

    function delete_list() {
        $this->AdminCommon->delete_list($this->data, $this->QuestionProduct);
        die;
    }
}

?>
