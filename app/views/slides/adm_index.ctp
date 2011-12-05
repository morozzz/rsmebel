<?php
define("Model", 'Slide');
define("model", 'slide');
$items = $slides;
?>

<h1>Управление слайдшоу</h1>

<div class="div-add-action">
    <a id="link-add" href="#" onclick="return false;">Добавить</a>
</div>

<div id="table-header">
    <div class="th-div td-id">Номер</div>
    <div class="th-div td-image">Изображение</div>
    <div class="th-div td-link">Ссылка</div>
    <div class="th-div td-sort-order">Сорт-ка</div>
    <div class="td-action">Действие</div>
</div>

<ul id="table-body">
    <?php foreach($items as $item) {
        $id = $item[Model]['id'];
        $image_id = $item[Model]['image_id'];
        $image_url = $item['Image']['url'];
        $link = $item[Model]['link'];
        $sort_order = $item[Model]['sort_order'];
    ?>
    <li item_id="<?php echo $id;?>"
        class="table-row"
        id="li-<?php echo $id;?>">
        <div class="td-div td-id">
            <h2><?php echo $id;?></h2>
        </div> <div class="td-div td-image">
            <?php echo $html->image($image_url, array(
                'class' => 'show-image',
                'height' => 30
            )); ?>
            <div append_to="div-dialog-image-<?php echo $id;?>"
                 class="link-dialog"
                 id="link-dialog-image-<?php echo $id;?>">
                <a href="#" onclick="return false;" style="width: 100%;">
                    Загрузить
                </a>
            </div>
            <div class="div-dialog"
                 id="div-dialog-image-<?php echo $id;?>"
                 title="Загрузка изображения"
                 dialog_height="110"
                 append_to="link-dialog-image-<?php echo $id;?>">
                <input type="file"
                       size="30"
                       class="input-image"
                       name="data<?php
                            if(empty($image_id)) {
                                echo "[".Model."][$id][image_file]";
                            } else {
                                echo "[Image][$image_id]";
                            }
                       ?>">
            </div>
        </div> <div class="td-div td-link">
            <input class="input-save-all-form input-data input-link"
                   value="<?php echo $link;?>"
                   name="data[<?php echo Model;?>][<?php echo $id;?>][link]">
        </div><div class="td-div td-sort-order">
            <input class="input-save-all-form input-data input-sort-order textbox-int"
                   value="<?php echo $sort_order;?>"
                   name="data[<?php echo Model;?>][<?php echo $id;?>][sort_order]">
        </div> <div class="td-action">
            <select item_id="<?php echo $id;?>"
                    class="select-action">
                <option selected="selected" value="0">Выберите действие</option>
                <option value="delete">Удалить</option>
            </select>
        </div>
    </li>
    <?php } ?>

    <?php echo $form->create(Model, array(
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

    $(document).ready(function() {
        enable_validation();
        enable_image_show();
        enable_link_dialog();

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
            var item_id = $(this).attr('item_id');
            switch(action) {
                case 'delete':
                    $('#dialog-delete .dialog-caption').html(item_id);
                    $('#dialog-delete .input-item-id').val(item_id);
                    $('#dialog-delete').dialog('open');
                    break;
            }
            $(this).val(0);
        });
    });
</script>

<div id="dialog-add">
    <?php
    echo $form->create(Model, array(
        'action' => 'add',
        'id' => 'form-add',
        'type' => 'file'
    ));
    ?>
    <div class="dialog-div-row">
        <div class="dialog-label">
            Изображение
        </div>
        <div class="dialog-div-input">
            <?php
            echo $form->file('image_file', array(
                'id' => 'input-add-image-file',
                'class' => 'dialog-input'
            ));
            ?>
        </div>
    </div>
    <div class="dialog-div-row">
        <div class="dialog-label">
            Ссылка
        </div>
        <div class="dialog-div-input">
            <?php
            echo $form->text('link', array(
                'id' => 'input-add-link',
                'class' => 'dialog-input'
            ))
            ?>
        </div>
    </div>
    <?php
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
$('#dialog-add').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    title: 'Добавление слайдшоу',
    dialogClass: 'widget-add',
    resizable: true,
    height: 'auto',
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
    $('#input-add-image-file').val('');
    $('#dialog-add').dialog('open');
});
</script>

<div id="dialog-delete">
    <h3 id="dialog-caption-delete"
        class="dialog-caption"></h3>
    <?php
    echo $form->create(Model, array(
        'action' => 'delete',
        'id' => 'form-delete'
    ));
    ?>
    <input type="hidden"
           value=""
           class="input-item-id"
           name="data[<?php echo model;?>_id]">
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
    title: 'Удаление слайдшоу',
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