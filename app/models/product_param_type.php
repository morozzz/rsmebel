<?php

class ProductParamType extends AppModel {
    var $name = 'ProductParamType';

    var $hasMany = array(
        'ProductParam',
        'ProductDetParamValue'
    );

    var $field_types = array(
        'name' => 'text',
        'postfix' => 'text'
    );

    var $caches = array(
        'adm_product_param_types',
        'product_param_type_list',
        'all_catalogs'
    );

    function getIdByName($name) {
        $id = $this->find('first', array(
            'conditions' => array(
                'ProductParamType.name' => $name
            )
        ));

        if(empty($id)) {
            $this->create();
            $this->save(array(
                'name' => $name
            ));
            $id = $this->id;
        } else {
            $id = $id['ProductParamType']['id'];
        }

        return $id;
    }
}

?>
