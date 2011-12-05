<?php

class SortOrderBehavior extends ModelBehavior {
    var $name = 'SortOrder';

    function setup(&$Model, $setting) {
        $setting = array_merge(array(
            'field' => 'sort_order'
        ), $setting);
        $this->setting = $setting;
    }

    function getMinSortOrder(&$Model, $conditions = array()) {
        extract($this->setting);

        $min_sort_order = $Model->find('first', array(
            'fields' => array(
                "min($field) AS min_sort_order"
            ),
            'conditions' => $conditions,
            'recursive' => -1
        ));
        $min_sort_order = $min_sort_order[0]['min_sort_order'];
        if(empty($min_sort_order)) $min_sort_order = 0;
        return $min_sort_order;
    }

    function getMaxSortOrder(&$Model, $conditions = array()) {
        extract($this->setting);

        $max_sort_order = $Model->find('first', array(
            'fields' => array(
                "max($field) AS max_sort_order"
            ),
            'conditions' => $conditions,
            'recursive' => -1
        ));
        $max_sort_order = $max_sort_order[0]['max_sort_order'];
        if(empty($max_sort_order)) $max_sort_order = 0;
        return $max_sort_order;
    }
}

?>
