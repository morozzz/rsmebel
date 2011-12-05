<h2>Страницы статьи '<?php echo $article['Article']['caption'];?>'</h2>
<div style="color: red">*Для корректной работы, сортировка страниц должна быть
от 1 до n, где n - количество страниц в данной статье</div>
<div class="div-show-path ui-state-default ui-corner-all">
    <a href="<?php echo $html->url('/articles/adm_index/');?>">Статьи >> </a>
    <a href="<?php echo $html->url('/article_types/adm_index/');?>">Тематика статей >> </a>
</div>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'ArticlePage.id'
        ),
        array(
            'header' => 'Текст',
            'type' => 'text',
            'path' => 'ArticlePage.page',
            'name' => 'page'
        ),
        array(
            'header' => 'Сортировка',
            'type' => 'edit',
            'path' => 'ArticlePage.sort_order',
            'name' => 'sort_order',
            'sort_column' => true
        )
    ),
    'model_name' => 'ArticlePage',
    'id_path' => 'ArticlePage.id',
    'link_save_url' => '/article_pages/save_all',
    'sortable' => true,
    'actions' => array(
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
), $article_pages);
?>

<script type="text/javascript">
var article_pages = <?php echo $javascript->object($article_pages); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '1000px',
    'model_name' => 'ArticlePage',
    'form_action' => 'add',
    'title' => 'Добавление страницы',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Сортировка',
            'name' => 'data[sort_order]'
        ),
        array(
            'type' => 'text',
            'label' => 'Текст',
            'name' => 'data[page]'
        ),
        array(
            'type' => 'hidden',
            'name' => 'data[article_id]',
            'value' => $article['Article']['id'],
            'clear_class' => false
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
    'model_name' => 'ArticlePage',
    'form_action' => 'delete',
    'title' => 'Удаление страницы',
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
    var page = article_pages[row_id];
    dialog.find('.dialog-caption').html(page.ArticlePage.id);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>