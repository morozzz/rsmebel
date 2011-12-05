<?php
$td_div_width = 52/(count($product_params)+4);
?>

<style type="text/css">
.td-image,
.td-producer,
.td-article,
.td-param,
.td-product-param
{
    width: <?php echo $td_div_width;?>%;
}
</style>

<?php echo $catalogCommon->getCatalogPathStr($path, 'adm_catalog');?>

<h1>Параметры товара "<?php echo $product['Product']['name'];?>"</h1>
<div class="head-actions">
    <?php echo $html->link('Столбцы', array(
        'controller' => 'product_params',
        'action' => 'index',
        $product['Product']['id']
    ), array(
        'class' => 'link-columns'
    ));?>
    <?php echo $html->link('Списки', array(
        'controller' => 'product_det_param_values',
        'action' => 'adm_index'
    ), array(
        'class' => 'link-lists'
    ));?>
</div>

<div class="div-add-action">
    <a id="link-add" href="#" onclick="return false;">Добавить</a>
</div>

<div id="table-header">
    <div class="th-div td-id">Номер</div>
    <div class="th-div td-1c-code">1С-код</div>
    <div class="th-div td-image">Мал. изобр-е</div>
    <div class="th-div td-image">Бол. изобр-е</div>
    <div class="th-div td-producer">Произ-<br>водитель</div>

    <?php foreach($product_params as $product_param) { ?>
    <div class="th-div td-product-param">
        <?php echo $product_param['ProductParamType']['name'];?>
    </div>
    <?php } ?>

    <div class="th-div td-article">Артикул</div>
    <div class="th-div td-price">Цена</div>
    <div class="th-div td-cnt">Кол-во</div>
    <div class="th-div td-sort-order">Сорт-ка</div>
    <div class="th-div td-action">Действие</div>
</div>

<ul id="table-body">
    <?php foreach($product_dets as $product_det_id => $product_det) {
        $code_1c = $product_det['ProductDet']['code_1c'];
        $article = $product_det['ProductDet']['article'];
        $price = $product_det['ProductDet']['price'];
        $cnt = $product_det['ProductDet']['cnt'];
        $sort_order = $product_det['ProductDet']['sort_order'];
        
        $producer_id = $product_det['Producer']['id'];
        $producer_name = htmlspecialchars($product_det['Producer']['name']);

        $small_image_id = $product_det['ProductDet']['small_image_id'];
        $small_image_url = $product_det['SmallImage']['url'];

        $big_image_id = $product_det['ProductDet']['big_image_id'];
        $big_image_url = $product_det['BigImage']['url'];

        $is_special = $product_det['is_special'];
    ?>
    <li product_det_id="<?php echo $product_det_id;?>"
        class="table-row<?php if($is_special == 1) echo ' tr-special';?>"
        id="li-<?php echo $product_det_id;?>">
        <div class="td-div td-id">
            <h2><?php echo $product_det_id;?></h2>
        </div> <div class="td-div td-1c-code">
            <span class="span-1c-code"><?php echo $code_1c; ?></span>
        </div> <div class="td-div td-image">
            <?php echo $html->image($small_image_url, array(
                'class' => 'show-image',
                'height' => 30
            )); ?>
            <div append_to="div-dialog-small-image-<?php echo $product_det_id;?>"
                 class="link-dialog"
                 id="link-dialog-small-image-<?php echo $product_det_id;?>">
                <a href="#" onclick="return false;" style="width: 100%;">
                    Загрузить
                </a>
            </div>
            <div class="div-dialog"
                 id="div-dialog-small-image-<?php echo $product_det_id;?>"
                 title="Загрузка маленького изображения"
                 dialog_height="110"
                 append_to="link-dialog-small-image-<?php echo $product_det_id;?>">
                <input type="file"
                       size="30"
                       class="input-image"
                       name="data<?php
                            if(empty($small_image_id)) {
                                echo "[ProductDet][$product_det_id][small_image_file]";
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
            <div append_to="div-dialog-big-image-<?php echo $product_det_id;?>"
                 class="link-dialog"
                 id="link-dialog-big-image-<?php echo $product_det_id;?>">
                <a href="#" onclick="return false;" style="width: 100%;">
                    Загрузить
                </a>
            </div>
            <div class="div-dialog"
                 id="div-dialog-big-image-<?php echo $product_det_id;?>"
                 title="Загрузка большого изображения"
                 dialog_height="110"
                 append_to="link-dialog-big-image-<?php echo $product_det_id;?>">
                <input type="file"
                       size="30"
                       class="input-image"
                       name="data<?php
                            if(empty($big_image_id)) {
                                echo "[ProductDet][$product_det_id][big_image_file]";
                            } else {
                                echo "[Image][$big_image_id]";
                            }
                       ?>">
            </div>
        </div> <div class="td-div td-producer">
            <input class="input-data input-producer-name"
                   readonly
                   value="<?php echo $producer_name;?>">
            <input class="input-producer-id"
                   type="hidden"
                   value="<?php echo $producer_id;?>"
                   name="data[ProductDet][<?php echo $product_det_id;?>][producer_id]">
        </div>

        <?php
//        $product_det['ProductDetParam'] = Set::combine($product_det['ProductDetParam'],
//                '{n}.ProductDetParam.product_param_id', '{n}');
        foreach($product_params as $product_param_id => $product_param) {
            $product_det_param = $product_det['ProductDetParam'][$product_param_id];
//        foreach($product_det['ProductDetParam'] as $product_det_param) {
        ?>
        <div class="td-div td-param">
            <?php
//            $product_param_id = $product_det_param['ProductDetParam']['product_param_id'];
//            $product_param = $product_params[$product_param_id];
            $input_name = "data[ProductDet][$product_det_id][ProductParam][$product_param_id]";
            if($product_param['ProductParam']['product_param_show_type_id'] == 1) { ?>
            <input class="input-data input-save-all-form input-param"
                   value="<?php echo htmlspecialchars($product_det_param['ProductDetParam']['value']);?>"
                   name="<?php echo $input_name;?>[value]">
            <?php } else if($product_param['ProductParam']['product_param_show_type_id'] == 2) {
            ?>
            <input class="input-data input-param"
                   readonly
                   value="<?php echo htmlspecialchars($product_det_param['ProductDetParamValue']['name']);?>"
                   product_det_id="<?php echo $product_det_id;?>"
                   product_param_id="<?php echo $product_param_id;?>">
            <input class="input-param-hidden"
                   type="hidden"
                   value="<?php echo $product_det_param['ProductDetParamValue']['id'];?>"
                   name="<?php echo $input_name;?>[product_det_param_value_id]"
                   product_det_id="<?php echo $product_det_id;?>"
                   product_param_id="<?php echo $product_param_id;?>">
            <?php } ?>
        </div>
        <?php } ?>

        <div class="td-div td-article">
            <input class="input-data input-save-all-form input-article"
                   value="<?php echo $article;?>"
                   name="data[ProductDet][<?php echo $product_det_id;?>][article]">
        </div> <div class="td-div td-price">
            <input class="input-data input-save-all-form input-price textbox-float"
                   value="<?php echo $price;?>"
                   name="data[ProductDet][<?php echo $product_det_id;?>][price]">
        </div> <div class="td-div td-cnt">
            <input class="input-data input-save-all-form input-cnt textbox-int"
                   value="<?php echo $cnt;?>"
                   name="data[ProductDet][<?php echo $product_det_id;?>][cnt]">
        </div> <div class="td-div td-sort-order">
            <input class="input-data input-save-all-form input-sort-order textbox-int"
                   value="<?php echo $sort_order;?>"
                   name="data[ProductDet][<?php echo $product_det_id;?>][sort_order]">
        </div> <div class="td-div td-action">
            <select product_det_id="<?php echo $product_det_id;?>"
                    class="select-action">
                <option selected="selected" value="0">Выберите действие</option>
                <option value="edit_short_about">Редактировать краткое описание</option>
                <option value="edit_long_about">Редактировать полное описание</option>
                <option value="move_to_product">Перенести в товары</option>
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

    <?php echo $form->create('ProductDet', array(
        'action' => 'save_list',
        'id' => 'form-save-all',
        'type' => 'file'
    ));?>
    <div id="div-form-save-all" style="display: none;">
    </div>
    <?php echo $form->end();?>

    <a id="link-save-all" href="#" onclick="return false;">Сохранить</a>
</ul>

<script type="text/javascript">
    var webroot = '<?php echo $this->webroot; ?>';

    <?php
    $short_notes = Set::combine($product_dets, '{n}.ProductDet.id', '{n}.ProductDet.short_about');
    $long_notes = Set::combine($product_dets, '{n}.ProductDet.id', '{n}.ProductDet.long_about');
    $product_param_list = Set::combine($product_params, '{n}.ProductParam.id', '{n}.ProductParamType.name');
    ?>
    var short_notes = <?php echo $javascript->object($short_notes);?>;
    var long_notes = <?php echo $javascript->object($long_notes);?>;
    var notes = {
        'short': {
            name: 'data[short_about]',
            title: 'Редактирование краткого описания',
            notes: short_notes
        },
        'long': {
            name: 'data[long_about]',
            title: 'Редактирование полного описания',
            notes: long_notes
        }
    };
    var product_param_list = <?php echo $javascript->object($product_param_list);?>;
    var product_det_param_value_list = <?php echo $javascript->object($product_det_param_value_list);?>;
    var producers = <?php echo $javascript->object($producer_list);?>;

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

        $('#link-save-all').click(function() {
            $('.input-changed').clone().appendTo('#div-form-save-all');
            $('.input-file-changed').appendTo('#div-form-save-all');

            $('#form-save-all').submit();
        });

        $('#table-body').sortable({
            scrollSpeed: 5,
            update: function(event, ui) {
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
            var product_det_id = $(this).attr('product_det_id');
            switch(action) {
                case 'edit_short_about':
                    show_edit_note('short', product_det_id, product_det_id);
//                    $('#dialog-edit-note').dialog('option', 'title', 'Редактирование краткого описания');
//                    $('#text-edit-note').attr('name', 'data[short_about]');
//                    $('#text-edit-note').val(short_notes[product_det_id]);
//                    $('#input-edit-note-product-det-id').val(product_det_id);
//                    $('#caption-edit-note-product-det-id').html(product_det_id);
//                    $('#dialog-edit-note').dialog('open');
                    break;
                case 'edit_long_about':
                    show_edit_note('long', product_det_id, product_det_id);
//                    $('#dialog-edit-note').dialog('option', 'title', 'Редактирование полного описания');
//                    $('#text-edit-note').attr('name', 'data[long_about]');
//                    $('#text-edit-note').val(long_notes[product_det_id]);
//                    $('#input-edit-note-product-det-id').val(product_det_id);
//                    $('#caption-edit-note-product-det-id').html(product_det_id);
//                    $('#dialog-edit-note').dialog('open');
                    break;
                case 'move_to_product':
                    $('#input-move-to-product-product-det-id').val(product_det_id);
                    $('#input-move-to-product-catalog-id').val(<?php echo $product['Product']['catalog_id'];?>);
                    $('#caption-move-to-product-product-det-id').html(product_det_id);
                    $('#dialog-move-to-product').dialog('open');
                    break;
                case 'add_to_special':
                    $.ajax({
                        url: webroot+'specials/add/product_det_id:'+product_det_id,
                        context: $('#li-'+product_det_id),
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
                        url: webroot+'specials/delete/product_det_id:'+product_det_id,
                        context: $('#li-'+product_det_id),
                        success: function(data) {
                            this.removeClass('tr-special');
                            var option = this.find('select.select-action option[value=delete_from_special]');
                            option.attr('value', 'add_to_special');
                            option.html('Добавить в спецпредложения');
                        }
                    });
                    break;
                case 'delete':
                    $('#input-delete-product-det-id').val(product_det_id);
                    $('#caption-delete-product-det-id').html(product_det_id);
                    $('#dialog-delete').dialog('open');
                    break;
            }
            $(this).val(0);
        });
    });
</script>

<div id="dialog-product-param">
    <div class="dialog-div-row">
        <div class="dialog-label">

        </div>
        <div class="dialog-div-input">
            <?php
            echo $form->select('',
                    $product_det_param_value_list,
                    null,
                    array(
                        'id' => 'dialog-input-param',
                        'class' => 'dialog-input'
                    ),
                    false);
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
$(".input-param[readonly]").click(function() {
    var product_det_id = $(this).attr('product_det_id');
    var product_param_id = $(this).attr('product_param_id');
    var product_param_name = product_param_list[product_param_id];
    var input_hidden = $(this).parent().find('.input-param-hidden');
    var value = input_hidden.val();

    $('#dialog-product-param .dialog-label').html(product_param_name);
    $('#dialog-input-param').val(value);
    $('#dialog-product-param').attr('product_det_id', product_det_id);
    $('#dialog-product-param').attr('product_param_id', product_param_id);

    $('#dialog-product-param').dialog('option', 'title', 'Выберите '+product_param_name);
    $('#dialog-product-param').dialog('open');
});

$('#dialog-product-param').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    dialogClass: 'widget-move-to-param',
    resizable: true,
    width: 300,
    height: 110,
    buttons: {
        'Выбрать': function() {
            var product_det_id = $(this).attr('product_det_id');
            var product_param_id = $(this).attr('product_param_id');

            var input =
                $('.input-param[product_det_id='+product_det_id+
                '][product_param_id='+product_param_id+']');
            var input_hidden =
                $('.input-param-hidden[product_det_id='+product_det_id+
                '][product_param_id='+product_param_id+']');

            var val = $('#dialog-input-param').val();

            input.val(product_det_param_value_list[val]);
            input_hidden.val(val);

            input_hidden.addClass('input-changed');
            input_hidden.parent().addClass('div-changed');

            $(this).dialog('close');
        },
        'Отмена' : function() {
            $('#dialog-product-param').dialog('close');
        }
    }
});
</script>

<div id="dialog-add">
    <!--<span style="color: red; font-size: 12px;">
        Вы можете указать 1С-код создаваемого параметра. Остальные параметры можно
        будет изменить после его создания
    </span>-->
    <?php
    echo $form->create('ProductDet', array(
        'action' => 'add',
        'id' => 'form-add',
        'type' => 'file'
    ));
    ?>
    <div class="dialog-div-row">
        <div class="dialog-label">
            Цена
        </div>
        <div class="dialog-div-input">
            <?php
            echo $form->text('price', array(
                'id' => 'input-add-price',
                'class' => 'dialog-input'
            ));
            ?>
        </div>
        <div class="dialog-label">
            Количество
        </div>
        <div class="dialog-div-input">
            <?php
            echo $form->text('cnt', array(
                'id' => 'input-add-cnt',
                'class' => 'dialog-input'
            ));
            ?>
        </div>
    </div>
    <input type="hidden"
           name="data[ProductDet][product_id]"
           value="<?php echo $product['Product']['id'];?>"
           id="input-add-product-id">
    <?php echo $form->end();?>
</div>

<script type="text/javascript">
$('#dialog-add').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    title: 'Добавление параметра товара',
    dialogClass: 'widget-add',
    resizable: true,
    width: 400,
    buttons: {
        'Сохранить': function() {
            $('#form-add').submit();
        },
        'Отмена' : function() {
            $('#dialog-add').dialog('close');
        }
    }
});

$('#link-add').click(function() {
    $('#input-add-product-id').val(<?php echo $product['Product']['id'];?>);
    $('#input-add-price').val('');
    $('#input-add-cnt').val('');
    $('#dialog-add').dialog('open');
});
</script>

<div id="dialog-edit-note">
    <h4 id="title-edit-note-product-det-id"></h4>
    <h3 id="caption-edit-note-product-det-id" class="caption-product-det-id"></h3>
    <?php
    echo $form->create('ProductDet', array(
        'action' => 'edit_about',
        'id' => 'form-edit-note'
    ));
    ?>
    <textarea id="text-edit-note" name="data[note]"></textarea>
    <input type="hidden" value="" id="input-edit-note-id" name="data[product_det_id]">
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
    $('#title-edit-note-product-det-id').html(note.title);
    $('#caption-edit-note-product-det-id').html(caption);
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

<div id="dialog-move-to-product">
    <h3 id="caption-move-to-product-product-det-id" class="caption-product-det-id"></h3>
    <?php
    echo $form->create('ProductDet', array(
        'action' => 'move_to_product',
        'id' => 'form-move-to-product'
    ))
    ?>
    <div class="dialog-div-row">
        <div class="dialog-label">
            Переместить в
        </div>
        <div class="dialog-div-input">
            <?php
            echo $form->select('catalog_id',
                    $catalog_list,
                    $product['Product']['id'],
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
           id="input-move-to-product-product-det-id"
           name="data[ProductDet][product_det_id]">
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
    title: 'Перемещение в каталог',
    resizable: true,
    width: 350,
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

<div id="dialog-delete">
    <h3 id="caption-delete-product-det-id" class="caption-product-det-id"></h3>
    <?php
    echo $form->create('ProductDet', array(
        'action' => 'delete',
        'id' => 'form-delete'
    ));
    ?>
    <input type="hidden" value="" id="input-delete-product-det-id" name="data[product_det_id]">
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#dialog-delete').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    dialogClass: 'widget-delete',
    title: 'Удаление параметра',
    resizable: true,
    buttons: {
        'Удалить': function() {
            $('#form-delete').submit();
        },
        'Отмена' : function() {
            $('#dialog-delete').dialog('close');
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
</div>

<script type="text/javascript">
$(".input-producer-name").click(function() {
    var li_product_det = $(this).parent().parent();
    var product_det_id = li_product_det.attr('product_det_id');
    var input_producer_id = li_product_det.find('.input-producer-id');
    $('#input-producer-producer-id').val(input_producer_id.val());
    $('#input-producer-producer-id').attr('product_det_id', product_det_id);
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
            var product_det_id = $('#input-producer-producer-id').attr('product_det_id');
            var producer_id = $('#input-producer-producer-id').val();
            var producer_name = producers[producer_id];

            var li_product_det = $('#li-'+product_det_id);
            var input_producer_id = li_product_det.find('.input-producer-id');
            input_producer_id.val(producer_id);
            input_producer_id.addClass('input-changed');

            var input_producer_name = li_product_det.find('.input-producer-name');
            input_producer_name.val(producer_name);

            var td_producer = li_product_det.find('.td-producer');
            td_producer.addClass('div-changed');

            $('#dialog-producer').dialog('close');
        },
        'Отмена' : function() {
            $('#dialog-producer').dialog('close');
        }
    }
});
</script>