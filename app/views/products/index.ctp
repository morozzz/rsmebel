<div class="div-left-column">
    <div class="div-specials"><?php echo $this->element('specials');?></div>
    <div class="div-news"><?php echo $this->element('news');?></div>
</div>
<div class="div-right-column">
    <h1><?php echo $current_product['Product']['name'];?></h1>
    <div class="div-product-image">
        <?php echo $html->image($current_product['BigImage']['url'], array(
            'class' => 'image-product'
        ));?>
    </div>
    <div class="div-product-about">
        <?php echo $current_product['Product']['about'];?>
    </div>
</div>
