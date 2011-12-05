<?php

class ShortLink extends AppModel {
    var $name = 'ShortLink';
    var $order = 'ShortLink.sort_order';

    var $field_types = array(
        'name' => 'text',
        'link' => 'text',
        'sort_order' => 'number'
    );

    var $caches = array('short_links');
}

?>