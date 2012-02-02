<?php

class Search extends AppModel {
    var $name = 'Search';
    
    var $belongsTo = array(
        'Image'
    );
    
    var $order = 'Search.type_order, Search.sort_order';
}

?>
