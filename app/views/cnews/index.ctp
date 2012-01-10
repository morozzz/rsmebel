<div class="div-left-column">
    <div id="div-basket"><?php echo $this->element('basket');?></div>
    <div class="div-specials"><?php echo $this->element('specials');?></div>
    <div class="div-news"><?php echo $this->element('news');?></div>
</div>
<div class="div-right-column">
    <div class="div-main-news">
    <h1>Новости</h1>
    <?php echo $this->element('paginate');?>
        <?php foreach($cnews as $cnew) { ?>
        <div class="div-main-new">
            <?php
            echo $html->link($cnew['Cnew']['stamp'], array(
                'controller' => 'cnews',
                'action' => 'view',
                $cnew['Cnew']['eng_name']
            ), array(
                'class' => 'link-main-new-stamp'
            ));
            echo $html->div('div-main-new-caption', $cnew['Cnew']['caption']);
            ?>
        </div>
        <?php } ?>
    </div>
</div>
