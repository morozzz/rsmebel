<?php echo $html->div('table-caption', 'Список новостей'); 

    echo $html->div('action',
            $html->link('Добавить новость', array(
                'controller' => 'cnews',
                'action' => 'add'
            ))
    );
?>

<table class="align-table">
    <tr>
        <td width="75%" style="border-left: 1px dotted #CCCCDD;">

            <div id="table-header">
                <div class="td-cnew-stamp">Дата</div>
                <div class="td-cnew-name">Название</div>
                <div class="td-cnew-small-image">М. изображение</div>
                <div class="td-cnew-big-image">Б. изображение</div>
                <div class="td-sort-order">Сортировка</div>
                <div class="td-action"></div>
                <div class="td-action"></div>
            </div>
            <ul id="table-body">
                <?php foreach($cnews as $new) {

                    $stamp = $new[0]['stamp'];
                    $news_header = $new['Cnew']['news_header'];

                    $small_image_url = (empty($new['SmallImage']['url']))?'nopic.gif':$new['SmallImage']['url'];
                    $big_image_url = (empty($new['BigImage']['url']))?'nopic.gif':$new['BigImage']['url'];

                    $sort_order = $new['Cnew']['sort_order'];

                    $cnew_id = $new['Cnew']['id'];

                ?>
                <li cnew_id="<?php echo $cnew_id;?>"
                    class="table-row"
                    id="li-<?php echo $cnew_id;?>">
                    <div class="td-div td-cnew-stamp">
                       <?php echo $stamp; ?>
                    </div>
                    <div class="td-div td-cnew-name">
                       <?php echo $news_header; ?>
                    </div>
                    <div class="td-div td-cnew-small-image">
                       <?php echo $html->image($small_image_url, array('class' => 'table-image',
                                                                       'id' => 'small-image-'.$new['Cnew']['small_image_id'],
                                                                       'onclick' => 'show_image("small-image-'.$new['Cnew']['small_image_id'].'");'));
                       ?>
                    </div>
                    <div class="td-div td-cnew-big-image">
                       <?php echo $html->image($big_image_url, array('class' => 'table-image',
                                                                     'id' => 'big-image-'.$new['Cnew']['big_image_id'],
                                                                     'onclick' => 'show_image("big-image-'.$new['Cnew']['big_image_id'].'");'));
                       ?>
                    </div>

                    <div class="td-div td-sort-order">
                        <input class="input-save-all-form input-sort-order"
                               value="<?php echo $sort_order;?>"
                               name="data[Cnew][<?php echo $cnew_id;?>][sort_order]">
                        <input class="input-save-all-form input-cnew-id"
                               value="<?php echo $cnew_id;?>"
                               type="hidden"
                               name="data[Cnew][<?php echo $cnew_id;?>][id]">
                    </div>
                    <?php
                      echo "<div class='td-div td-action'>";
                      echo $html->link('ред', array('controller' => 'cnews', 'action' => 'edit/'.$cnew_id));
                      echo "</div>";
                      echo "<div class='td-div td-action'>";
                      echo $html->link('удал', array('controller' => 'cnews', 'action' => 'delete/'.$cnew_id));
                      echo "</div>";
                    ?>
                </li>
                <?php } ?>
            </ul>
            <?php echo $form->create('Cnew', array(
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

    function show_image(image_name) {
        var url = document.getElementById(image_name).src;

        var image = new Image();
        image.src = url;
        $.fumodal({
            'width' : image.width,
            'height' : image.height,
            'style' : false,
            'overlayColor' : '#555599',
            'overlayOpacity' : 0.8,
            'content' : '<img src="' + url + '" title="Нажмите, чтобы закрыть" style="cursor:pointer;" onClick="$.fumodal_close()"/>'
        });
    }
</script>


