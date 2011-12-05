<?php

class DesignOrderDet extends AppModel {
    var $name = 'DesignOrderDet';
    var $belongsTo = array(
        'BigImage' => array(
            'className' => 'Image',
            'foreignKey' => 'big_image_id'
        ),
      'Section'
    );
}

?>
