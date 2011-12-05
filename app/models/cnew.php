<?php

class CNew extends AppModel {
    var $name = 'Cnew';
    var $belongsTo = array(
        'SmallImage' => array(
            'className' => 'Image',
            'foreignKey' => 'small_image_id'
        ),
        'BigImage' => array(
            'className' => 'Image',
            'foreignKey' => 'big_image_id'
        )
    );

}

?>
