
<?php
   $basket_info = $this->requestAction('catalogs/get_basket');

   echo "<div>";
    echo $html->link(
          $html->image('basket.png', array(
              'class' => 'basket-image'
          )).'Ваша корзина: ', array(
              'controller' => 'basket',
              'action' => 'index'
          ), array(
              'escape' => false
          ));
    if($basket_info['basket_cnt'] > 0) {
        echo ' '.$basket_info['basket_cnt'].' наименовани'.$common->getWordEnd($basket_info['basket_cnt']);
        echo " на ".$basket_info['basket_price']." рублей";
       echo "</div>";
        echo "<div'>";
        echo $html->link('Оформление заказа', '/customs/order', array(
            'style' => 'color: white; padding-left: 32px;'
        ));
        echo "</div>";
    } else {
        echo "В вашей корзине нет товаров";
       echo "</div>";
    }
?>