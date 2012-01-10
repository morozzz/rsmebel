<div class="div-left-column">
    <div id="div-basket"><?php echo $this->element('basket');?></div>
    <div class="div-specials"><?php echo $this->element('specials');?></div>
    <div class="div-news"><?php echo $this->element('news');?></div>
</div>
<div class="div-right-column">
    <div class="div-main-new">
        <?php
        echo $html->tag('h1', $cnew['Cnew']['caption']);
        echo $html->div('div-main-new-stamp', $cnew['Cnew']['stamp']);
        echo $html->div('div-main-new-text', $cnew['Cnew']['text']);
        ?>
    </div>
</div>