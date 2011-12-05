<?php

class Article extends AppModel {
    var $name = 'Article';
    var $actsAs = array(
        'Image' => array(
            'images' => array(
                'small_image_id' => 'SmallImage'
            ),
            'image_type_id' => 5
        )
    );
    var $belongsTo = array(
        'SmallImage' => array(
            'className' => 'Image',
            'foreignKey' => 'small_image_id'
        )
    );
    var $hasMany = array(
        'ArticlePage',
        'ArticleTypeList'
    );
    var $hasAndBelongsToMany = array(
        'ArticleType' => array(
            'with' => 'ArticleTypeList',
            'unique' => true
        )
    );
    var $field_types = array(
        'caption' => 'text',
        'short_note' => 'text',
        'SmallImage' => 'file',
        'stamp' => 'text',
        'sort_order' => 'number'
    );
    var $order = 'Article.sort_order, Article.stamp DESC';
    var $limit = 5;

    function beforeSave() {
        if(!empty($this->data['Article']['stamp']))
                $this->data['Article']['stamp'] = date('Y.m.d',
                        strtotime($this->data['Article']['stamp']));
        return true;
    }

    function afterFind($results, $primary) {
        foreach($results as &$result) {
            if(!empty($result['Article']['stamp']))
                $result['Article']['stamp'] =
                    date('d.m.Y', strtotime($result['Article']['stamp']));
        }
        return $results;
    }
}

?>
