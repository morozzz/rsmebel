<?php

class CommonComponent extends Object {

    function RepairImage(&$array) {
        foreach($array as $key => $element) {
            if(empty($element['SmallImage']) || empty($element['SmallImage']['url'])) {
                $array[$key]['SmallImage'] = array(
                    'url' => 'nopic.gif'
                );
            }
            if(empty($element['BigImage']) || empty($element['BigImage']['url'])) {
                $array[$key]['BigImage'] = array(
                    'url' => 'nopic.gif'
                );
            }
        }
    }
}

?>
