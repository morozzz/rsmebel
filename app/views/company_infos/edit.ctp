<style type="text/css">
#CompanyInfoSortOrder {
    width: 50px;
    text-align: right;
}
</style>
<?php

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('CompanyInfo', array(
        'action' => 'edit',
        'id' => 'company_info-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Список страниц во вкладке "О Компании" - редактирование',

          'sort_order' => array(
            'label'       => 'Сортировка',
            'value' => $company_infos['CompanyInfo']['sort_order']
          ),
          'news_header' => array(
            'label'       => 'Заголовок',
            'value' => $company_infos['CompanyInfo']['news_header']
          ),
          'news_body' => array(
            'label'       => 'Содержание страницы',
            'value' => $company_infos['CompanyInfo']['news_body'],
            'id' => 'news_body',
            'type' => 'textarea'
          )
    ));

    echo $form->hidden('id', array('value' => $company_infos['CompanyInfo']['id']));

    echo $form->submit('Сохранить');

    echo $form->end();
    echo "</div>";

?>

<script type="text/javascript">
    window.onload = function()
    {
        CKEDITOR.replace('news_body');
    }

    enable_validation();
</script>
