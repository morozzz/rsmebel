<h2>Статьи</h2>
<div class="div-show-path ui-state-default ui-corner-all">
    <a href="<?php echo $html->url('/article_types/adm_index/');?>">Тематика статей >> </a>
</div>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'Article.id'
        ),
        array(
            'header' => 'Заголовок',
            'type' => 'edit',
            'path' => 'Article.caption',
            'name' => 'caption'
        ),
        array(
            'header' => 'Краткое описание',
            'type' => 'text',
            'path' => 'Article.short_note',
            'name' => 'short_note'
        ),
        array(
            'header' => 'Изображение',
            'type' => 'image',
            'path' => 'SmallImage.url',
            'name' => 'SmallImage'
        ),
        array(
            'header' => 'Дата',
            'type' => 'date',
            'path' => 'Article.stamp',
            'name' => 'stamp'
        ),
        array(
            'header' => 'Сортировка',
            'type' => 'edit',
            'path' => 'Article.sort_order',
            'name' => 'sort_order',
            'sort_column' => 'true'
        )
    ),
    'model_name' => 'Article',
    'id_path' => 'Article.id',
    'link_save_url' => '/articles/save_all',
    'sortable' => true,
    'actions' => array(
        'go_to_pages' => 'Перейти к страницам',
        'go_to_types' => 'Перейти к тематикам',
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
), $articles);
?>

<script type="text/javascript">
var articles = <?php echo $javascript->object($articles); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '1000px',
    'model_name' => 'Article',
    'form_action' => 'add',
    'title' => 'Добавление статьи',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Заголовок',
            'name' => 'data[caption]'
        ),
//        array(
//            'type' => 'file',
//            'label' => 'Изображение',
//            'name' => 'data[SmallImage]'
//        ),
        array(
            'type' => 'date',
            'label' => 'Дата',
            'name' => 'data[stamp]'
        ),
        array(
            'type' => 'edit',
            'label' => 'Сортировка',
            'name' => 'data[sort_order]'
        ),
        array(
            'type' => 'text',
            'lable' => 'Краткое описание',
            'name' => 'data[short_note]'
        )
    )
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
    'model_name' => 'Article',
    'form_action' => 'delete',
    'title' => 'Удаление статьи',
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
    var page = articles[row_id];
    dialog.find('.dialog-caption').html(page.Article.caption);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<script type="text/javascript">
function go_to_pages(row_id) {
    window.location = webroot+'article_pages/adm_index/'+row_id;
}

function go_to_types(row_id) {
    window.location = webroot+'article_type_lists/adm_index/'+row_id;
}
</script>