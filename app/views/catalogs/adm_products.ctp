<?php
$cur_catalog = $catalog;
$paginator->options(array('url' => $this->params['pass']));
?>

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

            <?php $productCommon->print_pagination_table($paginator, $limit);?>

            <div class="div-add-action">
                <a id="link-add-product" href="#" onclick="return false;">Добавить</a>
            </div>
            <div class="div-add-action">
                <a id="link-get-csv"
                   target="_blank"
                   href="<?php echo $html->url('/catalogs/get_csv/'.$catalog['Catalog']['id']);?>">
                    Выгрузка в CSV
                </a>
            </div>

            <div id="table-header">
                <div class="td-checkbox"></div>
                <div class="td-product-name">Название</div>
                <div class="td-producer">Произво-дитель</div>
                <div class="td-1c-code">1С-код</div>
                <div class="td-image">Мал. изобр-е</div>
                <div class="td-image">Бол. изобр-е</div>
                <div class="td-article">Артикул</div>
                <div class="td-price">Цена</div>
                <div class="td-cnt">Кол-во</div>
                <div class="td-sort-order">Сорт-ка</div>
                <div class="td-action">Действие</div>
            </div>
            <ul id="table-body">
                <?php foreach($products as $product) {
                    $product_id = $product['Product']['id'];

                    $name = htmlspecialchars($product['Product']['name']);
                    $producer_id = $product['Producer']['id'];
                    $producer_name = htmlspecialchars($product['Producer']['name']);
                    $code_1c = $product['Product']['code_1c'];
                    $article = $product['Product']['article'];
                    $price = $product['Product']['price'];
                    $cnt = $product['Product']['cnt'];
                    $sort_order = $product['Product']['sort_order'];

                    $small_image_id = $product['Product']['small_image_id'];
                    $small_image_url = $product['SmallImage']['url'];

                    $big_image_id = $product['Product']['big_image_id'];
                    $big_image_url = $product['BigImage']['url'];

                    $is_special = $product['is_special'];
                ?>
                <li product_id="<?php echo $product_id;?>"
                    class="table-row<?php if($is_special == 1) echo ' tr-special';?>"
                    id="li-<?php echo $product_id;?>">
                    <div class="td-div td-checkbox">
                        <input class="checkbox-product"
                               type="checkbox"
                               value="<?php echo $product_id;?>"
                               name="data[products_id][]">
                    </div> <div class="td-div td-product-name">
                        <input class="input-save-all-form input-product-name"
                               value="<?php echo $name;?>"
                               name="data[Product][<?php echo $product_id;?>][name]">
                    </div> <div class="td-div td-producer">
                        <input class="input-producer-name"
                               readonly
                               value="<?php echo $producer_name;?>">
                        <input class="input-producer-id"
                               type="hidden"
                               value="<?php echo $producer_id;?>"
                               name="data[Product][<?php echo $product_id;?>][producer_id]">
                    </div> <div class="td-div td-1c-code">
                        <span class="span-1c-code"><?php echo $code_1c; ?></span>
                    </div> <div class="td-div td-image">
                        <?php echo $html->image($small_image_url, array(
                            'class' => 'show-image',
                            'height' => 30
                        )); ?>
                        <div append_to="div-dialog-small-image-<?php echo $product_id;?>"
                             class="link-dialog"
                             id="link-dialog-small-image-<?php echo $product_id;?>">
                            <a href="#" onclick="return false;" style="width: 100%;">
                                Загрузить
                            </a>
                        </div>
                        <div class="div-dialog"
                             id="div-dialog-small-image-<?php echo $product_id;?>"
                             title="Загрузка маленького изображения"
                             dialog_height="110"
                             append_to="link-dialog-small-image-<?php echo $product_id;?>">
                            <input type="file"
                                   size="30"
                                   class="input-image"
                                   name="data<?php
                                        if(empty($small_image_id)) {
                                            echo "[Product][$product_id][small_image_file]";
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
                        <div append_to="div-dialog-big-image-<?php echo $product_id;?>"
                             class="link-dialog"
                             id="link-dialog-big-image-<?php echo $product_id;?>">
                            <a href="#" onclick="return false;" style="width: 100%;">
                                Загрузить
                            </a>
                        </div>
                        <div class="div-dialog"
                             id="div-dialog-big-image-<?php echo $product_id;?>"
                             title="Загрузка большого изображения"
                             dialog_height="110"
                             append_to="link-dialog-big-image-<?php echo $product_id;?>">
                            <input type="file"
                                   size="30"
                                   class="input-image"
                                   name="data<?php
                                        if(empty($big_image_id)) {
                                            echo "[Product][$product_id][big_image_file]";
                                        } else {
                                            echo "[Image][$big_image_id]";
                                        }
                                   ?>">
                        </div>
                    </div> <div class="td-div td-article">
                        <input class="input-save-all-form input-article"
                               value="<?php echo $article;?>"
                               name="data[Product][<?php echo $product_id;?>][article]">
                    </div> <div class="td-div td-price">
                        <input class="input-save-all-form input-price textbox-float"
                               value="<?php echo $price;?>"
                               name="data[Product][<?php echo $product_id;?>][price]">
                    </div> <div class="td-div td-cnt">
                        <input class="input-save-all-form input-cnt textbox-int"
                               value="<?php echo $cnt;?>"
                               name="data[Product][<?php echo $product_id;?>][cnt]">
                    </div> <div class="td-div td-sort-order">
                        <input class="input-save-all-form input-sort-order textbox-int"
                               value="<?php echo $sort_order;?>"
                               name="data[Product][<?php echo $product_id;?>][sort_order]">
                    </div> <div class="td-div td-action">
                        <select catalog_id="<?php echo $product_id;?>"
                                class="select-action">
                            <option selected="selected" value="0">Выберите действие</option>
                            <option value="go_to_param">Перейти к параметрам</option>
                            <option value="edit_short_about">Редактировать краткое описание</option>
                            <option value="edit_long_about">Редактировать полное описание</option>
                            <option value="change_catalog">Сменить каталог</option>
                            <option value="move_to_param">Перенести в параметры</option>
                            <option value="move_to_product">Перенести параметры в товары</option>
                            <?php if($is_special == 1) { ?>
                            <option value="delete_from_special">Удалить из спецпредложений</option>
                            <?php } else { ?>
                            <option value="add_to_special">Добавить в спецпредложения</option>
                            <?php } ?>
                            <option value="delete">Удалить</option>
                        </select>
                    </div>
                </li>
                <?php } ?>
            </ul>

            <?php echo $form->create('Product', array(
                'action' => 'save_list',
                'id' => 'product-save-all',
                'type' => 'file'
            ));?>
            <div id="div-product-save-all" style="display: none;">
            </div>
            <?php echo $form->end();?>

            <a id="link-product-save-all" href="#" onclick="return false;">Сохранить</a>
            <a id="link-product-concat-products" href="#" onclick="return false;">Объединить</a>
        </td>
    </tr>
</table>

<script type="text/javascript">
    var webroot = '<?php echo $this->webroot; ?>';
    var products = false;

    //catalogs
    <?php
    $products_short_notes = Set::combine($products, '{n}.Product.id', '{n}.Product.short_about');
    $products_long_notes = Set::combine($products, '{n}.Product.id', '{n}.Product.long_about');
    $products_name = Set::combine($products, '{n}.Product.id', '{n}.Product.name');
    ?>
    var products_short_notes = <?php echo $javascript->object($products_short_notes);?>;
    var products_long_notes = <?php echo $javascript->object($products_long_notes);?>;
    var notes = {
        'short': {
            name: 'data[short_about]',
            title: 'Редактирование краткого описания',
            notes: products_short_notes
        },
        'long': {
            name: 'data[long_about]',
            title: 'Редактирование полного описания',
            notes: products_long_notes
        }
    };
    var products_name = <?php echo $javascript->object($products_name);?>;
    var producers = <?php echo $javascript->object($producer_list);?>;
    /////////////

    //pagination options
    var page = <?php echo $page;?>;
    var limit = <?php echo $limit;?>;
    /////////////

    $(document).ready(function() {
        enable_validation();
        enable_image_show();
        enable_link_dialog();
        enable_ajax_waiting();

        $('#pagination-input-limit').change(function() {
            var limit = $('#pagination-input-limit option:selected').val();

            var url = "<?php echo $paginator->url(array_merge((array)$paginator->options['url'], array('limit' => null, 'page' => null)));?>";
            url += '/limit:'+limit;
            window.location = url;
        });

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
            $('.input-product-name').focus(function() {
                $(this).parent().parent().find('.td-div').css('visibility', 'hidden');
                $(this).parent().css('visibility', 'visible');
                $(this).animate({
                    width: 500
                });
            });

            $('.input-product-name').blur(function() {
                $(this).animate({
                    width: '90%'
                }, 'normal', function() {
                    $(this).parent().parent().find('.td-div').css('visibility', 'visible');
                });
            });
        }

        $('#link-product-save-all').click(function() {
            $('.input-changed').clone().appendTo('#div-product-save-all');
            $('.input-file-changed').appendTo('#div-product-save-all');

            $('#product-save-all').submit();
        });

        $('#table-body').sortable({
            scrollSpeed: 5,
            update: function(event, ui) {
                var array = $('#table-body').sortable('toArray');
                for(var key in array) {
                    var li_id = array[key];
                    $('#'+li_id).find('.input-sort-order').val(parseInt(key)+limit*(page-1)+1);
                }
                $('.input-sort-order').parent().addClass('div-changed');
                $('.input-sort-order').addClass('input-changed');
            }
        });

        $('.select-action').change(function() {
            var action = $(this).val();
            var product_id = $(this).parent().parent().attr('product_id');
            switch(action) {
                case 'go_to_param':
                    //window.location = webroot+'products/edit_param/'+product_id;
                    window.location = webroot+'product_dets/index/'+product_id;
                    break;
                case 'edit_short_about':
                    show_edit_note('short', product_id, products_name[product_id]);
                    //$('#dialog-edit-note').dialog('option', 'title', 'Редактирование краткого описания');
//                    $('#title-edit-note-product-name').html('Редактирование краткого описания');
//                    $('#text-edit-note').attr('name', 'data[short_about]');
//                    $('#text-edit-note').val(products_short_notes[product_id]);
//                    editor.setData(products_short_notes[product_id]);
//                    $('#input-edit-note-product-id').val(product_id);
//                    $('#caption-edit-note-product-name').html(products_name[product_id]);
//                    $('#dialog-edit-note').show();
//                    $('#dialog-edit-note').dialog('open');
                    break;
                case 'edit_long_about':
                    show_edit_note('long', product_id, products_name[product_id]);
                    //$('#dialog-edit-note').dialog('option', 'title', 'Редактирование полного описания');
//                    $('#title-edit-note-product-name').html('Редактирование полного описания');
//                    $('#text-edit-note').attr('name', 'data[long_about]');
                    //$('#text-edit-note').val(products_long_notes[product_id]);
//                    editor.setData(products_long_notes[product_id]);
//                    $('#input-edit-note-product-id').val(product_id);
//                    $('#caption-edit-note-product-name').html(products_name[product_id]);
//                    $('#dialog-edit-note').show();
//                    $('#dialog-edit-note').dialog('open');
                    break;
                case 'change_catalog':
                    $('#input-change-catalog-catalog-id').val(<?php echo $cur_catalog['Catalog']['id'];?>);
                    $('#caption-change-catalog-product-name').html(products_name[product_id]);
                    $('#input-change-catalog-product-id').val(product_id);
                    $('#dialog-change-catalog').dialog('open');
                    break;
                case 'move_to_param':
                    $('#input-move-to-param-product-id').val('');
                    $('#caption-move-to-param-product-name').html(products_name[product_id]);
                    $('#input-move-to-param-moving-product-id').val(product_id);
                    $('#dialog-move-to-param').dialog('open');
                    break;





                case 'move_to_product':
                    $('#input-move-to-product-product-id').val(product_id);
                    $('#input-move-to-product-catalog-id').val(<?php echo $cur_catalog['Catalog']['id'];?>);
                    $('#caption-move-to-product-product-name').html(products_name[product_id]);
                    $('#dialog-move-to-product').dialog('open');
                    break;





                case 'add_to_special':
                    $.ajax({
                        url: webroot+'specials/add/product_id:'+product_id,
                        context: $('#li-'+product_id),
                        success: function(data) {
                            this.addClass('tr-special');
                            var option = this.find('select.select-action option[value=add_to_special]');
                            option.attr('value', 'delete_from_special');
                            option.html('Удалить из спецпредложений');
                        }
                    });
                    break;
                case 'delete_from_special':
                    $.ajax({
                        url: webroot+'specials/delete/product_id:'+product_id,
                        context: $('#li-'+product_id),
                        success: function(data) {
                            this.removeClass('tr-special');
                            var option = this.find('select.select-action option[value=delete_from_special]');
                            option.attr('value', 'add_to_special');
                            option.html('Добавить в спецпредложения');
                        }
                    });
                    break;
                case 'delete':
                    $('#input-delete-product-product-id').val(product_id);
                    $('#caption-delete-product-product-name').html(products_name[product_id]);
                    $('#dialog-delete-product').dialog('open');
                    break;
            }
            $(this).val(0);
        });
    });
</script>

<div id="dialog-edit-note">
    <h4 id="title-edit-note-product-name"></h4>
    <h3 id="caption-edit-note-product-name" class="caption-product-name"></h3>
    <?php
    echo $form->create('Product', array(
        'action' => 'edit_about',
        'id' => 'form-edit-note'
    ));
    ?>
    <textarea id="text-edit-note" name="data[note]"></textarea>
    <input type="hidden" value="" id="input-edit-note-id" name="data[product_id]">
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

var editor = CKEDITOR.replace('text-edit-note');

function show_edit_note(type, id, caption) {
    var note = notes[type];
    $('#title-edit-note-product-name').html(note.title);
    $('#caption-edit-note-product-name').html(caption);
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

<div id="dialog-change-catalog">
    <h3 id="caption-change-catalog-product-name" class="caption-product-name"></h3>
    <?php
    echo $form->create('Product', array(
        'action' => 'change_catalog',
        'id' => 'form-change-catalog'
    ));
    ?>
    <div class="div-row-change-catalog">
        <div class="label-change-catalog">
            Перенести в
        </div>
        <div class="div-input-change-catalog">
            <?php
            echo $form->select('catalog_id',
                    $catalog_list,
                    $cur_catalog['Catalog']['id'],
                    array(
                        'id' => 'input-change-catalog-catalog-id'
                    ),
                    false);
            ?>
        </div>
    </div>
    <input type="hidden" value="" id="input-change-catalog-product-id" name="data[Product][id]">
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#dialog-change-catalog').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    dialogClass: 'widget-change-catalog',
    title: 'Перемещение товара',
    resizable: true,
    buttons: {
        'Сохранить': function() {
            $('#form-change-catalog').submit();
        },
        'Отмена' : function() {
            $('#dialog-change-catalog').dialog('close');
        }
    }
});
</script>

<div id="dialog-move-to-param">
    <h3 id="caption-move-to-param-product-name" class="caption-product-name"></h3>
    <?php
    echo $form->create('Product', array(
        'action' => 'move_to_param',
        'id' => 'form-move-to-param'
    ));
    ?>
    <div class="div-row-move-to-param">
        <div class="label-move-to-param">
            Товар, в параметры которого нужно перенести
        </div>
        <div class="div-input-move-to-param">
            <?php
            echo $form->select('product_id',
                    $product_list,
                    null,
                    array(
                        'id' => 'input-move-to-param-product-id'
                    ),
                    false);
            ?>
        </div>
    </div>
    <input type="hidden"
           value=""
           id="input-move-to-param-moving-product-id"
           name="data[Product][moving_product_id]">
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#dialog-move-to-param').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    dialogClass: 'widget-move-to-param',
    title: 'Перемещение товара в параметры',
    resizable: true,
    width: 350,
    buttons: {
        'Сохранить': function() {
            $('#form-move-to-param').submit();
        },
        'Отмена' : function() {
            $('#dialog-move-to-param').dialog('close');
        }
    }
});
</script>

<div id="dialog-move-to-product">
    <h3 id="caption-move-to-product-product-name" class="caption-product-name"></h3>
    <?php
    echo $form->create('ProductDet', array(
        'action' => 'move_all_to_product',
        'id' => 'form-move-to-product'
    ))
    ?>
    <div class="dialog-div-row">
        <div class="dialog-label">
            Переместить в (каталог)
        </div>
        <div class="dialog-div-input">
            <?php
            echo $form->select('catalog_id',
                    $catalog_list,
                    $cur_catalog['Catalog']['id'],
                    array(
                        'id' => 'input-move-to-product-catalog-id',
                        'class' => 'dialog-input'
                    ),
                    false);
            ?>
        </div>
    </div>
    <input type="hidden"
           value=""
           id="input-move-to-product-product-id"
           name="data[ProductDet][product_id]">
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#dialog-move-to-product').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    dialogClass: 'widget-move-to-product',
    title: 'Перемещение параметров в товары',
    resizable: true,
    width: 450,
    buttons: {
        'Сохранить': function() {
            $('#form-move-to-product').submit();
        },
        'Отмена' : function() {
            $('#dialog-move-to-product').dialog('close');
        }
    }
});
</script>

<div id="dialog-delete-product">
    <h3 id="caption-delete-product-product-name" class="caption-product-name"></h3>
    <?php
    echo $form->create('Product', array(
        'action' => 'delete',
        'id' => 'form-delete-product'
    ));
    ?>
    <input type="hidden" value="" id="input-delete-product-product-id" name="data[product_id]">
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#dialog-delete-product').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    dialogClass: 'widget-delete-product',
    title: 'Удаление товара',
    resizable: true,
    buttons: {
        'Удалить': function() {
            $('#form-delete-product').submit();
        },
        'Отмена' : function() {
            $('#dialog-delete-product').dialog('close');
        }
    }
});
</script>

<div id="dialog-add-product">
    <?php
    echo $form->create('Product', array(
        'action' => 'add',
        'id' => 'form-add-product'
    ));
    ?>
    <div class="div-row-add-product">
        <div class="label-add-product">
            Добавить в
        </div>
        <div class="div-input-add-product">
            <?php
            echo $form->select('catalog_id',
                    $catalog_list,
                    $cur_catalog['Catalog']['id'],
                    array(
                        'id' => 'input-add-product-catalog-id'
                    ),
                    false);
            ?>
        </div>
    </div>
    <div class="div-row-add-product">
        <div class="label-add-product">
            Название
        </div>
        <div class="div-input-add-product">
            <?php
            echo $form->text('name', array(
                'id' => 'input-add-product-name'
            ));
            ?>
        </div>
    </div>
    <div class="div-row-add-product">
        <div class="label-add-product">
            Артикул
        </div>
        <div class="div-input-add-product">
            <?php
            echo $form->text('article', array(
                'id' => 'input-add-product-article'
            ));
            ?>
        </div>
    </div>
    <div class="div-row-add-product">
        <div class="label-add-product">
            Цена
        </div>
        <div class="div-input-add-product">
            <?php
            echo $form->text('price', array(
                'id' => 'input-add-product-price',
                'class' => 'textbox-float'
            ));
            ?>
        </div>
    </div>
    <div class="div-row-add-product">
        <div class="label-add-product">
            Количество
        </div>
        <div class="div-input-add-product">
            <?php
            echo $form->text('cnt', array(
                'id' => 'input-add-product-cnt',
                'class' => 'textbox-int'
            ));
            ?>
        </div>
    </div>
    <div class="div-row-add-product">
        <div class="label-add-product">
            Сортировка
        </div>
        <div class="div-input-add-product">
            <?php
            echo $form->text('sort_order', array(
                'id' => 'input-add-product-sort-order',
                'class' => 'textbox-int'
            ));
            ?>
        </div>
    </div>
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
enable_validation();

$('#dialog-add-product').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    title: 'Добавление товара',
    dialogClass: 'widget-add-product',
    resizable: true,
    buttons: {
        'Сохранить': function() {
            $('#form-add-product').submit();
        },
        'Отмена' : function() {
            $('#dialog-add-product').dialog('close');
        }
    }
});

$('#link-add-product').click(function() {
    $('#input-add-product-catalog-id').val(<?php echo $cur_catalog['Catalog']['id'];?>);
    $('#input-add-product-name').val('');
    $('#input-add-product-code-1c').val('');
    $('#input-add-product-article').val('');
    $('#input-add-product-price').val('');
    $('#input-add-product-cnt').val('');
    $('#input-add-product-sort-order').val(0);
    $('#dialog-add-product').dialog('open');
});
</script>

<div id="dialog-concat-products">
    <?php
    echo $form->create('Product', array(
        'action' => 'concat_products',
        'id' => 'form-concat-products'
    ));
    ?>
    <div class="div-row-concat-products">
        <div class="label-concat-products">
            Название
        </div>
        <div class="div-input-concat-products">
            <?php
            echo $form->text('name', array(
                'id' => 'input-concat-products-name'
            ));
            ?>
        </div>
    </div>
    <h4 id="caption-concat-products">Объединяемые товары:</h4>
    <ul id="list-concat-products">
    </ul>
    <input type="hidden" name="data[catalog_id]" id="input-concat-products-catalog-id" val="">
    <div id="div-concat-products-checkboxes" style="display: none;">
    </div>
    <?php echo $form->end();?>
</div>

<script type="text/javascript">
$('#dialog-concat-products').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    title: 'Объединение товаров',
    dialogClass: 'widget-concat-products',
    resizable: true,
    width: 450,
    buttons: {
        'Сохранить': function() {
            $('#form-concat-products').submit();
        },
        'Отмена' : function() {
            $('#dialog-concat-products').dialog('close');
        }
    }
});

$('#link-product-concat-products').click(function() {
    $('#input-concat-products-catalog-id').val(<?php echo $cur_catalog['Catalog']['id'];?>);
    $('#input-concat-products-name').val('');

    $('#list-concat-products').html('');
    $('#table-body .checkbox-product:checked').each(function() {
        var li = $(this).parent().parent();
        var input_product_name = li.find('.input-product-name');
        var product_name = input_product_name.val();
        $('#list-concat-products').append('<li>'+product_name+'</li>');
    });

    $('#div-concat-products-checkboxes').html('');
    $('.checkbox-product:checked').clone().appendTo('#div-concat-products-checkboxes');

    $('#dialog-concat-products').dialog('open');
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
</div>

<script type="text/javascript">
$(".input-producer-name").click(function() {
    var li_product = $(this).parent().parent();
    var product_id = li_product.attr('product_id');
    var input_producer_id = li_product.find('.input-producer-id');
    $('#input-producer-producer-id').val(input_producer_id.val());
    $('#input-producer-producer-id').attr('product_id', product_id);
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
    height: 110,
    buttons: {
        'Выбрать': function() {
            var product_id = $('#input-producer-producer-id').attr('product_id');
            var producer_id = $('#input-producer-producer-id').val();
            var producer_name = producers[producer_id];

            var li_product = $('#li-'+product_id);
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