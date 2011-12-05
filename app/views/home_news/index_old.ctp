<div class="div-caption-container">
    <div class="div-news-caption">
        <h1 class="pie">
            <a href="<?php echo $html->url('/cnews/');?>">
                Новости
            </a>
        </h1>
    </div>
    <div class="div-specials-caption">
        <h1 class="pie">
            <a href="<?php echo $html->url('/specials/index/');?>">
                Спецпредложения
            </a>
        </h1>
    </div>
    <div class="div-to-caption">
        <h1 class="pie">
            <a href="<?php echo $html->url('/catalogs/index/');?>">
                Торговое оборудование
            </a>
        </h1>
    </div>
</div>
<div style="clear:both;"></div>

<div class="div-content-container">
<div class="div-content-sub-container div-content-container-1">
<div class="div-content-sub-container div-content-container-2">
<div class="div-content-sub-container div-content-container-3">
<div class="div-content-sub-container div-content-container-4">
<div class="div-content-sub-container div-content-container-5">
    <div class="div-content-news">
        <cake:nocache>
        <?php
        echo $this->element('cnews_box');
        ?>
        </cake:nocache>
    </div>
    <div class="div-widget-to">
        <div class="div-content-to">
            <div id="text2">
                <div class="div-slideshow-content-1">
                    <div class="div-slideshow-content-2 pie" align="center">
                        <div class="div-slideshow-content-3">
                            <div id="slideshow-content">
                              <?php $is_first = true;
                              foreach($slides as $slide) {
                              $style = 'style="display:none;"';
                              if($is_first) {
                                  $style='';
                                  $is_first = false;
                              }?>
                              <div class="slide" align="center" <?php echo $style;?>>
                                  <a href="<?php echo $html->url($slide['Slide']['link']);?>"
                                     class="link-slide"
                                     style="background: url(<?php echo $this->webroot.'img/'.$slide['Image']['url'];?>) center center no-repeat">
                                      <?php echo $html->image($slide['Image']['url']);?>
                                  </a>
                              </div>
                              <?php } ?>
                            </div>
                        </div>
                        <div id="slideshow-pages">
                            <?php for($i=1; $i<=count($slides); $i++) {
                                $class = '';
                                if($i==1) $class = 'activeSlide';
                                echo $html->link($i, '#', array(
                                    'class' => $class
                                ));
                            }?>
                        </div>

                        <div class="div-short-links">
                            <span class="short-link-caption">Быстрые ссылки:</span>
                            <?php $is_first = true;
                            foreach($short_links as $short_link) {
                            if($is_first) {
                                $is_first = false;
                            } else {
                                echo $html->image('small-gray-circle.png', array(
                                    'class' => 'img-short-link-separator'
                                ));
                            }?>
                            <span class="short-link">
                                <a href="<?php echo $short_link['ShortLink']['link'];?>">
                                    <?php echo $short_link['ShortLink']['name'];?>
                                </a>
                            </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="catalog-home pie">
                    <div class="catalog-home2">
                        <div class="div-catalog-lists">
                            <?php foreach($path_trees as $path_tree_key=>$path_tree) { ?>
                                <div class="div-catalog-list">
                                    <ul class="list-catalog">
                                        <?php foreach($path_tree as $catalog_id => $catalog_node) { ?>
                                        <li class="li-catalog li-catalog-<?php echo $catalog_node['level'];?>">
                                            <h3 class="catalog-tree-name catalog-tree-name-level<?php echo $catalog_node['level'];?>">
                                                <a href="<?php echo $html->url('/catalogs/index/'.$catalog_id);?>">
                                                    <?php
                                                    if($catalog_node['level'] == 0) echo ' - ';
                                                    echo $catalog_node['Catalog']['name'];
                                                    ?>
                                                </a>
                                            </h3>

                                            <?php
                                            if($catalog_node['level'] == 0) {
                                                echo $html->image($catalog_node['SmallImage']['url'], array(
                                                    'class' => 'catalog-list-image',
                                                    'url' => '/catalogs/index/'.$catalog_id
                                                ));
                                            }

                                            if($catalog_node['hasChild']) {
                                                echo '<ul class="ul-catalog ul-catalog-'.$catalog_node['level'].'">';
                                            } else {
                                                echo '</li>';
                                            }
                                            for($i=0; $i<$catalog_node['finishBlock']; $i++) {
                                             echo '</ul></li>';
                                            }
                                            ?>
                                        <!--</li>-->
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                            <div style="clear: both;"></div>
                        </div>
                    </div>

                    <div id="home-text" class="pie">
                      <cake:nocache>
                      <?php
                        echo $this->element('home_news_box');
                      ?>
                      </cake:nocache>
                    </div>
                </div>
          </div>
        </div>
    </div>
    <div class="div-content-specials">
        <cake:nocache>
        <?php echo $this->element('specials_box'); ?>
        </cake:nocache>
    </div>
    <div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</div>
</div>