<h1>Список заказов</h1>

<div id="custom-filter">
<h2 id="custom-filter-title"><a href="#">Фильтр</a></h2>
<div id="custom-filter-body">
<?php
    echo $form->create('Filter', array(
        'url' => array(
            'controller' => 'customs',
            'action' => 'adm_custom'
        )
    ));
?>
    <div style="float: left; width: 250px; border-right: 1px dotted #A3A3D3;">
<?php
    echo $html->div('custom-filter-label', 'Пользователь');
    echo $html->div('custom-filter-input', $form->text('username', array(
        'class' => 'input-username',
        'value' => $filter['username']
    )));

    echo $html->div('custom-filter-label', 'Статус');
    echo $html->div('custom-filter-input', $form->select('custom_status_type_id',
            $custom_status_type_list,
            ((empty($filter['custom_status_type_id']))?0:$filter['custom_status_type_id']),
            array(),
            false));
   ?>
    </div>
    <div style="margin-left: 250px; padding-left: 30px;">
<?php
    echo $html->div('custom-filter-label', 'Дата с');
    echo $html->div('custom-filter-input', $form->text('date1', array(
        'id' => 'custom-filter-date1',
        'value' => (empty($filter['date1'])?'':date('d.m.Y', strtotime($filter['date1'])))
    )));
    echo $html->div('custom-filter-label', 'Дата по');
    echo $html->div('custom-filter-input', $form->text('date2', array(
        'id' => 'custom-filter-date2',
        'value' => (empty($filter['date2'])?'':date('d.m.Y', strtotime($filter['date2'])))
    )));
?>
    </div>
<?php
    echo $form->end('Получить список');
?>
</div>
</div>

<?php
    //pagination table
    echo "<table class=\"admin-pagination ui-state-default ui-corner-all\"><tr>";
    echo "<td id=\"pagination-count\">";
    echo $paginator->counter('Всего заказов %count% '.
        $paginator->link("(Показать все)", array(
            'limit' => $paginator->params['paging']['Custom']['count']
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
        100 => '100',
        $paginator->params['paging']['Custom']['count'] => 'Все'
    ), $limit, array(
        'id' => 'pagination-input-limit'
    ), false);
    echo "</td>";
    echo "</tr></table>";
    //*****************************************************
?>

<div class="div-custom_status_types">
    <ul style="height: 33px;">
        <?php foreach($custom_status_types as $custom_status_type) { ?>
        <li>
            <a href="#tab-customs-<?php echo $custom_status_type['CustomStatusType']['id'];?>"
               onclick="return false;">
               <?php echo $html->image($custom_status_type['Image']['url']);?>
               <?php echo "{$custom_status_type['CustomStatusType']['name']} (<b>{$custom_status_type['CustomStatusType']['custom_cnt']}</b>)";?>
            </a>
        </li>
        <?php } ?>
    </ul>

    <?php foreach($custom_status_types as $custom_status_type) { ?>
    <div class="div-custom_status-type" id="tab-customs-<?php echo $custom_status_type['CustomStatusType']['id'];?>">
        <?php if(empty($custom_status_type['customs'])) { ?>
        <div class="div-empty-customs">В данной категории нет заказов</div>
        <?php } else { ?>
        <table class="table-customs">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Клиент</th>
                    <th>Тип</th>
<?php
//                    <th>Тип доставки</th>
?>
                    <th>Способ оплаты</th>
                    <th>Кол-во товаров (штук)</th>
                    <th>Стоимость товаров (руб)</th>
<?php
//                    <th>Стоимость (с доставкой) (руб)</th>
?>
                    <th>Дата создания</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($custom_status_type['customs'] as $custom) { ?>
                <tr custom_id="<?php echo $custom['Custom']['id'];?>">
                    <td align="center"><?php echo $custom['Custom']['id'];?></td>
                    <td align="center"><?php echo $custom['User']['username'];?></td>
                    <td align="center"><?php echo $custom['User']['ClientInfo']['CompanyType']['type_name'];?></td>
<?php
//                    <td align="center"><?php echo $custom['TransportData']['TransportType']['name'];? ></td>
?>
                    <td align="left"><?php echo $custom['PayType']['name'];?></td>
                    <td align="right"><?php echo $custom[0]['sum_cnt'];?></td>
                    <td align="right"><?php echo number_format($custom[0]['sum_price'], 2, '.', '');?></td>
<?php
//                    <td align="right"><?php echo ($custom['TransportData']['TransportType']['price']+$custom[0]['sum_price']);? ></td>
?>
                    <td align="center"><?php echo $custom[0]['created_date'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>
    <?php } ?>
</div>

<script type="text/javascript">
    $(function() {
        $('.div-custom_status_types').tabs({
            fx: {
                opacity: 'toggle',
                duration: 'fast'
            }
        });

        $('.table-customs tbody tr').hover(function() {
            $(this).addClass('highlight-row');
        }, function() {
            $(this).removeClass('highlight-row');
        });

        $('.table-customs tbody tr').click(function() {
            var custom_id = $(this).attr('custom_id');
            document.location = webroot+'customs/adm_view/'+custom_id;
        });

        $('#custom-filter-date1').datepicker();
        $('#custom-filter-date2').datepicker();

        $('#custom-filter').accordion({
            collapsible: true,
            active: false
        });

        $('#pagination-input-limit').change(function() {
            var limit = $('#pagination-input-limit option:selected').val();

            var url = "<?php echo $this->webroot.'customs/adm_custom';?>";
            url += '/limit:'+limit;
            window.location = url;
        });

        $('.input-username').autocomplete({
            'minLength': 0,
            'source': [
                <?php foreach($users as $user) echo "'$user', ";?>
            ]
        });
    });
</script>