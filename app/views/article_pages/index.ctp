<?php echo $this->element('caption', array(
    'caption_name' => $article['Article']['caption'],
    'caption_tag' => 'h1'
)); ?>
<div class="div-article-info-background">
    <div class="div-article-info">
        <div class="div-article-info-left">
            <div class="div-article-date"> - <?php echo $article['Article']['stamp'];?></div>
            <?php if(!empty($article_type_lists)) { ?>
            <div class="div-article-type-lists">
                Тематика статьи:
                <?php
                $flag = false;
                foreach($article_type_lists as $article_type) {
                    if($flag) {
                        echo ", ";
                    }
                    $flag = true;
                    echo $html->link($article_type['ArticleType']['name'],
                            '/articles/index/'.$article_type['ArticleType']['id']);
                }
                ?>
            </div>
            <?php } ?>
        </div>
        <div class="div-article-info-right">
            <?php echo $html->link('архив статей > > >', '/articles/index/');?>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>
<div class="div-article">
    <div class="div-article-pages-pagination">
        <div class="div-article-pages-pagination-prev">
            <?php if($article_index>1) { ?>
            <a href="<?php echo $html->url("/article_pages/index/".
                $article['Article']['id']."/".($article_index-1)); ?>">
                < < < назад
            </a>
            <?php } ?>
        </div>
        <div class="div-article-pages-pagination-next">
            <?php if($article_index<$article_page_cnt) { ?>
            <a href="<?php echo $html->url("/article_pages/index/".
                $article['Article']['id']."/".($article_index+1)); ?>">
                вперед > > >
            </a>
            <?php } ?>
        </div>
        <div class="div-article-pages-pagination-numbers">
            <?php
            for($index=1; $index<=$article_page_cnt; $index++) {
                echo "<span class='span-article-pages-pagination-number'>";
                if($index == $article_index) {
                    echo $index;
                } else {
                    echo $html->link($index, '/article_pages/index/'.$article['Article']['id'].'/'.$index);
                }
                echo "</span>";
            }
            ?>
        </div>
    </div>
    <div class="div-article-page">
        <div class="div-article-page-text">
            <?php echo $article_page['ArticlePage']['page'];?>
        </div>
    </div>
    <div class="div-article-pages-pagination">
        <div class="div-article-pages-pagination-prev">
            <?php if($article_index>1) { ?>
            <a href="<?php echo $html->url("/article_pages/index/".
                $article['Article']['id']."/".($article_index-1)); ?>">
                < < < назад
            </a>
            <?php } ?>
        </div>
        <div class="div-article-pages-pagination-next">
            <?php if($article_index<$article_page_cnt) { ?>
            <a href="<?php echo $html->url("/article_pages/index/".
                $article['Article']['id']."/".($article_index+1)); ?>">
                вперед > > >
            </a>
            <?php } ?>
        </div>
        <div class="div-article-pages-pagination-numbers">
            <?php
            for($index=1; $index<=$article_page_cnt; $index++) {
                echo "<span class='span-article-pages-pagination-number'>";
                if($index == $article_index) {
                    echo $index;
                } else {
                    echo $html->link($index, '/article_pages/index/'.$article['Article']['id'].'/'.$index);
                }
                echo "</span>";
            }
            ?>
        </div>
    </div>
</div>