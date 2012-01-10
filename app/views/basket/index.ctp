<div class="div-left-column">
    <div id="div-basket"><?php echo $this->element('basket', array('basket' => $basket));?></div>
    <div class="div-specials"><?php echo $this->element('specials');?></div>
    <div class="div-news"><?php echo $this->element('news');?></div>
</div>
<div class="div-right-column">
    <div id="div-custom-order">
        <h1>Корзина</h1>
        <?php debug($basket);?>
    </div>
</div>