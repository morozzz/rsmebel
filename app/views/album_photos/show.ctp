<?php echo $common->caption($html->link($album['Album']['name'],
        '/album_photos/index/'.$album['Album']['id']));?>
<div class="div-album-photo">

    <div class="div-neighbors pie">
        <div class="div-neighbor-prev">
            <?php
            if($photo_index>1) {
                echo $html->link(' < < < Назад',
                        '/album_photos/show/'.$album['Album']['id'].'/'.($photo_index-1));
            }
            ?>
        </div>
        <div class="div-neighbor-next">
            <?php
            if($photo_index<$cnt) {
                echo $html->link('Вперед > > > ',
                        '/album_photos/show/'.$album['Album']['id'].'/'.($photo_index+1));
            }
            ?>
        </div>
        <div class="div-neighbor-center">
            <?php echo $photo_index?> из
            <?php echo $cnt;?>
        </div>
    </div>
    <div class="div-album-photo-image" align="center">
        <?php
        echo $html->image($album_photo['BigImage']['url'], array(
            'url' => ($photo_index<$cnt)?('/album_photos/show/'.$album['Album']['id'].'/'.($photo_index+1)):(null)
        ));
        echo $album_photo['AlbumPhoto']['long_about'];
        ?>
    </div>

    <div class="div-neighbors pie">
        <div class="div-neighbor-prev">
            <?php
            if($photo_index>1) {
                echo $html->link(' < < < Назад',
                        '/album_photos/show/'.$album['Album']['id'].'/'.($photo_index-1));
            }
            ?>
        </div>
        <div class="div-neighbor-next">
            <?php
            if($photo_index<$cnt) {
                echo $html->link('Вперед > > > ',
                        '/album_photos/show/'.$album['Album']['id'].'/'.($photo_index+1));
            }
            ?>
        </div>
        <div class="div-neighbor-center">
            <?php echo $photo_index?> из
            <?php echo $cnt;?>
        </div>
    </div>
</div>