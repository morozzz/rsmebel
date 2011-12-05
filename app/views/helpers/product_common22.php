<?php

class ProductCommonHelper extends AppHelper {
    var $helpers = array(
        'CatalogCommon',
        'Javascript',
        'Html',
        'Form'
    );

    function print_pagination_table($paginator, $limit) {
        ?>
        <table class="pagination">
            <tr>
                <td id="pagination-count" width="40%">
                    <?php
                    echo $paginator->counter('Всего изделий %count% '.
                        $paginator->link("(Показать все)", array(
                        'limit' => $paginator->params['paging']['Product']['count'],
                        'page' => 1
                    )).
                    ', показано с %start% по %end%');
                    ?>
                </td>
                <td id="pagination-prev" width="10%">
                    <?php echo $paginator->prev(' < < < Назад');?>
                </td>
                <td id="pagination-pages" width="20%">
                    <?php
                    echo $paginator->numbers(array(
                        'before' => 'Страницы ',
                        'modulus' => 0,
                        'separator' => ' '
                    ));
                    ?>
                </td>
                <td id="pagination-next" width="10%">
                    <?php echo $paginator->next('Вперед > > > ');?>
                </td>
                <td id="pagination-limit" width="20%">
                    Количество на странице<br>
                    <?php
                    echo $this->Form->select('', array(
                        6 => '6',
                        10 => '10',
                        20 => '20',
                        30 => '30',
                        $paginator->params['paging']['Product']['count'] => 'Все'
                    ), $limit, array(
                        'id' => 'pagination-input-limit'
                    ), false);
                    ?>
                </td>
            </tr>
        </table>
        <?php
    }

    function print_product_table($product) {
        $product_id = $product['Product']['id'];
        if(!empty($product['columns'])) { ?>
        <div class="product-table">
            <table id="product-table-<?php echo $product_id;?>"
                   product_id="<?php echo $product_id;?>">
                <thead>
                    <tr>
                        <?php foreach($product['columns'] as $column) { ?>
                        <th product_param_id="<?php echo $column['product_param_id'];?>">
                            <?php echo $column['name'];?>
                        </th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <?php }
    }

    function print_product_comboboxes($product) {
        $product_id = $product['Product']['id'];
        if(!empty($product['comboboxes'])) { ?>
        <div class="product-comboboxes">
            <?php foreach($product['comboboxes'] as $combobox) {
                $product_param_id = $combobox['product_param_id'];
                
                echo "<label>".$combobox['name']."</label>";
                echo $this->Form->select('', $combobox['values'], 0, array(
                    'id' => "product-select-$product_param_id",
                    'product_id' => $product_id,
                    'product_param_id' => $product_param_id
                ), false);
            } ?>
        </div>
        <?php }
    }

    function print_price($product) {
        $product_id = $product['Product']['id'];
        $special_class = "";
        if($product['is_special'] == 1) $special_class = " product-price-label-special";
        ?>
    <div class='td-product-table-price'>
        <div class="product-cost-label<?php echo $special_class;?>">
            <span>Цена:</span>
            <span id="label-product-cost-<?php echo $product_id;?>"></span>
            <span class="span-rub">руб.</span>
        </div>
        <div class="div-product-count">
            <span class="product-count-label">Количество:</span>
            <input type="text"
                   id="edit-product-count-<?php echo $product_id;?>"
                   product_id="<?php echo $product_id;?>"
                   class="textbox-int product-count"
                   value="1">
        </div>
        <div class='product-price-label'>
            <span>Сумма: </span>
            <span id="label-product-price-<?php echo $product_id;?>"></span>
            <span class="span-rub">руб.</span>
        </div>

         <div class='make-custom'>
            <input type="button"
                   id="button-product-make-custom-<?php echo $product_id;?>"
                   product_id="<?php echo $product_id;?>"
                   class="product-make-custom"
                   value="Заказать">
        </div>
    </div>
    <?php }

    function print_javascript_init_product_table($products) { ?>
<script type="text/javascript">
    $(document).ready(function() {
        var products = <?php echo $this->Javascript->object($products);?>;
        for(var product_id in products) {
            var product = products[product_id];
            
            var edit_count = $('#edit-product-count-'+product_id);
            edit_count.get(0).product = product;

            var btn_make_custom = $('#button-product-make-custom-'+product_id);
            btn_make_custom.get(0).product = product;

            if(product.columns == null) {
                update_price(product);
                continue;
            }

            if(product.columns != null) {
                var table = $('#product-table-'+product_id);
                table.get(0).product = product;

                if(product.comboboxes == null) {
                    fill_table(table, product.table);
                } else {
                    fill_table(table, find_current_table_data(product_id))
                }
            }

            update_price(product);
        }

        $('.product-count').change(function() {
            update_price(this.product);
        });
        $('.product-count').keyup(function() {
            update_price(this.product);
        });

        $('.product-comboboxes select').change(function() {
            var product_id = $(this).attr('product_id');
            var table = $('#product-table-'+product_id);
            fill_table(table, find_current_table_data(product_id));
        });
        
        $('.product-make-custom').click(function() {
            var product_id = $(this).attr('product_id');
            var product = $(this).get(0).product;

            var edit_product_count = $('#edit-product-count-'+product_id);
            var count = edit_product_count.val();
            if(!(count>0)) {
                alert('Количество товара должно быть больше нуля');
                return;
            }

            var data = {
                cnt: count
            }

            if(product.columns == null) {
                data.product_id = product_id;
            } else {
                var table = $('#product-table-'+product_id);
                var selected_row = table.find('tr[selected]:first');
                if(selected_row.length == 0) {
                    alert('Выберите товар из таблицы');
                    return;
                } else {
                    var product_det_id = selected_row.attr('product_det_id');
                    data.product_det_id = product_det_id;
                }
            }

            $('#div-top-header-basket').load(
                webroot+'basket/add',
                data,
                function() {
                    var product_button_id = '#button-product-make-custom-'+product_id;
                    var position = $(product_button_id).position();
                    position.top -= $(window).scrollTop();

                    var dialog_height = $('#dialog-made-custom').dialog('option', 'height');
                    var dialog_width = $('#dialog-made-custom').dialog('option', 'width');

                    position.top -= dialog_height + 10;
                    position.left -= dialog_width - 50;

                    var pos = [position.left, position.top];
                    $('#dialog-made-custom').dialog('option', 'position', pos);
                    $('#dialog-made-custom').dialog('open');

                    $('#dialog-made-custom').dialog('open');
                }
            );
        });

        enable_validation();
    });

    function fill_table(table, table_data) {
        table.find('tbody').html('');

        if(table_data == null || table_data.rows == null) {
            var columns_cnt = table.find('th').length;
            var empty_row = $('<tr></tr>');
            var empty_cell = $('<td colspan='+columns_cnt+'>Записи отсутствуют</td>');
            empty_row.append(empty_cell);
            empty_row.css('cursor', 'default');
            table.find('tbody').append(empty_row);
            return;
        }

        for(var row_key in table_data.rows) {
            var row_data = table_data.rows[row_key];
            var row = $('<tr></tr>');
            row.attr('product_det_id', row_data.product_det_id);

            for(var cell_key in row_data.cells) {
                var cell_data = row_data.cells[cell_key];
                var cell = $('<td></td>');
                cell.attr('product_param_id', cell_data.product_param_id);
                cell.append(cell_data.value);

                row.append(cell);
            }

            table.find('tbody').append(row);
        }

        $(table).find('tbody tr').click(function() {
            var table = $(this).parent().parent();
            table.find('tbody tr').removeClass('selected');
            table.find('tbody tr').removeAttr('selected');
            table.find('input[type=radio]').removeAttr('checked');

            $(this).addClass('selected');
            $(this).attr('selected', 'true');
            $(this).find('input[type=radio]').attr('checked', 'true');

            var product_id = table.attr('product_id');
            var product_det_id = $(this).attr('product_det_id');
            var product = table.get(0).product;
            var product_det = product.ProductDet[product_det_id];

            $('#product-image-'+product_id+'[image_size=small]').attr(
                'src',
                webroot+'img/'+product_det.SmallImage.url
            );
            $('#product-image-'+product_id+'[image_size=big]').attr(
                'src',
                webroot+'img/'+product_det.BigImage.url
            );

            $('#td-product-'+product_id+' .product-short-about').html(product_det.ProductDet.short_about);
            $('#product-long-about').html(product_det.ProductDet.long_about);

            var producer_name = 'не указан';
            if(product_det.ProductDet.producer_id != null) {
                producer_name = product_det.Producer.name;
            }
            $('#span-producer-name-'+product_id).html(producer_name);

            update_price(table.get(0).product);

            var new_product_link = webroot+'products/index/'+product_id+'/'+product_det_id;
            $('a.product-link[product_id='+product_id+']').attr('href', new_product_link);
        });
        
        $(table).find('tbody tr').mouseover(function() {
            $(this).addClass('hover');
        });
        $(table).find('tbody tr').mouseout(function() {
            $(this).removeClass('hover');
        });

        $(table).find('tbody tr').dblclick(function() {
            var table = $(this).parent().parent();
            var product_id = table.attr('product_id');
            var product_det_id = $(this).attr('product_det_id');

            window.location = webroot+'products/index/'+product_id+'/'+product_det_id;
        });

        $(table).find('tbody tr:first').click();
    }

    function find_current_table_data(product_id) {
        var table = $('#product-table-'+product_id);
        var product = table.get(0).product;
        var product_id = product.Product.id;

        for(var table_key in product.tables) {
            var cbs_value = product.tables[table_key].comboboxes_value;

            var flag = true;
            for(var cb_key in cbs_value) {
                var cb = cbs_value[cb_key];
                var select = $('select[product_id='+product_id+'][product_param_id='+cb.product_param_id+']');
                if(select.val() != cb.value) {
                    flag = false;
                    break;
                }
            }
            if(flag) {
                return product.tables[table_key].table;
            }
        }
        return null;
    }

    function update_price(product) {
        var product_id = product.Product.id;

        var price = 0;
        if(product.columns != null) {
            var table = $('#product-table-'+product_id);
            var selected_row = table.find('tr[selected]:first');
            if(selected_row.length == 0) {
                price = 0;
            } else {
                var product_det_id = selected_row.attr('product_det_id');
                var product_det = product.ProductDet[product_det_id];
                if(product_det.ProductDet.cnt>0)
                    price = product_det.ProductDet.price;
                else
                    price = -1;
            }
        } else {
            if(product.Product.cnt>0)
                price = product.Product.price;
            else
                price = -1;
        }

        var edit_product_count = $('#edit-product-count-'+product_id);
        var cost = price;
        price = price * edit_product_count.val();

        var label_product_price = $('#label-product-price-'+product_id);
        var label_product_cost = $('#label-product-cost-'+product_id);

        if(price > 0) {
            label_product_cost.html(parseFloat(cost).toFixed(2) + '  ');
            label_product_cost.parent().find('.span-rub').html('руб.');
            label_product_price.html(parseFloat(price).toFixed(2) + '  ');
            label_product_price.parent().find('.span-rub').html('руб.');

            label_product_cost.parent().parent().find('.zakaz-text').remove();
        } else if(price==0) {
            label_product_cost.html('- ');
            label_product_cost.parent().find('.span-rub').html('руб.');
            label_product_price.html('- ');
            label_product_price.parent().find('.span-rub').html('руб.');

            label_product_cost.parent().parent().find('.zakaz-text').remove();
        } else {
            label_product_cost.html('под заказ');
            label_product_cost.parent().find('.span-rub').html('');
            label_product_price.html('под заказ');
            label_product_price.parent().find('.span-rub').html('');

            label_product_cost.parent().parent().find('.zakaz-text').remove();
            label_product_cost.parent().after('<div class="zakaz-text">Просим прощения на даный момент товар отсутствует на складе</div>');
        }
    }
</script>
        <?php
    }
}

?>
