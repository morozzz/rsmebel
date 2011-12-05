<h1>Управление спецпредложениями</h1>

<div id="table-header">
    <div class="th-div td-catalog">Каталог</div>
    <div class="th-div td-product">Товар</div>
    <div class="th-div td-date1">Дата с</div>
    <div class="th-div td-date2">Дата по</div>
    <div class="th-div td-action">Действие</div>
</div>


<ul id="table-body">
    <?php foreach($specials as $special) {
        $special_id = $special['Special']['id'];
        $product_id = $special['product_id'];

        $path = $catalogCommon->getCatalogPathStr($special['path'], 'adm_catalog');
        $product_name = $special['name'];

        $date1 = $special['Special']['date1'];
        if(!empty($date1)) $date1 = date('d.m.Y', strtotime($date1));
        $date2 = $special['Special']['date2'];
        if(!empty($date2)) $date2 = date('d.m.Y', strtotime($date2));
    ?>
    <li special_id="<?php echo $special_id;?>"
        product_id="<?php echo $product_id;?>"
        id="li-<?php echo $special_id;?>">
        <div class="td-div td-catalog">
            <?php echo $path;?>
        </div> <div class="td-div td-product">
            <a href="<?php echo $html->url("/product_dets/adm_index/$product_id");?>">
                <?php echo $product_name;?>
            </a>
        </div> <div class="td-div td-date1">
            <input type="text"
                   value="<?php echo $date1;?>"
                   name="data[Special][<?php echo $special_id;?>][date1]"
                   class="input-data input-date input-save-all-form">
        </div> <div class="td-div td-date2">
            <input type="text"
                   value="<?php echo $date2;?>"
                   name="data[Special][<?php echo $special_id;?>][date2]"
                   class="input-data input-date input-save-all-form">
        </div> <div class="td-div td-action">
            <select special_id="<?php echo $special_id;?>"
                    product_id="<?php echo $product_id;?>"
                    class="select-action">
                <option selected="selected" value="0">Выберите действие</option>
                <option value="delete">Удалить</option>
            </select>
        </div>
    </li>
    <?php } ?>

    <?php echo $form->create('Special', array(
        'action' => 'save_list',
        'id' => 'form-save-all'
    ));?>
    <div id="div-form-save-all" style="display: none;">
    </div>
    <?php echo $form->end();?>

    <a id="link-save-all" href="#" onclick="return false;">Сохранить</a>
</ul>

<script type="text/javascript">
    <?php $products_name = Set::combine($specials, '{n}.Product.id', '{n}.Product.name');?>
    var products_name = <?php echo $javascript->object($products_name);?>;

    $(document).ready(function() {
        $('.input-date').datepicker();

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

        $('.select-action').change(function() {
            var action = $(this).val();
            var product_id = $(this).attr('product_id');
            var special_id = $(this).attr('special_id');
            switch(action) {
                case 'delete':
                    $('#input-delete-special-id').val(special_id);
                    $('#caption-delete-special-product-name').html(products_name[product_id]);
                    $('#dialog-delete').dialog('open');
                    break;
            }
            $(this).val(0);
        });
    })
</script>

<div id="dialog-delete">
    <h3 id="caption-delete-special-product-name" class="caption-special-product-name"></h3>
    <?php
    echo $form->create('Special', array(
        'action' => 'delete',
        'id' => 'form-delete'
    ));
    ?>
    <input type="hidden" value="" id="input-delete-special-id" name="data[special_id]">
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
    title: 'Удаление спецпредложения',
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