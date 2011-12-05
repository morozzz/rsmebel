<?php

class LoadCatalog extends AppModel {
    var $name = 'LoadCatalog';
    var $hasMany = 'LoadCatalogDet';
    var $belongsTo = 'User';
}

?>
