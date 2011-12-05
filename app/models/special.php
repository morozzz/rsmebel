<?php

class Special extends AppModel {
    var $name = 'Special';
    var $belongsTo = array(
        'Product',
        'ProductDet'
    );

    var $caches = array(
        'adm_specials',
        'specials'
    );

    var $field_types = array(
        'product_id' => 'number',
        'product_det_id' => 'number',
        'date1' => 'text',
        'date2' => 'text',
        'prob' => 'number'
    );

    function beforeSave() {
        if(!empty($this->data['Special']['date1']))
                $this->data['Special']['date1'] = date('Y.m.d',
                        strtotime($this->data['Special']['date1']));
        if(!empty($this->data['Special']['date2']))
                $this->data['Special']['date2'] = date('Y.m.d',
                        strtotime($this->data['Special']['date2']));
        return true;
    }

    function afterFind($results, $primary) {
        foreach($results as &$result) {
            if(!empty($result['Special']['date1']))
                $result['Special']['date1'] =
                    date('d.m.Y', strtotime($result['Special']['date1']));
            if(!empty($result['Special']['date2']))
                $result['Special']['date2'] =
                    date('d.m.Y', strtotime($result['Special']['date2']));
        }
        return $results;
    }
}

?>
