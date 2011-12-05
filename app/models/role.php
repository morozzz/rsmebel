<?php

class Role extends AppModel {
    var $name = 'Role';
    var $hasMany = 'User';
    var $displayField = 'role_name';
}

?>
