<?php

class ProjectCatalog extends AppModel {
    var $name = 'ProjectCatalog';

    var $belongsTo = array(
        'Project',
        'Catalog'
    );
}

?>
