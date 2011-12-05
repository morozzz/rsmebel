<?php echo $session->flash(); ?>
<?php $cur_catalog = $catalog;?>

<table class="align-table">
    <tr>
        <td width="25%">
            <?php echo $catalogCommon->getCatalogTreeStr($path_tree, $path, $catalog['Catalog']['id']);?>
        </td>
        <td width="75%" style="border-left: 1px dotted #CCCCDD;">
            <?php echo $catalogCommon->getCatalogPathStr($path, 'adm_catalog');?>
            <h1 class="catalog-caption"><?php echo $catalog['Catalog']['name'];?></h1>

            <?php if($catalog['Catalog']['id'] != 0) { ?>
            <div class="change-parent-div">
                <?php
                    echo $form->create('Catalog', array(
                        'action' => 'change_parent',
                        'id' => 'change_parent_form'
                    ));
                    echo "Нахождение: ";
                    echo $form->select('parent_id', $catalog_list, $catalog['Catalog']['parent_id'], array(
                        'style' => 'margin-left: 5px;'
                    ), false);
                    echo $form->submit('Сменить', array(
                        'style' => 'margin-left: 5px;',
                        'div' => false
                    ));
                    echo $form->hidden('id', array(
                        'value' => $catalog['Catalog']['id']
                    ));
                    echo $form->end();
                ?>
            </div>
            <?php } ?>

            <div class="div-add-action">
                <a id="link-add-catalog" href="#" onclick="return false;">Добавить</a>
            </div>
            <div class="div-add-action">
                <a id="link-get-csv"
                   target="_blank"
                   href="<?php echo $html->url('/catalogs/get_csv/'.$catalog['Catalog']['id']);?>">
                    Выгрузка в CSV
                </a>
            </div>

            <div id="table-header">
                <div class="td-catalog-name">Название</div>
                <div class="td-producer">Производитель</div>
                <div class="td-1c-code">1С-код</div>
                <div class="td-image">Мал. изобр-е</div>
                <div class="td-image">Бол. изобр-е</div>
                <div class="td-sort-order">Сорт-ка</div>
                <div class="td-action">Действие</div>
            </div>
            <ul id="table-body">
                <?php foreach($catalogs as $catalog) {
                    $catalog_id = $catalog['Catalog']['id'];

                    $name = htmlspecialchars($catalog['Catalog']['name']);
                    $producer_id = $catalog['Producer']['id'];
                    $producer_name = htmlspecialchars($catalog['Producer']['name']);
                    $code_1c = $catalog['Catalog']['code_1c'];
                    $sort_order = $catalog['Catalog']['sort_order'];

                    $small_image_id = $catalog['Catalog']['small_image_id'];
                    $small_image_url = $catalog['SmallImage']['url'];

                    $big_image_id = $catalog['Catalog']['big_image_id'];
                    $big_image_url = $catalog['BigImage']['url'];
                ?>
                <li catalog_id="<?php echo $catalog_id;?>"
                    class="table-row"
                    id="li-<?php echo $catalog_id;?>">
                    <div class="td-div td-catalog-name">
                        <input catalog_id="<?php echo $catalog_id;?>"
                               class="input-save-all-form input-catalog-name"
                               value="<?php echo $name;?>"
                               name="data[Catalog][<?php echo $catalog_id;?>][name]">
                    </div> <div class="td-div td-producer">
                        <input class="input-producer-name"
                               readonly
                               value="<?php echo $producer_name;?>">
                        <input class="input-producer-id"
                               type="hidden"
                               value="<?php echo $producer_id;?>"
                               name="data[Catalog][<?php echo $catalog_id;?>][producer_id]">
                    </div> <div class="td-div td-1c-code">
                        <span class="span-1c-code"><?php echo $code_1c; ?></span>
                    </div> <div class="td-div td-image">
                        <?php echo $html->image($small_image_url, array(
                            'class' => 'show-image',
                            'height' => 30
                        )); ?>
                        <div append_to="div-dialog-small-image-<?php echo $catalog_id;?>"
                             class="link-dialog"
                             id="link-dialog-small-image-<?php echo $catalog_id;?>">
                            <a href="#" onclick="return false;" style="width: 100%;">
                                Загрузить
                            </a>
                        </div>
                        <div class="div-dialog"
                             id="div-dialog-small-image-<?php echo $catalog_id;?>"
                             title="Загрузка маленького изображения"
                             dialog_height="110"
                             append_to="link-dialog-small-image-<?php echo $catalog_id;?>">
                            <input type="file"
                                   size="30"
                                   class="input-image"
                                   name="data<?php
                                        if(empty($small_image_id)) {
                                            echo "[Catalog][$catalog_id][small_image_file]";
                                        } else {
                                            echo "[Image][$small_image_id]";
                                        }
                                   ?>">
                        </div>
                    </div> <div class="td-div td-image">
                        <?php echo $html->image($big_image_url, array(
                            'class' => 'show-image',
                            'height' => 30
                        )); ?>
                        <div append_to="div-dialog-big-image-<?php echo $catalog_id;?>"
                             class="link-dialog"
                             id="link-dialog-big-image-<?php echo $catalog_id;?>">
                            <a href="#" onclick="return false;" style="width: 100%;">
                                Загрузить
                            </a>
                        </div>
                        <div class="div-dialog"
                             id="div-dialog-big-image-<?php echo $catalog_id;?>"
                             title="Загрузка большого изображения"
                             dialog_height="110"
                             append_to="link-dialog-big-image-<?php echo $catalog_id;?>">
                            <input type="file"
                                   size="30"
                                   class="input-image"
                                   name="data<?php
                                        if(empty($big_image_id)) {
                                            echo "[Catalog][$catalog_id][big_image_file]";
                                        } else {
                                            echo "[Image][$big_image_id]";
                                        }
                                   ?>">
                        </div>
                    </div> <div class="td-div td-sort-order">
                        <input class="input-save-all-form input-sort-order"
                               value="<?php echo $sort_order;?>"
                               name="data[Catalog][<?php echo $catalog_id;?>][sort_order]">
                    </div> <div class="td-div td-action">
                        <select catalog_id="<?php echo $catalog_id;?>"
                                class="select-action">
                            <option selected="selected" value="0">Выберите действие</option>
                            <option value="go">Перейти в каталог</option>
                            <option value="add_catalog">Добавить каталог</option>
                            <option value="edit_short_about">Редактировать краткое описание</option>
                            <option value="edit_long_about">Редактировать полное описание</option>
                            <option value="move">Перенести</option>
                            <option value="csv">Выгрузка в CSV</option>
                            <option value="delete">Удалить</option>
                        </select>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <?php echo $form->create('Catalog', array(
                'action' => 'save_list',
                'id' => 'catalog-save-all',
                'type' => 'file'
            ));?>
            <div id="div-catalog-save-all" style="display: none;">

            </div>
            <?php echo $form->end('Сохранить');?>
        </td>
    </tr>
</table>

<script type="text/javascript">
    var webroot = '<?php echo $this->webroot; ?>';
    //var catalogs_reordered = false;

    //catalogs
    <?php
    $catalogs_short_notes = Set::combine($catalogs, '{n}.Catalog.id', '{n}.Catalog.short_about');
    $catalogs_long_notes = Set::combine($catalogs, '{n}.Catalog.id', '{n}.Catalog.long_about');
    $catalogs_name = Set::combine($catalogs, '{n}.Catalog.id', '{n}.Catalog.name');
    ?>
    var catalogs_short_notes = <?php echo $javascript->object($catalogs_short_notes);?>;
    var catalogs_long_notes = <?php echo $javascript->object($catalogs_long_notes);?>;
    var notes = {
        'short': {
            name: 'data[short_about]',
            title: 'Редактирование краткого описания',
            notes: catalogs_short_notes
        },
        'long': {
            name: 'data[long_about]',
            title: 'Редактирование полного описания',
            notes: catalogs_long_notes
        }
    };
    var catalogs_name = <?php echo $javascript->object($catalogs_name);?>;
    var producers = <?php echo $javascript->object($producer_list);?>;
    /////////////

    $(document).ready(function() {
        enable_validation();
        enable_image_show();
        enable_link_dialog();
        enable_ajax_waiting();

        $('.input-save-all-form').change(function() {
            $(this).parent().addClass('div-changed');
            $(this).addClass('input-changed');
        });
        $('.input-save-all-form').keypress(function() {
            $(this).parent().addClass('div-changed');
            $(this).addClass('input-changed');
        });

        $('.link-dialog').click(function() {
            $(this).parent().addClass('div-changed');
        });

        $('.input-image').change(function() {
            $(this).addClass('input-file-changed');
        });

        if(!$.browser.msie) {
            $('.input-catalog-name').focus(function() {
                $(this).parent().parent().find('.td-div').css('visibility', 'hidden');
                $(this).parent().css('visibility', 'visible');
                $(this).animate({
                    width: 500
                });
            });

            $('.input-catalog-name').blur(function() {
                $(this).animate({
                    width: '90%'
                }, 'normal', function() {
                    $(this).parent().parent().find('.td-div').css('visibility', 'visible');
                });
            });
        }

        $('#link-add-catalog').click(function() {
            $('#input-add-catalog-parent-id').val(<?php echo $cur_catalog['Catalog']['id'];?>);
            $('#input-add-catalog-name').val('');
            $('#dialog-add-catalog').dialog('open');
        });

        
        $('#catalog-save-all').submit(function() {
            $('.input-changed').clone().appendTo('#div-catalog-save-all');
            $('.input-file-changed').appendTo('#div-catalog-save-all');
            $('#div-catalog-save-all').append(
                '<input type="hidden" name="data[parent_id]" value="'+
                <?php echo $cur_catalog['Catalog']['id'];?>+'">');
        });

        $('#table-body').sortable({
            scrollSpeed: 5,
            update: function(event, ui) {
                //catalogs_reordered = true;
                var array = $('#table-body').sortable('toArray');
                for(var key in array) {
                    var li_id = array[key];
                    $('#'+li_id).find('.input-sort-order').val(parseInt(key)+1);
                }
                $('.input-sort-order').parent().addClass('div-changed');
                $('.input-sort-order').addClass('input-changed');
            }
        });

        $('.select-action').change(function() {
            var action = $(this).val();
            var catalog_id = $(this).parent().parent().attr('catalog_id');
            switch(action) {
                case 'go':
                    window.location = webroot+'catalogs/adm_catalog/'+catalog_id;
                    break;
                case 'add_catalog':
                    $('#input-add-catalog-parent-id').val(catalog_id);
                    $('#input-add-catalog-name').val('');
                    $('#dialog-add-catalog').dialog('open');
                    break;
                case 'edit_short_about':
                    show_edit_note('short', catalog_id, catalogs_name[catalog_id]);
//                    $('#dialog-edit-note').dialog('option', 'title', 'Редактирование краткого описания');
//                    $('#text-edit-note').attr('name', 'data[short_about]');
//                    $('#text-edit-note').val(catalogs_short_notes[catalog_id]);
//                    $('#input-edit-note-catalog-id').val(catalog_id);
//                    $('#caption-edit-note-catalog-name').html(catalogs_name[catalog_id]);
//                    $('#dialog-edit-note').dialog('open');
                    break;
                case 'edit_long_about':
                    show_edit_note('long', catalog_id, catalogs_name[catalog_id]);
//                    $('#dialog-edit-note').dialog('option', 'title', 'Редактирование полного описания');
//                    $('#text-edit-note').attr('name', 'data[long_about]');
//                    $('#text-edit-note').val(catalogs_long_notes[catalog_id]);
//                    $('#input-edit-note-catalog-id').val(catalog_id);
//                    $('#caption-edit-note-catalog-name').html(catalogs_name[catalog_id]);
//                    $('#dialog-edit-note').dialog('open');
                    break;
                case 'move':
                    $('#input-change-parent-parent-id').val(<?php echo $cur_catalog['Catalog']['id'];?>);
                    $('#caption-change-parent-catalog-name').html(catalogs_name[catalog_id]);
                    $('#input-change-parent-catalog-id').val(catalog_id);
                    $('#dialog-change-parent').dialog('open');
                    break;
                case 'csv':
                    window.open(webroot+'catalogs/get_csv/'+catalog_id);
                    break;
                case 'delete':
                    $('#input-delete-catalog-catalog-id').val(catalog_id);
                    $('#caption-delete-catalog-catalog-name').html(catalogs_name[catalog_id]);
                    $('#dialog-delete-catalog').dialog('open');
                    break;
            }
            $(this).val(0);
        });
    });
</script>

<div id="dialog-add-catalog">
    <?php
    echo $form->create('Catalog', array(
        'action' => 'add',
        'id' => 'form-add-catalog'
    ));
    ?>
    <div class="div-row-add-catalog">
        <div class="label-add-catalog">
            Добавить в
        </div>
        <div class="div-input-add-catalog">
            <?php
            echo $form->select('parent_id',
                    $catalog_list,
                    0,
                    array(
                        'id' => 'input-add-catalog-parent-id'
                    ),
                    false);
            ?>
        </div>
    </div>
    <div class="div-row-add-catalog">
        <div class="label-add-catalog">
            Название
        </div>
        <div class="div-input-add-catalog">
            <?php
            echo $form->text('name', array(
                'id' => 'input-add-catalog-name'
            ));
            ?>
        </div>
    </div>
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#dialog-add-catalog').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    title: 'Добавление каталога',
    dialogClass: 'widget-add-catalog',
    resizable: true,
    buttons: {
        'Сохранить': function() {
            $('#form-add-catalog').submit();
        },
        'Отмена' : function() {
            $('#dialog-add-catalog').dialog('close');
        }
    }
})
</script>

<div id="dialog-edit-note">
    <h4 id="title-edit-note-catalog-name"></h4>
    <h3 id="caption-edit-note-catalog-name" class="caption-catalog-name"></h3>
    <?php
    echo $form->create('Catalog', array(
        'action' => 'edit_about',
        'id' => 'form-edit-note'
    ));
    ?>
    <textarea id="text-edit-note" name="data[note]"></textarea>
    <input type="hidden" value="" id="input-edit-note-id" name="data[catalog_id]">
    <input type="button" id="btn-cancel-edit-note" value="Отмена">
    <input type="submit" id="btn-submit-edit-note" value="Сохранить">
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#btn-cancel-edit-note').click(function() {
    $('#dialog-edit-note').hide();
});
$('#dialog-edit-note').appendTo(document.body);
var editor = CKEDITOR.replace('text-edit-note', {
    //filebrowserBrowseUrl: webroot+'img'
});

function show_edit_note(type, id, caption) {
    var note = notes[type];
    $('#title-edit-note-catalog-name').html(note.title);
    $('#caption-edit-note-catalog-name').html(caption);
    $('#input-edit-note-id').val(id);
    $('#text-edit-note').attr('name', note.name);
    editor.setData(note.notes[id]);

    var dlg = $('#dialog-edit-note');
    var dlg_width = dlg.width();
    var dlg_height = dlg.height();
    var scroll_top = $(window).scrollTop();
    var win_width = $(window).width();
    var win_height = $(window).height();

    dlg.css('left', (win_width-dlg_width)/2);
    dlg.css('top', scroll_top+(win_height-dlg_height)/2)
    dlg.show();
}
</script>

<div id="dialog-change-parent">
    <h3 id="caption-change-parent-catalog-name" class="caption-catalog-name"></h3>
    <?php
    echo $form->create('Catalog', array(
        'action' => 'change_parent',
        'id' => 'form-change-parent'
    ));
    ?>
    <div class="div-row-change-parent">
        <div class="label-change-parent">
            Перенести в
        </div>
        <div class="div-input-change-parent">
            <?php
            echo $form->select('parent_id',
                    $catalog_list,
                    $cur_catalog['Catalog']['id'],
                    array(
                        'id' => 'input-change-parent-parent-id'
                    ),
                    false);
            ?>
        </div>
    </div>
    <input type="hidden" value="" id="input-change-parent-catalog-id" name="data[Catalog][id]">
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#dialog-change-parent').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    dialogClass: 'widget-change-parent',
    title: 'Перемещение каталога',
    resizable: true,
    buttons: {
        'Сохранить': function() {
            $(this).dialog('close');
            //$('#form-change-parent').submit();
            $('#form-change-parent').ajaxSubmit({
                success: function() {
                    location.reload();
                }
            })
        },
        'Отмена' : function() {
            $('#dialog-change-parent').dialog('close');
        }
    }
});
</script>

<div id="dialog-delete-catalog">
    <h3 id="caption-delete-catalog-catalog-name" class="caption-catalog-name"></h3>
    <?php
    echo $form->create('Catalog', array(
        'action' => 'delete',
        'id' => 'form-delete-catalog'
    ));
    ?>
    <input type="hidden" value="" id="input-delete-catalog-catalog-id" name="data[catalog_id]">
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#dialog-delete-catalog').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    dialogClass: 'widget-delete-catalog',
    title: 'Удаление каталога',
    resizable: true,
    height: 120,
    buttons: {
        'Удалить': function() {
            $(this).dialog('close');
            //$('#form-delete-catalog').submit();
            $('#form-delete-catalog').ajaxSubmit({
                success: function() {
                    location.reload();
                }
            })
        },
        'Отмена' : function() {
            $('#dialog-delete-catalog').dialog('close');
        }
    }
});
</script>

<div id="dialog-producer">
    <div class="div-row-producer">
        <div class="label-producer">
            Выберите производителя
        </div>
        <div class="div-input-producer">
            <?php
            echo $form->select('producer_id',
                    $producer_list,
                    null,
                    array(
                        'id' => 'input-producer-producer-id'
                    ),
                    false);
            ?>
        </div>
    </div>
    <span style="color: red;">Внимание: все товары каталога также сменят производителя</span>
</div>

<script type="text/javascript">
$(".input-producer-name").click(function() {
    var li_product = $(this).parent().parent();
    var catalog_id = li_product.attr('catalog_id');
    var input_producer_id = li_product.find('.input-producer-id');
    $('#input-producer-producer-id').val(input_producer_id.val());
    $('#input-producer-producer-id').attr('catalog_id', catalog_id);
    $('#dialog-producer').dialog('open');
});

$('#dialog-producer').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    dialogClass: 'widget-move-to-param',
    title: 'Выбор производителя',
    resizable: true,
    width: 300,
    height: 150,
    buttons: {
        'Выбрать': function() {
            var catalog_id = $('#input-producer-producer-id').attr('catalog_id');
            var producer_id = $('#input-producer-producer-id').val();
            var producer_name = producers[producer_id];

            var li_product = $('#li-'+catalog_id);
            var input_producer_id = li_product.find('.input-producer-id');
            input_producer_id.val(producer_id);
            input_producer_id.addClass('input-changed');

            var input_producer_name = li_product.find('.input-producer-name');
            input_producer_name.val(producer_name);

            var td_producer = li_product.find('.td-producer');
            td_producer.addClass('div-changed');

            $('#dialog-producer').dialog('close');
        },
        'Отмена' : function() {
            $('#dialog-producer').dialog('close');
        }
    }
});
</script>