<table cellpadding="0" cellspacing="0" border="0" width="100%" style="table-layout: fixed;">
    <tr>
        <td class="cell-news" width="20%" valign="top">
            <div class="div-captions">
                <h1 class="caption-top caption-news">
                    <?php echo $html->link('Новости', '/cnews');?>
                </h1>
            </div>
            <div class="div-news">
                <cake:nocache><?php echo $this->element('cnews_box'); ?></cake:nocache>
            </div>
        </td>
        <td class="cell-to" width="60%" valign="top">
            <div class="div-captions">
                <h1 class="caption-top caption-to">
                    <?php echo $html->link('Торговое оборудование', '/catalogs/index');?>
                </h1>
            </div>
            <div class="div-slideshow">
                <div class="slide">
                    <?php
                    $slide = $slides[0];
                    echo $html->link($html->image($slide['Image']['url']),
                            $slide['Slide']['link'], array(
                                'style' => 'background: url('.$this->webroot.
                                           'img/'.$slide['Image']['url'].
                                           ') no-repeat center center;',
                                'escape' => false
                            ));
                    ?>
                </div>
            </div>
            <div class="div-short-links">
                <span class="short-link-caption">Быстрые ссылки:</span>
                <?php $is_first = true;
                foreach($short_links as $short_link) {
                if($is_first) $is_first = false; 
                else echo $html->image('small-gray-circle.png', array('class' => 'img-short-link-separator'));?>
                <span class="short-link">
                    <?php echo $html->link($short_link['ShortLink']['name'],
                            $short_link['ShortLink']['link']);?>
                </span>
                <?php } ?>
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
                                    <!--</li>-->
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
        </td>
        <td class="cell-specials" width="20%" valign="top">
            <div class="div-captions">
                <h1 class="caption-top caption-specials">
                    <?php echo $html->link('Спецпредложения', '/specials');?>
                </h1>
            </div>
            <cake:nocache><?php echo $this->element('specials_box'); ?></cake:nocache>
        </td>
    </tr>
</table>