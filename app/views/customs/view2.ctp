<?php echo $common->caption("ИНФОРМАЦИЯ О ЗАКАЗЕ №".$custom['Custom']['id']); ?>
<div class="div-print-version">
    <?php echo $html->image('printer.png');?>
    <?php echo $html->link('Печатная версия', '/customs/view/'.$custom['Custom']['id'].'/print', array(
        'target' => '_blank'
    ));?>
</div>

<div id="div-background-custom-data">
<div id="custom-data">
    <ul>
        <li><a href="#tab-infos" onclick="return false;">Общая информация</a></li>
        <li><a href="#tab-dets" onclick="return false;">Заказанные товары</a></li>
        <li><a href="#tab-statuses" onclick="return false;">Статусы заказа</a></li>
    </ul>
    <div id="tab-infos">
        <div id="tab-infos-general">
        <h2>Общая информация о заказе</h2>
        <?php
            echo $html->div('div-info-label', 'Номер');
            echo $html->div('div-info-value', $custom['Custom']['id'].' ');

            echo $html->div('div-info-label', 'Текущий статус');
            echo $html->div('div-info-value', $custom['CustomStatusType']['name'].' ');

            echo $html->div('div-info-label', 'Способ оплаты');
            echo $html->div('div-info-value', $custom['PayType']['name'].' ');

            echo $html->div('div-info-label', 'Дата создания');
            echo $html->div('div-info-value', $custom['0']['created_date'].' ');

            echo $html->div('div-info-label', 'Примечание');
            echo $html->div('div-info-value', $custom['Custom']['note'].' ');

            echo $html->div('div-info-label', 'Количество товаров');
            echo $html->div('div-info-value', $custom[0]['sum_cnt'].' ');

            echo $html->div('div-info-label', 'Стоимость товаров');
            echo $html->div('div-info-value', number_format($custom[0]['sum_price'], 2, '.', '').' руб.');

            echo $html->div('div-info-label', 'Сумма заказа', array(
                'style' => 'color: yellow; font-size: 18px;'
            ));
            echo $html->div('div-info-value', number_format($custom[0]['sum_price']+$custom['TransportType']['price'], 2, '.', '').' руб.', array(
                'style' => 'color: yellow; font-size: 18px;'
            ));
        ?>
        </div>
<?php
//        <div id="tab-infos-transport">
//        <h2>Информация о доставке</h2>
//        <?php
//            echo $html->div('div-info-label', 'Тип доставки');
//            echo $html->div('div-info-value', $custom['TransportType']['name'].' ');
//
//            echo $html->div('div-info-label', 'Стоимость доставки');
//            echo $html->div('div-info-value', number_format($custom['TransportType']['price'], 2, '.', ''). ' руб. ');
//
//            echo $html->div('div-info-label', 'Индекс');
//            echo $html->div('div-info-value', $custom['TransportAddress']['post_index'].' ');
//
//            echo $html->div('div-info-label', 'Регион');
//            echo $html->div('div-info-value', $custom['TransportAddress']['region'].' ');
//
//            echo $html->div('div-info-label', 'Город');
//            echo $html->div('div-info-value', $custom['TransportAddress']['city'].' ');
//
//            echo $html->div('div-info-label', 'Улица');
//            echo $html->div('div-info-value', $custom['TransportAddress']['street'].' ');
//
//            echo $html->div('div-info-label', 'Дом');
//            echo $html->div('div-info-value', $custom['TransportAddress']['house'].' ');
//
//            echo $html->div('div-info-label', 'Кв./Офис');
//            echo $html->div('div-info-value', $custom['TransportAddress']['flat'].' ');
//        ? >
//        </div>
?>
        <div id="tab-infos-company">
        <h2>Информация о покупателе</h2>
        <?php
            echo $html->div('div-info-label', 'Фирма');
            echo $html->div('div-info-value', $company_types['CompanyType']['type_name']." ".$custom['CustomClientInfo'][0]['name'].' ');

            echo $html->div('div-info-label', 'Контактное лицо:');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['fio'].' ');

            echo $html->div('div-info-label', 'E-mail:');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['email'].' ');

            echo $html->div('div-info-label', 'Телефон:');
            if (!empty($custom['CustomClientInfo'][0]['phone_kod'])) { $custom['CustomClientInfo'][0]['phone_kod'] = "(".$custom['CustomClientInfo'][0]['phone_kod'].")"; }
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['phone_kod']." ".$custom['CustomClientInfo'][0]['phone'].' ');

            echo $html->div('div-info-label', 'Регистрационный номер(ИП)');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['reg_num'].' ');

            echo $html->div('div-info-label', 'ИНН');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['INN'].' ');

            echo $html->div('div-info-label', 'КПП(кроме ИП)');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['KPP'].' ');

            echo $html->div('div-info-label', 'Банк');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['bank'].' ');

            echo $html->div('div-info-label', 'Расчетный счет');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['operating_account'].' ');

            echo $html->div('div-info-label', 'Корреспондентский счет');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['correspondent_account'].' ');

            echo $html->div('div-info-label', 'БИК');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['BIK'].' ');

            echo $html->div('div-info-label', 'ОКПО');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['OKPO'].' ');

            echo $html->div('div-info-label', 'ОКВЕД');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['OKVED'].' ');

            echo $html->div('div-info-label', 'Индекс');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['jur_index'].' ');

            echo $html->div('div-info-label', 'Регион');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['jur_region'].' ');

            echo $html->div('div-info-label', 'Город');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['jur_city'].' ');

            echo $html->div('div-info-label', 'Улица');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['jur_street'].' ');

            echo $html->div('div-info-label', 'Дом');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['jur_hnumber'].' ');

            echo $html->div('div-info-label', 'Кв./Офис');
            echo $html->div('div-info-value', $custom['CustomClientInfo'][0]['jur_office'].' ');

         ?>
        </div>
    </div>

    <div id="tab-dets">
        <h2>Список заказанных товаров</h2>
        <table>
            <thead>
                <tr>
                    <th>N</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Стоимость</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $all_cnt = 0;
                    $all_sum = 0;
                    if(!empty($custom['CustomDet'])) {
                        $n = 1;
                        foreach($custom['CustomDet'] as $custom_det) {
                            $all_cnt = $all_cnt + $custom_det['cnt'];
                            $url = '/products/index/'.$custom_det['product_id'];
                            if(!empty($custom_det['product_det_id'])) $url.='/'.$custom_det['product_det_id'];
                            echo "<tr>";

                            $id_url = '';
                            if(empty($custom_det['product_det_id'])) {
                                $id_url = $html->url('/products/index/'.$custom_det['product_id']);
                            } else {
                                $id_url = $html->url('/products/index/'.$custom_det['product_id'].'/'.$custom_det['product_det_id']);
                            }

                            echo "<td><a href='$id_url'>".$n."</a></td>";
                            echo "<td><a href='$id_url'>";
                            echo $html->link($custom_det['name'], $url);
                            echo "</a></td>";
                            if($custom_det['price']>0)
                                echo "<td align='right'>".number_format($custom_det['price'], 2, '.', '')." руб.</td>";
                            else
                                echo "<td align='right'>Под заказ</td>";
                            echo "<td align='right'>".$custom_det['cnt']."</td>";
                            if($custom_det['price']>0) {
                                $all_sum = number_format($all_sum + $custom_det['cnt']*$custom_det['price'], 2, '.', '');
                                echo "<td align='right' style='font-weight: bold;'>".number_format($custom_det['cnt']*$custom_det['price'], 2, '.', '')." руб.</td>";
                            }
                            else
                                echo "<td align='right' style='font-weight: bold;'>Под заказ</td>";
                            
                            echo "</tr>";

                            $n++;
                        }
                    
                     echo "<tr>";
                       echo "<td></td>";
                       echo "<td align='left' style='font-weight: bold;'> Всего заказано </td>";
                       echo "<td></td>";
                       echo "<td align='right' style='font-weight: bold;'>".$all_cnt."</td>";
                       echo "<td align='right' style='font-weight: bold;'>".$all_sum." руб.</td>";
                     echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <div id="tab-statuses">
        <h2>История статусов заказа</h2>
        <table>
            <thead>
                <tr>
                    <th>Статус</th>
                    <th>Кем установлен</th>
                    <th>Дата</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($custom['CustomStatus'])) {
                        foreach($custom['CustomStatus'] as $custom_status) {
                            echo "<tr>";
                            
                            echo "<td>";
                            echo $html->image($custom_status['Image']['url'], array(
                                'class' => 'status-image'
                            ));
                            echo $custom_status['CustomStatusType']['name'];
                            echo "</td>";
                            echo "<td align='center'>".$custom_status['User']['username']."</td>";
                            echo "<td align='center'>".$custom_status[0]['created_date'];
                            
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>

</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#custom-data').tabs({
            fx: {
                opacity: 'toggle',
                duration: 'fast'
            }
        });

        $('#tab-dets tr, #tab-statuses tr').find('td:first, th:first').addClass('td-first');
        $('#tab-dets tr, #tab-statuses tr').find('td:last, th:last').addClass('td-last');
    });
</script>