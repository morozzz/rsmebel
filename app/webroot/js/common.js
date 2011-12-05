function enable_validation() {
    //проверка ввода только чисел
    $(".textbox-float").keypress(function (e) {
        if( e.which!=46 && e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {
            //$("#errmsg").html("Digits Only").show().fadeOut("slow");
            return false;
        }
        return true;
    });

    //проверка ввода только целых чисел
    $(".textbox-int").keypress(function (e) {
        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {
            //$("#errmsg").html("Digits Only").show().fadeOut("slow");
            return false;
        }
        return true;
    });
}

function enable_image_show() {
    //показывать изображение в всплывающем псевдоокне при нажатии на него
    $('.show-image').css('cursor', 'pointer');

    $('.show-image').click(function() {
        var image = new Image();
        image.src = this.src;
        $.fumodal({
            'width' : image.width,
            'height' : image.height,
            'style' : false,
            'overlayColor' : '#555599',
            'overlayOpacity' : 0.8,
            'content' : '<img src="' + this.src + '" title="Нажмите, чтобы закрыть" style="cursor:pointer;" onClick="$.fumodal_close()"/>'
        });
    });
}

function enable_collapsing() {
    //при нажатии на блок класса link-collapse,
    //он скрывается, а вместо него появляется блок класса div-collapsed
    $('.link-collapse').click(function() {
        $(this).hide();
        $(this).parent().find('.div-collapsed').show('slow');
    });
}

function enable_link_dialog() {
    $('.div-dialog').dialog({
        show: 'blind',
        hide: 'blind',
        modal: true,
        autoOpen: false,
        resizable: false,
        buttons: {
            'ОК': function() {
                $('#'+$(this).attr('append_to')).change();
                $('.div-dialog').dialog('close');
            }
        }
    });

    $('.link-dialog').click(function() {
        var div_dialog = $('#'+$(this).attr('append_to'));
        var height = parseInt(div_dialog.attr('dialog_height'));
        if(height>0) div_dialog.dialog('option', 'height', height);
        var width = parseInt(div_dialog.attr('dialog_width'));
        if(width>0) div_dialog.dialog( "option", "width", width );
        div_dialog.dialog('open');
    });
}

function enable_ajax_waiting() {
    $(document).ajaxStart(function() {
        var image = new Image();
        image.src = webroot+'img/busy.gif';
        $.fumodal({
            'width' : image.width,
            'height' : image.height,
            'style' : false,
            'overlayColor' : '#FFFFFF',
            'overlayOpacity' : 0.8,
            'content' : '<img src="' + image.src + '" title="подождите, выполняется запрос" style="cursor: wait;"/>'
        });
        $('#fumodal_background').css('cursor', 'wait');
    });
    $(document).ajaxStop(function() {
        $.fumodal_close();
        $('#fumodal_background').css('cursor', 'default');
    });
}