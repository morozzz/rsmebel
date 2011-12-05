<?php

class TransportType extends AppModel {
    var $name = 'TransportType';
    var $hasMany = array(
        'TransportTypeAbout'
    );
}

?>
