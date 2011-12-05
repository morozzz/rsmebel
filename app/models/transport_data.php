<?php

class TransportData extends AppModel {
    var $name = 'TransportData';
    var $hasOne = array(
        'TransportAddress'
    );
    var $belongsTo = array(
        'TransportType'
    );
}

?>
