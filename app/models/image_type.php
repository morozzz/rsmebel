<?php

class ImageType extends AppModel {
    var $name = 'ImageType';

    var $belongsTo = array(
        'ImageTemplate'
    );
}

?>
