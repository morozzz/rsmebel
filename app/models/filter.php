<?php

class Filter extends AppModel {
    var $name = 'Filter';

    var $belongsTo = array(
        'ProductParamType',
        'Catalog',
        'FilterType'
    );

    var $field_types = array(
        'product_param_type_id' => 'number',
        'filter_type_id' => 'number',
        'catalog_id' => 'number',
        'sort_order' => 'number'
    );

    var $order = 'Filter.sort_order';

    function beforeSave() {
        if(!empty($this->data['Filter']['filter_type_id']) &&
                $this->data['Filter']['filter_type_id'] == 3) {
            $this->data['Filter']['product_param_type_id'] = null;
        }
        return true;
    }
}

?>