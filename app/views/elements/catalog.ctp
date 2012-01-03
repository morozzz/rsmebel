<h1><?php echo $caption;?></h1>
<?php
if(empty($catalog_id)) $catalogs = $this->requestAction('/catalogs/get_catalogs');
else $catalogs = $this->requestAction('/catalogs/get_catalogs/'.$catalog_id);
?>

<?php foreach($catalogs as $catalog) { ?>
<div class="div-catalog">
    <h2><?php echo $html->link($catalog['Catalog']['name'], array(
        'controller' => 'catalogs',
        'action' => 'index',
        $catalog['Catalog']['url']
    ));?></h2>
    <?php echo $html->link("смотреть все ({$catalog['Catalog']['products_cnt']})", array(
        'controller' => 'catalogs',
        'action' => 'index',
        $catalog['Catalog']['url']
    ), array(
        'class' => 'link-catalog-show-all'
    ));?>
    <div class="div-products">
        <?php foreach($catalog['Product'] as $product) { ?>
        <div class="div-product">
            <?php
            echo $html->image($product['SmallImage']['url'], array(
                'class' => 'image-product',
                'url' => array(
                    'controller' => 'products',
                    'action' => 'index',
                    $product['Product']['url']
                )
            ));
            echo $html->link($product['Product']['name'], array(
                'controller' => 'products',
                'action' => 'index',
                $product['Product']['url']
            ), array(
                'class' => 'link-product'
            ));
            echo $html->link($html->image('icon_zoom.png'),
                    $this->webroot.'img/'.$product['BigImage']['url'], array(
                        'class' => 'link-product-zoom',
                        'escape' => false,
                        'title' => $product['Product']['name'],
                        'rel' => 'lightbox_product'
                    )
            );
            ?>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>
