<?php

class CommonHelper extends AppHelper {
    function getWordEnd($cnt) {
        if($cnt%100>=11 && $cnt%100<=19) {
            return 'ов';
        } else if($cnt%10==1) {
            return '';
        } else if($cnt%10>=2 && $cnt%10<=4) {
            return 'а';
        } else {
            return 'ов';
        }
    }
}

?>
