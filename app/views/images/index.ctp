<h1>Загрузка изображений</h1>
<?php
    echo $form->create('Image', array(
        'action' => 'save',
        'type' => 'file'
    ));
?>
<div id="div-image">
<table id="table-image">
    <thead>
        <tr>
            <th>url</th>
            <th>Изображение</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($images)) {
            foreach($images as $image) {
                $id = $image['Image']['id'];
        ?>
        <tr>
            <td>
                <span class='image-url'><?php echo$image['Image']['url'];?></span>
            </td>
            <td class="td-image">
                <?php echo $html->image($image['Image']['url'], array(
                    "class" => "table-icon show-image"
                ));?>
                <a href="#"
                   class="link-collapse"
                   onclick="return false">
                    загрузить
                </a>
                <div class="div-collapsed">
                    <input type="file"
                           name="data[Image][<?php echo $id;?>][image_file]"
                           size="10">
                </div>
            </td>
            <td>
                <?php
                echo $html->link($html->image('delete.png', array(
                    'alt' => 'Удалить'
                )), array(
                    'controller' => 'images',
                    'action' => 'delete',
                    $id
                ), array(
                    'escape' => false,
                    'title' => 'Удалить'
                ), 'Вы уверены, что хотите удалить данное изображение?');
                ?>
            </td>
            <td></td>
        </tr>
        <?php
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
    var table_image;
    var image_index = 0;
    $(document).ready(function() {
        table_image = $('#table-image').dataTable({
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
        table_image.fnAddData([
            '',
            '<input type="file" size="10" name="data[ImageNew]['+image_index+'][image_file]"/>',
            '<a class="link-delete-new-row" title="Удалить" href="#"><img src="'+webroot+'img/delete.png"/></a>',
            'new'
        ]);
        image_index++;

        $('.link-delete-new-row').click(function() {
            table_image.fnDeleteRow($(this).parent().parent().get(0));
        });
    }
</script>