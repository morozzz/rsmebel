<h1>Списки параметров товаров</h1>
<?php
    echo $form->create('ProductDetParamValue', array(
        'action' => 'save',
        'type' => 'file'
    ));
?>
<div id="div-product-det-param-value">
<table id="table-product-det-param-value">
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
        if(!empty($product_det_param_values)) {
            foreach($product_det_param_values as $product_det_param_value) {
                $id = $product_det_param_value['ProductDetParamValue']['id'];
                echo "<tr>";

                //изображение
                echo '<td class="td-image"';
                    if(empty($product_det_param_value['Image']['url'])) {
                        echo "Нет изображения";
                    } else {
                        echo $html->image($product_det_param_value['Image']['url'], array(
                            "class" => "table-icon show-image"
                        ));
                    }

                    echo $html->link('загрузить', '#', array('class' => 'link-collapse'));
                    echo $html->div('div-collapsed', $form->file('', array(
                        'name' => 'data[ProductDetParamValue]['.$id.'][image_file]',
                        'size' => 10
                    )));
                echo "</td>";

                //название
                echo "<td>";
                    echo $form->text('', array(
                        'name' => 'data[ProductDetParamValue]['.$id.'][name]',
                        'value' => $product_det_param_value['ProductDetParamValue']['name']
                    ));
                echo "</td>";

                //удалить
                echo "<td>";
                echo $html->link($html->image('delete.png', array(
                    'alt' => 'Удалить'
                )), array(
                    'controller' => 'product_det_param_values',
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
    var table_product_det_param_value;
    var product_det_param_value_index = 0;
    $(document).ready(function() {
        table_product_det_param_value = $('#table-product-det-param-value').dataTable({
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            "oLanguage" : {
                "sZeroRecords":  "Записи отсутствуют."
            },
            "aoColumns": [
                {
                    'bVisible': false
                },
//                null,
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
        table_product_det_param_value.fnAddData([
            '<input type="file" size="10" name="data[ProductDetParamValueNew]['+product_det_param_value_index+'][image_file]"/>',
            '<input type="text" name="data[ProductDetParamValueNew]['+product_det_param_value_index+'][name]"/>',
            '<a class="link-delete-new-row" title="Удалить" href="#"><img src="'+webroot+'img/delete.png"/></a>',
            'new'
        ]);
        product_det_param_value_index++;

        $('.link-delete-new-row').click(function() {
            table_product_det_param_value.fnDeleteRow($(this).parent().parent().get(0));
        });
    }
</script>