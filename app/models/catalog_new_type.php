<?php

class CatalogNewType extends AppModel {
    var $name = 'CatalogNewType';

    var $field_types = array(
        'name' => 'text'
    );

    function getIdByName($name) {
        $id = $this->find('first', array(
            'conditions' => array(
                'CatalogNewType.name' => $name
            )
        ));

        if(empty($id)) {
            $this->create();
            $this->save(array(
                'name' => $name
            ));
            $id = $this->id;
        } else {
            $id = $id['CatalogNewType']['id'];
        }

        return $id;
    }
}

?>
