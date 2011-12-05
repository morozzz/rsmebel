<?php

class ProjectSlide extends AppModel {
    var $name = 'ProjectSlide';

    var $belongsTo = array(
        'Project',
        'SmallImage' => array(
            'className' => 'Image',
            'foreignKey' => 'small_image_id'
        ),
        'BigImage' => array(
            'className' => 'Image',
            'foreignKey' => 'big_image_id'
        )
    );

    var $order = 'ProjectSlide.sort_order';
}

?>
