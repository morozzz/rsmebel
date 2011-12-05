<?php $specials = $this->requestAction('home_news/specials_box'); ?>

<?php
$first = true;
foreach($specials as $special) {?>
<?php if(!$first) { ?>
<div class="div-special-separator">
    <div class="div-special-separator-left"></div>
    <div class="div-special-separator-center"></div>
</div>
<?php } else {
    $first = false;
} ?>
<?php $img_url = $this->webroot.'img/'.$special['image_url'];?>
<div class="div-special">
    <div class="div-special-image-container">
        <a class="span-special-image"
           style="background: url(<?php echo $img_url;?>) center center no-repeat white;"
           href="<?php echo $html->url('/products/index/'.$special['product_id']);?>">
            <img src="<?php echo $img_url;?>" width="150" height="150"/>
        </a>
    </div>

    <div class="div-special-name">
        <a href="<?php echo $html->url('/products/index/'.$special['product_id']);?>">
            <?php echo $special['name'];?>
        </a>
    </div>
    <div class="div-special-price">
        Цена:
        <span class="span-special-price">
            <span style="visibility: hidden;"><?php echo $special['price'];?> р.</span>
            <span class="span-special-price-text"><?php echo $special['price'];?> р.</span>
            <?php echo $html->image('special-item-price-background.png', array(
                'class' => 'img-special-price-background iepngfix'
            ));?>
        </span>
    </div>
</div>
<?php } ?>
<div class="div-special-bottom-separator"></div>
<div class="div-special-bottom"></div>