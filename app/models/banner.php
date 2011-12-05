<?php

class Banner extends AppModel {
    var $name = 'Banner';
    var $belongsTo = array(
        'Image'
    );
    var $order = 'Banner.sort_order';
}

?>
