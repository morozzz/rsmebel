<?php echo $session->flash(); ?>

<?php echo $html->div('table-caption', 'Список секций заявки на дизайн'); ?>

<table class="align-table">
    <tr>
        <td width="75%" style="border-left: 1px dotted #CCCCDD;">

            <div id="table-header">
                <div class="td-section-name">Название</div>
                <div class="td-section-type">Тип</div>
                <div class="td-section-mode-name">Обязательное</div>
                <div class="td-section-note">Комментарий</div>
                <div class="td-sort-order">Сортировка</div>
                <div class="td-action">Действие</div>
            </div>
            <ul id="table-body">
                <?php foreach($sections as $section) {
                    $section_id = $section['Section']['id'];

                    $section_name    = $section['Section']['section_name'];
                    $section_type_id = $section['Section']['section_type_id'];
                    $section_type    = $section['SectionType']['section_type_name'];
                    $section_mode_id = $section['Section']['section_mode_id'];
                    if ($section_mode_id == 1) {
                      $section_mode = 'Да';
                    } else { $section_mode = 'Нет'; }
                    $section_note    = htmlspecialchars($section['Section']['note']);
                    $sort_order      = $section['Section']['sort_order'];
                ?>
                <li section_id="<?php echo $section_id;?>"
                    class="table-row"
                    id="li-<?php echo $section_id;?>">
                    <div class="td-div td-section-name">
                        <input section_id="<?php echo $section_id;?>"
                               class="input-save-all-form input-section-name"
                               value="<?php echo $section_name;?>"
                               name="data[Section][<?php echo $section_id;?>][section_name]">
                    </div>
                    <div class="td-div td-section-type">
                        <input class="input-section-type-name"
                               readonly
                               value="<?php echo $section_type;?>">
                        <input class="input-section-type-id"
                               type="hidden"
                               value="<?php echo $section_type_id;?>"
                               name="data[Section][<?php echo $section_id;?>][section_type_id]">
                    </div>
                    <div class="td-div td-section-mode">
                        <?php echo $section_mode;?>
                        <input class="input-section-mode-id"
                               type="hidden"
                               value="<?php echo $section_mode_id;?>"
                               name="data[Section][<?php echo $section_id;?>][section_mode_id]">
                    </div>
                    <div class="td-div td-section-note">
                        <input section_id="<?php echo $section_id;?>"
                               class="input-save-all-form input-section-note"
                               value="<?php echo $section_note; ?>"
                               name="data[Section][<?php echo $section_id;?>][note]">
                    </div>
                    <div class="td-div td-sort-order">
                        <input class="input-save-all-form input-sort-order"
                               value="<?php echo $sort_order;?>"
                               name="data[Section][<?php echo $section_id;?>][sort_order]">
                    </div>
                    <?php
                      if (($section_type_id == 1)||($section_type_id == 3)||($section_type_id == 4)) {
                      echo "<div class='td-div td-action'>";
                      echo $html->link('Настройка', array('controller' => 'design_order_dets', 'action' => 'adm_section_det/'.$section_id));
                      echo "</div>";
                      }
                    ?>
                </li>
                <?php } ?>
            </ul>
            <?php echo $form->create('DesignOrderDet', array(
                'action' => 'save_list',
                'id' => 'section-save-all',
                'type' => 'file'
            ));?>
            <div id="div-section-save-all" style="display: none;">

            </div>
            <?php echo $form->end('Сохранить');?>
        </td>
    </tr>
</table>

<script type="text/javascript">

    $(document).ready(function() {
        enable_validation();
        enable_image_show();
        enable_link_dialog();

        $('.input-save-all-form').change(function() {
            $(this).parent().addClass('div-changed');
            $(this).addClass('input-changed');
        });
        $('.input-save-all-form').keypress(function() {
            $(this).parent().addClass('div-changed');
            $(this).addClass('input-changed');
        });

        if(!$.browser.msie) {
            $('.input-section-name').focus(function() {
                $(this).parent().parent().find('.td-div').css('visibility', 'hidden');
                $(this).parent().css('visibility', 'visible');
                $(this).animate({
                    width: 500
                });
            });

            $('.input-section-name').blur(function() {
                $(this).animate({
                    width: '90%'
                }, 'normal', function() {
                    $(this).parent().parent().find('.td-div').css('visibility', 'visible');
                });
            });

            $('.input-section-note').focus(function() {
                $(this).parent().parent().find('.td-div').css('visibility', 'hidden');
                $(this).parent().css('visibility', 'visible');
                $(this).animate({
                    width: 500
                });
            });

            $('.input-section-note').blur(function() {
                $(this).animate({
                    width: '90%'
                }, 'normal', function() {
                    $(this).parent().parent().find('.td-div').css('visibility', 'visible');
                });
            });
        }

        $('#section-save-all').submit(function() {
            $('.input-changed').clone().appendTo('#div-section-save-all');
        });

        $('#table-body').sortable({
            scrollSpeed: 5,
            update: function(event, ui) {
                //catalogs_reordered = true;
                var array = $('#table-body').sortable('toArray');
                for(var key in array) {
                    var li_id = array[key];
                    $('#'+li_id).find('.input-sort-order').val(parseInt(key)+1);
                }
                $('.input-sort-order').parent().addClass('div-changed');
                $('.input-sort-order').addClass('input-changed');
            }
        });
   });
</script>
