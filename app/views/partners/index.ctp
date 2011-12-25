<div class="div-left-column">
    <div class="div-specials"><?php echo $this->element('specials');?></div>
    <div class="div-news"><?php echo $this->element('news');?></div>
</div>
<div class="div-right-column">
    <h1>Партнеры</h1>
    <div class="div-partners">
        <?php echo $this->element('paginate');?>
        <?php foreach($partners as $partner) { ?>
        <div class="div-partner">
            <?php
            echo $html->tag('h2', $partner['Partner']['name']);
            echo $html->image($partner['Image']['url'], array(
                'class' => 'image-partner'
            ));
            echo $html->div('div-partner-text', $partner['Partner']['text']);
            ?>
        </div>
        <?php } ?>
    </div>
</div>
