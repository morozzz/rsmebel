<?php define('MAX_ROW_COUNT', 4);?>
<?php echo $common->caption(
        $html->link('Галерея - ', '/projects/index/').$project['Project']['name']);?>
<div class="div-project-info-background">
    <div class="div-project-info">
        <?php if(!empty($project['Project']['project_profile_id'])) { ?>
        <div class="div-project-profile div-project-line">
            <h2 class="caption-project-profile-label caption-label">Профиль:</h2>
            <h3 class="caption-project-profile caption-data">
                <?php echo $project['ProjectProfile']['name']; ?>
            </h3>
        </div>
        <div style="clear: both;"></div>
        <?php } ?>
        <?php if(!empty($project['Project']['address'])) { ?>
        <div class="div-project-address div-project-line">
            <h2 class="caption-project-address-label caption-label">Адрес:</h2>
            <h3 class="caption-project-address caption-data">
                <?php echo $project['Project']['address']; ?>
            </h3>
        </div>
        <div style="clear: both;"></div>
        <?php } ?>
    </div>
</div>

<div class="div-project">
    <?php if(!empty($project['Project']['about']) ||
            !empty($project_catalogs)) { ?>
    <div class="div-project-about-background">
        <?php if(!empty($project['Project']['about'])) { ?>
        <div class="div-project-about">
            <?php echo $project['Project']['about'];?>
        </div>
        <?php } ?>

        <?php if(!empty($project_catalogs)) { ?>
        <div class="div-project-catalogs-main">
            <div class="div-project-catalogs-caption">
                <h4 class="caption-project-catalogs">Использованные серии оборудования</h4>
            </div>
            <ul class="ul-project-catalogs">
                <?php foreach($project_catalogs as $catalog_id => $path) { ?>
                <li class="li-project-catalog"> - <?php echo $catalogCommon->getCatalogPathStr($path);?></li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>
    </div>
    <?php } ?>

    <div class="div-neighbors">
        <div class="div-neighbor-prev">
            <?php
            if(!empty($neighbors['prev'])) {
                echo $html->link(' < < < Назад', array(
                    'controller' => 'projects',
                    'action' => 'show',
                    $neighbors['prev']['Project']['id']
                ));
            }?>
        </div>
        <div class="div-neighbor-next">
            <?php
            if(!empty($neighbors['next'])) {
                echo $html->link('Вперед > > > ', array(
                    'controller' => 'projects',
                    'action' => 'show',
                    $neighbors['next']['Project']['id']
                ));
            }?>
        </div>
        <div class="div-neighbor-center">
            Всего проектов <?php echo $project_cnt;?>,
            показан <?php echo $project['Project']['sort_order'];?>
        </div>
    </div>

    <div class="div-project-slides">
    <table width="100%" cellpadding="0" cellspacing="10px" border="0"><tbody>
        <?php $row_cnt = 0; $num_img=1;?>
        <?php foreach($project_slides as $slide_id => $slide) { ?>
        <?php $url = $html->url("/project_slides/index/$slide_id");?>
        <?php if($row_cnt == 0)  { ?>
        <tr>
        <?php } ?>
            <td width="<?php echo 100/MAX_ROW_COUNT ?>%" class="td-slide" valign="top">
                <a href="<?php echo $url;?>">
                    <div class="div-slide">
                        <div class="div-slide-image">
                            <div class="div-slide-image-1">
                                <div class="div-slide-image-2">
                                    <div class="div-slide-image-3"
                                         style="background: url(<?php echo $this->webroot.'img/'.$slide['SmallImage']['url'];?>) no-repeat center center">
                                        <?php echo $html->image($slide['SmallImage']['url']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="div-slide-num">
                            <?php echo $num_img;?>
                        </div>
                    </div>
                </a>
            </td>
        <?php $row_cnt++; $num_img++;
        if($row_cnt >= MAX_ROW_COUNT)  {
            $row_cnt = 0; ?>
        </tr>
        <?php } ?>

        <?php }
        for($i=$row_cnt+1; $i<=MAX_ROW_COUNT; $i++) {
            $percent = 100/MAX_ROW_COUNT;
            echo "<td width='$percent%' class='td-slide'></td>";
        }
        echo "</tr>";
        ?>
    </tbody></table>
    </div>

    <div class="div-neighbors">
        <div class="div-neighbor-prev">
            <?php
            if(!empty($neighbors['prev'])) {
                echo $html->link(' < < < Назад', array(
                    'controller' => 'projects',
                    'action' => 'show',
                    $neighbors['prev']['Project']['id']
                ));
            }?>
        </div>
        <div class="div-neighbor-next">
            <?php
            if(!empty($neighbors['next'])) {
                echo $html->link('Вперед > > > ', array(
                    'controller' => 'projects',
                    'action' => 'show',
                    $neighbors['next']['Project']['id']
                ));
            }?>
        </div>
        <div class="div-neighbor-center">
            Всего проектов <?php echo $project_cnt;?>,
            показан <?php echo $project['Project']['sort_order'];?>
        </div>
    </div>
</div>