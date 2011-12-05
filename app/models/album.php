<?php

class Album extends AppModel {
    var $name = 'Album';
    var $actsAs = array(
        'Image' => array(
            'images' => array(
                'small_image_id' => 'SmallImage'
            ),
            'image_type_id' => 8
        )
    );
    var $belongsTo = array(
        'SmallImage' => array(
            'className' => 'Image',
            'foreignKey' => 'small_image_id'
        )
    );
    var $hasMany = array(
        'AlbumPhoto'
    );
    var $field_types = array(
        'name' => 'text',
        'short_about' => 'text',
        'long_about' => 'text',
        'SmallImage' => 'file',
        'stamp' => 'text',
        'sort_order' => 'number'
    );
    var $order = 'Album.sort_order, Album.stamp DESC';

    function beforeSave() {
        if(!empty($this->data['Album']['stamp']))
                $this->data['Album']['stamp'] = date('Y.m.d',
                        strtotime($this->data['Album']['stamp']));
        return true;
    }

    function afterFind($results, $primary) {
        foreach($results as &$result) {
            if(!empty($result['Album']['stamp']))
                $result['Album']['stamp'] =
                    date('d.m.Y', strtotime($result['Album']['stamp']));
        }
        return $results;
    }
}

?>
