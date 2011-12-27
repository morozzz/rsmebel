<?php

class Cnew extends AppModel {
    var $name = 'Cnew';
    var $order = 'Cnew.sort_order';

    function beforeSave() {
        if(!empty($this->data['Cnew']['stamp']))
                $this->data['Cnew']['stamp'] = date('Y.m.d',
                        strtotime($this->data['Cnew']['stamp']));
        return true;
    }

    function afterFind($results, $primary) {
        foreach($results as &$result) {
            if(!empty($result['Cnew']['stamp']))
                $result['Cnew']['stamp'] =
                    date('d.m.Y', strtotime($result['Cnew']['stamp']));
        }
        return $results;
    }

}

?>
