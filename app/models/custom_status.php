<?php

class CustomStatus extends AppModel {
    var $name = 'CustomStatus';
    var $belongsTo = array(
        'User'
    );

    function beforeFind($queryData) {
        //добавляем к полям количество и стоимость товаров
        // + дата создания в хорошем формате
        if(empty($queryData['fields']))
            $queryData['fields'] = array(
                '*',
                'date_format(CustomStatus.created, "%d.%m.%Y") created_date'
            );
        return $queryData;
    }
}

?>
