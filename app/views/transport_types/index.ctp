<h1>Типы доставки</h1>
<?php
    echo $form->create('TransportType', array(
        'action' => 'save'
    ));
?>
<div id="div-transport-type">
<table id="table-transport-type">
    <thead>
        <tr>
            <th>Название</th>
            <th>Стоимость</th>
            <th>Описания</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($transport_types)) {
            foreach($transport_types as $transport_type) {
                $id = $transport_type['TransportType']['id'];
                echo "<tr>";

                //название
                echo "<td>";
                    echo $form->text('', array(
                        'name' => 'data[TransportType]['.$id.'][name]',
                        'value' => $transport_type['TransportType']['name'],
                        'class' => 'input-transport-type-name'
                    ));
                echo "</td>";

                //стоимость
                echo "<td>";
                    echo $form->text('', array(
                        'name' => 'data[TransportType]['.$id.'][price]',
                        'value' => $transport_type['TransportType']['price'],
                        'class' => 'input-transport-type-price textbox-float'
                    ));
                echo "</td>";

                //описание
                echo "<td>";
                    echo $html->link('Описания', array(
                        'controller' => 'transport_type_abouts',
                        'action' => 'index',
                        $id
                    ));
                echo "</td>";

                //удалить
                echo "<td>";
                echo $html->link($html->image('delete.png', array(
                    'alt' => 'Удалить'
                )), array(
                    'controller' => 'transport_types',
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
<a href="#" onclick="fnAddRow();">Добавить строку</a>
<?php
    echo $form->end('Сохранить');
?>
</div>

<script type="text/javascript">
    var webroot = "<?php echo $this->webroot; ?>";
    var table_transport_type;
    var transport_type_index = 0;
    $(document).ready(function() {
        enable_validation();
        
        table_transport_type = $('#table-transport-type').dataTable({
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
                null,
                {
                    "bVisible": false
                }
            ],
            'fnRowCallback': function(nRow, aArray, iDisplayIndex) {
                if(aArray[4] == 'new')
                    nRow.className = 'added-row';
                return nRow;
            }
        });
    });

    function fnAddRow() {
        table_transport_type.fnAddData([
            '<input type="text" name="data[TransportTypeNew]['+transport_type_index+'][name]" class="input-transport-type-name"/>',
            '<input type="text" name="data[TransportTypeNew]['+transport_type_index+'][price]" class="input-transport-type-price"/>',
            '',
            '<a class="link-delete-new-row" title="Удалить" href="#"><img src="'+webroot+'img/delete.png"/></a>',
            'new'
        ]);
        transport_type_index++;

        $('.link-delete-new-row').click(function() {
            table_transport_type.fnDeleteRow($(this).parent().parent().get(0));
        });
    }
</script>