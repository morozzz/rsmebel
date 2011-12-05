<h2>Вопросы по товарам</h2>
<?php
echo $session->flash();
?>

<?php
echo $adminCommon->table(array(
    'columns' => array(
        array(
            'header' => '',
            'type' => 'checkbox',
            'value' => 0,
            'class' => 'chb-question-product-select',
            'saving_column' => false
        ),
        array(
            'header' => 'ID',
            'type' => 'label',
            'path' => 'QuestionProduct.id'
        ),
        array(
            'header' => 'Имя',
            'type' => 'label',
            'path' => 'QuestionProduct.name'
        ),
        array(
            'header' => 'Email',
            'type' => 'label',
            'path' => 'QuestionProduct.email'
        ),
        array(
            'header' => 'Телефон',
            'type' => 'label',
            'path' => 'QuestionProduct.phone'
        ),
        array(
            'header' => 'Вопрос',
            'type' => 'text',
            'path' => 'QuestionProduct.question',
            'name' => 'question'
        ),
        array(
            'header' => 'Ответ',
            'type' => 'text',
            'path' => 'QuestionProduct.answer',
            'name' => 'answer'
        ),
        array(
            'header' => 'Статус',
            'type' => 'combo',
            'path' => 'QuestionProduct.question_product_type_id',
            'name' => 'question_product_type_id',
            'list' => $question_product_type_list
        ),
        array(
            'header' => 'Создан',
            'type' => 'label',
            'path' => 'QuestionProduct.created'
        )
    ),
    'model_name' => 'QuestionProduct',
    'id_path' => 'QuestionProduct.id',
    'link_save_url' => '/question_products/save_all',
    'sortable' => false,
    'actions' => array(
        'del' => 'Удалить'
    ),
    'buttons' => array(
        'Сохранить' => array(
            'type' => 'save'
        ),
        'Удалить' => array(
            'func_name' => 'delete_list'
        )
    )
), $question_products);
?>

<script type="text/javascript">
var question_products = <?php echo $javascript->object($question_products); ?>;
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-delete',
    'model_name' => 'QuestionProduct',
    'form_action' => 'delete',
    'title' => 'Удаление вопроса',
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
    var page = question_products[row_id];
    dialog.find('.dialog-caption').html(page.QuestionProducts.id);
    dialog.find('.input-row-id').val(row_id);
    dialog.dialog('open');
}
</script>

<?php
echo $adminCommon->dialog_form(array(
    'dialog_id' => 'dialog-delete-list',
    'model_name' => 'QuestionProduct',
    'form_action' => 'delete_list',
    'form_class' => 'form-delete-list',
    'title' => 'Удаление вопросов',
    'ok_caption' => 'Удалить',
    'caption' => 'Удаление вопросов',
    'fields' => array(
    )
));
?>

<script type="text/javascript">
function delete_list() {
    var dlg = $('#dialog-delete-list');
    var form_concat = dlg.find('.form-delete-list:first');
    form_concat.find('.input-questions_id').remove();
    form_concat.find('.list-delete-questions').remove();

    var list = $("<ul style='margin:0;padding:0px 20px;'></ul>");
    $('input[type=checkbox].chb-question-product-select:checked').each(function() {
        var tr = $(this).parent().parent();
        var row_id = tr.attr('row_id');
        var page = question_products[row_id];

        form_concat.append("<input class='input-questions_id' type='hidden' "+
            "name='data[rows_id][]' value='"+row_id+"'>");
        list.append("<li>"+row_id+"</li>");
    });
    var div = $("<div class='list-delete-questions'></div>");
    div.append("<h4 style='margin:0;padding:5px;'>Удаляемые вопросы:</h4>");
    div.append(list);

    form_concat.append(div);

    dlg.dialog('open');
}
</script>