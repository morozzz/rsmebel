<?php

class ProductImage extends AppModel {
    var $name = 'ProductImage';
    var $actsAs = array(
        'Image' => array(
            'images' => array(
                'small_image_id' => 'SmallImage',
                'big_image_id' => 'BigImage'
            ),
            'image_type_id' => 7
        )
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
    var $order = 'ProductImage.sort_order';

    var $field_types = array(
        'name' => 'text',
        'product_id' => 'number',
        'sort_order' => 'number',
        'SmallImage' => 'file',
        'BigImage' => 'file'
    );
}

?>
