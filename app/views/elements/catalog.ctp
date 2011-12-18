<h1>Каталог фирм-производителей</h1>
<?php $catalogs = $this->requestAction('/catalogs/get_catalogs');?>

<?php foreach($catalogs as $catalog) { ?>
<div class="div-catalog">
    <h2><?php echo $catalog['Catalog']['name'];?></h2>
    <?php echo $html->link("смотреть все ({$catalog['Catalog']['products_cnt']})", array(
        'controller' => 'catalogs',
        'action' => 'index',
        $catalog['Catalog']['eng_name']
    ), array(
        'class' => 'link-catalog-show-all'
    ));?>
    <div class="div-products">
        <?php foreach($catalog['Product'] as $product) { ?>
        <div class="div-product">
            <?php echo $html->image($product['SmallImage']['url'], array(
                'class' => 'image-product',
                'url' => array(
                    'controller' => 'products',
                    'action' => 'index',
                    $product['Product']['eng_name']
                )
            ));?>
            <?php echo $html->link($product['Product']['name'], array(
                'controller' => 'products',
                'action' => 'index',
                $product['Product']['eng_name']
            ), array(
                'class' => 'link-product'
            ));?>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>
