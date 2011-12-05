<?php echo $common->caption('Корзина товаров');?>
<cake:nocache>
<div class="top-header hide-menu pie">
   <?php
     echo $this->element('basket_menu_box');
   ?>
</div>
</cake:nocache>
<?php $session->flash(); ?>
<div class="div-basket">
    <form action="<?php echo $this->webroot;?>basket/update" id="form-update-basket" method="post">
    <div class="div-basket-table-background pie">
        <div class="div-basket-table">
            <table id="basket-table">
                <thead>
                    <tr id="tr-th-basket-table">
                        <th width="100"></th>
                        <th>Ваш заказ</th>
                        <th width="10%">Цена</th>
                        <th width="10%">Количество</th>
                        <th width="10%">Стоимость</th>
                        <th width="9%">Удалить</th>
                        <th width="9%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $all_price = 0;
                        foreach($basket_data as $basket_data_key => $product) {
                            $url = '/products/index/'.$product['product_id'];
                            if(!empty($product['product_det_id']))
                                $url .= '/'.$product['product_det_id'];
                            $all_price += $product['total_price'];
                            echo "<tr>";

                            echo "<td>";
                            echo "<div class='div-basket-image'>";
                            echo "<div class='div-basket-image-1'>";
                            echo "<div class='div-basket-image-2'>";
                            echo "<div class='div-basket-image-3' ".
                                "style='background: url(".$this->webroot."img/".$product['image_url'].") no-repeat center center'>";
                            echo "<a href='".$html->url($url)."' style='display: block; height: 100%;'>";
                            echo "</a>";
                            echo $html->image($product['image_url'], array(
                                'class' => 'basket-table-image',
                                'url' => $url
                            ));
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</td>";

                            echo "<td>";
                            echo '<div class="div-basket-catalog-path">';
                            echo '<span class="text-shadow">';
                            echo $common->getPathStr($product['catalog_path']);
                            echo "</span>";
                            echo "</div>";
                            echo '<div class="div-basket-product-name">';
                            echo '<span class="text-shadow">';
                            echo $html->link($product['name'], $url);
                            echo "</span>";
                            echo "</div>";
                            echo '<div class="div-basket-product-short-about">'.$product['short_about']."</div>";
                            echo "</td>";

                            echo "<td class='td-price'>";
//                            echo '<span class="text-shadow">';
                            echo $product['price'];
//                            echo "</span>";
                            echo "</td>";

                            echo "<td>";
                            echo $form->text('', array(
                                'name' => 'data[Basket]['.$basket_data_key.'][cnt]',
                                'value' => $product['cnt'],
                                'class' => 'textbox-int',
                                'size' => '10'
                            ));
                            echo "</td>";

                            echo "<td class='td-total-price'>";
//                            echo '<span class="text-shadow">';
                            echo $product['total_price'];
//                            echo "</span>";
                            echo "</td>";

                            echo '<td class="td-delete">';
                            echo $html->image('delete.png', array(
                                'alt' => 'Удалить',
                                'escape' => false,
                                'title' => 'Удалить',
                                'class' => 'link-delete-basket iepngfix'
                            ));
                            echo "</td>";

                            echo "<td>";
                            echo $basket_data_key;
                            echo "</td>";

                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="div-total-price">
            <span class="text-shadow">
                Сумма заказа:
            </span>
            <span id="span-basket-all-price" class="text-shadow">
                <?php echo $all_price;?>
            </span>
        </div>
        <div id="div-basket-form-submit">
            <input type="submit" id="submit-recalc" value="Пересчитать">
            <input type="button" id="button-custom-registr" value="Оформление заказа">
        </div>
    </div>

    </form>
</div>


<script type="text/javascript">
    var basket_table;
    var webroot = "<?php echo $this->webroot; ?>"
    $(document).ready(function() {
        enable_validation();
        enable_ajax_waiting();

        update_all_price();
        
        basket_table = $('#basket-table').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": false,
            "bInfo": false,
            "bAutoWidth": false,
            "oLanguage" : {
                "sZeroRecords":  "Корзина пуста"
            },
            'aoColumns': [
                null,
                null,
                {
                    'fnRender': function(oObj) {
                        var t = 0;
                        if(oObj.aData[oObj.iDataColumn] > 0)
                            t = parseFloat(oObj.aData[oObj.iDataColumn]).toFixed(2);
                        if(t==0)
                            return 'Под заказ';
                        else
                            return t + ' руб.';
                    }
                },
                null,
                {
                    'fnRender': function(oObj) {
                        var t = 0;
                        if(oObj.aData[oObj.iDataColumn] > 0)
                            t = parseFloat(oObj.aData[oObj.iDataColumn]).toFixed(2);
                        var s = '';
                        if(t==0)
                            s = 'Под заказ';
                        else
                            s = parseFloat(oObj.aData[oObj.iDataColumn]).toFixed(2) + ' руб.';

                        return '<span id="td-total-price-'+oObj.aData[6]+'">'+s+ '</span>';
                    }
                },
                null,
                {
                    'bVisible': false
                }
            ]
        });

        $('#form-update-basket').ajaxForm({
            success: function(responseText, statusText) {
                var obj = eval(responseText);
                if(obj==null) return;
                var updated_price = obj.updated_price
                for(var price_key in updated_price) {
                    var total_price = updated_price[price_key];
                    $('#td-total-price-'+price_key).html(parseFloat(total_price).toFixed(2) + ' руб.');
                }
                $('.div-top-header-basket').html(obj.basket_str);
                update_all_price(obj.all_price);
            }
        });

        $('.link-delete-basket').click(function() {
            var tr = $(this).parent().parent().get(0);
            var basket_data_key = basket_table.fnGetData(tr)[6];
            basket_table.fnDeleteRow(tr);

            $.ajax({
                url: webroot+'basket/delete',
                data: {
                    basket_key: basket_data_key
                },
                type: 'post',
                success: function(responseText) {
                    var obj = eval(responseText);
                    $('.div-top-header-basket').html(obj.basket_str);
                    update_all_price(obj.all_price);
                }
            });
        });

        $('#button-custom-registr').click(function() {
            document.location = webroot+'customs/order';
        });
    });

    function update_all_price(all_price) {
        if(all_price == null) {
            var all_price_str = $('#span-basket-all-price').html();
            all_price = parseFloat(all_price_str);
        }

        $('#span-basket-all-price').html(all_price.toFixed(2) + ' руб.');
    }
</script>