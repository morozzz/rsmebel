<?php define('MAX_ROW_COUNT', 4);?>
<?php $paginator->options(array('url' => $this->params['pass']));?>
<?php echo $this->element('caption', array(
    'caption_name' => 'Дизайн интерьера магазина',
    'caption_tag' => 'h1'
)); ?>
<div class="div-project-body">
    <div class="div-project-str-top-background">
        <div class="div-project-str-top">
            <?php echo $strs[2];?>
        </div>
    </div>

      <?php
        echo $this->element('projects_menu_box');
      ?>

    <div class="div-projects">
    <table width="100%" cellpadding="0" cellspacing="10px" border="0"><tbody>
        <?php $row_cnt = 0;?>
        <?php foreach($projects as $project_id => $project) { ?>
        <?php $url = $html->url("/projects/show/$project_id");?>
        <?php if($row_cnt == 0)  { ?>
        <tr>
        <?php } ?>
            <td width="<?php echo 100/MAX_ROW_COUNT ?>%" class="td-project" valign="top">
                <a href="<?php echo $url;?>">
                    <div class="div-project">
                        <h2 class="caption-project-name">
                            <?php echo $project['Project']['name'];?>
                        </h2>
                        <div class="div-project-image">
                            <div class="div-project-image-1">
                                <div class="div-project-image-2">
                                    <div class="div-project-image-3"
                                         style="background: url(<?php echo $this->webroot.'img/'.$project['SmallImage']['url'];?>) no-repeat center center">
                                        <?php echo $html->image($project['SmallImage']['url']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($project['Project']['project_profile_id'])) { ?>
                        <div class="project-line">
                            <h3 class="caption-profile-label caption-label">Профиль:</h3>
                            <h4 class="caption-profile-name caption-data"><?php echo $project['ProjectProfile']['name'];?></h4>
                        </div>
                        <br>
                        <?php } ?>
                        <?php if(!empty($project['Project']['address'])) { ?>
                        <div class="project-line">
                            <h3 class="caption-address-label caption-label">Адрес:</h3>
                            <h4 class="caption-address caption-data"><?php echo $project['Project']['address'];?></h4>
                        </div>
                        <div style="clear: both"></div>
                        <?php } ?>
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
    
      <?php
        echo $this->element('projects_menu_box');
      ?>

    <div class="div-project-str-bottom-background">
        <div class="div-project-str-bottom">
            <?php echo $strs[3];?>
        </div>
    </div>
</div>

<script type="text/javascript">
    var webroot = "<?php echo $this->webroot;?>";
    $(".select-profile").change(function() {
        var profile_id = $(this).find('option:selected').val();
        document.location = webroot+'projects/index/'+profile_id;
    })

    $('.pagination-limit-select').change(function() {
        var limit = $(this).val();
        var url = webroot+'projects/index/<?php if($profile_id>0) echo "$profile_id/"?>limit:'+limit;
        window.location = url;
    });
</script>