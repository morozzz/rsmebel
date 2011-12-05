<?php $cnews = $this->requestAction('home_news/cnews_box');?>

<?php
$first = true;
foreach($cnews as $new) {?>
<?php if(!$first) { ?>
<div class="div-new-separator">
    <div class="div-new-separator-right"></div>
    <div class="div-new-separator-center"></div>
</div>
<?php } else {
    $first = false;
} ?>
<?php $img_url = $this->webroot.'img/'.$new['SmallImage']['url'];?>
<div class="div-new">
    <div class="div-new-image-container">
        <a class="span-new-image"
           style="background: url(<?php echo $img_url;?>) center center no-repeat white;"
           href="<?php echo $html->url('/cnews/view_new/'.$new['Cnew']['id']);?>">
            <img src="<?php echo $img_url;?>" width="150" height="150"/>
        </a>
    </div>

    <div class="div-new-text">
        <div class="div-new-text-stamp">
            <a href="<?php echo $html->url('/cnews/view_new/'.$new['Cnew']['id']);?>">
                 - <?php echo $new['0']['stamp'];?>
            </a>
        </div>
        <div class="div-new-text-header">
            <a href="<?php echo $html->url('/cnews/view_new/'.$new['Cnew']['id']);?>">
                > <?php echo $new['Cnew']['news_header'];?>
            </a>
        </div>
    </div>
</div>
<?php } ?>
<div class="div-cnews-bottom-separator">
    <div class="div-cnews-bottom"></div>
</div>
