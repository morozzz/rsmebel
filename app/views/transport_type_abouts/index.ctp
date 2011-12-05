<h1>Описания способа доставки "<?php echo $transport_type['TransportType']['name']?>"</h1>
<?php
    echo $form->create('TransportTypeAbout', array(
        'action' => 'save'
    ));
?>
<div id="div-transport-type-about">
<table id="table-transport-type-about">
    <thead>
        <tr>
            <th>Название</th>
            <th>Текст</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($transport_type_abouts)) {
            foreach($transport_type_abouts as $transport_type_about) {
                $id = $transport_type_about['TransportTypeAbout']['id'];
                echo "<tr>";

                //название
                echo "<td>";
                    echo $form->text('', array(
                        'name' => 'data[TransportTypeAbout]['.$id.'][name]',
                        'value' => $transport_type_about['TransportTypeAbout']['name'],
                        'class' => 'input-transport-type-about-name'
                    ));
                echo "</td>";

                echo "<td>";
                echo $html->div('action edit_text', 'Редактировать текст');
                echo "</td>";

                //удалить
                echo "<td>";
                echo $html->link($html->image('delete.png', array(
                    'alt' => 'Удалить'
                )), array(
                    'controller' => 'transport_type_abouts',
                    'action' => 'delete',
                    $id
                ), array(
                    'escape' => false,
                    'title' => 'Удалить'
                ), 'Вы уверены, что хотите удалить данную позицию?');
                echo "</td>";

                echo "<td>$id</td>";

                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>
<a href="#" onclick="fnAddRow();">Добавить строку</a>
<?php
    echo $form->hidden('', array(
        'value' => $transport_type['TransportType']['id'],
        'name' => 'data[transport_type_id]'
    ));
    echo $form->end('Сохранить');
?>
</div>

<div id="div-edit-text-dialog">
    <?php
        echo $form->create('TransportTypeAbout', array(
            'action' => 'save_about_text',
            'id' => 'dialog-save-text-form'
        ));

        echo $form->textarea('', array(
            'name' => 'data[text]',
            'id' => 'dialog-about'
        ));
    ?>
    <?php
        echo $form->hidden('', array(
            'name' => 'data[transport_type_about_id]',
            'value' => 0,
            'id' => 'dialog-transport-type-about-id'
        ));
        echo $form->button('Отмена', array(
            'id' => 'dialog-cancel'
        ));
        echo $form->button('Сохранить', array(
            'type' => 'submit'
        ));
        echo $form->end();
    ?>
</div>

<script type="text/javascript">
    var webroot = "<?php echo $this->webroot; ?>";
    var about_textes = <?php
        $about_textes = Set::combine($transport_type_abouts, '{n}.TransportTypeAbout.id', '{n}.TransportTypeAbout.text');
        echo $javascript->object($about_textes);
    ?>;
    var table_transport_type_about;
    var transport_type_about_index = 0;
    var editor = null;
    $(document).ready(function() {
        table_transport_type_about = $('#table-transport-type-about').dataTable({
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

        editor = CKEDITOR.replace('dialog-about');
        $('#div-edit-text-dialog').appendTo(document.body);
        //всплывающее окно редактирования текста описания
        $('.edit_text').click(function() {
            var transport_type_about_id = table_transport_type_about.fnGetData($(this).parent().parent().get(0))[3];
            if(transport_type_about_id == null) return;

            var about_text = about_textes[transport_type_about_id];
            if(about_text != null) {
                //$('#dialog-about').val(about_text);
                editor.setData(about_text);
            } else {
                editor.setData('');
            }
            $('#dialog-transport-type-about-id').val(transport_type_about_id);

            var dlg = $('#div-edit-text-dialog');
            var dlg_width = dlg.width();
            var dlg_height = dlg.height();
            var scroll_top = $(window).scrollTop();
            var win_width = $(window).width();
            var win_height = $(window).height();

            dlg.css('left', (win_width-dlg_width)/2);
            dlg.css('top', scroll_top+(win_height-dlg_height)/2)
            dlg.show();


        });

        //расширенный редактор текста описания
//        var about_text_fck = new FCKeditor('dialog-about');
//        about_text_fck.BasePath = "<?php /*echo $this->webroot;*/ ?>js/fckeditor/" ;
//        about_text_fck.Height = 470;
//        about_text_fck.ReplaceTextarea();
        
        //кнопка Отмена во всплывающем окне
        $('#dialog-cancel').click(function() {
            $('#div-edit-text-dialog').close();
        });
    });

    function fnAddRow() {
        table_transport_type_about.fnAddData([
            '<input type="text" name="data[TransportTypeAboutNew]['+transport_type_about_index+'][name]" class="input-transport-type-about-name"/>',
            '',
            '<a class="link-delete-new-row" title="Удалить" href="#"><img src="'+webroot+'img/delete.png"/></a>',
            'new'
        ]);
        transport_type_about_index++;

        $('.link-delete-new-row').click(function() {
            table_transport_type_about.fnDeleteRow($(this).parent().parent().get(0));
        });
    }
</script>