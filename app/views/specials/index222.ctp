<?php $paginator->options(array('url' => $this->params['pass']));?>
<h1 class="caption-page">Специальные предложения</h1>

<div class="div-pagination-row">
    <div class="div-pagination-prev">
        <?php echo $paginator->prev(" < < < Назад");?>
    </div>
    <div class="div-pagination-all">
        <?php
        echo $paginator->counter('Всего спецпредложений %count%, показано с %start% по %end%');
        ?>
    </div>
    <div class="div-pagination-next">
        <?php echo $paginator->next('Вперед > > > ');?>
    </div>
    <div class="div-pagination-count">
        <label class="label-pagination-limit">Количество на странице</label>
        <?php echo $form->select('', array(
            3 => '3',
            6 => '6',
            9 => '9',
            12 => '12',
            15 => '15',
            $paginator->params['paging']['Special']['count'] => 'Все'
        ), $limit, array(
            'id' => 'pagination-input-limit'
        ), false);?>
    </div>
</div>

<?php $product_row_count = 0;
$last_products = array();
foreach($products as $product_id => $product) {
    $image_url = $product['SmallImage']['url'];
    $name = $product['Product']['name'];
    $producer_name = empty($product['Producer']['name'])?'не указан':$product['Producer']['name'];
    $short_about = $product['Product']['short_about'];

    if($product_row_count == 0) { ?>
<div class="tr-product-table">
    <?php } ?>
    <div class="td-product-table"
         id="td-product-<?php echo $product_id;?>">
        <?php echo $catalogCommon->getCatalogPathStr($product['path']);?>
        <div class="product-image-name-about">
            <div class="product-small-image">
                <a href="<?php echo $html->url(array(
                                        'controller' => 'products',
                                        'action' => 'index',
                                        $product_id
                    ));?>"
                   product_id="<?php echo $product_id;?>"
                   class="product-link">
                    <?php echo $html->image($image_url, array(
                        'id' => 'product-image-'.$product_id,
                        'image_size' => 'small'
                    ));?>
                    увеличить
                </a>
            </div>

            <h3 class="product-name">
                <?php echo $name;?>
            </h3>
            <h4 class="product-producer">
                Производитель: 
                <span id="span-producer-name-<?php echo $product_id;?>">
                    <?php echo $producer_name;?>
                </span>
            </h4>
            <div class="product-short-about">
                <?php echo $short_about;?>
            </div>

            <?php $productCommon->print_product_table($product, 'big');?>
        </div>

        <?php $productCommon->print_product_comboboxes($product);?>
    </div>

    <?php $product_row_count++;
    if($product_row_count == 3) {
        $product_row_count = 0;
    ?>
</div>
<div class="tr-product-table-price">
    <?php
    //$productCommon->print_price($last_product);
    $productCommon->print_price($last_products[0]);
    $productCommon->print_price($last_products[1]);
    $productCommon->print_price($product);
    $last_products = array();
    ?>
</div>
    <?php } else {
    //$last_product = $product;
    $last_products[] = $product;
    }
    ?>
<?php } ?>

<?php if($product_row_count>0) {
    echo "</div>"; ?>
<div class="tr-product-table-price">
    <?php
    if(!empty($last_products[0])) $productCommon->print_price($last_products[0]);
    if(!empty($last_products[1])) $productCommon->print_price($last_products[1]);
    ?>
    <?php
    //$productCommon->print_price($last_product);
    ?>
</div>
<?php } ?>

<div id="dialog-made-custom">
    <div id="dialog-made-custom-link">
        <?php echo $html->link('Перейти в корзину', array(
            'controller' => 'basket',
            'action' => 'index'));?>
    </div>
</div>

<script type="text/javascript">
    var webroot = "<?php echo $this->webroot;?>";
    enable_ajax_waiting();

    $(document).ready(function() {
        $('#pagination-input-limit').change(function() {
            var limit = $(this).find('option:selected').val();

            var url = "<?php echo $this->webroot.'specials/index';?>";
            url += '/limit:'+limit;
            window.location = url;
        });

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
$productCommon->print_javascript_init_product_table($products, 'small');
?>