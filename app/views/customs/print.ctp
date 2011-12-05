<h1>Общая информация о заказе</h1>
<table>
    <tbody>
        <tr>
            <td>Номер:</td>
            <td><?php echo $custom['Custom']['id']; ?></td>
        </tr>
        <tr>
            <td>Текущий статус:</td>
            <td><?php echo $custom['CustomStatusType']['name'];?></td>
        </tr>
        <tr>
            <td>Способ оплаты:</td>
            <td><?php echo $custom['PayType']['name'];?></td>
        </tr>
        <tr>
            <td>Дата создания:</td>
            <td><?php echo $custom['0']['created_date'];?></td>
        </tr>
        <tr>
            <td>Примечание:</td>
            <td><?php echo $custom['Custom']['note'];?></td>
        </tr>
        <tr>
            <td>Количество товаров:</td>
            <td><?php echo $custom[0]['sum_cnt'];?></td>
        </tr>
        <tr>
            <td>Стоимость товаров:</td>
            <td><?php echo number_format($custom[0]['sum_price'], 2, '.', '').' руб.';?></td>
        </tr>
        <tr>
            <td>Сумма заказа:</td>
            <td><?php echo number_format($custom[0]['sum_price']+$custom['TransportType']['price'], 2, '.', '').' руб.';?></td>
        </tr>
    </tbody>
</table>

<?php
//<h1>Информация о доставке</h1>
//<table>
//    <tbody>
//        <tr>
//            <td>Тип доставки:</td>
//            <td><?php echo $custom['TransportType']['name'];? ></td>
//        </tr>
//        <tr>
//            <td>Стоимость доставки:</td>
//            <td><?php echo number_format($custom['TransportType']['price'], 2, '.', ''). ' руб. ';? ></td>
//        </tr>
//        <tr>
//            <td>Индекс:</td>
//            <td><?php echo $custom['TransportAddress']['post_index'];? ></td>
//        </tr>
//        <tr>
//            <td>Регион:</td>
//            <td><?php echo $custom['TransportAddress']['region'];? ></td>
//        </tr>
//        <tr>
//            <td>Город:</td>
//            <td><?php echo $custom['TransportAddress']['city'];? ></td>
//        </tr>
//        <tr>
//            <td>Улица:</td>
//            <td><?php echo $custom['TransportAddress']['street'];? ></td>
//        </tr>
//        <tr>
//            <td>Дом:</td>
//            <td><?php echo $custom['TransportAddress']['house'];? ></td>
//        </tr>
//        <tr>
//            <td>Кв./Офис:</td>
//            <td><?php echo $custom['TransportAddress']['flat'];? ></td>
//        </tr>
//    </tbody>
//</table>
?>

<h1>Информация о покупателе</h1>
<table>
    <tbody>
        <tr>
            <td>Фирма:</td>
            <td><?php echo $company_types['CompanyType']['type_name']." ".$custom['CustomClientInfo'][0]['name'];?></td>
        </tr>
        <tr>
            <td>Контактное лицо:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['fio'];?></td>
        </tr>
        <tr>
            <td>E-mail:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['email'];?></td>
        </tr>
        <tr>
            <td>Телефон:</td>
            <?php if (!empty($custom['CustomClientInfo'][0]['phone_kod'])) { $custom['CustomClientInfo'][0]['phone_kod'] = "(".$custom['CustomClientInfo'][0]['phone_kod'].")"; }?>
            <td><?php echo $custom['CustomClientInfo'][0]['phone_kod']." ".$custom['CustomClientInfo'][0]['phone'];?></td>
        </tr>
        <tr>
            <td>Регистрационный номер(ИП):</td>
            <td><?php echo $custom['CustomClientInfo'][0]['reg_num'];?></td>
        </tr>
        <tr>
            <td>ИНН:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['INN'];?></td>
        </tr>
        <tr>
            <td>КПП(кроме ИП):</td>
            <td><?php echo $custom['CustomClientInfo'][0]['KPP'];?></td>
        </tr>
        <tr>
            <td>Банк:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['bank'];?></td>
        </tr>
        <tr>
            <td>Расчетный счет:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['operating_account'];?></td>
        </tr>
        <tr>
            <td>Корреспондентский счет:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['correspondent_account'];?></td>
        </tr>
        <tr>
            <td>БИК:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['BIK'];?></td>
        </tr>
        <tr>
            <td>ОКПО:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['OKPO'];?></td>
        </tr>
        <tr>
            <td>ОКВЕД:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['OKVED'];?></td>
        </tr>
        <tr>
            <td>Индекс:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['jur_index'];?></td>
        </tr>
        <tr>
            <td>Регион:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['jur_region'];?></td>
        </tr>
        <tr>
            <td>Город:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['jur_city'];?></td>
        </tr>
        <tr>
            <td>Улица:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['jur_street'];?></td>
        </tr>
        <tr>
            <td>Дом:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['jur_hnumber'];?></td>
        </tr>
        <tr>
            <td>Кв./Офис:</td>
            <td><?php echo $custom['CustomClientInfo'][0]['jur_office'];?></td>
        </tr>
    </tbody>
</table>

<h1>Список заказанных товаров</h1>
<table cellpadding="5">
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
                    echo "<tr>";

                    echo "<td>".$n."</td>";
                    echo "<td>";
                    echo $custom_det['name'];
                    echo "</td>";
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

<h1>История статусов заказа</h1>
<table cellpadding="5">
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
                    echo $custom_status['CustomStatusType']['name'];
                    echo "</td>";
                    echo "<td>".$custom_status['User']['username']."</td>";
                    echo "<td>".$custom_status[0]['created_date'];

                    echo "</tr>";
                }
            }
        ?>
    </tbody>
</table>