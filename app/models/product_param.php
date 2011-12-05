<?php

class ProductParam extends AppModel {
    var $name = 'ProductParam';
    var $belongsTo = array(
        'ProductParamType',
        'ProductParamShowType',
        'Product'
    );
    var $hasMany = array(
        'ProductDetParam'
    );
    var $hasAndBelongsToMany = array(
        'ProductDet' => array(
            'className' => 'ProductDet',
            'with' => 'ProductDetParam',
            'order' => 'ProductDet.sort_order',
            'unique' => true
        )
    );
    var $order = 'ProductParam.sort_order';

    var $field_types = array(
        'product_id' => 'number',
        'product_param_type_id' => 'number',
        'product_param_type_name' => 'text',
        'product_param_show_type_id' => 'number',
        'sort_order' => 'number'
    );

    var $caches = array(
        'all_catalogs'
    );

    function beforeSave() {
        if(!empty($this->data[$this->name]['product_param_type_name'])) {
            $product_param_type_name = $this->data[$this->name]['product_param_type_name'];
            unset($this->data[$this->name]['product_param_type_name']);

            $product_param_type_id = $this->ProductParamType->getIdByName($product_param_type_name);
            $this->data[$this->name]['product_param_type_id'] = $product_param_type_id;
        }
        if(!empty($this->data[$this->name]['product_id'])) {
            $this->product_id = $this->data[$this->name]['product_id'];
        }
        
        return true;
    }

    function afterSave($created) {
        if($created && !empty($this->product_id)) {
            $product_dets = $this->ProductDet->find('all', array(
                'conditions' => array(
                    'ProductDet.product_id' => $this->product_id
                ),
                'contain' => array()
            ));
            foreach($product_dets as $product_det) {
                $this->ProductDetParam->save(array(
                    'product_det_id' => $product_det['ProductDet']['id'],
                    'product_param_id' => $this->id,
                    'value' => ""
                ));
            }
        }
        if(!$created) {
            $product_det_params = $this->ProductDetParam->find('all', array(
                'conditions' => array(
                    'ProductDetParam.product_param_id' => $this->id
                ),
                'contain' => array(
                    'ProductDetParamValue'
                )
            ));
            foreach($product_det_params as $product_det_param) {
                $product_det_param['ProductDetParam']['value'] =
                    $product_det_param['ProductDetParamValue']['name'];
                unset($product_det_param['ProductDetParamValue']);
                $this->ProductDetParam->save($product_det_param);
//                $product_det_param_id = $product_det_param['ProductDetParam']['id'];
//                $name = $product_det_param['ProductDetParamValue']['name'];
//                $product_det_param_value_id = $this->ProductDetParam->
//                        ProductDetParamValue->getIdByName($name, $this->data[$this->name]['product_param_type_id']);
//                debug($product_det_param_id);
//                debug($name);
//                debug($product_det_param_value_id);
//                $this->ProductDetParam->save(array(
//                    'id' => $product_det_param_id,
//                    'product_det_param_value_id' => $product_det_param_value_id
//                ));
            }
        }
    }

    function beforeDelete() {
        $product_det_params = $this->ProductDetParam->find('all', array(
            'conditions' => array(
                'ProductDetParam.product_param_id' => $this->id
            ),
            'contain' => array()
        ));
        foreach($product_det_params as $product_det_param) {
            $this->ProductDetParam->delete(
                    $product_det_param['ProductDetParam']['id'], false);
        }

        return parent::beforeDelete();
    }
}

?>
