<?php
    if(!empty($error)) {
        echo $error;
    } else {
        echo $basket->getBasketStr($all_cnt, $all_price);
    }
?>