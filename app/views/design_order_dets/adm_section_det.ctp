<?php echo $session->flash(); ?>

<?php echo $html->div('table-caption', 'Настройка секции "'.$section_name.'"');

    echo $html->div('action',
            $html->link('Добавить параметр', array(
                'controller' => 'section_dets',
                'action' => 'add_section_det/'.$section_dets[0]['SectionDet']['section_id']
            ))
    );
?>
<table class="align-table">
    <tr>
        <td width="75%" style="border-left: 1px dotted #CCCCDD;">

            <div id="table-header">
                <div class="td-section-det-name">Название параметра</div>
                <div class="td-sort-order">Сортировка</div>
                <div class="td-action">Действие</div>
            </div>
            <ul id="table-body">
                <?php foreach($section_dets as $section_det) {
                    $section_id = $section_det['SectionDet']['section_id'];
                    $section_det_id = $section_det['SectionDet']['id'];

                    $param_name      = $section_det['SectionDet']['param_name'];
                    $sort_order      = $section_det['SectionDet']['sort_order'];
                ?>
                <li section_det_id="<?php echo $section_det_id;?>"
                    class="table-row"
                    id="li-<?php echo $section_det_id;?>">
                    <div class="td-div td-section-det-name">
                        <input section_det_id="<?php echo $section_det_id;?>"
                               class="input-save-all-form input-section-det-name"
                               value="<?php echo $param_name;?>"
                               name="data[SectionDet][<?php echo $section_det_id;?>][param_name]">
                    </div>
                    <div class="td-div td-sort-order">
                        <input class="input-save-all-form input-sort-order"
                               value="<?php echo $sort_order;?>"
                               name="data[SectionDet][<?php echo $section_det_id;?>][sort_order]">
                    </div>
                    <div class="td-div td-action">
                       <?php echo $html->link('Удалить', array('controller' => 'section_dets', 'action' => 'delete_section_det/'.$section_det_id)); ?>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <?php echo $form->create('DesignOrderDet', array(
                'action' => 'save_list_section_det',
                'id' => 'section-det-save-all',
                'type' => 'file'
            ));

            $form->hidden('section_id', array('value' => $section_id));
            ?>
            <div id="div-section-det-save-all" style="display: none;">
            </div>
            <?php 
               echo $form->button('Отмена', array('id' => 'btnCancel'));
               echo $form->end('Сохранить');
            ?>
        </td>
    </tr>
</table>

<script type="text/javascript">

    $(document).ready(function() {
        enable_validation();
        enable_image_show();
        enable_link_dialog();

       jQuery('#btnCancel').click( function(){
         window.location = <?php echo "'".$this->webroot."design_order_dets/adm_design_section'"; ?>;
       });

        $('.input-save-all-form').change(function() {
            $(this).parent().addClass('div-changed');
            $(this).addClass('input-changed');
        });
        $('.input-save-all-form').keypress(function() {
            $(this).parent().addClass('div-changed');
            $(this).addClass('input-changed');
        });

        if(!$.browser.msie) {
            $('.input-section-det-name').focus(function() {
                $(this).parent().parent().find('.td-div').css('visibility', 'hidden');
                $(this).parent().css('visibility', 'visible');
                $(this).animate({
                    width: 500
                });
            });

            $('.input-section-det-name').blur(function() {
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

        $('#section-det-save-all').submit(function() {
            $('.input-changed').clone().appendTo('#div-section-det-save-all');
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
