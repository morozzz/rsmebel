<h1>Производители</h1>
<?php
    echo $form->create('Producer', array(
        'action' => 'save'
    ));
?>
<div id="div-producer">
<table id="table-producer">
    <thead>
        <tr>
            <th>Название</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($producers)) {
            foreach($producers as $producer) {
                $id = $producer['Producer']['id'];
                echo "<tr>";

                //название
                echo "<td>";
                    echo $form->text('', array(
                        'name' => 'data[Producer]['.$id.'][name]',
                        'value' => $producer['Producer']['name']
                    ));
                echo "</td>";

                //удалить
                echo "<td>";
                echo $html->link($html->image('delete.png', array(
                    'alt' => 'Удалить'
                )), array(
                    'controller' => 'producers',
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
    var table_producer;
    var producer_index = 0;
    $(document).ready(function() {
        table_producer = $('#table-producer').dataTable({
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
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
        table_producer.fnAddData([
            '<input type="text" name="data[ProducerNew]['+producer_index+'][name]"/>',
            '<a class="link-delete-new-row" title="Удалить" href="#"><img src="'+webroot+'img/delete.png"/></a>',
            'new'
        ]);
        producer_index++;

        $('.link-delete-new-row').click(function() {
            table_producer.fnDeleteRow($(this).parent().parent().get(0));
        });
    }
</script>