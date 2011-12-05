<?php define('MAX_ROW_COUNT', 5); ?>
<?php echo $common->caption($html->link($album['Album']['name'],
        'album_photos/index/'.$album['Album']['id']));?>

<div class="div-album-body">
    <div class="div-album-about">
        <?php echo $album['Album']['long_about'];?>
    </div>

    <div class="div-album-photos">
    <table width="100%" cellpadding="0" cellspacing="10px" border="0"><tbody>
        <?php $row_cnt = 0;?>
        <?php foreach($album_photos as $album_photo_id => $album_photo) { ?>
        <?php $url = $html->url("/album_photos/show/{$album['Album']['id']}/$album_photo_id");?>
        <?php if($row_cnt == 0)  { ?>
        <tr>
        <?php } ?>
            <td width="<?php echo 100/MAX_ROW_COUNT ?>%" class="td-album-photo" valign="top">
                <a href="<?php echo $url;?>">
                    <div class="div-album-photo">
                        <div class="div-album-photo-image">
                            <?php echo $html->image($album_photo['SmallImage']['url']);?>
                        </div>
                        <div class="div-album-photo-short-about">
                            <?php echo $album_photo['AlbumPhoto']['short_about'];?>
                        </div>
                    </div>
                </a>
            </td>
        <?php $row_cnt++;
        if($row_cnt >= MAX_ROW_COUNT)  {
            $row_cnt = 0; ?>
        </tr>
        <?php } ?>

        <?php }
        for($i=$row_cnt+1; $i<=MAX_ROW_COUNT; $i++) {
            $percent = 100/MAX_ROW_COUNT;
            echo "<td width='$percent%' class='td-project'></td>";
        }
        echo "</tr>";
        ?>
    </tbody></table>
    </div>
</div>