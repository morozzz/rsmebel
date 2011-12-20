<?php

class Special extends AppModel {
    var $name = 'Special';
    var $order = 'Special.sort_order';
    var $actsAs = array(
        'Image' => array(
            'images' => array(
                'image_id' => 'Image'
            )
        )
    );
    var $belongsTo = array(
        'Image',
        'Product'
    );
    
    var $field_types = array(
        'product_id' => 'number',
        'sort_order' => 'number',
        'enabled' => 'number',
        'Image' => 'file'
    );
}

?>
