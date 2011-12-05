<h1>Информация о заказе №<?php echo $custom['Custom']['id'];?></h1>
<div class="div-print-version">
    <?php echo $html->image('printer.png');?>
    <?php echo $html->link('Печатная версия', '/customs/adm_view/'.$custom['Custom']['id'].'/print', array(
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
            echo $html->div('div-info-value', $custom['PayType']['name'].' ');

            echo $html->div('div-info-label', 'Дата создания');
            echo $html->div('div-info-value', $custom['0']['created_date'].' ');

            echo $html->div('div-info-label', 'Примечание');
            echo $html->div('div-info-value', $custom['Custom']['note'].' ');

            echo $html->div('div-info-label', 'Количество товаров');
            echo $html->div('div-info-value', $custom[0]['sum_cnt'].' ');

            echo $html->div('div-info-label', 'Стоимость товаров');
            echo $html->div('div-info-value', number_format($custom[0]['sum_price'], 2, '.', '').' руб.');

            echo $html->div('div-info-label', 'Итого (с учетом доставки)');
            echo $html->div('div-info-value', number_format($custom[0]['sum_price']+$custom['TransportType']['price'], 2, '.', '').' руб.', array(
                'style' => 'color: #992299; font-size: 18px;'
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
            echo $html->div('div-info-value', $company_types['CompanyType']['type_name']." ".$custom['CustomClientInfo'][0]['name']);

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
                    <th>ID</th>
                    <th>1с-код</th>
                    <th>1с-название</th>
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
                            $id_url = '';
                            if(empty($custom_det['product_det_id'])) {
                                $id_name = $custom_det['product_id'];
                                $id_url = $html->url('/products/index/'.$custom_det['product_id']);
                            } else {
                                $id_name = $custom_det['product_id'].'/'.$custom_det['product_det_id'];
                                $id_url = $html->url('/products/index/'.$custom_det['product_id'].'/'.$custom_det['product_det_id']);
                            }
                            echo "<td><a href='$id_url'>$id_name</a></td>";
                            echo "<td><a href='$id_url'>{$custom_det['code_1c']}</a></td>";
                            echo "<td><a href='$id_url'>{$custom_det['name_1c']}</a></td>";
                            echo "<td><a href='$id_url'>".$custom_det['name']."</a></td>";
                            if($custom_det['price']>0)
                                echo "<td class='td-align-right'>".number_format($custom_det['price'], 2, '.', '')." руб.</td>";
                            else
                                echo "<td class='td-align-right'>Под заказ</td>";
                            echo "<td class='td-align-right'>".$custom_det['cnt']."</td>";
                            if($custom_det['price']>0)
                                echo "<td class='td-align-right' style='font-weight: bold;'>".number_format($custom_det['cnt']*$custom_det['price'], 2, '.', '')." руб.</td>";
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
                    <th></th>
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
                            $id = $custom_status['CustomStatus']['id'];
                            echo "<tr>";

                            echo "<td>$id</td>";
                            echo "<td>";
                            echo $html->image($custom_status['Image']['url'], array(
                                'class' => 'status-image'
                            ));
                            echo $custom_status['CustomStatusType']['name'];
                            echo "</td>";
                            echo "<td class='td-align-center'>".$custom_status['User']['username']."</td>";
                            echo "<td class='td-align-center'>".$custom_status[0]['created_date'];
                            echo "<td class='td-align-center'>";
                            if($custom_status['can_delete']) {
                                echo $html->link($html->image('delete.png', array(
                                    'alt' => 'Удалить'
                                )), '#', array(
                                    'class' => 'link-delete-status',
                                    'onclick' => 'return false;',
                                    'escape' => false,
                                    'title' => 'Удалить'
                                ));
                            }
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
                $custom_status_types,
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

        $('#tab-dets tr, #tab-statuses tr').find('td:first, th:first').addClass('td-first');
        $('#tab-dets tr, #tab-statuses tr').find('td:last, th:last').addClass('td-last');

        table_statuses = $('#table-statuses').dataTable({
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            "oLanguage" : {
                "sZeroRecords":  "Записи отсутствуют."
            },
            "aoColumns": [
                {
                    "bVisible": false
                },
                null,
                {
                    sClass: 'td-align-center'
                },
                {
                    sClass: 'td-align-center'
                },
                {
                    sClass: 'td-align-center'
                }
            ]
        });

        $('#dialog-add-status').dialog({
            show: 'fold',
            hide: 'fold',
            modal: true,
            autoOpen: false,
            title: 'Добавление статуса',
            dialogClass: 'widget-add-status',
            width: 250,
            height: 110,
            resizable: false,
            buttons: {
                'Сохранить': function() {
                    $('#dialog-add-status').dialog('close');
                    $('#btnSave').click();
                }
            }
        });

        $('.link-delete-status').click(delete_status);
    });

    function delete_status() {
        var tr = $(this).parent().parent().get(0);
        var custom_status_id = table_statuses.fnGetData(tr)[0];
        var custom_id = <?php echo $custom['Custom']['id']; ?>;
        window.location = webroot+'customs/delete_status/'+custom_status_id+'/'+custom_id;

    }

    function add_status() {
        $('#dialog-add-status').dialog('open');
    }
</script>