
<?php echo $common->caption('ОФОРМЛЕНИЕ ЗАКАЗА'); ?>

<?php $session->flash(); ?>

<form action="<?php echo $this->webroot;?>customs/order" method="post" id="form-order">

<div class="custom-form-group" id="div-client-info">
    <label class="custom-form-labels">
        Филиал:
    </label>
    <div class="custom-form-inputs">
      <?php
         echo "<select id='ClientInfoId' name='data[ClientInfo][id]'>";
         foreach ($client_infos as $client_info) {
           echo "<option value='".$client_info['ClientInfo']['id']."'>".$client_info['ClientInfo']['name']."</option>";
         }
         echo "</select>";

         echo $form->input('ClientInfo.name', array('class' => 'div-input','label' => '<font color = yellow> Покупатель(фирма)</font><font color = red> * </font>:', 'size' => '51'));
         echo $form->input('ClientInfo.company_type_id', array('class' => 'div-input', 'label' => 'Орг. правовая форма:', 'empty' => 'Выберете из списка'));
         echo $form->input('ClientInfo.reg_num', array('class' => 'div-input','label' => 'Регистрационный номер(ИП):', 'size' => '43'));
         echo $form->input('User.email', array('class' => 'div-input', 'label' => '<font color = yellow>E-mail</font><font color = red> * </font>:', 'style' => 'width: 200px;'));
         echo $form->input('ClientInfo.fio', array('class' => 'div-input', 'label' => '<font color = yellow>Контактное лицо</font><font color = red> * </font>:'));

          echo "<table width = 100%> <tr>";
          echo "<td style='width:117px'>";
            echo $form->input('ClientInfo.phone_kod', array('label' => 'Телефон:(', 'size' => '10', 'style' => 'width: 50px; height: 20px; margin-left:3px;'));
          echo "</td>";
          echo "<td style='text-align: left; width:5px;'>";
            echo "<div class = 'input text'>";
              echo $form->label(')');
            echo "</div>";
          echo "</td>";
          echo "<td>";
            echo $form->input('ClientInfo.phone', array('label' => '', 'size' => '30', 'style' => 'height: 20px;'));
          echo "</td>";
          echo "</table>";

          echo "<table width = 100%> <tr>";
          echo "<td style='width:94px'>";
            echo $form->input('ClientInfo.fax_kod', array('label' => 'Факс:(', 'size' => '10', 'style' => 'width: 50px; margin-left: 3px; height: 20px;'));
          echo "</td>";
          echo "<td style='text-align: left; width:5px;'>";
            echo "<div class = 'input text'>";
              echo $form->label(')');
            echo "</div>";
          echo "</td>";
          echo "<td>";
            echo $form->input('ClientInfo.fax', array('label' => '', 'size' => '30', 'style' => 'height: 20px;'));
          echo "</td>";
          echo "</table>";
      ?>

      </div>

        <label class="custom-form-labels">
            Юридический адрес:
        </label>
        <div class="custom-form-inputs">
            <div id="custom-form-address-block1" class="custom-form-address-block">
                Индекс: <input class = "div-input" type="text" value="" name="data[ClientInfo][jur_index]" size="5" id="ClientInfoJurIndex">&nbsp;&nbsp;
                Регион: <input class = "div-input" type="text" value="" name="data[ClientInfo][jur_region]" size="15" id="ClientInfoJurRegion">&nbsp;&nbsp;
                Город: <input class = "div-input" type="text" value="" name="data[ClientInfo][jur_city]" size="15" id="ClientInfoJurCity">
            </div>
            <div class="custom-form-address-block">
                Улица: <input class = "div-input" type="text" value="" name="data[ClientInfo][jur_street]" size="24" id="ClientInfoJurStreet">&nbsp;&nbsp;
                Дом: <input class = "div-input" type="text" value="" name="data[ClientInfo][jur_hnumber]" size="6" id="ClientInfoJurHnumber">&nbsp;&nbsp;
                Кв./Офис: <input class = "div-input" type="text" value="" name="data[ClientInfo][jur_office]" size="6" id="ClientInfoJurOffice">
            </div>
        </div>

      <div class="custom-form-inputs">
      <?php
        echo $form->input('ClientInfo.INN', array('class' => 'div-input','label' => 'ИНН:', 'size' => '50'));
        echo $form->input('ClientInfo.KPP', array('class' => 'div-input','label' => 'КПП(кроме ИП):', 'size' => '50'));
        echo $form->input('ClientInfo.operating_account', array('class' => 'div-input', 'label' => 'Расчетный счет:', 'size' => '50'));
        echo $form->input('ClientInfo.bank', array('class' => 'div-input', 'label' => 'Банк:', 'size' => '50'));
        echo $form->input('ClientInfo.correspondent_account', array('class' => 'div-input', 'label' => 'Корреспондентский счет:', 'size' => '46'));
        echo $form->input('ClientInfo.BIK', array('class' => 'div-input', 'label' => 'БИК:', 'size' => '50'));
        echo $form->input('ClientInfo.OKPO', array('class' => 'div-input', 'label' => 'ОКПО:', 'size' => '50'));
        echo $form->input('ClientInfo.OKVED', array('class' => 'div-input', 'label' => 'ОКВЭД(ОКОНХ):', 'size' => '50'));
        echo $form->hidden('CustomClientInfo.id');
      ?>
      </div>

</div>

<?php
//<div class="custom-form-group" id="div-transport-type">
//    <label class="custom-form-labels">
//        Способ доставки:
//    </label>
//    <div class="custom-form-inputs">
//    <?php
//    $transport_types_radio = array();
//    foreach($transport_types as $transport_type) {
//        $radio_text = $transport_type['TransportType']['name'];
//        if(!empty($transport_type['TransportTypeAbout'])) {
//            $radio_text .= ' (';
//            $is_first = true;
//            foreach($transport_type['TransportTypeAbout'] as $transport_type_about) {
//                if(!$is_first) $radio_text .= ', ';
//                $radio_text .= $html->link($transport_type_about['name'], array(
//                    'controller' => 'transport_type_abouts',
//                    'action' => 'show',
//                    $transport_type_about['id']
//                ), array(
//                    'target' => '_blabk'
//                ));
//                $is_first = false;
//            }
//            $radio_text .= ')';
//        }
//        $transport_types_radio[$transport_type['TransportType']['id']] = $radio_text;
//    }
//    echo $form->radio(
//            'transport_type_id',
//            $transport_types_radio,
//            array(
//                'value' => $transport_types[0]['TransportType']['id'],
//                'separator' => '<br>',
//                'class' => 'radio-transport-type'
//            )
//    );
//    ? >
//    </div>
//</div>
?>

<div class="custom-form-group" id="div-pay-type">
    <label class="custom-form-labels">
        Форма оплаты:
    </label>
    <div class="custom-form-inputs">
    <?php
    echo $form->radio(
            'pay_type_id',
            $pay_type_list,
            array(
                'separator' => '<br>',
                'class' => 'radio-pay-type',
                'value' => array_shift(array_keys($pay_type_list))
            )
    );
    ?>
    </div>
</div>

<?php
//<div class="custom-form-group" id="div-transport-address">
//    <label class="custom-form-labels">
//        Адрес для доставки:
//    </label>
//    <div class="custom-form-inputs">
//        <div id="custom-form-address-block1" class="custom-form-address-block">
//            Индекс: <input class = "div-input" type="text" value="" name="data[TransportAddress][post_index]" size="5" id="TransportIndex">&nbsp;&nbsp;
//            Регион: <input class = "div-input" type="text" value="" name="data[TransportAddress][region]" size="15" id="TransportRegion">&nbsp;&nbsp;
//            Город: <input class = "div-input" type="text" value="" name="data[TransportAddress][city]" size="15" id="TransportCity">
//        </div>
//        <div class="custom-form-address-block">
//            Улица: <input class = "div-input" type="text" value="" name="data[TransportAddress][street]" size="24" id="TransportStreet">&nbsp;&nbsp;
//            Дом: <input class = "div-input" type="text" value="" name="data[TransportAddress][house]" size="6" id="TransportHnumber">&nbsp;&nbsp;
//            Кв./Офис: <input class = "div-input" type="text" value="" name="data[TransportAddress][flat]" size="6" id="TransportOffice">
//        </div>
//    </div>
//
//    <?php
//      echo $form->button('=юридический адрес', array('style' => 'font-size: 12px', 'onClick' => 'setAddress()', 'id' => 'btnPost'));
//    ? >
//</div>
?>

<div class="custom-form-group" id="div-custom-note">
    <label class="custom-form-labels">
        Комментарий:
    </label>
    <div class="custom-form-inputs">
        <textarea rows="5" cols="70" style="font-size: 13px; font-family: arial;" name="data[note]"></textarea>
    </div>
</div>
<table id="basket-table">
    <thead>
        <tr id="tr-th-basket-table">
            <th>Ваш заказ</th>
            <th width="15%">Цена</th>
            <th width="15%">Количество</th>
            <th width="15%">Стоимость</th>
            <th width="9%"></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $all_price = 0;
            foreach($basket_data as $basket_data_key => $product) {
                $url = "/products/index/".$product['product_id'];
                if(!empty($product['product_det_id']))
                    $url .= '/'.$product['product_det_id'];
                $all_price += $product['total_price'];
                echo "<tr>";

                echo "<td>";
                echo '<div class="div-basket-product-name">'.
                    $html->link($product['name'], $url).
                        "</div>";
//                echo '<div class="div-basket-product-short-about">'.$product['short_about']."</div>";
                echo "</td>";

                echo "<td>";
                echo $product['price'];
                echo "</td>";

                echo "<td>";
                echo $product['cnt'];
                echo "</td>";

                echo "<td>";
                echo $product['total_price'];
                echo "</td>";

                echo "<td>";
                echo $basket_data_key;
                echo "</td>";

                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<div class="div-price">
    <div class="div-price-value" id="div-basket-price-value"><?php echo $all_price;?></div>
    <div class="div-price-label">Сумма заказа:</div>
</div>
<div class="div-price">
    <div class="div-price-value" id="div-transport-price-value"><?php echo 'нет';?></div>
    <div class="div-price-label">Доставка:</div>
</div>
<div class="div-price">
    <div class="div-price-value" id="div-custom-price-value" style="font-size: 18px; color: yellow;"><?php echo $all_price;?></div>
    <div class="div-price-label">Итого к оплате:</div>
</div>

<div id="div-custom-form-submit">
    <input type="button" id="button-basket-edit" value="Редактировать корзину">
    <input type="submit" id="submit-custom-order" value="Отправить заказ">
</div>

</form>

<script type="text/javascript">
    var basket_table;
    var webroot = "<?php echo $this->webroot; ?>";

    var client_info_id = <?php echo $client_info_id; ?>;

    jQuery('#ClientInfoId').attr('value', client_info_id);

       jQuery('#ClientInfoId').change(function(){

         var url = <?php echo "'".$this->webroot."customs/order/'"; ?>;
         url = url + jQuery('#ClientInfoId').val();

         window.location = url;
       });

       jQuery('#ClientInfoCompanyTypeId').change(function(){
         if (jQuery('#ClientInfoCompanyTypeId').attr('value') == 4) {
           jQuery('#ClientInfoRegNum').attr('disabled', '');
           jQuery('#ClientInfoKPP').attr('disabled', 'true');
         }
         else {
           jQuery('#ClientInfoRegNum').attr('disabled', 'true');
           jQuery('#ClientInfoKPP').attr('disabled', '');
         }

       }).change();

    var transport_prices = <?php
        $transport_prices = Set::combine($transport_types, '{n}.TransportType.id', '{n}.TransportType.price');
        echo $javascript->object($transport_prices);
    ?>;
    var basket_all_price = <?php echo $all_price; ?>;
    $(document).ready(function() {
        $('#button-basket-edit').click(function() {
            document.location = webroot+'basket';
        });

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

                        return '<span id="td-total-price-'+oObj.aData[4]+'">'+s+ '</span>';
                    }
                },
                {
                    'bVisible': false
                }
            ]
        });

        update_all_price();
        $('.radio-transport-type').click(function() {
            update_all_price();
        });
    });

    function update_all_price(all_price) {
        var checked_transport_type_radio = $('.radio-transport-type').filter(':checked');
        var transport_type_id = checked_transport_type_radio.val();
        var transport_price = parseFloat(transport_prices[transport_type_id]);

        $('#div-basket-price-value').html(parseFloat(basket_all_price).toFixed(2) + ' руб.');
        if(transport_price > 0) {
            $('#div-transport-price-value').html(parseFloat(transport_price).toFixed(2) + ' руб.');
            $('#div-custom-price-value').html(parseFloat(transport_price+basket_all_price).toFixed(2) + ' руб.');
        } else {
            $('#div-transport-price-value').html('нет');
            $('#div-custom-price-value').html(parseFloat(basket_all_price).toFixed(2) + ' руб.');
        }
    }

   function setAddress() {
     jQuery("#TransportIndex").attr('value', jQuery("#ClientInfoJurIndex").attr('value'));
     jQuery("#TransportRegion").attr('value', jQuery("#ClientInfoJurRegion").attr('value'));
     jQuery("#TransportCity").attr('value', jQuery("#ClientInfoJurCity").attr('value'));
     jQuery("#TransportStreet").attr('value', jQuery("#ClientInfoJurStreet").attr('value'));
     jQuery("#TransportHnumber").attr('value', jQuery("#ClientInfoJurHnumber").attr('value'));
     jQuery("#TransportOffice").attr('value', jQuery("#ClientInfoJurOffice").attr('value'));
   }

</script>