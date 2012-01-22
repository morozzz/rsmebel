<?php

class ClientInfo extends AppModel {
    var $name = 'ClientInfo';
    var $belongsTo = array("CompanyType", "ProfilType", "ClientType");
    var $transactional = true;

}

?>
