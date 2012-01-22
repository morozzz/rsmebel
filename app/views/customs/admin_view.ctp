<h1>Информация о заказе №<?php echo $custom['Custom']['id'];?></h1>
<div class="div-print-version">
    <?php echo $html->image('printer.png');?>
    <?php echo $html->link('Печатная версия', '/customs/admin_view/'.$custom['Custom']['id'].'/print', array(
        'target' => '_blank'
    ));?>
</div>
<div id="custom-data">
    <ul style="height: 33px;">
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
            echo $html->div('div-info-value', $custom['CustomClientInfo']['PayType']['name'].' ');
            
            echo $html->div('div-info-label', 'Способ доставки');
            echo $html->div('div-info-value', $custom['CustomClientInfo']['TransportType']['name'].' ');

            echo $html->div('div-info-label', 'Дата создания');
            echo $html->div('div-info-value', $custom['0']['created_date'].' ');

            echo $html->div('div-info-label', 'Количество товаров');
            echo $html->div('div-info-value', $custom[0]['sum_cnt'].' ');

            echo $html->div('div-info-label', 'Стоимость товаров');
            echo $html->div('div-info-value', $common->getMoneyFormat($custom[0]['sum_price'], 2, '.', ''));

            echo $html->div('div-info-label', 'Итого (с учетом доставки)');
            echo $html->div('div-info-value', $common->getMoneyFormat($custom[0]['sum_price']+$custom['CustomClientInfo']['TransportType']['price'], 2, '.', ''), array(
                'style' => 'color: #992299; font-size: 18px;'
            ));
        ?>
        </div>

        <div id="tab-person">
        <h2>Персональная информация</h2>
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
        <div id="div-company">
            <h2>Информация о фирме</h2>
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

    </div>

    <div id="tab-dets">
        <h2>Список заказанных товаров</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Стоимость</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($custom['CustomDet'])) {
                        foreach($custom['CustomDet'] as $custom_det) {
                            echo "<tr>";

                            $id_name = '';
                            if(empty($custom_det['product_det_id'])) {
                                $id_name = $custom_det['product_id'];
                            } else {
                                $id_name = $custom_det['product_id'].'/'.$custom_det['product_det_id'];
                            }
                            $url = $html->url(array(
                                'controller' => 'products',
                                'action' => 'index',
                                $custom_det['Product']['url']
                            ));
                            echo "<td><a href='$url'>$id_name</a></td>";
                            echo "<td><a href='$url'>".$custom_det['name']."</a></td>";
                            if($custom_det['price']>0)
                                echo "<td class='td-align-right'>".$common->getMoneyFormat($custom_det['price'], 2, '.', '')."</td>";
                            else
                                echo "<td class='td-align-right'>Под заказ</td>";
                            echo "<td class='td-align-right'>".$custom_det['cnt']."</td>";
                            if($custom_det['price']>0)
                                echo "<td class='td-align-right' style='font-weight: bold;'>".$common->getMoneyFormat($custom_det['cnt']*$custom_det['price'], 2, '.', '')."</td>";
                            else
                                echo "<td class='td-align-right' style='font-weight: bold;'>Под заказ</td>";

                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>

    <div id="tab-statuses">
        <h2>История статусов заказа</h2>
        <table id="table-statuses">
            <thead>
                <tr>
                    <th>Статус</th>
                    <th>Кем установлен</th>
                    <th>Дата</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($custom['CustomStatus'])) {
                        foreach($custom['CustomStatus'] as $custom_status) {
                            $id = $custom_status['id'];
                            echo "<tr>";

                            echo "<td>";
                            echo $html->image($custom_status['CustomStatusType']['Image']['url'], array(
                                'class' => 'status-image'
                            ));
                            echo $custom_status['CustomStatusType']['name'];
                            echo "</td>";
                            echo "<td class='td-align-center'>".$custom_status['User']['username']."</td>";
                            echo "<td class='td-align-center'>".$custom_status['created'];
                            echo "<td class='td-align-center'>";
                            echo $html->link($html->image('delete.png', array(
                                'alt' => 'Удалить'
                            )), array(
                                'controller' => 'customs',
                                'action' => 'delete_status',
                                $id
                            ), array(
                                'class' => 'link-delete-status',
                                'escape' => false,
                                'title' => 'Удалить'
                            ));
                            echo "</td>";

                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
        <a id="link-add-status" href="#" onclick="add_status(); return false;">Добавить</a>
    </div>
</div>

<div id="dialog-add-status">
    <?php

        echo $form->create('Custom', array(
            'action' => 'add_status',
            'id' => 'add-custom-status-form'
        ));

        echo $form->hidden('Custom.id', array('value' => $custom['Custom']['id']));

        echo $form->select('custom_status_type_id',
                $custom_status_type_list,
                1,
                array(
                    'id' => 'input-add-status'
                ),
                false);

        echo $form->submit('Сохранить', array('id' => 'btnSave', 'style' => 'display: none;'));
        echo $form->end();

    ?>
</div>

<script type="text/javascript">
    var webroot = "<?php echo $this->webroot; ?>"
    var table_statuses;
    $(document).ready(function () {
        enable_ajax_waiting();
        
        $('#custom-data').tabs({
            fx: {
                opacity: 'toggle',
                duration: 'fast'
            }
        });
        $("#custom-data ul.tabs a").css('height', $("#custom-data ul.tabs").height());

        $('#dialog-add-status').dialog({
            show: 'fold',
            hide: 'fold',
            modal: true,
            autoOpen: false,
            title: 'Добавление статуса',
            dialogClass: 'widget-add-status',
            width: 250,
            height: 150,
            resizable: false,
            buttons: {
                'Сохранить': function() {
                    $('#dialog-add-status').dialog('close');
                    $('#btnSave').click();
                }
            }
        });
    });

    function add_status() {
        $('#dialog-add-status').dialog('open');
    }
</script>