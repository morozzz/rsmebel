<h2>Детализация товара "<?php echo $product['Product']['name'];?>"</h2>
<div class="div-show-path ui-state-default ui-corner-all">
    <?php echo $common->getPathStr($path);?>
</div>
<div class="div-show-path ui-state-default ui-corner-all">
    <a href="<?php echo $html->url("/product_params/index/".$product['Product']['id']);?>">
        Столбцы >> 
    </a>
</div>
<?php
$session->flash();

$columns = array(
    array(
        'header' => 'ID',
        'type' => 'label',
        'path' => 'ProductDet.id'
    ),
    array(
        'header' => '1С-код',
        'type' => 'label',
        'path' => 'ProductDet.code_1c'
    ),
    array(
        'header' => '1С-назв.',
        'type' => 'label',
        'path' => 'ProductDet.name_1c'
    ),
//    array(
//        'header' => 'Название',
//        'type' => 'label',
//        'path' => 'ProductDet.name'
//    ),
    array(
        'header' => 'Краткое описание',
        'type' => 'text',
        'path' => 'ProductDet.short_about',
        'name' => 'short_about'
    ),
    array(
        'header' => 'Полное описание',
        'type' => 'text',
        'path' => 'ProductDet.long_about',
        'name' => 'long_about'
    ),
    array(
        'header' => 'Мал. изобр-е',
        'type' => 'image',
        'path' => 'SmallImage.url',
        'name' => 'SmallImage'
    ),
    array(
        'header' => 'Бол. изобр-е',
        'type' => 'image',
        'path' => 'BigImage.url',
        'name' => 'BigImage'
    ),
    array(
        'header' => 'Производитель',
        'type' => 'combo',
        'path' => 'ProductDet.producer_id',
        'name' => 'producer_id',
        'list' => $producer_list
    )
);

foreach($product_params as $product_param) {
    $list = Set::combine($product_param['ProductParamType']['ProductDetParamValue'], '{n}.id', '{n}.name');
    $product_param_id = $product_param['ProductParam']['id'];

    $columns[] = array(
        'header' => $product_param['ProductParamType']['name'],
        'type' => 'autocomplete',
        'path' => "ProductDetParam.$product_param_id.product_det_param_value_id",
        'list' => $list,
        'fullname' => "[ProductDetParam][$product_param_id]",
        'js_list_name' => "product_param_$product_param_id"
    );
}

$columns = array_merge($columns, array(
    array(
        'header' => 'Артикул',
        'type' => 'edit',
        'path' => 'ProductDet.article',
        'name' => 'article'
    ),
    array(
        'header' => 'Фикс. цену',
        'type' => 'checkbox',
        'path' => 'ProductDet.fix_price',
        'name' => 'fix_price'
    ),
    array(
        'header' => 'Фикс. кол-во',
        'type' => 'checkbox',
        'path' => 'ProductDet.fix_cnt',
        'name' => 'fix_cnt'
    ),
    array(
        'header' => 'Цена',
        'type' => 'edit',
        'path' => 'ProductDet.price',
        'name' => 'price'
    ),
    array(
        'header' => 'Кол-во',
        'type' => 'edit',
        'path' => 'ProductDet.cnt',
        'name' => 'cnt'
    ),
    array(
        'header' => 'Сорт-ка',
        'type' => 'edit',
        'path' => 'ProductDet.sort_order',
        'name' => 'sort_order',
        'sort_column' => true
    )
));

echo $adminCommon->table(array(
    'columns' => $columns,
    'model_name' => 'ProductDet',
    'id_path' => 'ProductDet.id',
    'tr_class_path' => 'special_class',
    'sortable' => true,
    'link_save_url' => '/product_dets/save_all',
    'actions' => array(
        'move_to_product' => 'Перенести в товары',
        'add_to_special' => 'Добавить в спецпредложения',
        'del' => 'Удалить'
    ),
    'buttons' => array(
        'Добавить' => array(
            'func_name' => 'add'
        ),
        'Сохранить' => array(
            'type' => 'save'
        )
    )
), $product_dets)
?>

<script type="text/javascript">
var product_dets = <?php echo $javascript->object($product_dets); ?>;
</script>

<?php
$fields = array(
    array(
        'type' => 'file',
        'label' => 'Мал. изображение',
        'name' => 'data[SmallImage]'
    ),
    array(
        'type' => 'file',
        'label' => 'Бол. изображение',
        'name' => 'data[BigImage]'
    )
);

foreach($product_params as $product_param) {
    $list = Set::combine($product_param['ProductParamType']['ProductDetParamValue'], '{n}.id', '{n}.name');
    $product_param_id = $product_param['ProductParam']['id'];

    $fields[] = array(
        'type' => 'autocomplete',
        'label' => $product_param['ProductParamType']['name'],
        'list' => $list,
        'name' => "data[ProductDetParam][$product_param_id]",
        'js_list_name' => "d_product_param_$product_param_id"
    );
}

$fields = array_merge($fields, array(
    array(
        'type' => 'edit',
        'label' => 'Артикул',
        'name' => 'data[article]'
    ),
    array(
        'type' => 'edit',
        'label' => 'Цена',
        'name' => 'data[price]'
    ),
    array(
        'type' => 'edit',
        'label' => 'Количество',
        'name' => 'data[cnt]'
    ),
    array(
        'type' => 'combo',
        'label' => 'Производитель',
        'list' => $producer_list,
        'name' => 'data[producer_id]'
    ),
    array(
        'type' => 'edit',
        'label' => 'Сортировка',
        'name' => 'data[sort_order]'
    ),
    array(
        'type' => 'text',
        'label' => 'Краткое описание',
        'name' => 'data[short_about]',
        'height' => '70'
    ),
    array(
        'type' => 'text',
        'label' => 'Полное описание',
        'name' => 'data[long_about]',
        'height' => '70'
    ),
    array(
        'type' => 'hidden',
        'name' => 'data[product_id]',
        'value' => $product['Product']['id'],
        'clear_class' => false
    )
));

echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '1000px',
    'model_name' => 'ProductDet',
    'form_action' => 'add',
    'title' => 'Добавление детализации',
    'ok_caption' => 'Добавить',
    'fields' => $fields,
    'form_type' => 'file'
));
?>

<script type="text/javascript">
function add() {
    $('#dialog-add .input-clear').val('');
    $('#dialog-add').dialog('open');
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-delete',
    'model_name' => 'ProductDet',
    'form_action' => 'delete',
    'title' => 'Удаление детализации',
    'ok_caption' => 'Удалить',
    'caption' => ' ',
    'fields' => array(
        array(
            'type' => 'hidden',
            'name' => 'data[row_id]',
            'input_class' => 'input-row-id',
            'clear_class' => false
        )
    )
));
?>

<script type="text/javascript">
function del(row_id) {
    var dialog = $('#dialog-delete');
    var page = product_dets[row_id];
    dialog.find('.dialog-caption').html(page.ProductDet.id);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-move-to-product',
    'model_name' => 'ProductDet',
    'form_action' => 'move_to_product',
    'title' => 'Перенос в товары',
    'width' => '300',
    'ok_caption' => 'Перенести',
    'caption' => ' ',
    'fields' => array(
        array(
            'type' => 'combo',
            'name' => 'data[catalog_id]',
            'label' => 'Каталог',
            'list' => $catalog_list,
            'value' => $product['Product']['catalog_id']
        ),
        array(
            'type' => 'hidden',
            'name' => 'data[product_det_id]',
            'input_class' => 'input-row-id',
            'clear_class' => false
        )
    )
));
?>

<script type="text/javascript">
function move_to_product(row_id) {
    var dialog = $('#dialog-move-to-product');
    var page = product_dets[row_id];
    dialog.find('.dialog-caption').html(page.ProductDet.id);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('tr.tr-special select.select-action-admin option[value=add_to_special]').each(function() {
        $(this).val('delete_from_special');
        $(this).html('Удалить из спецпредложений');
    })
});

function add_to_special(row_id) {
    $.ajax({
        url: webroot+'specials/add/product_det_id:'+row_id,
        context: $('#tr'+row_id),
        success: function(data) {
            $(this).addClass('tr-special');
            $(this).find('select.select-action-admin option[value=add_to_special]').each(function() {
                $(this).attr('value', 'delete_from_special');
                $(this).html('Удалить из спецпредложений');
            });
        }
    });
}

function delete_from_special(row_id) {
    $.ajax({
        url: webroot+'specials/delete/product_det_id:'+row_id,
        context: $('#tr'+row_id),
        success: function(data) {
            $(this).removeClass('tr-special');
            $(this).find('select.select-action-admin option[value=delete_from_special]').each(function() {
                $(this).attr('value', 'add_to_special');
                $(this).html('Добавить в спецпредложения');
            });
        }
    });
    var tr = $('#tr'+row_id);
    tr.removeClass('tr-special');
    tr.find('select.select-action-admin option[value=delete_from_special]').each(function() {
        $(this).val('add_to_special');
        $(this).html('Добавить в спецпредложения');
    });
}
</script>