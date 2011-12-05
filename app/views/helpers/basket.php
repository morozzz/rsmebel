<?php

class BasketHelper extends AppHelper {
    var $helpers = array(
        'Common',
        'Html'
    );
    
    function getBasketStr($all_cnt, $all_price) {
        $str = '';
        $str .= '<div>';
        $str .= $this->Html->link(
              $this->Html->image('basket.png', array(
                  'class' => 'basket-image'
              )).'Ваша корзина:', array(
                  'controller' => 'basket',
                  'action' => 'index'
              ), array(
                  'escape' => false
              ));

        if($all_cnt>0) {
            $str .= ' '.$all_cnt.' наименовани'.$this->Common->getWordEnd($all_cnt);
            $str .= " на ".$all_price." рублей";
            $str .= "</div>";
            $str .= "<div>";
            $str .= $this->Html->link('Оформление заказа', '/customs/order', array(
                'style' => 'color: white; padding-left: 32px;'
            ));
            $str .= "</div>";
        } else {
            $str .= ' В вашей корзине нет товаров';
            $str .= "</div>";
        }

        return $str;
    }
}

?>
