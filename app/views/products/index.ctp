<?php echo $common->caption($product['Product']['name']);?>
<cake:nocache>
<div class="top-header hide-menu">
   <?php
     echo $this->element('basket_menu_box');
   ?>
</div>
</cake:nocache>
<script type="text/javascript">
var product_dets = <?php echo $productCommon->js_product_dets(array($product));?>;
</script>
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
    <table width="100%" cellpadding="0" cellspacing="0" border="0"><tbody><tr>
        <td valign="middle" align="center" width="20%">
            <?php if(!empty($neighbors['prev'])) {
                $neighbor = $neighbors['prev']; ?>
            <a href="<?php echo $html->url('/products/index/'.$neighbor['Product']['id']);?>">
                <div class="div-product-prev">
                    <h3><span class="text-shadow"><?php echo $neighbor['Product']['name'];?></span></h3>
                    <div class="div-small-image-product">
                        <?php
                        echo $html->image($neighbor['SmallImage']['url'], array(
                            'class' => 'img-product img-small-product',
                            'product_id' => $neighbor['Product']['id']
                        ));
                        ?>
                    </div>
                    <div class="div-nazad">< < < назад</div>
                </div>
            </a>
            <?php } ?>
        </td><td valign="top" align="center" width="60%">
            <div class="div-product">
                <?php
                echo $productCommon->big_product($product);
                echo $productCommon->product_custom($product, $strs[7]);
                ?>
            </div>
        </td><td valign="middle" align="center" width="20%">
            <?php if(!empty($neighbors['next'])) {
                $neighbor = $neighbors['next']; ?>
            <a href="<?php echo $html->url('/products/index/'.$neighbor['Product']['id']);?>">
                <div class="div-product-next">
                    <h3><span class="text-shadow"><?php echo $neighbor['Product']['name'];?></span></h3>
                    <div class="div-small-image-product">
                        <?php
                        echo $html->image($neighbor['SmallImage']['url'], array(
                            'class' => 'img-product img-small-product',
                            'product_id' => $neighbor['Product']['id']
                        ));
                        ?>
                    </div>
                    <div class="div-vpered">вперед > > ></div>
                </div>
            </a>
            <?php } ?>
        </td>
    </tr></tbody></table>
</div>
</td></tr></tbody></table></div>
<!--<table width="100%"><tbody><tr>
    <td valign="top" width="300px">
        <?php echo $catalogCommon->getCatalogTreeStr($path_tree, $path, $cur_catalog_id, 'index');?>
    </td> <td valign="top">
        <?php echo $common->getPathStr($path);?>
        <table width="99%"><tbody><tr>
            <td valign="middle" align="center" width="20%">
                <?php if(!empty($neighbors['prev'])) {
                    $neighbor = $neighbors['prev']; ?>
                <a href="<?php echo $html->url('/products/index/'.$neighbor['Product']['id']);?>">
                    <h3><?php echo $neighbor['Product']['name'];?></h3>
                    <?php echo $html->image($neighbor['SmallImage']['url'], array(
                        'class' => 'img-product img-small-product bevel iradius16',
                        'product_id' => $neighbor['Product']['id']
                        )
                    );?>
                    <div>назад</div>
                </a>
                <?php } ?>
            </td><td valign="top" align="center" width="60%">
                <?php
                echo $productCommon->big_product($product);
                echo $productCommon->product_custom($product, $strs[7]);
                ?>
            </td><td valign="middle" align="center" width="20%">
                <?php if(!empty($neighbors['next'])) {
                    $neighbor = $neighbors['next']; ?>
                <a href="<?php echo $html->url('/products/index/'.$neighbor['Product']['id']);?>">
                    <h3><?php echo $neighbor['Product']['name'];?></h3>
                    <?php echo $html->image($neighbor['SmallImage']['url'], array(
                        'class' => 'img-product img-small-product bevel iradius16',
                        'product_id' => $neighbor['Product']['id']
                        )
                    );?>
                    <div>вперед</div>
                </a>
                <?php } ?>
            </td>
        </tr></tbody></table>
    </td>
</tr></tbody></table>-->
<div style="clear:both; height: 10px;"></div>
<cake:nocache>
<div class="top-header hide-menu">
   <?php
     echo $this->element('basket_menu_box');
   ?>
</div>
</cake:nocache>
<?php echo $productCommon->dialog_made_custom();?>
<script type="text/javascript">
    $(document).ready(function() {
        enable_ajax_waiting();
        <?php if(!empty($product_det_id)) { ?>
        var tr = $('.tr-product-det[product_det_id=<?php echo $product_det_id;?>]');
        $('.select-product-param').each(function() {
            var product_param_id = $(this).attr('product_param_id');
            var value = tr.attr('p_'+product_param_id);
            $(this).val(value);
        });
        change_product_param(<?php echo $product['Product']['id'];?>);
        select_product_det(<?php echo $product_det_id;?>);
        <?php } ?>

        $('.span-product-cost-sum').css('display', 'inline');
    });
</script>