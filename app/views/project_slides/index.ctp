<?php echo $common->caption(
        $html->link($slide['Project']['name'],
                '/projects/show/'.$slide['Project']['id']).' - изображения');?>

<div class="div-slide">
    <?php if(!empty($slide['ProjectSlide']['about']) ||
            !empty($slide_catalogs)) { ?>
    <div class="div-slide-about-background">
        <?php if(!empty($slide['ProjectSlide']['about'])) { ?>
        <div class="div-slide-about">
            <?php echo $slide['ProjectSlide']['about'];?>
        </div>
        <?php } ?>

        <?php if(!empty($slide_catalogs)) { ?>
        <div class="div-slide-catalogs-main">
            <div class="div-slide-catalogs-caption">
                <h4 class="caption-slide-catalogs">Использованные серии оборудования</h4>
            </div>
            <ul class="ul-slide-catalogs">
                <?php foreach($slide_catalogs as $catalog_id => $path) { ?>
                <li class="li-slide-catalog"><?php echo $catalogCommon->getCatalogPathStr($path);?></li>
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
                    'controller' => 'project_slides',
                    'action' => 'index',
                    $neighbors['prev']['ProjectSlide']['id']
                ));
            }?>
        </div>
        <div class="div-neighbor-next">
            <?php
            if(!empty($neighbors['next'])) {
                echo $html->link('Вперед > > > ', array(
                    'controller' => 'project_slides',
                    'action' => 'index',
                    $neighbors['next']['ProjectSlide']['id']
                ));
            }?>
        </div>
        <div class="div-neighbor-center">
            <?php echo $slide['ProjectSlide']['sort_order']?> из
            <?php echo $slide_cnt;?>
        </div>
    </div>

    <?php if(false) { ?>
    <div class="div-slide-image">
        <div class="div-slide-image-1">
            <div class="div-slide-image-2">
                <div class="div-slide-image-3"
                     style="background: url(<?php echo $this->webroot.'img/'.$slide['BigImage']['url'];?>) no-repeat center center">
                    <?php echo $html->image($slide['BigImage']['url']); ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div align="center" class="div-slide-image">
        <?php
        $url = null;
        if(!empty($neighbors['next']))
            $url = '/project_slides/index/'.$neighbors['next']['ProjectSlide']['id'];
        echo $html->image($slide['BigImage']['url'], array(
            'class' => 'img-slide',
            'url' => $url
        ));
        ?>
    </div>

    <div class="div-neighbors">
        <div class="div-neighbor-prev">
            <?php
            if(!empty($neighbors['prev'])) {
                echo $html->link(' < < < Назад', array(
                    'controller' => 'project_slides',
                    'action' => 'index',
                    $neighbors['prev']['ProjectSlide']['id']
                ));
            }?>
        </div>
        <div class="div-neighbor-next">
            <?php
            if(!empty($neighbors['next'])) {
                echo $html->link('Вперед > > > ', array(
                    'controller' => 'project_slides',
                    'action' => 'index',
                    $neighbors['next']['ProjectSlide']['id']
                ));
            }?>
        </div>
        <div class="div-neighbor-center">
            <?php echo $slide['ProjectSlide']['sort_order']?> из
            <?php echo $slide_cnt;?>
        </div>
    </div>
</div>