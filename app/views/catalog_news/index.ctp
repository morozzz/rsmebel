<?php echo $common->caption("Новости ассортимента");?>
<div class="div-catalog-news-body pie">
    <?php foreach($catalog_news as $catalog_new) { ?>
    <div class="div-catalog-new">
        <div class="div-catalog-new-stamp">
            <?php echo $catalog_new['CatalogNew']['stamp']?>
        </div>
        <div class="div-catalog-new-name">
            <?php echo $catalog_new['CatalogNewType']['name'];?>
        </div>
        <div class="div-catalog-new-path">
            "<?php
            echo $html->link($catalog_new['Catalog']['name'],
                    '/catalogs/index/'.$catalog_new['Catalog']['id']);
            //echo $common->getPathStr($catalog_new['catalog_path']);
            ?>"
        </div>
    </div>
    <?php } ?>
</div>