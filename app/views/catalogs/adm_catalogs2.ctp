<table class="align-table"><tr><td width="200px">
    <?php echo $catalogCommon->getCatalogTreeStr($path_tree, $path, $catalog['Catalog']['id']);?>
</td><td>
    <h1><?php echo $catalog['Catalog']['name'];?></h1>
    <div class="div-show-path ui-state-default ui-corner-all">
        <?php echo $common->getPathStr($path);?>
    </div>
    <?php
    $session->flash();
    echo $adminCommon->table(array(
        'columns' => array(
            array(
                'header' => 'ID',
                'type' => 'label',
                'path' => 'Catalog.id'
            ),
            array(
                'header' => '1С-код',
                'type' => 'label',
                'path' => 'Catalog.code_1c'
            ),
            array(
                'header' => '1С-назв.',
                'type' => 'label',
                'path' => 'Catalog.name_1c'
            ),
            array(
                'header' => 'Название',
                'type' => 'edit_dialog',
                'path' => 'Catalog.name',
                'name' => 'name'
            ),
            array(
                'header' => 'Анг. назв.',
                'type' => 'edit_dialog',
                'path' => 'Catalog.eng_name',
                'name' => 'eng_name'
            ),
            array(
                'header' => 'Краткое описание',
                'type' => 'text',
                'path' => 'Catalog.short_about',
                'name' => 'short_about'
            ),
            array(
                'header' => 'Полное описание',
                'type' => 'text',
                'path' => 'Catalog.long_about',
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
                'path' => 'Catalog.producer_id',
                'name' => 'producer_id',
                'list' => $producer_list
            ),
            array(
                'header' => 'Сорт-ка',
                'type' => 'edit',
                'path' => 'Catalog.sort_order',
                'name' => 'sort_order',
                'sort_column' => true
            )
        ),
        'model_name' => 'Catalog',
        'id_path' => 'Catalog.id',
        'sortable' => true,
        'link_save_url' => '/catalogs/save_all',
        'actions' => array(
            'go_to_catalog' => 'Перейти',
            'move' => 'Перенести',
            'get_csv' => 'CSV',
            'del' => 'Удалить'
        ),
        'buttons' => array(
            'Добавить' => array(
                'func_name' => 'add'
            ),
            '.CSV' => array(
                'func_name' => 'get_csv'
            ),
            'Сохранить' => array(
                'type' => 'save'
            )
        )
    ), $catalogs);
    ?>
</td></tr></table>

<script type="text/javascript">
var catalogs = <?php echo $javascript->object($catalogs); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '1000px',
    'model_name' => 'Catalog',
    'form_action' => 'add',
    'title' => 'Добавление каталога',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'combo',
            'label' => 'Добавить в',
            'list' => $catalog_list,
            'name' => 'data[parent_id]',
            'value' => $catalog['Catalog']['id']
        ),
        array(
            'type' => 'edit',
            'label' => 'Название',
            'name' => 'data[name]'
        ),
        array(
            'type' => 'file',
            'label' => 'Мал. изображение',
            'name' => 'data[SmallImage]'
        ),
        array(
            'type' => 'file',
            'label' => 'Бол. изображение',
            'name' => 'data[BigImage]'
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
        )
    ),
    'form_type' => 'file'
));
?>

<script type="text/javascript">
function add() {
    $('#dialog-add .input-clear').val('');
    $('#dialog-add').dialog('open');
}
</script>

<script type="text/javascript">
function go_to_catalog(row_id) {
    var link = "<?php echo $html->url('/catalogs/adm_catalog/');?>";
    link += row_id;
    window.location = link;
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-move',
    'model_name' => 'Catalog',
    'form_action' => 'change_catalog',
    'title' => 'Перемещение каталога',
    'ok_caption' => 'Перенести',
    'caption' => ' ',
    'fields' => array(
        array(
            'type' => 'combo',
            'label' => 'Перенести в',
            'name' => 'data[parent_id]',
            'list' => $catalog_list,
            'value' => $catalog['Catalog']['id']
        ),
        array(
            'type' => 'hidden',
            'name' => 'data[catalog_id]',
            'input_class' => 'input-row-id',
            'clear_class' => false
        )
    )
))
?>

<script type="text/javascript">
function move(row_id) {
    var dialog = $('#dialog-move');
    var page = catalogs[row_id];
    dialog.find('.dialog-caption').html(page.Catalog.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-delete',
    'model_name' => 'Catalog',
    'form_action' => 'delete',
    'title' => 'Удаление каталога',
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
function get_csv(row_id) {
    var catalog_id = row_id
    if(catalog_id == null) {
        catalog_id = <?php echo $catalog['Catalog']['id'];?>;
    }
    window.open(webroot+'catalogs/get_csv/'+catalog_id);
}
</script>

<script type="text/javascript">
function del(row_id) {
    var dialog = $('#dialog-delete');
    var page = catalogs[row_id];
    dialog.find('.dialog-caption').html(page.Catalog.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>