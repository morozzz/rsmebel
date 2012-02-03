<div class="div-left-column">
    <div id="div-basket"><?php echo $this->element('basket');?></div>
    <div class="div-specials"><?php echo $this->element('specials');?></div>
    <div class="div-news"><?php echo $this->element('news');?></div>
</div>
<div class="div-right-column">
    <div id="div-products">
        <h1><?php echo $current_catalog['Catalog']['name'];?></h1>
        <?php $td_count = 0;?>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
                <?php foreach($products as $product) { ?>
                <?php if($td_count==0) echo "<tr>"; ?>
                <td>
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
                        <?php if(false && !empty($product['Product']['product_det_list'])) { ?>
                        <div class="div-product-det">
                            <?php
                            echo $form->select('', $product['Product']['product_det_list'], null, array(
                                'class' => 'select-product-det'
                            ), false);
                            ?>
                        </div>
                        <?php } ?>
                    </div>
                </td>
                <?php $td_count++; if($td_count>=4) {echo "</tr>";$td_count=0;}?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
