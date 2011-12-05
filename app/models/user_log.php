<?php

class UserLog extends AppModel {
    var $name = 'UserLog';

    var $belongsTo = array(
        'User',
        'UserLogType'
    );

    var $order = 'UserLog.stamp DESC';

    function beforeSave() {
        if(!empty($this->data['UserLog']['stamp']))
                $this->data['UserLog']['stamp'] = date('Y.m.d H:i:s',
                        strtotime($this->data['UserLog']['stamp']));
        return true;
    }

    function afterFind($results, $primary) {
        foreach($results as &$result) {
            if(!empty($result['UserLog']['stamp']))
                $result['UserLog']['stamp'] =
                    date('d.m.Y H:i:s', strtotime($result['UserLog']['stamp']));
        }
        return $results;
    }
}

?>
