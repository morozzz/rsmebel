<?php
echo $html->image('divan.jpg', array(
    'id' => 'image-divan',
    'alt' => 'Диван',
    'url' => '/'
));
echo $html->image('region_sib_mebel.jpg', array(
    'id' => 'image-region-sib-mebel',
    'alt' => 'РегионСибМебель',
    'url' => '/'
));
echo $html->image('magazin_domashnego_yuta.jpg', array(
    'id' => 'image-magazin-domashnego-yuta',
    'alt' => 'Магазин домашнего уюта',
    'url' => '/'
))
?>
<div id="div-top-right">
    <div id="div-top-auth"><?php echo $this->element('auth_box');?></div>
    <div id="div-top-phone">8(391)264-97-22</div>
    <div id="div-top-work-time">в будние дни, с 9.00 до 19.00</div>
    <div id="div-top-search"><?php echo $this->element('top_search');?></div>
</div>