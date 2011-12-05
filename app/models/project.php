<?php

class Project extends AppModel {
    var $name = 'Project';

    var $belongsTo = array(
        'ProjectProfile',
        'SmallImage' => array(
            'className' => 'Image',
            'foreignKey' => 'small_image_id'
        ),
        'BigImage' => array(
            'className' => 'Image',
            'foreignKey' => 'big_image_id'
        )
    );
    
    var $hasMany = array(
        'ProjectSlide'
    );

    var $order = 'Project.sort_order';
}

?>
