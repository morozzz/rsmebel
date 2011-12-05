<?php

class Section extends AppModel {
    var $name = 'Section';
    var $hasMany = 'SectionDet';
    var $belongsTo = 'SectionType';
}

?>
