<?php

class ProjectSlideCatalog extends AppModel {
    var $name = 'ProjectSlideCatalog';

    var $belongsTo = array(
        'ProjectSlide',
        'Catalog'
    );
}

?>
