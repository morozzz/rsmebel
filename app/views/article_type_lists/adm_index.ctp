<h2>Тематики статьи '<?php echo $article['Article']['caption'];?>'</h2>
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
            'path' => 'ArticleTypeList.id'
        ),
        array(
            'header' => 'Тематика',
            'type' => 'combo',
            'path' => 'ArticleTypeList.article_type_id',
            'name' => 'article_type_id',
            'list' => $article_type_list
        )
    ),
    'model_name' => 'ArticleTypeList',
    'id_path' => 'ArticleTypeList.id',
    'link_save_url' => '/article_type_lists/save_all',
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
), $article_type_lists);
?>

<script type="text/javascript">
var article_type_lists = <?php echo $javascript->object($article_type_lists); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '500px',
    'model_name' => 'ArticleTypeList',
    'form_action' => 'add',
    'title' => 'Добавление тематики',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'combo',
            'label' => 'Тематика',
            'name' => 'data[article_type_id]',
            'list' => $article_type_list
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
    'model_name' => 'ArticleTypeList',
    'form_action' => 'delete',
    'title' => 'Удаление тематики',
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
    var page = article_type_lists[row_id];
    dialog.find('.dialog-caption').html(page.ArticleType.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>