<?php

class ArticlePage extends AppModel {
    var $name = 'ArticlePage';
    var $belongsTo = array(
        'Article'
    );
    var $order = 'ArticlePage.sort_order';

    var $field_types = array(
        'sort_order' => 'number',
        'article_id' => 'number',
        'page' => 'text'
    );
}

?>
