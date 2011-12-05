
<div class="container3 captions">
   <div class="fluid-left3">
       <div class="div-news-caption">
          <a href="<?php echo $this->webroot; ?>cnews/">
              <div class="div-news-caption-right"></div>
              <div class="div-news-caption-center">
                  <?php echo $html->image('news-caption-center.png', array(
                      'class' => 'img-news-caption-center'
                  ));?>
                  <div class="div-news-caption-text">Новости</div>
                  <div class="div-news-caption-shade">Новости</div>
              </div>
          </a>
       </div>
   </div>
   <div class="fluid-right3">
       <div class="div-special-caption">
          <a href="<?php echo $this->webroot; ?>specials/">
              <div class="div-special-caption-left"></div>
              <div class="div-special-caption-center">
                  <?php echo $html->image('special-caption-center.png', array(
                      'class' => 'img-special-caption-center'
                  ));?>
                  <div class="div-special-caption-text">Спецпредложения</div>
                  <div class="div-special-caption-shade">Спецпредложения</div>
              </div>
          </a>
       </div>
   </div>
   <div class="fixed3">
       <div class="div-to-caption">
          <a href="<?php echo $this->webroot; ?>catalogs/">
               <div class="div-to-caption-left"></div>
               <div class="div-to-caption-right"></div>
               <div class="div-to-caption-center">
                  <?php echo $html->image('to-caption-center.png', array(
                      'class' => 'img-to-caption-center'
                  ));?>
                  <div class="div-to-caption-text">Торговое оборудование</div>
                  <div class="div-to-caption-shade">Торговое оборудование</div>
               </div>
          </a>
       </div>
   </div>
</div>
<div class="clear-div"></div>

<div class="container3">
    <div class="div-left-background"></div>
    <div class="div-right-background"></div>

    <div class="fluid-left3">
          <cake:nocache>
          <?php
            echo $this->element('cnews_box');
          ?>
          </cake:nocache>
    </div>

    <div class="fluid-right3">
          <cake:nocache>
          <?php
            echo $this->element('specials_box');
          ?>
          </cake:nocache>
    </div>

    <div class="fixed3">
        <div id="text2">
            <div class="div-slideshow-content-1">
                <div class="div-slideshow-content-2">
                  <?php foreach($slides as $slide) { ?>
                  <div class="slide">
                      <a href="<?php echo $html->url($slide['Slide']['link']);?>"
                         class="link-slide"
                         style="background: url(<?php echo $this->webroot.'img/'.$slide['Image']['url'];?>) center center no-repeat">
                          <?php echo $html->image($slide['Image']['url']);?>
                      </a>
                  </div>
                  <?php } ?>

                    <div class="div-short-links">
                        <span class="short-link-caption">Быстрые ссылки:</span>
                        <?php foreach($short_links as $short_link) {?>
                        <span class="short-link">
                            <a href="<?php echo $short_link['ShortLink']['link'];?>">
                                <?php echo $short_link['ShortLink']['name'];?>
                            </a>
                        </span>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="catalog-home">
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
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                        <div style="clear: both;"></div>
                    </div>
                </div>

                <div id="home-text">
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

<script type="text/javascript">

    $('#slideshow-content').cycle({
        timeout: (1000 * 7) ,
        //pager: '#slideshow-pages',
        pagerEvent: 'click',
        pauseOnPagerHover: false,
        random: true
    });
</script>

