<div class="div-left-column">
    <div id="div-basket"><?php echo $this->element('basket');?></div>
    <div class="div-specials"><?php echo $this->element('specials');?></div>
    <div class="div-news"><?php echo $this->element('news');?></div>
</div>
<div class="div-right-column">
    <div id="div-customs">
        <div class="div-customs div-form">
            <h1>Список заказов</h1>
            <?php echo $this->element('paginate');?>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Статус</th>
                        <th>Дата</th>
                        <th>Кол-во товаров</th>
                        <th>Сумма</th>
                        <th>Доставка</th>
                        <th>Итого</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($customs as $custom) { ?>
                    <tr>
                        <td align="center"><?php echo $html->link($custom['Custom']['id'], array(
                            'controller' => 'customs',
                            'action' => 'view',
                            $custom['Custom']['id']
                        ));?></td>
                        <td align="center"><?php echo /*$html->image($custom['CustomStatusType']['Image']['url']).*/
                                       $custom['CustomStatusType']['name'];?></td>
                        <td align="center"><?php echo $custom[0]['created_date'];?></td>
                        <td align="right"><?php echo $custom[0]['sum_cnt'];?> шт.</td>
                        <td align="right"><?php echo $common->getMoneyFormat($custom[0]['sum_price']);?></td>
                        <td align="center"><?php
                        $transport_type = $custom['CustomClientInfo']['TransportType'];
                        $transport_price = ($transport_type['price']>0)?
                                $common->getMoneyFormat($transport_type['price']):
                                'бесплатно';
                        echo "{$transport_type['name']} ($transport_price)";?></td>
                        <td align="right"><?php echo $common->getMoneyFormat($custom[0]['sum_price']+$transport_type['price']);?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
