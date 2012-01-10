<?php if(!isset($basket)) $basket = $this->requestAction('basket/get');?>
<?php extract($basket);?>
<h2><?php echo $html->link('Корзина', array(
    'controller' => 'basket',
    'action' => 'index'
), array(
    'class' => 'link-basket-header'
));
if(!empty($products) || !empty($product_dets)) {
    echo $html->link('(очистить)', array(
        'controller' => 'basket',
        'action' => 'clear'
    ), array(
        'id' => 'link-clear-basket'
    ));
}?></h2>
<div class="div-basket-products">
    <?php if(empty($products) && empty($product_dets)) { ?>
    <div class="div-basket-clear">Ваша корзина пуста</div>
    <?php } else {
        $all_cnt = 0; $all_price = 0;
        $price_name = ($is_opt_price)?'opt_price':'price';
        
        foreach($products as $product) {
            $cur_cnt = $product['Basket']['cnt'];
            $cur_price = $product['Product'][$price_name];
            
            $all_cnt += $cur_cnt;
            $all_price += $cur_cnt*$cur_price;
        }
        
        foreach($product_dets as $product_det) {
            $cur_cnt = $product_det['Basket']['cnt'];
            $cur_price = $product_det['ProductDet'][$price_name];
            
            $all_cnt += $cur_cnt;
            $all_price += $cur_cnt*$cur_price;
        }
        
        $word_end = $common->getWordEnd($all_cnt);
        echo "В вашей корзине $all_cnt товар$word_end на $all_price руб.";
        
        echo $html->link('оформить заказ', array(
            'controller' => 'basket',
            'action' => 'index'
        ), array(
            'class' => 'link-custom-order'
        ));
    } ?>
</div>

<script type="text/javascript">
    $('#link-clear-basket').click(function() {
        $('#div-basket').load($(this).attr('href'));
        return false;
    });
</script>