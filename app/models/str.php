<?php

class Str extends AppModel {
    var $name = 'Str';
    var $useTable = 'strings';
    var $order = 'Str.id';
    var $belongsTo = array('StringType');

    var $field_types = array(
        'str' => 'text'
    );

    var $caches = array('strs');
}

?>
