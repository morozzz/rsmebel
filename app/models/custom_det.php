<?php

class CustomDet extends AppModel {
    var $name = 'CustomDet';
    
    var $belongsTo = array(
        'Product',
        'ProductDet'
    );
}

?>
