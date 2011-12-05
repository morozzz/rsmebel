<?php

class DesignOrder extends AppModel {
    var $name = 'DesignOrder';
    var $hasMany = 'DesignOrderDet';
    var $belongsTo = 'DesignOrderStatus';
}

?>
