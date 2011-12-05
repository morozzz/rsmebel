<?php echo $common->caption($catalog['Catalog']['name']);?>
<?php define('MAX_ROW_COUNT', 2);?>
<cake:nocache>
<div class="top-header hide-menu">
   <?php
     echo $this->element('basket_menu_box');
   ?>
</div>
</cake:nocache>
<script type="text/javascript">
var product_dets = <?php echo $productCommon->js_product_dets($products);?>;
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
    <div class="div-catalog-header">
        <div class="div-catalog-about">
            <div class="div-catalog-image">
                <!--<div class="div-catalog-image-1">
                    <div class="div-catalog-image-2">
                        <div class="div-catalog-image-3"
                             style="background: url(<?php echo $this->webroot.'img/'.$catalog['BigImage']['url'];?>) no-repeat center center;">
                            <?php echo $html->image($catalog['BigImage']['url']);?>
                        </div>
                    </div>
                </div>-->
                <?php echo $html->image($catalog['BigImage']['url']);?>
            </div>
            <div class="div-catalog-about-text">
                <?php echo $catalog['Catalog']['long_about'];?>
            </div>
            <?php if(!empty($projects)) { ?>
            <div class="div-projects">
                Проекты магазинов, при оборудовании которых использована серия
                "<?php echo $catalog['Catalog']['name'];?>":
                <?php foreach($projects as $project) {?>
                <a href="<?php echo $html->url('/projects/show/'.$project['Project']['id']);?>"
                   class="link-project">
                   <?php echo $project['Project']['name'];?>
                </a>
                <?php } ?>
            </div>
            <?php } ?>
            <?php if(!empty($project_slides)) { ?>
            <div class="div-catalog-project-slides-link">
                <a href="<?php echo $html->url('/catalogs/project_slides/'.$cur_catalog_id);?>">
                    Иллюстрации серии в проектах магазинов
                </a>
            </div>
            <?php } ?>
            <div class="div-catalog-links">
                <div class="div-catalog-print-link">
                    <a href="<?php echo $html->url("/catalogs/get_print/".$cur_catalog_id);?>"
                       target="_blank">
                       <?php echo $html->image('printer.png');?>
                       Версия для печати
                    </a>
                </div>
                <div class="div-catalog-excel-link">
                    <a href="<?php echo $html->url("/catalogs/get_excel/".$cur_catalog_id);?>">
                       <?php echo $html->image('excel.gif');?>
                       Каталог в Excel
                    </a>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
        <?php if(!empty($filters)) { ?>
        <div class="div-filters">
            <div class="catalog-filters-caption">Фильтр</div>
            <?php foreach($filters as $filter) { ?>
            <div class="catalog-filter">
                <div class="catalog-filter-name">
                    <?php
                    if($filter['Filter']['filter_type_id']==3) {
                        echo "Цена, руб";
                    } else {
                        echo $filter['ProductParamType']['name'];
                        if(!empty($filter['ProductParamType']['postfix']))
                            echo ", ".$filter['ProductParamType']['postfix'];
                    }?>
                </div>
            <?php if($filter['Filter']['filter_type_id'] == 1) { ?>
                <div style="padding: 1px 0px; height: 22px; line-height: 22px;">
                    <span style="float:left; width: 20px;">от</span>
                    <input type="text" style="width:50px;" class="input-catalog-filter"
                           <?php if(!empty($filter['from']))
                               echo "value='{$filter['from']}' ";?>
                           product_param_type_id="<?php echo $filter['ProductParamType']['id'];?>"
                           filter_type="f">
                    <span>
                        <?php echo $filter['ProductParamType']['postfix'];?>
                    </span>
                </div> <div style="padding: 1px 0px; height: 22px; line-height: 22px;">
                    <div style="float:left; width: 20px;">до</div>
                    <input type="text" style="width:50px;" class="input-catalog-filter"
                           <?php if(!empty($filter['to']))
                               echo "value='{$filter['to']}' ";?>
                           product_param_type_id="<?php echo $filter['ProductParamType']['id'];?>"
                           filter_type="t">
                    <span>
                        <?php echo $filter['ProductParamType']['postfix'];?>
                    </span>
                </div>
            <?php } else if($filter['Filter']['filter_type_id'] == 2) { ?>
                <?php foreach($filter['ProductParamType']['ProductDetParamValue'] as $value) { ?>
                <div>
                    <input type="checkbox" class="input-catalog-filter"
                           <?php if(!empty($value['checked'])) echo "checked ";?>
                           product_param_type_id="<?php echo $filter['ProductParamType']['id'];?>"
                           filter_type="e"
                           value="<?php echo $value['id'];?>">
                    <a href="<?php echo $html->url('/catalogs/index/'.
                            $catalog['Catalog']['id'].'/e_'.
                            $filter['ProductParamType']['id'].':'.
                            $value['id']);?>">
                        <?php echo $value['name'];?>
                    </a>
                </div>
                <?php } ?>
            <?php } else if($filter['Filter']['filter_type_id'] == 3) { ?>
                <div style="padding: 1px 0px; height: 22px; line-height: 22px;">
                    <span style="float:left; width: 20px;">от</span>
                    <input type="text" style="width:50px;" class="input-catalog-filter"
                           <?php if(!empty($filter['from']))
                               echo "value='{$filter['from']}' ";?>
                           product_param_type_id="price"
                           filter_type="f">
                    <span> руб.</span>
                </div> <div style="padding: 1px 0px; height: 22px; line-height: 22px;">
                    <div style="float:left; width: 20px;">до</div>
                    <input type="text" style="width:50px;" class="input-catalog-filter"
                           <?php if(!empty($filter['to']))
                               echo "value='{$filter['to']}' ";?>
                           product_param_type_id="price"
                           filter_type="t">
                    <span> руб.</span>
                </div>
            <?php } ?>
            </div>
            <?php } ?>
            <div class="div-filter-buttons">
                <input type="button" class="catalog-filter-reset" value="Сбросить фильтр">
                <input type="button" class="catalog-filter-submit" value="Применить фильтр">
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="div-products">
        <div class="div-pagination">
            <?php echo $common->paginate_table($paginator, 'Product');?>
        </div>
        <?php
        $row_count = 0;
        $last_products = array();
        foreach($products as $product) {
            if($row_count==0) {
                echo "<div class='div-product-row div-product-row1'>";
                echo "<div class='div-product-row div-product-row2'>";
            }
            echo "<div class='div-product div-product$row_count'>";
            echo $productCommon->small_product($product);
            echo "</div>";
            $row_count++;
            $last_products[] = $product;
            if($row_count>=MAX_ROW_COUNT) {
                echo "<div style='clear:both'></div>";
                echo "</div>";
                echo "</div>";
                echo "<div class='div-product-custom-row div-product-custom-row1'>";
                echo "<div class='div-product-custom-row div-product-custom-row2'>";
                $i=0;
                foreach($last_products as $last_product) {
                    echo "<div class='div-product-custom div-product-custom$i'>";
                    echo $productCommon->product_custom($last_product, $strs[7]);
                    echo "</div>";
                    $i++;
                }
                echo "<div style='clear:both'></div>";
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
            echo "<div style='clear:both'></div>";
            echo "</div>";
            echo "</div>";
            echo "<div class='div-product-custom-row div-product-custom-row1'>";
            echo "<div class='div-product-custom-row div-product-custom-row2'>";
            $i=0;
            foreach($last_products as $last_product) {
                echo "<div class='div-product-custom div-product-custom$i'>";
                echo $productCommon->product_custom($last_product, $strs[7]);
                echo "</div>";
                $i++;
            }
            echo "<div style='clear:both'></div>";
            echo "</div>";
            echo "</div>";
            echo "<div class='div-product-row-separator'></div>";
        }
        ?>
        <div class="div-pagination" style="margin-top: 10px;">
            <?php echo $common->paginate_table($paginator, 'Product');?>
        </div>
    </div>
</div>
</td></tr></tbody></table>
<div style="clear:both; height: 10px;"></div>
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
            var base_url = $(this).attr('base_url');
            var limit = $(this).val();
            var url = base_url+'/limit:'+limit;
            window.location = url;
        })
        ///////////////////////////////////////////////////////////////////////////

        var cur_clear_url = "<?php echo $html->url('/catalogs/index/'.$catalog['Catalog']['id']);?>";
        $('.catalog-filter-reset').click(function() {
            window.location = cur_clear_url;
        });
        $('.catalog-filter-submit').click(function() {
            var filter_str = "";
            var filter = {};
            $('.input-catalog-filter').each(function() {
                var filter_type = $(this).attr('filter_type');
                var product_param_type_id = $(this).attr('product_param_type_id');
                var value = "";
                var input_type = $(this).attr('type');
                if(input_type=='text') {
                    value = $(this).val();
                    if(value=="") return;
                } else if(input_type=='checkbox') {
                    if(!$(this).is(':checked')) return;
                    value = $(this).attr('value');
                }

                filter_type += '_'+product_param_type_id;
                if(filter[filter_type]==null)
                    filter[filter_type] = value;
                else
                    filter[filter_type] += '_'+value;
            });

            for(filter_type in filter) {
                value = filter[filter_type];
                filter_str += '/'+filter_type+':'+value;
            }

            window.location = cur_clear_url+filter_str;
        });

        $('.span-product-cost-sum').css('display', 'inline');
    });
</script>