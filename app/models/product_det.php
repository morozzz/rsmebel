<?php

class ProductDet extends AppModel {
    var $name = 'ProductDet';
    var $actsAs = array(
        'Image' => array(
            'images' => array(
                'small_image_id' => 'SmallImage',
                'big_image_id' => 'BigImage'
            ),
            'image_type_id' => 7
        ),
        'Code1c',
        'SortOrder'
    );
    var $belongsTo = array(
        'Product',
        'SmallImage' => array(
            'className' => 'Image',
            'foreignKey' => 'small_image_id'
        ),
        'BigImage' => array(
            'className' => 'Image',
            'foreignKey' => 'big_image_id'
        )
    );
    var $order = 'ProductDet.sort_order';

    var $field_types = array(
        'product_id' => 'number',
        'name' => 'text',
        'price' => 'number',
        'opt_price' => 'number',
        'cnt' => 'number',
        'sort_order' => 'number',
        'code_1c' => 'text',
        'name_1c' => 'text',
        'about' => 'text',
        'SmallImage' => 'file',
        'BigImage' => 'file'
    );
}

?>
