<h1>Названия колонок товаров</h1>
<?php
    echo $form->create('ProductParamType', array(
        'action' => 'save'
    ));
?>
<div id="div-product-param-type">
<table id="table-product-param-type">
    <thead>
        <tr>
            <th>Название</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($product_param_types)) {
            foreach($product_param_types as $product_param_type) {
                $id = $product_param_type['ProductParamType']['id'];
                echo "<tr>";

                //название
                echo "<td>";
                    echo $form->text('', array(
                        'name' => 'data[ProductParamType]['.$id.'][name]',
                        'value' => $product_param_type['ProductParamType']['name']
                    ));
                echo "</td>";

                //удалить
                echo "<td>";
                echo $html->link($html->image('delete.png', array(
                    'alt' => 'Удалить'
                )), array(
                    'controller' => 'product_param_types',
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
    var table_product_param_type;
    var product_param_type_index = 0;
    $(document).ready(function() {
        table_product_param_type = $('#table-product-param-type').dataTable({
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
        table_product_param_type.fnAddData([
            '<input type="text" name="data[ProductParamTypeNew]['+product_param_type_index+'][name]"/>',
            '<a class="link-delete-new-row" title="Удалить" href="#"><img src="'+webroot+'img/delete.png"/></a>',
            'new'
        ]);
        product_param_type_index++;

        $('.link-delete-new-row').click(function() {
            table_product_param_type.fnDeleteRow($(this).parent().parent().get(0));
        });
    }
</script>