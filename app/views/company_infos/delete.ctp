<style type="text/css">
#CompanyInfoSortOrder {
    width: 50px;
    text-align: right;
}
</style>
<?php

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('CompanyInfo', array(
        'action' => 'delete/'.$company_infos['CompanyInfo']['id'],
        'id' => 'company-info-edit-form',
        'type' => 'file'
    ));

    echo $form->inputs(array(
          'legend' => 'Список страниц во вкладке "О Компании" - удалить',

          'sort_order' => array(
            'label'       => 'Сортировка',
            'value' => $company_infos['CompanyInfo']['sort_order'],
            'disabled' => true
          ),
          'news_header' => array(
            'label'       => 'Заголовок',
            'value' => $company_infos['CompanyInfo']['news_header'],
            'disabled' => true
          )
    ));

    echo $form->hidden('id', array('value' => $company_infos['CompanyInfo']['id']));

    echo $form->submit('Удалить');

    echo $form->end();
    echo "</div>";

?>

<script type="text/javascript">
    enable_validation();
</script>
