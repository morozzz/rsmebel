<div style="height: auto; border-collapse: collapse;">
<div id="catalog-path-tree">
    <?php echo $catalogCommon->getCatalogTreeStr(
                    $path_tree, $path, $cur_catalog_id, 'index'); ?>
</div>
<div id="catalog-body">
    <?php echo $catalogCommon->getCatalogPathStr($path);?>

    <table style="width: 99%;">
        <tr>
            <td valign="middle" align="center" width="20%" id="td-prev-neighbor" class="td-neighbor">
                <?php if(!empty($neighbors['prev'])) {
                    $neighbor = $neighbors['prev']; ?>
                <a href="<?php echo $html->url(array(
                    'controller' => 'products',
                    'action' => 'index',
                    $neighbor['Product']['id']
                    ));?>">
                    <h2 class="product-name"><?php echo $neighbor['Product']['name'];?></h2>
                    <?php echo $html->image($neighbor['SmallImage']['url'], array('class' => 'img-neighbor-image'));?>
                    <div class="div-neighbor-label">назад</div>
                </a>
                <?php } ?>
            </td>
            <td valign="top" align="center" width="60%" id="td-product">
                <?php echo $html->image($product['BigImage']['url'], array(
                    'class' => 'img-product-image',
                    'id' => 'product-image-'.$product['Product']['id'],
                    'image_size' => 'big'
                ));?>
                <h1 class="product-name"><?php echo $product['Product']['name'];?></h1>
                <h4 class="product-producer">
                    Производитель:
                    <span id="span-producer-name-<?php echo $product['Product']['id'];?>">
                        <?php echo empty($product['Producer']['name'])?'не указан':$product['Producer']['name'];?>
                    </span>
                </h4>
                <div id="product-long-about">
                    <?php echo $product['Product']['long_about'];?>
                </div>
                <?php $productCommon->print_product_comboboxes($product);?>
                <?php $productCommon->print_product_table($product);?>
                <?php $productCommon->print_price($product);?>
            </td>
            <td valign="middle" align="center"  width="20%" id="td-next-neighbor" class="td-neighbor">
                <?php if(!empty($neighbors['next'])) {
                    $neighbor = $neighbors['next']; ?>
                <a href="<?php echo $html->url(array(
                    'controller' => 'products',
                    'action' => 'index',
                    $neighbor['Product']['id']
                    ));?>">
                    <h2 class="product-name"><?php echo $neighbor['Product']['name'];?></h2>
                    <?php echo $html->image($neighbor['SmallImage']['url'], array('class' => 'img-neighbor-image'));?>
                    <div class="div-neighbor-label">вперед</div>
                </a>
                <?php } ?>
            </td>
        </tr>
    </table>

    <div id="div-prev-neighbor" class="div-neighbor">
    </div>
    <div id="div-next-neighbor" class="div-neighbor">
    </div>
    <div id="div-product">
        
    </div>
</div>
</div>

<div id="dialog-made-custom">
    <div id="dialog-made-custom-link">
        <?php echo $html->link('Перейти в корзину', array(
            'controller' => 'basket',
            'action' => 'index'));?>
    </div>
</div>

<script type="text/javascript">
    var webroot = "<?php echo $this->webroot; ?>"
    enable_ajax_waiting();
    $(document).ready(function() {
        $('#dialog-made-custom').dialog({
            show: 'blind',
            hide: 'blind',
            modal: false,
            autoOpen: false,
            title: 'Товар добавлен в корзину',
            width: 250,
            height: ($.browser.msie)?100:65,
            resizable: false,
            dialogClass: 'widget-made-custom'
        });
    });
</script>

<?php
$productCommon->print_javascript_init_product_table(array($product['Product']['id'] => $product));
?>

<?php if(!empty($product_det)) {?>
<script type="text/javascript">
    $(document).ready(function() {
        <?php foreach($product_det['ProductDetParam'] as $product_det_param) {
            $product_param_id = $product_det_param['ProductDetParam']['product_param_id'];
            $value = $product_det_param['ProductDetParamValue']['id'];
            if(empty($value)) continue;
        ?>
        var select = $('select[product_param_id=<?php echo $product_param_id;?>]');
        select.val(<?php echo $value;?>);
        select.change();
        <?php } ?>

        $('tr[product_det_id=<?php echo $product_det['ProductDet']['id'];?>]').click();
    })
</script>
<?php } ?>