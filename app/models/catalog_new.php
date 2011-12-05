<?php

class CatalogNew extends AppModel {
    var $name = 'CatalogNew';
    var $belongsTo = array(
        'Catalog',
        'CatalogNewType'
    );
    var $order = 'CatalogNew.sort_order, CatalogNew.stamp DESC';
    var $field_types = array(
        'catalog_new_type_name' => 'text',
        'catalog_new_type_id' => 'number',
        'catalog_id' => 'number',
        'stamp' => 'text',
        'sort_order' => 'number'
    );

    function beforeSave() {
        if(!empty($this->data[$this->name]['catalog_new_type_name'])) {
            $catalog_new_type_name = $this->data[$this->name]['catalog_new_type_name'];
            unset($this->data[$this->name]['catalog_new_type_name']);

            $catalog_new_type_id = $this->CatalogNewType->getIdByName($catalog_new_type_name);
            $this->data[$this->name]['catalog_new_type_id'] = $catalog_new_type_id;
        }
        if(!empty($this->data[$this->name]['stamp']))
                $this->data[$this->name]['stamp'] = date('Y.m.d',
                        strtotime($this->data[$this->name]['stamp']));

        return true;
    }

    function afterFind($results, $primary) {
        foreach($results as &$result) {
            if(!empty($result['CatalogNew']['stamp']))
                $result['CatalogNew']['stamp'] =
                    date('d.m.Y', strtotime($result['CatalogNew']['stamp']));
        }
        return $results;
    }
}

?>
