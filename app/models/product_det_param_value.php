<?php

class ProductDetParamValue extends AppModel {
    var $name = 'ProductDetParamValue';
//    var $belongsTo = array('Image');

    var $field_types = array(
        'name' => 'text',
        'product_param_type_id' => 'number'
    );

    var $caches = array(
        'product_det_param_value_list',
        'all_catalogs'
    );

    function getIdByName($name, $product_param_type_id) {
        $id = $this->find('first', array(
            'conditions' => array(
                'ProductDetParamValue.name' => $name,
                'ProductDetParamValue.product_param_type_id' => $product_param_type_id
            )
        ));

        if(empty($id)) {
            $this->create();
            $this->save(array(
                'name' => $name,
                'product_param_type_id' => $product_param_type_id
            ));
            $id = $this->id;
        } else {
            $id = $id['ProductDetParamValue']['id'];
        }

        return $id;
    }
}

?>
