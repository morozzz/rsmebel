<?php
    $obj = array(
        'basket_str' => $basket->getBasketStr($all_cnt, $all_price),
        'all_price' => $all_price,
        'all_cnt' => $all_cnt
    );
    echo '('.$javascript->object($obj).')';
?>