<?php

class SpecialBehavior extends ModelBehavior {
    var $name = 'Special';

    function setup(&$Model, $setting) {
        $setting = array_merge(array(
            'class' => 'Special',
            'field_id' => 'id',
            'field_date1' => 'date1',
            'field_date2' => 'date2',
            'field_special' => 'is_special',
            'field_special_class' => 'special_class',
            'special_class' => 'tr-special',
            'no_special_class' => ''
        ), $setting);
        $this->setting = $setting;
    }

    function afterFind(&$Model, $results, $primary) {
        extract($this->setting);

        $now = strtotime('now');
        if($primary) {
            foreach($results as &$result) {
                if(isset($result[$class])) {
                    if(empty($result[$class][$field_id])) {
                        $result[$field_special] = 0;
                    } else {
                        $date1 = strtotime($result[$class][$field_date1]);
                        if(empty($date1)) $date1 = $now;
                        $date2 = strtotime($result[$class][$field_date2]);
                        if(empty($date2)) $date2 = $now;
                        if( ($date1 <= $now) && ($now <= $date2) ) {
                            $result[$field_special] = 1;
                        } else {
                            $result[$field_special] = 0;
                        }
                    }
                    if($result[$field_special] == 1)
                        $result[$field_special_class] = $special_class;
                    else
                        $result[$field_special_class] = $no_special_class;
                }
            }
        } else {
            if(isset($results[$class])) {
                if(empty($results[$class][$field_id])) {
                    $results[$field_special] = 0;
                } else {
                    $date1 = strtotime($results[$class][$field_date1]);
                    if(empty($date1)) $date1 = $now;
                    $date2 = strtotime($results[$class][$field_date2]);
                    if(empty($date2)) $date2 = $now;

                    if( ($date1 <= $now) && ($now <= $date2) ) {
                        $results[$field_special] = 1;
                    } else {
                        $results[$field_special] = 0;
                    }
                }
                if($results[$field_special] == 1)
                    $results[$field_special_class] = $special_class;
                else
                    $results[$field_special_class] = $no_special_class;
            }
        }
        return $results;
    }
}

?>
