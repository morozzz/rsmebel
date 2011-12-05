<?php define('MAX_ROW_COUNT', 4);?>
<?php echo $common->caption($catalog['Catalog']['name'].' (иллюстрации из проектов)');?>
<cake:nocache>
<div class="top-header hide-menu">
   <?php
     echo $this->element('basket_menu_box');
   ?>
</div>
</cake:nocache>
<div class="div-main-catalog"><table width="100%" class="table-main-catalog" align="left" cellpadding="0" cellspacing="0" border="0"><tbody><tr><td width="25%" valign="top">
<div id="catalog-path-tree">
    <?php echo $catalogCommon->getCatalogTreeStr(
                    $path_tree, $path, $cur_catalog_id, 'index'); ?>
</div>
<!--<div id="catalog-path-tree-background"></div>-->
</td><td width="75%" valign="top">
<div class="div-catalog-path">
    <?php echo $common->getPathStr($path);?>
</div>
<div id="catalog-body">
    <table width="100%" cellpadding="0" cellspacing="20px" border="0" class="table-slides"><tbody>
        <?php $row_cnt = 0;?>
        <?php foreach($project_slides as $project_slide) { ?>
        <?php $url = $html->url("/project_slides/index/{$project_slide['ProjectSlide']['id']}");?>
        <?php if($row_cnt == 0)  { ?>
        <tr>
        <?php } ?>
            <!--<div class="td-article" style="float: left; width: 20%;">-->
            <td width="<?php echo 100/MAX_ROW_COUNT ?>%" class="td-projectslide" valign="top">
                <a href="<?php echo $url;?>">
                    <div class="div-projectslide">
                        <div class="div-projectslide-image">
                            <div class="div-projectslide-image-1">
                                <div class="div-projectslide-image-2">
                                    <div class="div-projectslide-image-3"
                                         style="background: url(<?php echo $this->webroot.'img/'.$project_slide['ProjectSlide']['SmallImage']['url'];?>) no-repeat center center">
                                        <?php echo $html->image($project_slide['ProjectSlide']['SmallImage']['url']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="<?php echo $html->url('/projects/show/'.$project_slide['ProjectSlide']['project_id']);?>">
                    <div class="div-project-name">
                        <?php echo $project_slide['ProjectSlide']['Project']['name'];?>
                    </div>
                </a>
            <!--</div>-->
            </td>
        <?php $row_cnt++;
        if($row_cnt >= MAX_ROW_COUNT)  {
            $row_cnt = 0; ?>
        <!--</div>-->
        </tr>
        <?php } ?>

        <?php }
        for($i=$row_cnt+1; $i<=MAX_ROW_COUNT; $i++) {
            $percent = 100/MAX_ROW_COUNT;
            echo "<td width='$percent%' class='td-projectslide'></td>";
        }
        echo "</tr>";
        ?>
    </tbody></table>
</div>
</td></tr></tbody></table></div>