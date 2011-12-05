<h1>Профили портфолио</h1>
<?php
    echo $form->create('ProjectProfile', array(
        'action' => 'save'
    ));
?>
<div id="div-project-profile">
<table id="table-project-profile">
    <thead>
        <tr>
            <th>Название</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($project_profiles)) {
            foreach($project_profiles as $project_profile) {
                $id = $project_profile['ProjectProfile']['id'];
                echo "<tr>";

                //название
                echo "<td>";
                    echo $form->text('', array(
                        'name' => 'data[ProjectProfile]['.$id.'][name]',
                        'value' => $project_profile['ProjectProfile']['name']
                    ));
                echo "</td>";

                //удалить
                echo "<td>";
                echo $html->link($html->image('delete.png', array(
                    'alt' => 'Удалить'
                )), array(
                    'controller' => 'project_profiles',
                    'action' => 'delete',
                    $id
                ), array(
                    'escape' => false,
                    'title' => 'Удалить'
                ), 'Вы уверены, что хотите удалить данную позицию?');
                echo "</td>";

                echo "<td></td>";

                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>
<a href="#" onclick="fnAddRow(); return false;">Добавить строку</a>
<?php
    echo $form->end('Сохранить');
?>
</div>

<script type="text/javascript">
    var webroot = "<?php echo $this->webroot; ?>";
    var table_project_profile;
    var project_profile_index = 0;
    $(document).ready(function() {
        table_project_profile = $('#table-project-profile').dataTable({
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            "bSort": false,
            "oLanguage" : {
                "sZeroRecords":  "Записи отсутствуют."
            },
            "aoColumns": [
                null,
                null,
                {
                    "bVisible": false
                }
            ],
            'fnRowCallback': function(nRow, aArray, iDisplayIndex) {
                if(aArray[2] == 'new')
                    nRow.className = 'added-row';
                return nRow;
            }
        });
    });

    function fnAddRow() {
        table_project_profile.fnAddData([
            '<input type="text" name="data[ProjectProfileNew]['+project_profile_index+'][name]"/>',
            '<a class="link-delete-new-row" title="Удалить" href="#"><img src="'+webroot+'img/delete.png"/></a>',
            'new'
        ]);
        project_profile_index++;

        $('.link-delete-new-row').click(function() {
            table_project_profile.fnDeleteRow($(this).parent().parent().get(0));
        });
    }
</script>