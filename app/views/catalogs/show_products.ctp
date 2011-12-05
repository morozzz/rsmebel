<style type="text/css">
/*.product-price-label {
    text-align: right;
    padding: 5px 5px;
    font-size: 16px;
    font-weight: bold;
}*/

.tr-product-table,
.tr-product-table-price {
    clear: both;
    overflow: auto;
    height: auto;
    padding-right: 1px;/*для IE*/
    margin-bottom: 10px;
}

.tr-product-table-price {
    padding-bottom: 5px;
    border-bottom: 2px #DDDDDD solid;
    height: 60px;
}

.td-product-table,
.td-product-table-price {
    width: 50%;
    float: left;
    overflow: auto;
}

/*.make-custom {
    text-align: right;
    padding: 5px 5px;
}*/

img.product-small-image {
    width: 150px;
    height: 150px;
    float: left;
    padding: 5px 0px;
    padding-left: 5px;
}

div.product-table {
    margin-left: 155px;
    padding: 5px;
}

h3.product-name {
    font-size: 11px;
    font-weight: bold;
    padding: 3px;
    margin: 5px 0px 5px 155px;
    text-align: center;
}

div.product-short-about {
    margin-left: 155px;
    padding: 5px;
}

div.product-short-about p {
    margin: 5px;
}

div.product-table table {
    width: 100%;
}

div.product-image-name-about {
    overflow: auto;
    height: auto;
}

div.product-table table {
    border: 1px solid #D1CDCE;
    border-collapse: collapse;
    text-align: center;
}

div.product-table table th {
    border: 1px solid #D1CDCE;
    font-weight: normal;
}

div.product-table table tbody tr {
    cursor: pointer;
}

div.product-table table tbody tr:hover,
div.product-table table tbody tr.hover /*for IE*/
{
    background-color: #F1EDEE;
}

div.product-table table tbody tr.selected {
    background-color: #C1BDDE;
}

div.product-table table tbody tr.dataTables_empty {
    background-color: white;
    cursor: auto;
}

div.product-table table tbody tr.dataTables_empty:hover
{
    background-color: white;
}

div.product-table table td {
    border: 1px solid #D1CDCE;
    margin: 1px;
}

td.product-table-td-price {
    font-size: 14px;
    font-weight: bold;
}

div.product-comboboxes {
    padding: 3px;
    clear: both;
}

div.product-comboboxes label {
    display: block;
    padding: 3px 0px;
    font-weight: bold;
}

div.product-comboboxes select {
    width: 150px;
}

div.product-price-label {
    text-align: right;
    padding: 5px;
    /*position: absolute;
    bottom: 20px;*/
}

div.make-custom {
    text-align: right;
    padding-right: 5px;
    /*position: absolute;
    bottom: 0px;*/
}

div.product-price-label {
    font-size: 16px;
    font-weight: bold;
}

</style>

<?php
    $paginator->options(array('url' => $this->params['pass']));
    echo "<table><tr>";
    echo "<td id=\"catalogs-show-path-tree\">";
    $show_level_2 = false;
    foreach($path_tree as $id => $path_node) {
        if($path_node['level'] == 1) {
            $show_level_2 = $path_node['show_sub_level'];
        }
        if($path_node['level'] == 2 && !$show_level_2 && $catalog['Catalog']['id'] != $id) continue;

        $path_node_link = array(
            'controller' => 'catalogs',
            'action' => 'show',
            $id
        );

        echo $html->div(
                (($catalog['Catalog']['id'] == $id)?'catalogs-show-path-tree-node-selected ':'').
                    'catalogs-show-path-tree-node catalogs-show-path-tree-node-'.
                    $path_node['level'],
                (($path_node['level']==2)?'<li>':'').
                $html->link($path_node['Catalog']['name'], $path_node_link));
        if($path_node['level'] == 0) {
            echo $html->image($path_node['SmallImage']['url'], array(
                'class' => 'catalogs-show-path-tree-node-0-image',
                'url' => $path_node_link
            ));
        }
    }
    echo "</td>";

    echo "<td id=\"catalogs-show-products\">";
    $path_str = '';
    for($i=0; $i<count($path); $i++) {
        $path_str .= $html->link($path[$i]['Catalog']['name'] . ' >> ', array(
            'controller' => 'catalogs',
            'action' => 'show',
            $path[$i]['Catalog']['id']
        ));
    }
    echo $html->div('catalogs-show-path', $path_str);

    echo $html->div('', $catalog['Catalog']['name'], array(
        'id' => 'catalogs-show-products-catalog-caption'
    ));
    echo $html->div('',
            $html->image($catalog['BigImage']['url']).
            $catalog['Catalog']['long_about'].
            $html->div('clear-div', ''),
        array(
            'id' => 'catalogs-show-products-catalog-about'
        )
    );
    echo $html->link('excel', array(
        'controller' => 'catalogs',
        'action' => 'get_excel',
        $catalog['Catalog']['id']
    ));

    //pagination table
    echo "<table class=\"pagination\"><tr>";
    echo "<td id=\"pagination-count\">";
    echo $paginator->counter('Всего изделий %count% '.
        $paginator->link("(Показать все)", array(
            'limit' => $paginator->params['paging']['Product']['count']
        )).
        ', показано с %start% по %end%');
    echo "</td>";
    echo "<td id=\"pagination-prev\">";
    echo $paginator->prev(' < < < Назад');
    echo "</td>";
    echo "<td id=\"pagination-pages\">";
    echo $paginator->numbers(array(
                'before' => 'Страницы ',
                'modulus' => 0,
                'separator' => ' '
            ));
    echo "</td>";
    echo "<td id=\"pagination-next\">";
    echo $paginator->next('Вперед > > > ');
    echo "</td>";
    echo "<td id=\"pagination-limit\">";
    echo "Количество на странице<BR>";
    echo $form->select('', array(
        6 => '6',
        10 => '10',
        20 => '20',
        30 => '30',
        $paginator->params['paging']['Product']['count'] => 'Все'
    ), $limit, array(
        'id' => 'pagination-input-limit'
    ), false);
    echo "</td>";
    echo "</tr></table>";
    //*****************************************************

    //echo "<table class=\"catalogs-show-products-product-table\">";
    $product_row_count = 0;
    foreach($products as $product_id => $product) {
        if($product_row_count == 0) {
            echo "<div class='tr-product-table'>";
        }

        $td_product_id = "td-product-".$product['Product']['id'];
//        echo "<td class='td-product-table' id=\"$td_product_id\">";
        echo "<div class='td-product-table' id='$td_product_id'>";

        echo "<div class='product-image-name-about'>";
        $image_url = empty($product['SmallImage']['url'])?'nopic.gif':$product['SmallImage']['url'];
        echo $html->image($image_url, array(
            'class' => 'product-small-image'
        ));

        echo "<h3 class='product-name'>".$product['Product']['name']."</h3>";
        echo $html->div('product-short-about', $product['Product']['short_about'].' ');
        if(!empty($product['table'])) {
            echo "<div class='product-table'>";

            echo "<table id='product-table-".$product_id."'>";
            echo "<thead>";
            echo "<tr>";
            foreach($product['columns'] as $column_name) {
                echo "<th>$column_name</th>";
            }
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            echo "</tbody>";
            echo "</table>";

            echo "</div>";
        }
        echo "</div>";

        if(!empty($product['comboboxes'])) {
            echo "<div class='product-comboboxes'>";
            foreach($product['comboboxes'] as $product_param_id => $combobox) {
                echo "<label>";
                echo $combobox['name'];
                echo "</label>";

                echo "<select id='product-select-".$product_param_id."' onChange=\"product_select_change('".$product_id."')\">";
                foreach($combobox['values'] as $product_det_param_value_id => $product_det_param_value) {
                    echo "<option value='".$product_det_param_value_id."'>";
                    echo $product_det_param_value['name'];
                    echo "</option>";
                }
                echo "</select>";
            }
            echo "</div>";
        }

//        echo "<div class='product-price-label'>";
//        echo "<span>Цена: </span>";
//        echo "<span id='label-product-price-".$product['Product']['id']."'></span>";
//        echo "<span >руб.</span>";
//        echo "</div>";
//
//        echo "<div class='make-custom'>";
//        echo "<span class=\"product-count-label\">Количество:</span>";
//        echo $form->text('', array(
//            'id' => 'edit-product-count-'.$product['Product']['id'],
//            'class' => 'textbox-int product-count',
//            'value' => '1'
//        ));
//        echo $form->button('Заказать', array(
//            'class' => 'product-make-custom',
//            'id' => 'button-product-make-custom-'.$product['Product']['id']
//        ));
//        echo "</div>";

        echo "</div>";

        $product_row_count++;
        if($product_row_count==2) {
            echo "</div>";
            $product_row_count = 0;
            echo "<div class='tr-product-table-price'>";
            print_price($form, $last_product_id);
            print_price($form, $product_id);
            echo "</div>";
        }
        $last_product_id = $product_id;

    }

    if($product_row_count>0) {
        echo "</div>";
        echo "<div class='tr-product-table-price'>";
        print_price($form, $last_product_id);
        echo "</div>";
    }

    echo "</td>";

    echo "</tr></table>";

    $json_products = $products;
    //обрезаем лишнее, чтобы любопытные не нашли
//    foreach($json_products as $id => $json_product) {
////        unset($json_products[$id]['Product']['name']);
//        unset($json_products[$id]['Product']['sort_order']);
//        unset($json_products[$id]['Product']['catalog_id']);
//        unset($json_products[$id]['Product']['small_image_id']);
//        unset($json_products[$id]['Product']['big_image_id']);
//        unset($json_products[$id]['Product']['code_1c']);
//        unset($json_products[$id]['Product']['short_about']);
//        unset($json_products[$id]['Product']['long_about']);
//        if($json_product['Product']['cnt']>0)
//            $json_products[$id]['Product']['cnt'] = 1;
//        else
//            $json_products[$id]['Product']['cnt'] = 0;
//
//        unset($json_products[$id]['SmallImage']['id']);
//        unset($json_products[$id]['SmallImage']['image_type_id']);
//
////        обрезается еще в контроллере
////        unset($json_products[$id]['BigImage']['id']);
////        unset($json_products[$id]['BigImage']['image_type_id']);
//
//        $json_products[$id]['Product']['product_param_count'] = count($json_product['ProductParam']);
//        $json_products[$id]['Product']['product_det_count'] = count($json_product['ProductDet']);
//
//        foreach($json_product['ProductParam'] as $par_id => $product_param) {
//            unset($json_products[$id]['ProductParam'][$par_id]['product_id']);
//            unset($json_products[$id]['ProductParam'][$par_id]['product_param_type_id']);
//            unset($json_products[$id]['ProductParam'][$par_id]['sort_order']);
//            unset($json_products[$id]['ProductParam'][$par_id]['ProductParamType']['id']);
//        }
//
//        foreach($json_product['ProductDet'] as $det_id => $product_det) {
//            unset($json_products[$id]['ProductDet'][$det_id]['product_id']);
//            unset($json_products[$id]['ProductDet'][$det_id]['sort_order']);
//            unset($json_products[$id]['ProductDet'][$det_id]['code_1c']);
//            unset($json_products[$id]['ProductDet'][$det_id]['small_image_id']);
//            unset($json_products[$id]['ProductDet'][$det_id]['big_image_id']);
//            unset($json_products[$id]['ProductDet'][$det_id]['SmallImage']['id']['image_type_id']);
//            unset($json_products[$id]['ProductDet'][$det_id]['BigImage']['id']['image_type_id']);
//        }
//    }
//    debug($json_products);

    function print_price($form, $product_id) {
        echo "<div class='td-product-table-price'>";
        echo "<div class='product-price-label'>";
        echo "<span>Цена: </span>";
        echo "<span id='label-product-price-".$product_id."'></span>";
        echo "<span >руб.</span>";
        echo "</div>";

        echo "<div class='make-custom'>";
        echo "<span class=\"product-count-label\">Количество:</span>";
        echo $form->text('', array(
            'id' => 'edit-product-count-'.$product_id,
            'class' => 'textbox-int product-count',
            'value' => '1'
        ));
        echo $form->button('Заказать', array(
            'class' => 'product-make-custom',
            'id' => 'button-product-make-custom-'.$product_id
        ));
        echo "</div>";
        echo "</div>";
    }
?>

<script type="text/javascript">
    var products = <?php echo $javascript->object($json_products); ?>;
    var webroot = "<?php echo $this->webroot; ?>"
    enable_ajax_waiting();
    $(document).ready(function() {
        for(var product_id in products) {
            var product = products[product_id];
            //$('#button-product-make-custom-'+product_id).get(0).product_id = product_id;
            document.getElementById('button-product-make-custom-'+product_id).product_id = product_id;
            document.getElementById('edit-product-count-'+product_id).product_id = product_id;

            if(product.ProductParam != null) {
                document.getElementById('product-table-'+product_id).product_id = product_id;
            }
            for(var product_param_id in product.comboboxes) {
                document.getElementById('product-select-'+product_param_id).product_id = product_id;
                document.getElementById('product-select-'+product_param_id).product_param_id = product_param_id;
            }

            update_price(product_id);
        }

        //для каждой таблицы детализации товара проставляем колонки
        $('.product-table table').each(function() {
            var product = products[this.product_id];
            var aoColumns = [];
            for(var column_key in product.columns) {
                if(column_key == 'price') {
                    aoColumns.push({
                        'sClass': 'product-table-td-price',
                        'fnRender': function(oObj) {
                            return parseFloat(oObj.aData[oObj.iDataColumn]).toFixed(2) + ' руб.';
                        }
                    });
                } else if(column_key == 'product_det_id') {
                    aoColumns.push({
                        'bVisible': false
                    });
                } else {
                    aoColumns.push(null);
                }
            }
            product.data_table = $(this).dataTable({
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bSort": false,
		"bInfo": false,
		"bAutoWidth": false,
                "oLanguage" : {
                    "sZeroRecords":  "Записи отсутствуют."
                },
                'aoColumns': aoColumns,
                'fnRowCallback': function(nRow, aArray, iDisplayIndex) {
                    nRow.product_det_id = aArray[aArray.length-1];
                    nRow.product_id = product_id;
                    return nRow;
                }
            });

            //и инициализируем ее данными
            fill_current_product_comboboxes_value(this.product_id);
            show_product_table(this.product_id);
        });

        $('#pagination-input-limit').change(function() {
            var limit = $('#pagination-input-limit option:selected').val();

            var url = "<?php echo $paginator->url(array_merge((array)$paginator->options['url'], array('limit' => null)));?>";
            url += '/limit:'+limit;
            window.location = url;
        });

        $('.product-make-custom').click(function() {
            var product = products[this.product_id];
            var cnt = $('#edit-product-count-'+this.product_id).val();
            if(cnt<=0) {
                alert('Количество товара должно быть больше нуля');
                return;
            }
            if(product.ProductParam != null) {
                if(product.current_product_det_id == null) {
                    alert('Выберите товар из таблицы');
                } else {
//                    alert(product.current_product_det_id);
                    $('#div-top-header-basket').load(
                        webroot+'basket/add',
                        {
                            product_det_id: product.current_product_det_id,
                            cnt: cnt
                        }
                    );
//                    $.ajax({
//                        'url': webroot+'basket/add',
//                        'type': 'post',
//                        'data': {
//                            product_det_id: product.current_product_det_id,
//                            cnt: cnt
//                        }
//                    });
                }
            } else {
//                alert(this.product_id);
                $('#div-top-header-basket').load(
                    webroot+'basket/add',
                    {
                        product_id: this.product_id,
                        cnt: cnt
                    }
                );
//                $.ajax({
//                    'url': webroot+'basket/add',
//                    'type': 'post',
//                    'data': {
//                        product_id: this.product_id,
//                        cnt: cnt
//                    }
//                });
            }
        });
    });

    function fill_current_product_comboboxes_value(product_id) {
        var product = products[product_id];
        if(product.comboboxes == null) {
            return;
        }
        product.current_comboboxes_value = {};
        $('#td-product-'+product_id+' .product-comboboxes select').each(function() {
            product.current_comboboxes_value[this.product_param_id] = $(this).find('option:selected').val();
        });
    }

    function show_product_table(product_id) {
        var product = products[product_id];
        product.current_product_det_id = null;
        product.data_table.fnClearTable();
        var table_data = null;
        if(product.current_comboboxes_value == null) {
            table_data = product.table;
        } else {
            var current_table_key = -1;
            for(var table_key in product.tables) {
                var table = product.tables[table_key];
                var is_same = true;
                for(var product_param_id in table.comboboxes_value) {
                    if(table.comboboxes_value[product_param_id] !=
                            product.current_comboboxes_value[product_param_id]) {
                        is_same = false;
                        break;
                    }
                }
                if(is_same) {
                    current_table_key = table_key;
                    break;
                }
            }
            product.data_table.fnClearTable();
            if(current_table_key == -1) {
                //очистить таблицу
            } else {
                table_data = product.tables[current_table_key].table;
            }
        }

        if(table_data != null) {
            for(table_key in table_data) {
                var row = table_data[table_key];
                var data = [];
                for(var product_param_id in row) {
                    data.push(row[product_param_id]);
                }
                product.data_table.fnAddData(data);
            }
        }

        $('#product-table-'+product_id+' tbody').click(function(event) {
            $('#product-table-'+product_id+' tbody tr').removeClass('selected');
            var row = event.target.parentNode;
            $(row).addClass('selected');
            products[product_id]['current_product_det_id'] = row.product_det_id;
            update_price(product_id);
        });

        //for IE
        $('#product-table-'+product_id+' tbody tr').mouseover(function() {
            $(this).addClass('hover');
        });
        $('#product-table-'+product_id+' tbody tr').mouseout(function() {
            $(this).removeClass('hover');
        });
        ////////////////
    }

    function product_select_change(product_id) {
        fill_current_product_comboboxes_value(product_id);
        show_product_table(product_id);
    }

    $('.product-count').change(function() {
        update_price(this.product_id);
    });

    $('.product-count').keyup(function() {
        update_price(this.product_id);
    });

    function update_price(product_id) {
        var product = products[product_id];

        var label_product_price_id = 'label-product-price-'+product_id;
        var label_product_price = $('#'+label_product_price_id);

        var edit_product_count_id = 'edit-product-count-'+product_id;
        var edit_product_count = $('#'+edit_product_count_id);

        var price = 0;

        if(product.ProductParam != null) {
            if(product.current_product_det_id == null) {
                price = 0
            } else {
                price = product.table[product.current_product_det_id].price;
            }
        } else {
            price = product.Product.price;
        }

        price = price * edit_product_count.val();
        if(price>0) {
            label_product_price.html(parseFloat(price).toFixed(2) + '  ');
        } else {
            label_product_price.html('- ');
        }

    }
    enable_validation();
</script>