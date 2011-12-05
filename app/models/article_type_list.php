<?php

class ArticleTypeList extends AppModel {
    var $name = 'ArticleTypeList';
    var $belongsTo = array(
        'Article',
        'ArticleType'
    );
    var $order = 'ArticleTypeList.id';

    var $field_types = array(
        'article_id' => 'number',
        'article_type_id' => 'number'
    );
}

?>
