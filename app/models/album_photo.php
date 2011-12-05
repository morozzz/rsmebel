<?php

class AlbumPhoto extends AppModel {
    var $name = 'AlbumPhoto';
    var $actsAs = array(
        'Image' => array(
            'images' => array(
                'small_image_id' => 'SmallImage',
                'big_image_id' => 'BigImage'
            ),
            'image_type_id' => 8
        )
    );
    var $belongsTo = array(
        'SmallImage' => array(
            'className' => 'Image',
            'foreignKey' => 'small_image_id'
        ),
        'BigImage' => array(
            'className' => 'Image',
            'foreignKey' => 'big_image_id'
        ),
        'Album'
    );
    var $field_types = array(
        'album_id' => 'number',
        'short_about' => 'text',
        'long_about' => 'text',
        'SmallImage' => 'file',
        'BigImage' => 'file',
        'sort_order' => 'number'
    );
    var $order = 'AlbumPhoto.sort_order';
}

?>
