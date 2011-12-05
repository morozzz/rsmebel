<?php define('TR_IMAGE_COUNT', 5);?>

<div class="div-images">
    <table class="table-images">
        <tbody>
            <tr>
                <?php
                $tr_image_cnt = 0;
                foreach($images as $image) {
                    if($tr_image_cnt == TR_IMAGE_COUNT) {
                        echo "</tr><tr>";
                        $tr_image_cnt = 0;
                    }
                ?>
                <td class="td-image">
                    <div class="div-td-image">
                        <div class="div-image">
                            <a href="#"
                               onclick="return false;"
                               title="увеличить">
                                <?php echo $html->image($image['Image']['url'], array(
                                    'class' => 'show-image image'
                                ));?>
                            </a>
                        </div>
                        <a href="#"
                           class="link-select-image"
                           onclick="return false;">
                            выбрать
                        </a>
                    </div>
                </td>
                <?php $tr_image_cnt++;?>
                <?php } ?>
                <?php for($i=TR_IMAGE_COUNT; $i>$tr_image_cnt; $i--) { ?>
                    <td class="td-image"></td>
                <?php } ?>
            </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        enable_image_show();
        
        $('.div-images').height($(window).height());

        $('.div-td-image').click(function() {
            $('.div-td-image-selected').removeClass('div-td-image-selected');
            $(this).addClass('div-td-image-selected');
        })

        $('.div-td-image').dblclick(function() {
            select_image($(this));
        });

        $('.link-select-image').click(function() {
            select_image($(this).parent());
        })
    });

    function select_image(div_td_image) {
        var funcNum = <?php echo $params['CKEditorFuncNum'];?>;
        var image = div_td_image.find('img.image');
//        alert(image.attr('src'));
        window.opener.CKEDITOR.tools.callFunction(funcNum, image.attr('src'));
        window.close();
    }
</script>