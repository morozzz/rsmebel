<div class="div-left-column">
    <div id="div-basket"><?php echo $this->element('basket');?></div>
    <div class="div-specials"><?php echo $this->element('specials');?></div>
    <div class="div-news"><?php echo $this->element('news');?></div>
</div>
<div class="div-right-column">
    <div id="div-custom">
        <h1>Заказ № <?php echo $custom['Custom']['id'];?></h1>
        
        <div class="div-custom-info div-form">
            <h2>Информация о заказе</h2>
            <?php if($is_opt_price) { ?>
            <div class="div-company">
                <h3>Информация о фирме</h3>
                <?php
                echo $html->div('div-info-label', 'Фирма');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['CompanyType']['type_name'].
                        " ".$custom['CustomClientInfo']['name']);

                echo $html->div('div-info-label', 'Регистрационный номер(ИП)');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['reg_num'].' ');

                echo $html->div('div-info-label', 'ИНН');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['INN'].' ');

                echo $html->div('div-info-label', 'КПП(кроме ИП)');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['KPP'].' ');

                echo $html->div('div-info-label', 'Расчетный счет');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['operating_account'].' ');

                echo $html->div('div-info-label', 'Банк');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['bank'].' ');

                echo $html->div('div-info-label', 'Корреспондентский счет');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['correspondent_account'].' ');

                echo $html->div('div-info-label', 'БИК');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['BIK'].' ');

                echo $html->div('div-info-label', 'ОКПО');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['OKPO'].' ');

                echo $html->div('div-info-label', 'ОКВЕД');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['OKVED'].' ');

                echo $html->div('div-info-label', 'Факс:');
                if (!empty($custom['CustomClientInfo']['phone_kod'])) { $custom['CustomClientInfo']['phone_kod'] = "(".$custom['CustomClientInfo']['phone_kod'].")"; }
                echo $html->div('div-info-value', $custom['CustomClientInfo']['phone_kod']." ".$custom['CustomClientInfo']['phone'].' ');

                echo $html->div('div-info-label', 'Юр. адрес');
                echo $html->div('div-info-value', ' ');

                echo $html->div('div-info-label', 'Индекс');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['jur_index'].' ');

                echo $html->div('div-info-label', 'Регион');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['jur_region'].' ');

                echo $html->div('div-info-label', 'Город');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['jur_city'].' ');

                echo $html->div('div-info-label', 'Улица');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['jur_street'].' ');

                echo $html->div('div-info-label', 'Дом');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['jur_hnumber'].' ');

                echo $html->div('div-info-label', 'Кв./Офис');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['jur_office'].' ');

             ?>
            </div>
            <?php } ?>

            <div class="div-infos-general">
            <h3>Общая информация о заказе</h3>
            <?php
                echo $html->div('div-info-label', 'Номер');
                echo $html->div('div-info-value', $custom['Custom']['id'].' ');
                echo $html->div('div-info-label', 'Текущий статус');
                echo $html->div('div-info-value', $custom['CustomStatusType']['name'].' ');

                echo $html->div('div-info-label', 'Способ оплаты');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['PayType']['name'].' ');

                echo $html->div('div-info-label', 'Способ доставки');
                $transport_price = $custom['CustomClientInfo']['TransportType']['price'];
                if($transport_price>0) $transport_price = $common->getMoneyFormat($transport_price);
                else $transport_price = 'бесплатно';
                echo $html->div('div-info-value', $custom['CustomClientInfo']['TransportType']['name']." ($transport_price)");

                echo $html->div('div-info-label', 'Дата создания');
                echo $html->div('div-info-value', $custom['0']['created_date'].' ');

                echo $html->div('div-info-label', 'Количество товаров');
                echo $html->div('div-info-value', $custom[0]['sum_cnt'].' ');

                echo $html->div('div-info-label', 'Стоимость товаров');
                echo $html->div('div-info-value', $common->getMoneyFormat($custom[0]['sum_price'], 2, '.', ''));

                echo $html->div('div-info-label', 'Итого (с учетом доставки)');
                echo $html->div('div-info-value', $common->getMoneyFormat($custom[0]['sum_price']+$custom['CustomClientInfo']['TransportType']['price'], 2, '.', ''));
            ?>
            </div>

            <div class="div-person">
            <h3>Персональная информация</h3>
            <?php
                echo $html->div('div-info-label', 'ФИО:');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['fio'].' ');

                if(!empty($custom['User'])) {
                    echo $html->div('div-info-label', 'E-mail:');
                    echo $html->div('div-info-value', $custom['User']['email'].' ');
                }

                echo $html->div('div-info-label', 'Телефон:');
                if (!empty($custom['CustomClientInfo']['phone_kod'])) { $custom['CustomClientInfo']['phone_kod'] = "(".$custom['CustomClientInfo']['phone_kod'].")"; }
                echo $html->div('div-info-value', $custom['CustomClientInfo']['phone_kod']." ".$custom['CustomClientInfo']['phone'].' ');

                echo $html->div('div-info-label', 'Почтовый адрес');
                echo $html->div('div-info-value', ' ');

                echo $html->div('div-info-label', 'Индекс');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['post_index'].' ');

                echo $html->div('div-info-label', 'Регион');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['post_region'].' ');

                echo $html->div('div-info-label', 'Город');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['post_city'].' ');

                echo $html->div('div-info-label', 'Улица');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['post_street'].' ');

                echo $html->div('div-info-label', 'Дом');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['post_hnumber'].' ');

                echo $html->div('div-info-label', 'Кв./Офис');
                echo $html->div('div-info-value', $custom['CustomClientInfo']['post_office'].' ');
                ?>
            </div>
        </div>
        
        <div class="div-custom-dets div-form">
            <h2>Заказанные товары</h2>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Стоимость</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $all_sum = 0;?>
                    <?php foreach($custom['CustomDet'] as $custom_det) { ?>
                    <tr>
                        <td align="left"><?php echo $html->link($custom_det['name'], array(
                            'controller' => 'products',
                            'action' => 'index',
                            $custom_det['Product']['url']
                        ));?></td>
                        <td align="right"><?php echo $common->getMoneyFormat($custom_det['price']);?></td>
                        <td align="right"><?php echo $custom_det['cnt'];?></td>
                        <td align="right"><?php
                            $cur_sum = $custom_det['cnt']*$custom_det['price'];
                            $all_sum += $cur_sum;
                            echo $common->getMoneyFormat($all_sum);
                        ?></td>
                    </tr>
                    <?php } ?>
                    <?php $transport_price = $custom['CustomClientInfo']['TransportType']['price'];?>
                    <?php if($transport_price>0) { ?>
                    <tr class="transport">
                        <td colspan="3" align="right">Доставка</td>
                        <td align="right"><?php $all_sum+=$transport_price; echo $common->getMoneyFormat($transport_price);?></td>
                    </tr>
                    <?php } ?>
                    <tr class="itogo">
                        <td colspan="3" align="right">Итого</td>
                        <td align="right"><?php echo $common->getMoneyFormat($all_sum);?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
