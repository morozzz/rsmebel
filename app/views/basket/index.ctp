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
            <?php echo $form->create('Custom', array(
                'action' => 'order'
            ));?>
            <h2>Оформление заказа</h2>
            <?php echo $html->tag('h3', 'Персональная информация');?>
            <table class="table-person-info" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="26%">ФИО</td>
                    <td width="74%" colspan="4"><?php echo $form->input('ClientInfo.fio', array('label' => false));?></td>
                </tr>
                <tr>
                    <td width="26%">Телефон</td>
                    <td width="12%"><?php echo $form->input('ClientInfo.phone_kod', array('label' => false));?></td>
                    <td width="62%" colspan="3"><?php echo $form->input('ClientInfo.phone', array('label' => false));?></td>
                </tr>
                <tr>
                    <td width="26%">Почтовый адрес</td>
                    <td width="12%">Индекс</td>
                    <td width="25%"><?php echo $form->input('ClientInfo.post_index', array('label' => false));?></td>
                    <td width="12%">Регион</td>
                    <td width="25%"><?php echo $form->input('ClientInfo.post_region', array('label' => false));?></td>
                </tr>
                <tr>
                    <td width="26%"></td>
                    <td width="12%">Город</td>
                    <td width="25%"><?php echo $form->input('ClientInfo.post_city', array('label' => false));?></td>
                    <td width="12%">Улица</td>
                    <td width="25%"><?php echo $form->input('ClientInfo.post_street', array('label' => false));?></td>
                </tr>
                <tr>
                    <td width="26%"></td>
                    <td width="12%">Дом</td>
                    <td width="25%"><?php echo $form->input('ClientInfo.post_hnumber', array('label' => false));?></td>
                    <td width="12%">Кв./Офис</td>
                    <td width="25%"><?php echo $form->input('ClientInfo.post_office', array('label' => false));?></td>
                </tr>
            </table>
            <?php if($is_opt_price) { ?>
            <div class="div-company-info">
                <?php
                    echo $html->tag('h3', 'Информация о фирме');
                    echo $form->input('ClientInfo.company_type_id', array('label' => 'Орг. правовая форма'));
                    echo $form->input('ClientInfo.name', array('label' => 'Название фирмы<font size=4 color = red> * </font>:', 'size' => '50', 'div' => 'input text div-required'));
                    echo $form->input('ClientInfo.reg_num', array('label' => 'Регистрационный номер(ИП):'));
                    echo $form->input('ClientInfo.INN', array('label' => 'ИНН:'));
                    echo $form->input('ClientInfo.KPP', array('label' => 'КПП(кроме ИП):'));
                    echo $form->input('ClientInfo.operating_account', array('label' => 'Расчетный счет:'));
                    echo $form->input('ClientInfo.bank', array('label' => 'Банк:'));
                    echo $form->input('ClientInfo.correspondent_account', array('label' => 'Корреспондентский счет:'));
                    echo $form->input('ClientInfo.BIK', array('label' => 'БИК:'));
                    echo $form->input('ClientInfo.OKPO', array('label' => 'ОКПО:'));
                    echo $form->input('ClientInfo.OKVED', array('label' => 'ОКВЭД(ОКОНХ):'));
                } ?>
                <table class="table-company-info" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="26%">Факс</td>
                        <td width="12%"><?php echo $form->input('ClientInfo.fax_kod', array('label' => false));?></td>
                        <td width="62%" colspan="3"><?php echo $form->input('ClientInfo.fax', array('label' => false));?></td>
                    </tr>
                    <tr>
                        <td width="26%">Юр. адрес</td>
                        <td width="12%">Индекс</td>
                        <td width="25%"><?php echo $form->input('ClientInfo.jur_index', array('label' => false));?></td>
                        <td width="12%">Регион</td>
                        <td width="25%"><?php echo $form->input('ClientInfo.jur_region', array('label' => false));?></td>
                    </tr>
                    <tr>
                        <td width="26%"><?php echo $form->button('=почтовый адрес', array('id' => 'button-set-address'));?></td>
                        <td width="12%">Город</td>
                        <td width="25%"><?php echo $form->input('ClientInfo.jur_city', array('label' => false));?></td>
                        <td width="12%">Улица</td>
                        <td width="25%"><?php echo $form->input('ClientInfo.jur_street', array('label' => false));?></td>
                    </tr>
                    <tr>
                        <td width="26%"></td>
                        <td width="12%">Дом</td>
                        <td width="25%"><?php echo $form->input('ClientInfo.jur_hnumber', array('label' => false));?></td>
                        <td width="12%">Кв./Офис</td>
                        <td width="25%"><?php echo $form->input('ClientInfo.jur_office', array('label' => false));?></td>
                    </tr>
                </table>
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
            $("#ClientInfoJurIndex").attr('value', $("#ClientInfoPostIndex").attr('value'));
            $("#ClientInfoJurRegion").attr('value', $("#ClientInfoPostRegion").attr('value'));
            $("#ClientInfoJurCity").attr('value', $("#ClientInfoPostCity").attr('value'));
            $("#ClientInfoJurStreet").attr('value', $("#ClientInfoPostStreet").attr('value'));
            $("#ClientInfoJurHnumber").attr('value', $("#ClientInfoPostHnumber").attr('value'));
            $("#ClientInfoJurOffice").attr('value', $("#ClientInfoPostOffice").attr('value'));
        })
    });
</script>