<div class="div-left-column">
    <div id="div-basket"><?php echo $this->element('basket', array('basket' => $basket));?></div>
    <div class="div-specials"><?php echo $this->element('specials');?></div>
    <div class="div-news"><?php echo $this->element('news');?></div>
</div>
<div class="div-right-column">
    <div id="div-custom-order">
        <h1>Корзина</h1>
        <div class="div-basket div-form">
            <h2>Содержимое корзины</h2>
            <?php
            echo $form->create('Basket', array(
                'url' => array(
                    'controller' => 'basket',
                    'action' => 'index'
                )
            ));
            echo $form->hidden('request_type', array(
                'value' => 'basket_update',
                'name' => 'data[request_type]'
            ));
            $all_sum = 0;
            ?>
            <table class="table-basket" cellpadding="0" cellspacing="0" border="0" width="100%">
                <thead>
                    <tr>
                        <th>Название товара</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Сумма</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(array_merge($basket['products'],$basket['product_dets']) as $product) { ?>
                    <tr>
                        <td class="td-name">
                            <?php
                            $product_name = $product['Product']['name'];
                            if(!empty($product['ProductDet'])) $product_name .= " ({$product['ProductDet']['name']})";
                            echo $html->link($product_name, array(
                                'controller' => 'products',
                                'action' => 'index',
                                $product['Product']['url']
                            ), array(
                                'class' => 'link-product-name'
                            ));
                            ?>
                            <div class="div-catalog-breadcrumbs">
                                <?php
                                $catalog_breadcrumb_links = array(
                                    $html->link('Каталог', array(
                                        'controller' => 'catalogs',
                                        'action' => 'index'
                                    ))
                                );
                                foreach($product['Product']['catalog_breadcrumbs'] as $breadcrumb) {
                                    $catalog_breadcrumb_links[] = $html->link($breadcrumb['label'],
                                            $breadcrumb['url'], array(
                                        'class' => 'link-catalog-breadcrumb'
                                    ));
                                }
                                echo implode($catalog_breadcrumb_links, ' > ');
                                ?>
                            </div>
                        </td>
                        <td class="td-price"><?php
                        echo $common->getMoneyFormat($product['Product']['cur_price']);
                        ?></td>
                        <td class="td-count"><?php
                        $count_input_name = '';
                        if(empty($product['ProductDet']))
                            $count_input_name = "Product.{$product['Product']['id']}";
                        else
                            $count_input_name = "ProductDet.{$product['ProductDet']['id']}";
                        echo $form->text($count_input_name, array(
                            'class' => 'input-product-count',
                            'value' => $product['Basket']['cnt']
                        ));?></td>
                        <td class="td-sum"><?php
                        echo $common->getMoneyFormat($product['Product']['sum']);
                        $all_sum += $product['Product']['sum'];
                        ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="div-all-sum">
                Итого: <span class="span-all-sum">
                    <?php echo $common->getMoneyFormat($all_sum);?></span>
            </div>
            <?php echo $form->end('Пересчитать');?>
        </div>
        <div class="div-custom-info div-form">
            <?php echo $form->create('Basket', array(
                'url' => array(
                    'controller' => 'basket',
                    'action' => 'index'
                )
            ));
            echo $form->hidden('request_type', array(
                'value' => 'custom_order',
                'name' => 'data[request_type]'
            ));?>
            <h2>Оформление заказа</h2>
            <div class="div-company-info">
                <?php
                    echo $html->tag('h3', 'Информация о заказе');
                    echo $form->input('CustomClientInfo.pay_type_id', array('label' => 'Способ оплаты'));
                    echo $form->input('CustomClientInfo.transport_type_id', array('label' => 'Способ доставки'));
                ?>
            </div>
            
            <?php echo $html->tag('h3', 'Персональная информация');?>
            <table class="table-person-info" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="26%" valign="top"><div class="div-required">ФИО <span class="span-required">*</span></div></td>
                    <td width="74%" valign="top" colspan="4"><?php echo $form->input('CustomClientInfo.fio', array('label' => false));?></td>
                </tr>
                <tr>
                    <td width="26%" valign="top"><div class="div-required">Телефон <span class="span-required">*</span></div></td>
                    <td width="12%" valign="top"><?php echo $form->input('CustomClientInfo.phone_kod', array('label' => false));?></td>
                    <td width="62%" valign="top" colspan="3"><?php echo $form->input('CustomClientInfo.phone', array('label' => false));?></td>
                </tr>
                <tr>
                    <td width="26%" valign="top">Почтовый адрес</td>
                    <td width="12%" valign="top">Индекс</td>
                    <td width="25%" valign="top"><?php echo $form->input('CustomClientInfo.post_index', array('label' => false));?></td>
                    <td width="12%" valign="top">Регион</td>
                    <td width="25%" valign="top"><?php echo $form->input('CustomClientInfo.post_region', array('label' => false));?></td>
                </tr>
                <tr>
                    <td width="26%" valign="top"></td>
                    <td width="12%" valign="top">Город</td>
                    <td width="25%" valign="top"><?php echo $form->input('CustomClientInfo.post_city', array('label' => false));?></td>
                    <td width="12%" valign="top">Улица</td>
                    <td width="25%" valign="top"><?php echo $form->input('CustomClientInfo.post_street', array('label' => false));?></td>
                </tr>
                <tr>
                    <td width="26%" valign="top"></td>
                    <td width="12%" valign="top">Дом</td>
                    <td width="25%" valign="top"><?php echo $form->input('CustomClientInfo.post_hnumber', array('label' => false));?></td>
                    <td width="12%" valign="top">Кв./Офис</td>
                    <td width="25%" valign="top"><?php echo $form->input('CustomClientInfo.post_office', array('label' => false));?></td>
                </tr>
            </table>
            <?php if($is_opt_price) { ?>
            <div class="div-company-info">
                <?php
                    echo $html->tag('h3', 'Информация о фирме');
                    echo $form->input('CustomClientInfo.company_type_id', array('label' => 'Орг. правовая форма'));
                    echo $form->input('CustomClientInfo.name', array('label' => 'Название фирмы <span class="span-required">*</span>:', 'div' => 'input text div-required'));
                    echo $form->input('CustomClientInfo.reg_num', array('label' => 'Регистрационный номер(ИП):'));
                    echo $form->input('CustomClientInfo.INN', array('label' => 'ИНН:'));
                    echo $form->input('CustomClientInfo.KPP', array('label' => 'КПП(кроме ИП):'));
                    echo $form->input('CustomClientInfo.operating_account', array('label' => 'Расчетный счет:'));
                    echo $form->input('CustomClientInfo.bank', array('label' => 'Банк:'));
                    echo $form->input('CustomClientInfo.correspondent_account', array('label' => 'Корреспондентский счет:'));
                    echo $form->input('CustomClientInfo.BIK', array('label' => 'БИК:'));
                    echo $form->input('CustomClientInfo.OKPO', array('label' => 'ОКПО:'));
                    echo $form->input('CustomClientInfo.OKVED', array('label' => 'ОКВЭД(ОКОНХ):'));
                ?>
                <table class="table-company-info" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="26%">Факс</td>
                        <td width="12%"><?php echo $form->input('CustomClientInfo.fax_kod', array('label' => false));?></td>
                        <td width="62%" colspan="3"><?php echo $form->input('CustomClientInfo.fax', array('label' => false));?></td>
                    </tr>
                    <tr>
                        <td width="26%">Юр. адрес</td>
                        <td width="12%">Индекс</td>
                        <td width="25%"><?php echo $form->input('CustomClientInfo.jur_index', array('label' => false));?></td>
                        <td width="12%">Регион</td>
                        <td width="25%"><?php echo $form->input('CustomClientInfo.jur_region', array('label' => false));?></td>
                    </tr>
                    <tr>
                        <td width="26%"><?php echo $form->button('=почтовый адрес', array('id' => 'button-set-address'));?></td>
                        <td width="12%">Город</td>
                        <td width="25%"><?php echo $form->input('CustomClientInfo.jur_city', array('label' => false));?></td>
                        <td width="12%">Улица</td>
                        <td width="25%"><?php echo $form->input('CustomClientInfo.jur_street', array('label' => false));?></td>
                    </tr>
                    <tr>
                        <td width="26%"></td>
                        <td width="12%">Дом</td>
                        <td width="25%"><?php echo $form->input('CustomClientInfo.jur_hnumber', array('label' => false));?></td>
                        <td width="12%">Кв./Офис</td>
                        <td width="25%"><?php echo $form->input('CustomClientInfo.jur_office', array('label' => false));?></td>
                    </tr>
                </table>
            </div>
            <?php } ?>
            <div class="div-price">
                <div class="div-transport-price">
                    Стоимость доставки: <span class="price">бесплатно</span>
                </div>
                <div class="div-itogo">
                    Итого (с доставкой): <span class="price"><?php echo $common->getMoneyFormat($all_sum);?>руб.</span>
                </div>
            </div>
            <?php echo $form->end('Оформить заказ');?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('.input-product-count').keypress(function(e) {
            return (e.which==8 || e.which==0 || (e.which>=48 && e.which<=57));
        });
        $('#button-set-address').click(function() {
            $("#CustomClientInfoJurIndex").attr('value', $("#CustomClientInfoPostIndex").attr('value'));
            $("#CustomClientInfoJurRegion").attr('value', $("#CustomClientInfoPostRegion").attr('value'));
            $("#CustomClientInfoJurCity").attr('value', $("#CustomClientInfoPostCity").attr('value'));
            $("#CustomClientInfoJurStreet").attr('value', $("#CustomClientInfoPostStreet").attr('value'));
            $("#CustomClientInfoJurHnumber").attr('value', $("#CustomClientInfoPostHnumber").attr('value'));
            $("#CustomClientInfoJurOffice").attr('value', $("#CustomClientInfoPostOffice").attr('value'));
        });
        
        var transport_prices = <?php echo $javascript->object($transport_prices);?>;
        $('#CustomClientInfoTransportTypeId').change(function() {
            var transport_price = transport_prices[$(this).val()];
            if(transport_price>0)
                $('#div-custom-order .div-transport-price .price').html(parseFloat(transport_price).toFixed(2)+'руб.');
            else
                $('#div-custom-order .div-transport-price .price').html('бесплатно');
            
            var itogo_price = parseFloat(transport_price) + <?php echo $all_sum;?>;
            $('#div-custom-order .div-itogo .price').html(parseFloat(itogo_price).toFixed(2)+'руб.');
        })
        $('#CustomClientInfoTransportTypeId').change();
    });
</script>