<?php

class DilerInfo extends AppModel {
    var $name = 'DilerInfo';
    var $field_types = array(
        'fio' => 'text',
        'workpost' => 'text',
        'email' => 'text',
        'phone' => 'text',
        'fax' => 'text',
        'company_name' => 'text',
        'city' => 'text',
        'note' => 'text',
        'stamp' => 'text'
    );
    var $order = 'DilerInfo.stamp DESC, DilerInfo.id DESC';

    function beforeSave() {
        $this->data['DilerInfo']['stamp'] = date('Y.m.d');
//        if(!empty($this->data['DilerInfo']['stamp']))
//                $this->data['DilerInfo']['stamp'] = date('Y.m.d',
//                        strtotime($this->data['DilerInfo']['stamp']));
        return true;
    }

    function afterFind($results, $primary) {
        foreach($results as &$result) {
            if(!empty($result['DilerInfo']['stamp']))
                $result['DilerInfo']['stamp'] =
                    date('d.m.Y', strtotime($result['DilerInfo']['stamp']));
        }
        return $results;
    }
}

?>
