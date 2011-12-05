$(document).ready(function() {
    enable_validation();
    $('.tr-product-det').mouseover(function() {
        $(this).addClass('product-det-tr-hover');
    });
    $('.tr-product-det').mouseout(function() {
        $(this).removeClass('product-det-tr-hover');
    });
    $('.tr-product-det').click(function() {
        var product_det_id = $(this).attr('product_det_id');
        select_product_det(product_det_id);
    });
    $('.tr-product-det').dblclick(function() {
        var product_det_id = $(this).attr('product_det_id');
        var product_det = product_dets[product_det_id];
        window.location = webroot+'products/index/'+product_det.product_id+'/'+product_det_id;
    });
    $('.product-count').change(function() {
        var product_id = $(this).attr('product_id');
        update_product_sum(product_id);
    });
    $('.product-count').keyup(function() {
        var product_id = $(this).attr('product_id');
        update_product_sum(product_id);
    });
    $('.select-product-param').change(function() {
        var product_id = $(this).attr('product_id');
        change_product_param(product_id);
    });
    $('.div-product-content').each(function() {
        var product_id = $(this).attr('product_id');
        change_product_param(product_id);
        var table = $('.table-product-det[product_id='+product_id+']');
        table.find('.tr-product-det:visible:first').each(function() {
            var product_det_id = $(this).attr('product_det_id');
            select_product_det(product_det_id);
        })
    });
    $('.btn-product-custom').click(function() {
        var product_id = $(this).attr('product_id');
        product_custom(product_id);
    });
     $('#dialog-made-custom').dialog({
        show: 'blind',
        hide: 'blind',
        modal: false,
        autoOpen: false,
        title: 'Товар добавлен в корзину',
        width: 250,
        height: ($.browser.msie)?100:65,
        resizable: false,
        dialogClass: 'widget-made-custom'
    });
});

function change_product_param(product_id) {
    var product_search = '[product_id='+product_id+']';
    var tr_selector = "";
    $('.select-product-param'+product_search).each(function() {
        var product_param_id = $(this).attr('product_param_id');
        var value = $(this).val();
        tr_selector += "[p_"+product_param_id+"="+value+"]";
    });
    if(tr_selector=="") return;

    var table = $('.table-product-det'+product_search);
    table.find('.tr-product-det').each(function() {
        var visible = $(this).is(tr_selector);
        if(visible) $(this).show();
        else $(this).hide();
    });
    var product_det_id = table.find('.tr-product-det:visible:first').attr('product_det_id');
    select_product_det(product_det_id);
}

function select_product_det(product_det_id) {
    if(product_det_id == null) return;
    var product_det = product_dets[product_det_id];
    var product_id = product_det.product_id;
    var product_search = '[product_id='+product_id+']';

    //удаляем выделенные
    var table = $('.table-product-det[product_id='+product_id+']');
    table.find('.tr-product-det').removeClass('product-det-tr-selected');
    table.find('.radio-product-det').removeAttr('checked');

    //выделяем текущую
    var tr = $('.tr-product-det[product_det_id='+product_det_id+']');
    tr.addClass('product-det-tr-selected');
    tr.find('.radio-product-det').attr('checked', 'true');

    //заменяем изображения
    $('.img-small-product'+product_search).attr('src', product_det.small_image_url);
    $('.img-big-product'+product_search).attr('src', product_det.big_image_url);
    $('.div-small-image-product-background'+product_search).css({
        background: 'url('+product_det.small_image_url+') no-repeat center center'
    });
    $('.div-big-image-product-background'+product_search).css({
        background: 'url('+product_det.big_image_url+') no-repeat center center'
    });
//    var small_image_html = '<img src="'+product_det.small_image_url+
//        '" class="img-product img-small-product bevel iradius16" '+
//        'product_id="'+product_id+'">';
//    var big_image_html = '<img src="'+product_det.big_image_url+
//        '" class="img-product img-big-product bevel iradius32" '+
//        'product_id="'+product_id+'">';
//    $('.link-product-small-image'+product_search).html(small_image_html);
//    $('.link-product-big-image'+product_search).html(big_image_html);

    //заменяем описания
    $('.div-product-short-about'+product_search).html(product_det.short_about);
    $('.div-product-long-about'+product_search).html(product_det.long_about);

    //меняем производителя
    $('.span-producer-name'+product_search).html(product_det.producer_name);

    //меняем ссылки
    $('.link-product'+product_search).attr('href', webroot+'products/index/'+
        product_id+'/'+product_det_id);

    //заменяем цену
    var zakaz = true;
    if(product_det.cnt>0) zakaz = false;
    var price = product_det.price;
    if(zakaz) price = 'под заказ';
    var price_value = product_det.price;
    if(zakaz) price_value = -1;
    $('.span-product-cost'+product_search).html(price);
    $('.span-product-cost'+product_search).attr('value', price_value);
    if(zakaz) $('.span-product-cost-rub'+product_search).hide();
    else $('.span-product-cost-rub'+product_search).show();

    //устанавливаем/снимаем спецпредложение
    if(product_det.is_special == 1) {
        $('.span-product-cost-sum'+product_search).addClass('span-product-cost-sum-special');
    } else {
        $('.span-product-cost-sum'+product_search).removeClass('span-product-cost-sum-special');
    }

    //прячем/отображаем надпись "Просим прощения....."
    if(zakaz) $('.div-product-zakaz-text'+product_search).show();
    else $('.div-product-zakaz-text'+product_search).hide();

    update_product_sum(product_id);
}

function update_product_sum(product_id) {
    var product_search = '[product_id='+product_id+']';
    var cost = $('.span-product-cost'+product_search).attr('value');

    var zakaz = false;
    if(cost==-1) zakaz = true;

    var cnt = $('.product-count'+product_search).val();
    var price = cost*cnt;
    if(zakaz) price = 'под заказ';

    $('.span-product-sum'+product_search).html(price);
    if(zakaz) $('.span-product-sum-rub'+product_search).hide();
    else $('.span-product-sum-rub'+product_search).show();
}

function product_custom(product_id) {
    var product_search = '[product_id='+product_id+']';

    var cnt = $('.product-count'+product_search).val();
    if(!(cnt>0)) {
        alert('Количество товара должно быть больше нуля');
        return;
    }
    var data = {
        cnt: cnt
    }

    var table = $('.table-product-det'+product_search);
    if(table.length>0) {
        var tr = table.find('.product-det-tr-selected');
        if(tr.length<=0) {
            alert('Выберите товар из таблицы');
            return;
        }
        var product_det_id = tr.attr('product_det_id');
        data.product_det_id = product_det_id;
    } else {
        data.product_id = product_id;
    }
    
    $('.div-top-header-basket').load(
        webroot+'basket/add',
        data,
        function() {
            var product_button = $('.btn-product-custom'+product_search);
            var position = product_button.offset();
            position.top -= $(window).scrollTop();

            var dialog_height = $('#dialog-made-custom').dialog('option', 'height');
            var dialog_width = $('#dialog-made-custom').dialog('option', 'width');

            position.top -= dialog_height + 10;
            position.left -= dialog_width - 50;

            var pos = [position.left, position.top];
            $('#dialog-made-custom').dialog('option', 'position', pos);
            $('#dialog-made-custom').dialog('open');

            $('#dialog-made-custom').dialog('open');
        }
    );
}