<?php

    echo "<div align=\"center\" class=\"form form-cke\">";
    echo $form->create('HomeFooter', array(
        'action' => 'edit',
        'id' => 'home_footer-edit-form'
    ));

    echo $form->inputs(array(
          'legend' => 'Подвал на главной странице - редактирование',

          'contacts' => array(
            'label'       => 'Адрес и контакты',
            'value' => $home_footers[0]['HomeFooter']['contacts'],
            'id' => 'contacts',
            'type' => 'textarea'
          ),
          'left_info' => array(
            'label'       => 'Информация слева',
            'value' => $home_footers[0]['HomeFooter']['left_info'],
            'id' => 'left_info',
            'type' => 'textarea'
          ),
          'center_info' => array(
            'label'       => 'Информация в центре',
            'value' => $home_footers[0]['HomeFooter']['center_info'],
            'id' => 'center_info',
            'type' => 'textarea'
          ),
          'right_info' => array(
            'label'       => 'Информация справа',
            'value' => $home_footers[0]['HomeFooter']['right_info'],
            'id' => 'right_info',
            'type' => 'textarea'
          )
    ));
    echo $form->submit('Сохранить');

    echo $form->end();
    echo "</div>";

?>

<script type="text/javascript">
    window.onload = function()
    {
        CKEDITOR.replace('contacts');
        CKEDITOR.replace('left_info');
        CKEDITOR.replace('center_info');
        CKEDITOR.replace('right_info');
    }

    enable_validation();
</script>