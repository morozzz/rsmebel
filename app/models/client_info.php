<?php

class ClientInfo extends AppModel {
    var $name = 'ClientInfo';
    var $belongsTo = array("CompanyType", "ProfilType", "ClientType");
    var $transactional = true;

//    var $validate = array(
//        'name' => array(
//            'notempty' => array(
//                'rule' => 'notEmpty',
//                'message' => 'Введите название фирмы',
//                'last' => true
//            )
//         )
//    );

}

?>
