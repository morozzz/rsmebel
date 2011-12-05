<?php echo $catalogCommon->getCatalogPathStr($path, 'adm_catalog');?>

<h1 class="page-caption">
    Столбцы товара "<?php echo $html->link($product['Product']['name'], array(
        'controller' => 'product_dets',
        'action' => 'adm_index',
        $product['Product']['id']
    ));?>"
</h1>
<div class="head-actions">
    <?php echo $html->link('Названия', array(
        'controller' => 'product_param_types',
        'action' => 'adm_index'
    ), array(
        'class' => 'link-names'
    ));?>
</div>

<div class="div-add-action">
    <a id="link-add" href="#" onclick="return false;">Добавить</a>
</div>

<div id="table-header">
    <div class="th-div td-id">Номер</div>
    <div class="th-div td-name">Название</div>
    <div class="th-div td-type">Тип</div>
    <div class="th-div td-sort-order">Сорт-ка</div>
    <div class="th-div td-action">Действие</div>
</div>

<ul id="table-body">
    <?php foreach($product_params as $product_param) {
        $product_param_id = $product_param['ProductParam']['id'];
        $sort_order = $product_param['ProductParam']['sort_order'];

        $name_id = $product_param['ProductParam']['product_param_type_id'];
        $name = $product_param['ProductParamType']['name'];

        $type_id = $product_param['ProductParam']['product_param_show_type_id'];
        $type = $product_param['ProductParamShowType']['name'];
    ?>
    <li product_param_id="<?php echo $product_param_id;?>"
        class="table-row"
        id="li-<?php echo $product_param_id;?>">
        <div class="td-div td-id">
            <h2><?php echo $product_param_id;?></h2>
        </div> <div class="td-div td-name">
            <input class="input-data input-name"
                   readonly
                   value="<?php echo $name;?>"
                   product_param_id="<?php echo $product_param_id;?>"
                   list_type="name">
            <input class="input-name-hidden"
                   type="hidden"
                   value="<?php echo $name_id;?>"
                   name="data[ProductParam][<?php echo $product_param_id;?>][product_param_type_id]"
                   product_param_id="<?php echo $product_param_id;?>">
        </div> <div class="td-div td-type">
            <input class="input-data input-type"
                   readonly
                   value="<?php echo $type;?>"
                   product_param_id="<?php echo $product_param_id;?>"
                   list_type="type">
            <input class="input-type-hidden"
                   type="hidden"
                   value="<?php echo $type_id;?>"
                   name="data[ProductParam][<?php echo $product_param_id;?>][product_param_show_type_id]"
                   product_param_id="<?php echo $product_param_id;?>">
        </div> <div class="td-div td-sort-order">
            <input class="input-data input-save-all-form input-sort-order textbox-int"
                   value="<?php echo $sort_order;?>"
                   name="data[ProductParam][<?php echo $product_param_id;?>][sort_order]">
        </div> <div class="td-div td-action">
            <select product_param_id="<?php echo $product_param_id;?>"
                    class="select-action">
                <option selected="selected" value="0">Выберите действие</option>
                <option value="delete">Удалить</option>
            </select>
        </div>
    </li>
    <?php } ?>

    <?php echo $form->create('ProductParam', array(
        'action' => 'save_list',
        'id' => 'form-save-all'
    ));?>
    <div id="div-form-save-all" style="display: none;">
    </div>
    <?php echo $form->end();?>

    <a id="link-save-all" href="#" onclick="return false;">Сохранить</a>
</ul>

<script type="text/javascript">
    var webroot = '<?php echo $this->webroot; ?>';

    var product_param_type_list = <?php echo $javascript->object($product_param_type_list);?>;
    var product_param_show_type_list = <?php echo $javascript->object($product_param_show_type_list);?>;

    var select_lists = {
        name: {
            label: 'Название',
            list: product_param_type_list
        },
        type: {
            label: 'Тип',
            list: product_param_show_type_list
        }
    };

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

        $('#link-save-all').click(function() {
            $('.input-changed').clone().appendTo('#div-form-save-all');

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
            var product_param_id = $(this).attr('product_param_id');
            switch(action) {
                case 'delete':
                    $('#input-delete-product-param-id').val(product_param_id);
                    $('#caption-delete-product-param-id').html(product_param_id);
                    $('#dialog-delete').dialog('open');
                    break;
            }
            $(this).val(0);
        });
    });
</script>

<div id="dialog-input-hidden">
    <div class="dialog-div-row">
        <div class="dialog-label">

        </div>
        <div class="dialog-div-input">
            <select id="select-dialog-input-hidden"
                    class="dialog-input">
            </select>
        </div>
    </div>
</div>

<script type="text/javascript">
$(".input-data[readonly]").click(function() {
    var node_id = $(this).attr('product_param_id');

    var input_hidden = $(this).parent().find('input[type=hidden]');
    var value = input_hidden.val();

    var list_type = $(this).attr('list_type');
    var list = select_lists[list_type];

    $('#dialog-input-hidden .dialog-label').html(list.label);

    var select = $('#select-dialog-input-hidden');
    select.html('');
    for(var key_list in list.list) {
        var value_list = list.list[key_list];
        select.append('<option value="'+key_list+'">'+value_list+'</option>');
    }
    select.val(value);

    $('#dialog-input-hidden').attr('node_id', node_id);
    $('#dialog-input-hidden').attr('list_type', list_type);

    $('#dialog-input-hidden').dialog('option', 'title', 'Выберите '+list.label);
    $('#dialog-input-hidden').dialog('open');
});

$('#dialog-input-hidden').dialog({
    show: 'blind',
    hide: 'blind',
    modal: true,
    autoOpen: false,
    dialogClass: 'widget-input-hidden',
    resizable: true,
    width: 300,
    height: 110,
    buttons: {
        'Выбрать': function() {
            var node_id = $(this).attr('node_id');
            var list_type = $(this).attr('list_type');

            var input =
                $('.input-data[product_param_id='+node_id+
                '][list_type='+list_type+']');
            var input_hidden =
                input.parent().find('input[type=hidden]');
            var val = $('#select-dialog-input-hidden').val();
            var list = select_lists[list_type];

            input.val(list.list[val]);
            input_hidden.val(val);

            input_hidden.addClass('input-changed');
            input_hidden.parent().addClass('div-changed');

            $(this).dialog('close');
        },
        'Отмена' : function() {
            $(this).dialog('close');
        }
    }
});
</script>

<div id="dialog-add">
    <h3 id="caption-add-product-param-id" class="caption-product-param-id"></h3>
    <?php
    echo $form->create('ProductParam', array(
        'action' => 'add',
        'id' => 'form-add'
    ));
    ?>
    <div class="dialog-div-row">
        <div class="dialog-label">
            Название
        </div>
        <div class="dialog-div-input">
            <?php
            echo $form->select('product_param_type_id',
                    $product_param_type_list,
                    null,
                    array(
                        'id' => 'dialog-add-name',
                        'class' => 'dialog-input'
                    ),
                    false);
            ?>
        </div>
    </div>
    <div class="dialog-div-row">
        <div class="dialog-label">
            Тип
        </div>
        <div class="dialog-div-input">
            <?php
            echo $form->select('product_param_show_type_id',
                    $product_param_show_type_list,
                    null,
                    array(
                        'id' => 'dialog-add-type',
                        'class' => 'dialog-input'
                    ),
                    false);
            ?>
        </div>
    </div>
    <input type="hidden"
           name="data[ProductParam][product_id]"
           value="<?php echo $product['Product']['id'];?>">
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
    dialogClass: 'widget-delete',
    title: 'Добавление столбца',
    resizable: true,
    buttons: {
        'Добавить': function() {
            $('#form-add').submit();
        },
        'Отмена' : function() {
            $(this).dialog('close');
        }
    }
});

$('#link-add').click(function() {
    $('#dialog-add-name').val(0);
    $('#dialog-add-type').val(0);
    $('#dialog-add').dialog('open');
});
</script>

<div id="dialog-delete">
    <h3 id="caption-delete-product-param-id" class="caption-product-param-id"></h3>
    <?php
    echo $form->create('ProductParam', array(
        'action' => 'delete',
        'id' => 'form-delete'
    ));
    ?>
    <input type="hidden" value="" id="input-delete-product-param-id" name="data[product_param_id]">
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
    title: 'Удаление столбца',
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