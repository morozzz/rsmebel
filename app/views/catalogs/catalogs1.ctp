<?php echo $common->caption($catalog['Catalog']['name']);?>
<cake:nocache>
<div class="top-header hide-menu">
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
<div class="div-catalog-path">
    <?php echo $common->getPathStr($path);?>
</div>
<div id="catalog-body">
    <?php foreach($catalogs[$catalog['Catalog']['id']]['Catalogs'] as $catalog2) { ?>
    <div class="div-catalog">
        <div class="div-catalog-caption">
            <?php echo $common->caption($html->link($catalog2['Catalog']['name'],
                    '/catalogs/index/'.$catalog2['Catalog']['id']));?>
        </div>
        <div class="div-catalog-content">
            <div class="div-catalog-image">
                <div class="div-catalog-image-1">
                    <div class="div-catalog-image-2">
                        <div class="div-catalog-image-3"
                             style="background: url(<?php echo $this->webroot.'img/'.$catalog2['SmallImage']['url'];?>) no-repeat center center">
                            <a href="<?php echo $html->url('/catalogs/index/'.$catalog2['Catalog']['id']);?>"
                               style="display: block; height: 100%;">
                            </a>
                             <?php echo $html->image($catalog2['SmallImage']['url'], array(
                                 'class' => 'img-catalog'
                             ));?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div-catalog-about">
                <?php echo $catalog2['Catalog']['short_about'];?>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>
    <?php } ?>
</div>
</td></tr></tbody></table></div>
<div style="clear:both; height: 10px;"></div>
<cake:nocache>
<div class="top-header hide-menu">
   <?php
     echo $this->element('basket_menu_box');
   ?>
</div>
</cake:nocache>