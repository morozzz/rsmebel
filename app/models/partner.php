<?php

class Partner extends AppModel {
    var $name = 'Partner';
    var $order = 'Partner.sort_order';
    var $actsAs = array(
        'Image' => array(
            'images' => array(
                'image_id' => 'Image'
            ),
            'image_type_id' => 9
        )
    );
    var $belongsTo = array(
        'Image'
    );
    
    var $field_types = array(
        'enabled' => 'number',
        'name' => 'text',
        'text' => 'text',
        'Image' => 'file',
        'sort_order' => 'number'
    );
}

?>
