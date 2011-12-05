<h1>Анжелика</h1>
<?php echo $strs[6];?>
<?php foreach($catalogs as $catalog) { ?>
    <hr/><hr/><hr/><hr/><hr/>
    <br/><h2><?php echo $catalog['Catalog']['name'];?></h2>
    <hr/><hr/><hr/><hr/>/><hr/>

    <?php foreach($catalog['Product'] as $product) { $product['Product'] = $product;?>
    <br/><div class="product">
        <?php echo $product['name'];?>
        <?php if(empty($product['ProductDet'])) {
            if(empty($product['cnt']) || $product['cnt']<=0) { ?>
            <br/>
            Под заказ
            <?php } else { ?>
            <div>
            </div>
            <?php } ?>
        <?php } ?>
    </div>
    <hr/>
    <?php } ?>
<?php } ?>