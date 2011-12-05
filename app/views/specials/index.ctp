<?php define('MAX_ROW_COUNT', 3);?>
<script type="text/javascript">
var product_dets = <?php echo $productCommon->js_product_dets($products);?>;
</script>
<?php echo $common->caption('Специальные предложения');?>
<cake:nocache>
<div class="top-header hide-menu">
   <?php
     echo $this->element('basket_menu_box');
   ?>
</div>
</cake:nocache>
<div class="div-catalog-body">
    <div class="div-pagination">
        <?php echo $common->paginate_table($paginator, 'Special', array(
            9 => '9',
            18 => '18',
            27 => '27'
        ));?>
    </div>
    <?php
    $row_count = 0;
    $last_products = array();
    foreach($products as $product) {
        if($row_count==0) {
            echo "<div class='div-product-row div-product-row1'>";
            echo "<div class='div-product-row div-product-row2'>";
            echo "<div class='div-product-row div-product-row3'>";
        }
        echo "<div class='div-product div-product$row_count'>";
        echo $productCommon->special_product($product);
        echo "</div>";
        $row_count++;
        $last_products[] = $product;
        if($row_count>=MAX_ROW_COUNT) {
            echo "<div style='clear: both'></div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<div class='div-product-custom-row div-product-custom-row1'>";
            echo "<div class='div-product-custom-row div-product-custom-row2'>";
            echo "<div class='div-product-custom-row div-product-custom-row3'>";
            $i=0;
            foreach($last_products as $last_product) {
                echo "<div class='div-product-custom div-product-custom$i'>";
                echo $productCommon->product_custom($last_product, $strs[7]);
                echo "</div>";
                $i++;
            }
            echo "<div style='clear: both'></div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<div class='div-product-row-separator'></div>";
            $row_count = 0;
            $last_products = array();
        }
    }
    if($row_count != 0) {
        for($i=$row_count; $i<MAX_ROW_COUNT; $i++) {
            echo "<div class='div-product div-product$i'>";
            echo "</div>";
        }
        echo "<div style='clear: both'></div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "<div class='div-product-custom-row div-product-custom-row1'>";
        echo "<div class='div-product-custom-row div-product-custom-row2'>";
        echo "<div class='div-product-custom-row div-product-custom-row3'>";
        $i=0;
        foreach($last_products as $last_product) {
            echo "<div class='div-product-custom div-product-custom$i'>";
            echo $productCommon->product_custom($last_product, $strs[7]);
            echo "</div>";
            $i++;
        }
        echo "<div style='clear: both'></div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "<div class='div-product-row-separator'></div>";
    }
    ?>
    <div style="clear:both; height: 10px;"></div>
    <div class="div-pagination" style="margin-bottom: 0px;">
        <?php echo $common->paginate_table($paginator, 'Special', array(
            9 => '9',
            18 => '18',
            27 => '27'
        ));?>
    </div>
</div>
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

        //paginate
        ///////////////////////////////////////////////////////////////////////////
//        $('.admin-pagination').addClass('ui-state-default ui-corner-all');
        $('.pagination-limit-select').change(function() {
            var limit = $(this).val();
            var url = webroot+'specials/index/limit:'+limit;
            window.location = url;
        })
        ///////////////////////////////////////////////////////////////////////////

        $('.table-product-det').each(function() {
            var product_id = $(this).attr('product_id');
            var product_search = '[product_id='+product_id+']';
            $(this).find('.tr-product-det-special:first').each(function() {
                var tr = $(this);
                var product_det_id = tr.attr('product_det_id');
                $('.select-product-param'+product_search).each(function() {
                    var product_param_id = $(this).attr('product_param_id');
                    var value = tr.attr('p_'+product_param_id);
                    $(this).val(value);
                });
                change_product_param(product_id);
                select_product_det(product_det_id);
            });
        });

        $('.span-product-cost-sum').css('display', 'inline');
    });
</script>