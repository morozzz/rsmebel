<h2>Тематика статей</h2>
<div class="div-show-path ui-state-default ui-corner-all">
    <a href="<?php echo $html->url('/articles/adm_index/');?>">Статьи >> </a>
</div>
<?php
echo $session->flash();

echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'ArticleType.id'
        ),
        array(
            'header' => 'Название',
            'type' => 'edit',
            'path' => 'ArticleType.name',
            'name' => 'name'
        )
    ),
    'model_name' => 'ArticleType',
    'id_path' => 'ArticleType.id',
    'link_save_url' => '/article_types/save_all',
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
), $article_types);
?>

<script type="text/javascript">
var article_types = <?php echo $javascript->object($article_types); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-add',
    'width' => '500px',
    'model_name' => 'ArticleType',
    'form_action' => 'add',
    'title' => 'Добавление тематики',
    'ok_caption' => 'Добавить',
    'fields' => array(
        array(
            'type' => 'edit',
            'label' => 'Название',
            'name' => 'data[name]'
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
    'model_name' => 'ArticleType',
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
    var page = article_types[row_id];
    dialog.find('.dialog-caption').html(page.ArticleType.name);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>