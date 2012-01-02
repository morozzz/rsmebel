<div class="div-left-column">
    <div class="div-specials"><?php echo $this->element('specials');?></div>
    <div class="div-news"><?php echo $this->element('news');?></div>
</div>
<div class="div-right-column">
    <div id="div-products">
        <h1><?php echo $current_catalog['Catalog']['name'];?></h1>
        <?php foreach($products as $product) { ?>
        <div class="div-product pie">
            <?php
            echo $html->link($product['Product']['name'], array(
                'controller' => 'products',
                'action' => 'index',
                $product['Product']['url']
            ), array(
                'class' => 'link-product-name'
            ));
            ?>
            <div class="div-product-image" align="center">
                <?php
                echo $html->image($product['SmallImage']['url'], array(
                    'class' => 'image-product',
                    'url' => array(
                        'controller' => 'products',
                        'action' => 'index',
                        $product['Product']['url']
                    )
                ));
                ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
