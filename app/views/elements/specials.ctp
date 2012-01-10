<?php $specials = $this->requestAction('/specials/get_specials'); ?>
<?php if(!empty($specials)) { ?>
<h2>Спец. предложения</h2>
<?php foreach($specials as $special) { ?>
<div class="div-special" align="center">
    <?php
    echo $html->image($special['Image']['url'], array(
        'class' => 'image-special',
        'url' => array(
            'controller' => 'products',
            'action' => 'index',
            $special['Special']['url']
        )
    ));
    echo $html->link('в корзину', array(
        'controller' => 'basket',
        'action' => 'add',
        '?product_id='.$special['Special']['product_id']
    ), array(
        'class' => 'link-add-special-to-basket'
    ));
    ?>
</div>
<?php } ?>
<?php } ?>
