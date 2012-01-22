<?php

class Custom extends AppModel {
    var $name = 'Custom';
    var $belongsTo = array(
        'CustomStatusType',
        'User'
    );
    var $hasOne = array(
        'CustomClientInfo'
    );
    var $hasMany = array(
        'CustomStatus' => array(
            'order' => 'CustomStatus.created, CustomStatus.id'
        ),
        'CustomDet'
    );
    var $order = 'Custom.created desc';

    var $transactional = true;

    function beforeFind($queryData) {
        //добавляем к полям количество и стоимость товаров
        // + дата создания в хорошем формате
        if(empty($queryData['fields']))
            $queryData['fields'] = array(
                '*',
                '(SELECT sum(CustomDet.cnt) FROM cake_custom_dets CustomDet WHERE CustomDet.custom_id = Custom.id) sum_cnt',
                '(SELECT sum(CustomDet.cnt*CustomDet.price) FROM cake_custom_dets CustomDet WHERE CustomDet.custom_id = Custom.id) sum_price',
                'date_format(Custom.created, "%d.%m.%Y") created_date'
            );
        return $queryData;
    }
}

?>
