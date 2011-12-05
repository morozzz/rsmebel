<?php

class Alert extends AppModel {
    var $name = 'Alert';
    var $field_types = array(
        'message' => 'text',
        'caption' => 'text',
        'stamp' => 'text',
        'enabled' => 'number'
    );
    var $order = 'Alert.stamp DESC, Alert.id DESC';

    var $clearCache = true;

    function beforeSave() {
        if(!empty($this->data['Alert']['stamp'])) {
                $this->data['Alert']['stamp'] = date('Y.m.d',
                        strtotime($this->data['Alert']['stamp']));
        } else {
            $this->data['Alert']['stamp'] = date('Y.m.d');
        }
        return true;
    }

    function afterFind($results, $primary) {
        foreach($results as &$result) {
            if(!empty($result['Alert']['stamp']))
                $result['Alert']['stamp'] =
                    date('d.m.Y', strtotime($result['Alert']['stamp']));

            $result['Alert']['enable_str'] = ($result['Alert']['enabled'])?'X':'';
        }
        return $results;
    }
}

?>
