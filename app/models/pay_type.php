<?php

class PayType extends AppModel {
    var $name = 'PayType';
    var $field_types = array(
        'name' => 'text',
        'sort_order' => 'number'
    );
    var $order = 'PayType.sort_order';
}

?>
