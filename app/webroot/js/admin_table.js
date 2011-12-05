$(document).ready(function() {
    //конфигурация ckeditor
    ///////////////////////////////////////////////////////////////////////////
    var editor_config = {
        uiColor: '#DFEDFC'
    }
    ///////////////////////////////////////////////////////////////////////////

    //окно ожидания при ajax-вызовах
    ///////////////////////////////////////////////////////////////////////////
    var div_overlay = null;
    $(document).ajaxStart(function() {
        var width = $(document.body).width();
        var height = $(document.body).height();
        div_overlay = $("<div><div class='ui-widget-overlay' "+
            "style='width:100%;height:100%;z-index:1001;position:fixed'></div>"+
            "<img src='"+webroot+"img/busy.gif' style='display:block; margin:auto;"+
            "position:fixed;left:50%;top:50%;z-index:1002;'/>"+
            "</div>");
        $(document.body).append(div_overlay);

        div_overlay.css('cursor', 'wait');
    });
    $(document).ajaxStop(function() {
        if(div_overlay != null) {
            div_overlay.remove();
            div_overlay = null;
        }
    });
    ///////////////////////////////////////////////////////////////////////////

    //paginate
    ///////////////////////////////////////////////////////////////////////////
    $('.admin-pagination').addClass('ui-state-default ui-corner-all');
    $('.admin-pagination-limit-select').change(function() {
        var base_url = $(this).attr('base_url');
        var limit = $(this).val();
        var url = base_url+'/limit:'+limit;
        window.location = url;
    })
    ///////////////////////////////////////////////////////////////////////////

    //открывающиеся изображения
    ///////////////////////////////////////////////////////////////////////////
    var div_image = null;
    $('img.show-image').click(function() {
        var image = Image();
        image.src = this.src;

        var left = Math.round(window.innerWidth/2 - image.width/2);
        var top = Math.round(window.innerHeight/2 - image.height/2);
        div_image = $("<div style='display:none'><div class='ui-widget-overlay' "+
            "style='width:100%;height:100%;z-index:1001;position:fixed;'></div>"+
            "<img src='"+image.src+"' style='display:block; margin:auto;"+
            "position:fixed;left:"+left+"px;top:"+top+"px;z-index:1002;' "+
            "title='Нажмите, чтобы закрыть'/></div>");
        $(document.body).append(div_image);
        div_image.show('fast');

        div_image.click(function() {
            if(div_image != null) {
                div_image.remove();
                div_image = null;
            }
        })
    });
    ///////////////////////////////////////////////////////////////////////////

    //диалоговое окно выбора файла
    ///////////////////////////////////////////////////////////////////////////
    $('.file-dialog').dialog({
        modal: true,
        autoOpen: false,
        title: 'Выберите файл',
        dialogClass: 'widget',
        resizable: true,
        width: 300,
        height: 'auto',
        buttons: {
            'Ок': function() {
                var container = $(this.container);
                container.remove('.added-file');
                var div = $("<div class='added-file' style='display:none'></div>");
                var file = $(this).find('input[type=file]:first');
                div.append(file);
                container.append(div);

                container.addClass('changed');
                file.addClass('changed');
                $(this).dialog('close');
            },
            'Отмена': function() {
                $(this).dialog('close');
            }
        }
    });

    $('.div-file-dialog').click(function() {
        var parent = $(this).parent();
        var dlg = $('.file-dialog:first');
        dlg.get(0).container = parent.get(0);

        var name = $(this).attr('name');

        dlg.html("");
        dlg.append("<input type='file' name='"+name+"' width=100% />");
        dlg.dialog('open');
    });
    ///////////////////////////////////////////////////////////////////////////

    //диалоговое окно editbox
    ///////////////////////////////////////////////////////////////////////////
    $('.edit-dialog').dialog({
        modal: true,
        autoOpen: false,
        title: 'Введите текст',
        dialogClass: 'widget',
        resizable: true,
        width: 600,
        height: 'auto',
        buttons: {
            'Ок': function() {
                var editbox = $(this.editbox);
                editbox.val($(this).find('input[type=text]:first').val());

                editbox.addClass('changed');
                editbox.parent().addClass('changed');

                $(this).dialog('close');
            },
            'Отмена': function() {
                $(this).dialog('close');
            }
        }
    });

    $('.input-edit-dialog').click(function() {
        var dlg = $('.edit-dialog:first');
        dlg.get(0).editbox = this;
        var dlg_editor = dlg.find('input[type=text]:first');
        var value = $(this).val();
        dlg_editor.val(value);
        //dlg.find('input[type=text].first').val($(this).val());
        dlg.dialog('open');
    })
    ///////////////////////////////////////////////////////////////////////////

    //едитбоксы с датами
    ///////////////////////////////////////////////////////////////////////////
    $('.input-date').datepicker();
    ///////////////////////////////////////////////////////////////////////////

    //делаем заголовки заголовками
    ///////////////////////////////////////////////////////////////////////////
    $('h1, h2').addClass('ui-widget-header ui-corner-all');
    $('h3, h4').addClass('ui-state-default ui-corner-all');
    ///////////////////////////////////////////////////////////////////////////

    //делаем кнопки кнопками
    ///////////////////////////////////////////////////////////////////////////
    $('a.button').button();
    $('a.button[func_name]').click(function() {
        var func_name = $(this).attr('func_name');
        window[func_name]();
    })
    ///////////////////////////////////////////////////////////////////////////

    $('.dialog-div-row').addClass('ui-state-default');

    //подсвечивание измененных полей ввода
    ///////////////////////////////////////////////////////////////////////////
    $('input.input-edit-admin, select.select-edit-admin, input.checkbox-edit-admin').change(function() {
        $(this).addClass('changed');
        $(this).parent().addClass('changed');
    });
    $('input.input-edit-admin').keypress(function() {
        $(this).addClass('changed');
        $(this).parent().addClass('changed');
    });
    ///////////////////////////////////////////////////////////////////////////

    //кнопка Сохранить
    ///////////////////////////////////////////////////////////////////////////
    $('.link-save-admin').click(function() {
        var table_id = $(this).attr('table_id');
        var table = $('#'+table_id);

        var save_url = $(this).attr('save_url');

        var form = $("<form method='post' action='"+save_url+"' enctype='multipart/form-data'></form>");
        var div = $("<div style='display:none;'></div>");
        div.append(form);
        $(document.body).append(div);
        
        table.find('input[type=text].changed, select.changed').each(function() {
            var input = $(this).clone();
            input.val($(this).val());
            form.append(input);
        });
        table.find('input[type=checkbox].changed').each(function() {
            var input = $(this).clone();
            input.attr('type', 'text');

            var val = $(this).attr('checked');
            if(val) input.val('1');
            else input.val('0');

            form.append(input);
        })
        table.find('input[type=file].changed').each(function() {
            form.append($(this));
        });

        form.submit();
//        form.ajaxSubmit(function(res) {
////            $(document.body).html(res);
////alert(1);
//            location.reload();
//        });
    });
    ///////////////////////////////////////////////////////////////////////////

    //сортировка
    ///////////////////////////////////////////////////////////////////////////
    $('tbody.sortable').sortable({
        scrollSpeed: 5,
        update: function(event, ui) {
            var array = $(this).sortable('toArray');
            for(var key in array) {
                var tr = $('#'+array[key]);
                tr.find('.sort-column input').each(function() {
                    $(this).val(parseInt(key)+1);
                    $(this).change();
                });
            }
        }
    });
    ///////////////////////////////////////////////////////////////////////////

    //выбор Действия над строкой
    ///////////////////////////////////////////////////////////////////////////
    $('.select-action-admin').change(function() {
        var val = $(this).val();
        if(val == 0) return;
        var row_id = $(this).attr('row_id');
        $(this).val(0);
        window[val](row_id);

    });
    ///////////////////////////////////////////////////////////////////////////

    //диалоговые окна (с поддержкой ckeditor)
    ///////////////////////////////////////////////////////////////////////////
    $('.dialog-form').each(function() {
        var form = $(this).find('.form');
        if(form.attr('is_ajax') != 0) {
            form.find('.form').ajaxForm({
                beforeSubmit: function() {
                    $(this).parent().dialog('close');
                },
                success: function(responseText) {
    //                $(document.body).html(responseText);
                    location.reload();
                }
            });
        }

        var d_title = $(this).attr('d_title');
        var d_width = $(this).attr('d_width');
        var d_height = $(this).attr('d_height');
        var ok_caption = $(this).attr('ok_caption');
        var cancel_caption = $(this).attr('cancel_caption');

        var  buttons = {};
        if(form.attr('is_ajax') == 0) {
            buttons[ok_caption] = function() {
                form.submit();
            }
        } else {
            buttons[ok_caption] = function() {
                $(this).dialog('close');
                $(this).find('.form').ajaxSubmit(function(responseText) {
    //                $(document.body).html(responseText);
                    location.reload();
                });
            }
        }
        buttons[cancel_caption] = function() {
            $(this).dialog('close');
        }

        $(this).dialog({
            modal: true,
            autoOpen: false,
            title: d_title,
            dialogClass: 'widget',
            resizable: true,
            width: d_width,
            height: d_height,
            buttons: buttons,
            open: function() {
                if($.browser.safari) {
                    $(this).find('.dialog-editor').each(function() {
                        var alt_editor_config = $.extend({}, editor_config);;

                        var height = $(this).attr('ed_height');
                        if(height>0) alt_editor_config.height = height;

                        $(this).ckeditor(alt_editor_config);
                    });
                }
            },
            close: function() {
                if($.browser.safari) {
                    $(this).find('.dialog-editor').each(function() {
                       $(this).ckeditorGet().destroy();
                    });
                }
            }
        });
    });
    if(!$.browser.safari) {
        $('.dialog-editor').each(function() {
            var alt_editor_config = $.extend({}, editor_config);

            var height = $(this).attr('ed_height');
            if(height>0) alt_editor_config.height = height;

            $(this).ckeditor(alt_editor_config);
        })
    }
    ///////////////////////////////////////////////////////////////////////////

    //поля ввода с диалоговым окном с ckeditor
    ///////////////////////////////////////////////////////////////////////////
    $('.text-dialog').dialog({
        modal: true,
        autoOpen: false,
        title: 'Редактирование текста',
        dialogClass: 'widget',
        resizable: true,
        width: 750,
        height: 500,
//        height: 'auto',
        buttons: {
            'Ок': function() {
                var input = $(this.editor);
                var value = $(this).find('textarea:first').ckeditorGet().getData();
                input.val(value);
                input.addClass('changed');
                input.parent().addClass('changed');
                $(this).dialog('close');
            },
            'Отмена': function() {
                $(this).dialog('close');
            }
        },
        open: function() {
            if($.browser.safari) {
                $(this).find('textarea').each(function() {
                    $(this).ckeditor(editor_config);
                });
            }
        },
        close: function() {
            if($.browser.safari) {
                $(this).find('textarea').each(function() {
                   $(this).ckeditorGet().destroy();
                });
            }
        }
    });
    if(!$.browser.safari) $('.text-dialog textarea').ckeditor(editor_config);
    
    $('input.editor').click(function() {
        var dlg = $('.text-dialog:first');
        var value = $(this).val();
        if($.browser.safari) {
            dlg.find('textarea:first').val(value);
        } else {
            var editor = dlg.find('textarea:first').ckeditorGet();
            editor.setData(value);
        }
        dlg.get(0).editor = this;
        dlg.dialog('open');
    });
    ///////////////////////////////////////////////////////////////////////////

    //поля с автозаполнением
    ///////////////////////////////////////////////////////////////////////////
    $('.autocomplete-edit-admin').each(function() {
        var list_name = $(this).attr('list_name');
        var list = eval(list_name);
        $(this).autocomplete({
            'minLength': 0,
            'source': list
        });
    })
    ///////////////////////////////////////////////////////////////////////////
});