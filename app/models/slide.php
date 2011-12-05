<?php

class Slide extends AppModel {
    var $name = 'Slide';
    var $belongsTo = array(
        'Image'
    );
    var $order = 'Slide.sort_order';
}

?>
