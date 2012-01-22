<?php
class CustomClientInfo extends AppModel {

    var $name = 'CustomClientInfo';
    var $belongsTo = array(
        'CompanyType',
        'PayType',
        'TransportType'
    );

    var $validate = array(
        'fio' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => 'Введите ФИО',
                'last' => true
            )
        )
    );
}
?>
