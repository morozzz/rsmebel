<cake:nocache>
<div id="top-header" class="hide-menu">
   <?php
     echo $this->element('basket_menu_box');
   ?>
</div>
</cake:nocache>
<?php debug($products);?>
<?php foreach($products as $product) {
    echo $productCommon->small_product($product);
//    echo $productCommon->product_table($product);
//    echo $productCommon->product_small_image($product);
//    echo $productCommon->product_big_image($product);
//    echo $productCommon->product_comboboxes($product);
//    echo $productCommon->product_name($product);
//    echo $productCommon->product_producer($product);
//    echo $productCommon->product_short_about($product);
//    echo $productCommon->product_long_about($product);
}

?>
<?php $paginator->options(array('url' => $this->params['pass']));?>
<table>
    <tr>
        <td id="catalogs-show-path-tree">
            <?php echo $catalogCommon->getCatalogTreeStr($path_tree, $path, $cur_catalog_id, 'index');?>
        </td>
        <td id="catalogs-show-products">
            <?php /*echo $catalogCommon->getCatalogPathStr($path);*/?>
            <?php echo $common->getPathStr($path);?>
            <div id="catalogs-show-products-catalog-caption">
                <?php echo $catalog['Catalog']['name'];?>
            </div>
            <div id="catalogs-show-products-catalog-about">
                <?php echo $html->image($catalog['BigImage']['url']);?>
                <?php echo $catalog['Catalog']['long_about'];?>
                <div class="clear-div"></div>
            </div>
            <div id="div-catalogs-links">
                <a href="<?php echo $html->url('/catalogs/get_print/'.$cur_catalog_id)?>"
                   target="_blank"
                   id="link-catalogs-print">
                    Версия для печати
                </a>
                <a href="<?php echo $html->url('/catalogs/get_excel/'.$cur_catalog_id)?>"
                   target="_blank"
                   id="link-catalogs-excel">
                    Каталог в Excel
                </a>
            </div>
            <?php if(!empty($projects)) { ?>
            <div id="div-projects">
                Проекты магазинов, при оборудовании которых использована серия
                "<?php echo $catalog['Catalog']['name'];?>":
                <ul id="list-projects">
                    <?php foreach($projects as $project) {?>
                    <li class="li-project">
                        <a href="<?php echo $html->url('/projects/show/'.$project['Project']['id']);?>"
                           target="_blank">
                           <?php echo $project['Project']['name'];?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
            <?php
//            echo $html->link('excel', array(
//                'controller' => 'catalogs',
//                'action' => 'get_excel',
//                $catalog['Catalog']['id']
//            ));
            ?>

            <?php $productCommon->print_pagination_table($paginator, $limit);?>
            
            <?php $product_row_count = 0;
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
                            <a class="product-link"
                               product_id="<?php echo $product_id;?>"
                               href="<?php echo $html->url(array(
                                                   'controller' => 'products',
                                                   'action' => 'index',
                                                   $product_id
                                   ));?>">
                                <?php echo $name;?>
                            </a>
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
                if($product_row_count == 2) {
                    $product_row_count = 0
                ?>
            </div>
            <div class="tr-product-table-price">
                <?php
                $productCommon->print_price($last_product);
                $productCommon->print_price($product);
                ?>
            </div>
                <?php }
                $last_product = $product; ?>
            <?php } ?>

            <?php if($product_row_count>0) {
                echo "</div>"; ?>
            <div class="tr-product-table-price">
                <?php $productCommon->print_price($last_product);?>
            </div>
            <?php } ?>
        </td>
    </tr>
</table>

<div id="dialog-made-custom">
    <div id="dialog-made-custom-link">
        <?php echo $html->link('Перейти в корзину', array(
            'controller' => 'basket',
            'action' => 'index'));?>
    </div>
</div>

<?php $json_products = $products;?>

<script type="text/javascript">
    var webroot = "<?php echo $this->webroot; ?>"
    enable_ajax_waiting();
    $(document).ready(function() {
        $('#pagination-input-limit').change(function() {
            var limit = $('#pagination-input-limit option:selected').val();

            var url = "<?php echo $paginator->url(array_merge((array)$paginator->options['url'], array('limit' => null)));?>";
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
$productCommon->print_javascript_init_product_table($products, 'big');
?>