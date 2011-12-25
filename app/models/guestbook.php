<?php

class Guestbook extends AppModel {
    var $name = 'Guestbook';
    var $order = 'Guestbook.sort_order, Guestbook.created DESC';

    function beforeSave() {
        if(!empty($this->data['Guestbook']['created']))
                $this->data['Guestbook']['created'] = date('Y.m.d',
                        strtotime($this->data['Guestbook']['created']));
        if(!empty($this->data['Guestbook']['updated']))
                $this->data['Guestbook']['updated'] = date('Y.m.d',
                        strtotime($this->data['Guestbook']['updated']));
        return true;
    }

    function afterFind($results, $primary) {
        foreach($results as &$result) {
            if(!empty($result['Guestbook']['created']))
                $result['Guestbook']['created'] =
                    date('d.m.Y', strtotime($result['Guestbook']['created']));
            if(!empty($result['Guestbook']['updated']))
                $result['Guestbook']['updated'] =
                    date('d.m.Y', strtotime($result['Guestbook']['updated']));
        }
        return $results;
    }
}

?>
