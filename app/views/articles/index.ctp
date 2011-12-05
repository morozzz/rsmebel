<?php echo $this->element('caption', array(
    'caption_name' => 'Статьи',
    'caption_tag' => 'h1'
)); ?>
<?php echo $this->element('articles_combo_box'); ?>
<div class="div-article-wrapper">
    <div class="div-article-types">
        <?php foreach($article_type_list as $t_article_type_id => $article_type) { ?>
        <li class="text-shadow <?php if($t_article_type_id==$article_type_id) echo 'current';?>">
            <?php
            if($t_article_type_id == 0) $t_article_type_id = '';
            echo $html->link($article_type, '/articles/index/'.$t_article_type_id);
            ?>
        </li>
        <?php } ?>
    </div>
    <div class="div-articles">
        <?php foreach($articles as $article) { ?>
        <div class="div-article">
            <?php echo $this->element('caption', array(
                'caption_name' => $html->link($article['Article']['caption'], '/article_pages/index/'.$article['Article']['id'].'/1'),
                'caption_tag' => 'h2'
            )); ?>
            <div class="div-article-body">
                <div class="div-article-image">
                    <div class="div-article-image-1">
                        <div class="div-article-image-2">
                            <div class="div-article-image-3"
                                 style="background: url(<?php echo $this->webroot.'img/'.$article['SmallImage']['url'];?>) no-repeat center center">
                                <?php echo $html->image($article['SmallImage']['url']); ?>
                                <?php echo $html->link('', '/article_pages/index/'.$article['Article']['id'].'/1');?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="div-article-date">
                    - <?php echo $article['Article']['stamp'];?>
                </div>
                <div class="div-article-note">
                    <?php echo $article['Article']['short_note'];?>
                </div>
            </div>
        </div> 
        <?php } ?>
    </div>
    <div style="clear:both;"></div>
</div>

<script type="text/javascript">
    var webroot = "<?php echo $this->webroot;?>";
    $('.pagination-limit-select').change(function() {
        var limit = $(this).val();
        var url = webroot+'articles/index/<?php if($article_type_id>0) echo "$article_type_id/"?>limit:'+limit;
        window.location = url;
    });
</script>