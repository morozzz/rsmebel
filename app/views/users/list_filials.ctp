
<cake:nocache>
<div class="top-header hide-menu">
   <?php
     echo $this->element('basket_menu_box');
   ?>
</div>
</cake:nocache>

<?php

    echo "<div id='filial-edit'>";

    echo $common->caption('ПЕРСОНАЛЬНЫЕ ДАННЫЕ - ФИЛИАЛЫ');

    echo "<div id='div-filial-edit'>";
      echo $html->link('Перейти к основным данным', array('controller' => 'users', 'action' => 'register'));
    echo "</div>";

    echo "<div class='form'>";

    echo $html->div('action',
            $html->link('Добавить филиал', array(
                'controller' => 'users',
                'action' => 'edit_filial',
                null
            ))
    );
    echo "<table class=\"data-table tree-table\" id=\"filial-list-table\">";
    echo "<thead>";
    echo $html->tableHeaders(array(
        $html->div('filial_header', 'Тип филиала'),
        $html->div('filial_header', 'Название филиала'),
        $html->div('filial_header', 'Орг. правовая форма'),
        $html->div('filial_header', 'Профиль деятельности'),
        $html->div('filial_header', 'ФИО'),
        '', ''
    ));
    echo "</thead>";

    echo "<tbody>";
    foreach($filials as $filial) {

      if ($filial['ClientInfo']['filial_type_id'] == 1) {
            echo $html->tableCells(array(
                $filial['ClientInfo']['filial_type_name'],
                $filial['ClientInfo']['name'],
                $filial['CompanyType']['type_name'],
                $filial['ProfilType']['profil_name'],
                $filial['ClientInfo']['fio'],

                    $html->div('action',
                            $html->link('редактировать', array(
                                'controller' => 'users',
                                'action' => 'edit_filial',
                                $filial['ClientInfo']['id']
                            ))
                    ),
                    $html->div('action',
                            $html->link('удалить', array(
                                'controller' => 'users',
                                'action' => 'delete_filial',
                                $filial['ClientInfo']['id']
                            ))
                    )
                ));
             }
             else {
            echo $html->tableCells(array(
                $filial['ClientInfo']['filial_type_name'],
                $filial['ClientInfo']['name'],
                $filial['CompanyType']['type_name'],
                $filial['ProfilType']['profil_name'],
                $filial['ClientInfo']['fio'],

                    $html->div('action',
                            $html->link('редактировать', array(
                                'controller' => 'users',
                                'action' => 'register',
                                $filial['ClientInfo']['user_id']
                            ))
                    ),
                    ''
                ));
             }

    }
    echo "</tbody>";
    echo "</table>";

    echo "</div>";
    echo "</div>";

?>

<script type="text/javascript">

    var filial_list_table;
    var webroot = "<?php echo $this->webroot; ?>"

    jQuery(document).ready(function() {

        filial_list_table = jQuery('#filial-list-table').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": false,
            "bInfo": false,
            "bAutoWidth": false,
            "oLanguage" : {
                "sZeroRecords":  ""
            },
            'aoColumns': [
                {
                    'bVisible': false
                },
                null,
                null,
                null,
                null,
                null,
                null,
                null
            ]
        });

    });
</script>
