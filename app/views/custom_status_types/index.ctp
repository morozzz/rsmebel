<h1>Статусы заказов</h1>
<?php
    echo $form->create('CustomStatusType', array(
        'action' => 'save',
        'type' => 'file'
    ));
?>
<div id="div-custom-status-type">
<table id="table-custom-status-type">
    <thead>
        <tr>
            <th>Иконка</th>
            <th>Название</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($custom_status_types)) {
            foreach($custom_status_types as $custom_status_type) {
                $id = $custom_status_type['CustomStatusType']['id'];
                echo "<tr>";

                //изображение
                echo '<td class="td-image"';
                    if(empty($custom_status_type['Image']['url'])) {
                        echo "Нет изображения";
                    } else {
                        echo $html->image($custom_status_type['Image']['url'], array(
                            "class" => "table-icon show-image"
                        ));
                    }

                    echo $html->link('загрузить', '#', array('class' => 'link-collapse'));
                    echo $html->div('div-collapsed', $form->file('', array(
                        'name' => 'data[CustomStatusType]['.$id.'][image_file]',
                        'size' => 10
                    )));
                echo "</td>";

                //название
                echo "<td>";
                    echo $form->text('', array(
                        'name' => 'data[CustomStatusType]['.$id.'][name]',
                        'value' => $custom_status_type['CustomStatusType']['name']
                    ));
                echo "</td>";

                //удалить
                echo "<td>";
                echo $html->link($html->image('delete.png', array(
                    'alt' => 'Удалить'
                )), array(
                    'controller' => 'custom_status_types',
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
    var table_custom_status_type;
    var custom_status_type_index = 0;
    $(document).ready(function() {
        table_custom_status_type = $('#table-custom-status-type').dataTable({
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            "oLanguage" : {
                "sZeroRecords":  "Записи отсутствуют."
            },
            "aoColumns": [
                null,
                null,
                null,
                {
                    "bVisible": false
                }
            ],
            'fnRowCallback': function(nRow, aArray, iDisplayIndex) {
                if(aArray[3] == 'new')
                    nRow.className = 'added-row';
                return nRow;
            }
        });

        enable_image_show();//при нажатии на изображение оно показывается
        enable_collapsing();//при нажатии на ссылку, отобразить инпут для файла
    });

    function fnAddRow() {
        table_custom_status_type.fnAddData([
            '<input type="file" size="10" name="data[CustomStatusTypeNew]['+custom_status_type_index+'][image_file]"/>',
            '<input type="text" name="data[CustomStatusTypeNew]['+custom_status_type_index+'][name]"/>',
            '<a class="link-delete-new-row" title="Удалить" href="#"><img src="'+webroot+'img/delete.png"/></a>',
            'new'
        ]);
        custom_status_type_index++;

        $('.link-delete-new-row').click(function() {
            table_custom_status_type.fnDeleteRow($(this).parent().parent().get(0));
        });
    }
</script>