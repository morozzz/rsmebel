<?php echo $common->caption('КАТАЛОГ ТОРГОВОГО ОБОРУДОВАНИЯ');?>
<cake:nocache>
<div class="top-header hide-menu pie">
   <?php
     echo $this->element('basket_menu_box');
   ?>
</div>
</cake:nocache>
<div class="div-main-catalog"><table width="100%" class="table-main-catalog" align="left" cellpadding="0" cellspacing="0" border="0"><tbody><tr><td width="25%" valign="top">
<div id="catalog-path-tree">
    <?php echo $catalogCommon->getCatalogTreeStr(
                    $path_tree, $path, $cur_catalog_id, 'index'); ?>
</div>
<!--<div id="catalog-path-tree-background"></div>-->
</td><td width="75%" valign="top">
<?php if($cur_catalog_id != 0) { ?>
    <div class="div-catalog-path">
        <?php echo $common->getPathStr($path);?>
    </div>
<?php } ?>
<div id="catalog-body">
    <?php foreach($catalogs as $catalog) { ?>
    <div class="div-catalog">
        <div class="div-catalog-caption">
            <?php echo $common->caption($html->link($catalog['Catalog']['name'],
                    '/catalogs/index/'.$catalog['Catalog']['id']), 'h2');?>
        </div>
        <div class="div-catalog-list">
            <table width="100%"><tbody>
                <tr>
                    <?php $i=0; foreach($catalog['Catalogs'] as $catalog2) { ?>
                        <?php if($i==3) { $i=0;?>
                </tr><tr>
                        <?php } ?>
                    <td width="33%">
                        <a href="<?php echo $html->url('/catalogs/index/'.$catalog2['Catalog']['id']);?>">
                            <div class="div-catalog1">
                                <h3 class="catalog-caption1">
                                    <span class="text-shadow">
                                        <?php echo $catalog2['Catalog']['name'];?>
                                    </span>
                                </h3>

                                <div class="div-catalog1-image">
                                    <div class="div-catalog1-image-1">
                                        <div class="div-catalog1-image-2">
                                            <div class="div-catalog1-image-3"
                                                 style="background: url(<?php echo $this->webroot.'img/'.$catalog2['SmallImage']['url'];?>) no-repeat center center">
                                                <?php echo $html->image($catalog2['SmallImage']['url'], array(
                                                    'class' => 'img-catalog1'
                                                ));?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </td>
                    <?php $i++; ?>
                    <?php } ?>
                    <?php for($j=3-$i; $j>0; $j--) echo "<td width='33%'></td>"; ?>
                </tr>
            </tbody></table>
        </div>
    </div>
    <?php } ?>
</div>
</td></tr></tbody></table></div>
<div style="clear: both"></div>
<?php if(!empty($catalog_news)) { ?>
<div class="div-catalog-news-background">
    <div class="div-catalog-news">
        <?php echo $common->caption($html->link('Новости ассортимента', '/catalog_news/index/'), 'h4');?>
        <div class="div-catalog-news-body">
            <?php foreach($catalog_news as $catalog_new) { ?>
            <div class="div-catalog-new">
                <div class="div-catalog-new-stamp text-shadow">
                    <?php echo $catalog_new['CatalogNew']['stamp']?>:
                </div>
                <div class="div-catalog-new-name text-shadow">
                    <?php echo $catalog_new['CatalogNewType']['name'];?>
                </div>
                <div class="div-catalog-new-path text-shadow">
                    "<?php
                    echo $html->link($catalog_new['Catalog']['name'],
                            '/catalogs/index/'.$catalog_new['Catalog']['id']);
                    //echo $common->getPathStr($catalog_new['catalog_path']);
                    ?>"
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <div style="clear:both; height: 10px;"></div>
</div>
<?php } ?>
<cake:nocache>
<div class="top-header hide-menu">
   <?php
     echo $this->element('basket_menu_box');
   ?>
</div>
</cake:nocache>