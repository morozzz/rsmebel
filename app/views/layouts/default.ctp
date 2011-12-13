<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php header("Content-Type:text/html;charset=utf-8"); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $html->charset(); ?>
<?php if(empty($main_title_for_layout)) $main_title_for_layout = $title_for_layout;?>
<title><?php echo $main_title_for_layout?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<meta content="<?php echo $url_keyword;?>" name="keywords"/>
<meta content="<?php echo $url_description;?>" name="description"/>
<?php echo $scripts_for_layout ?>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery-1.4.2.min.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.cookie.js"> </script>
<?php foreach($page_js as $js) {echo $html->script($src);}?>
<?php
echo $html->css("all.css");
if(isset($page_css)) {
    foreach($page_css as $css) {
        $filename = 'css/'.$css.'.css';
        if(file_exists($filename))
            echo $html->css($css.".css");
    }
}
?>
</head>
<body>
    <div id="div-top"><?php echo $this->element('top');?></div>
    <div id="div-top-menu" class="h-menu"><?php echo $this->element('menu_box');?></div>

<div id="div-content-for-layout">
    <?php echo $content_for_layout ?>
</div>

    <div id="bottom-menu" class="h-menu">
       <?php
         echo $this->element('menu_box');
       ?>
    </div>

    <div class="div-footer">
        <div class="div-footer-left">
            <?php echo $home_footers[0]['HomeFooter']['left_info']; ?>
        </div>
        <div class="div-footer-right">
            <?php echo $home_footers[0]['HomeFooter']['right_info']; ?>
        </div>
        <div class="div-footer-info">
            <div class="div-footer-top-info">
                <?php echo $home_footers[0]['HomeFooter']['contacts'];?>
            </div>
            <div class="div-footer-bottom-info">
                <?php echo $home_footers[0]['HomeFooter']['center_info'];?>
            </div>
        </div>
    </div>

    <!--
    <div id="wrapper3">

        <div id="footer-info">
           <?php
              echo $home_footers[0]['HomeFooter']['contacts'];
           ?>
        </div>

        <div id="container3">
            <div class="fluid-left-wrapper">
                <div class="fluid-left">
                   <?php
                      echo $home_footers[0]['HomeFooter']['left_info'];
                   ?>
                </div>
            </div>
            <div class="fluid-right-wrapper">
                <div class="fluid-right">
                   <?php
                      echo $home_footers[0]['HomeFooter']['right_info'];
                   ?>
                </div>
            </div>
            <div class="fixed">
                   <?php
                      echo $home_footers[0]['HomeFooter']['center_info'];
                   ?>
            </div>
        </div>
        <div class="clear-div"></div>
    </div>
    -->

        <a href='http://host-tracker.com/ru/' onMouseOver='this.href="http://host-tracker.com/ru/site-availability-stats/6840654/ff/";'><img
        width='88' height='31' border='0' alt='службы мониторинга серверов'
        src="http://ext.host-tracker.com/uptime-img/?s=31&amp;t=6840654&amp;m=0.59&amp;p=Total&amp;src=ff" /></a><noscript><a href='http://host-tracker.com/ru/' >аудит работоспособности сайта</a></noscript>

        <a href='http://host-tracker.com/' onMouseOver='this.href="http://host-tracker.com/check_page/?furl=http://http://mto24.ru&amp;bt=check-server-speed-80x15.png";' target=_blank><img src='http://host-tracker.com/check-server-speed-80x15.png' border='0' alt='службы мониторинга серверов'></a><noscript><a href='http://host-tracker.com/' >службы мониторинга серверов</a></noscript>

    <script type="text/javascript">
        var webroot = "<?php echo $this->webroot;?>";
        jQuery(document).ready(function() {

            jQuery('.input-search').focus(function() {
                jQuery(this).css({
                    "color": "black",
                    "font-style": "normal"
                });
                jQuery(this).val('');
            });
            jQuery('.input-search').blur(function() {
                jQuery(this).css({
                    "color": "gray",
                    "font-style": "italic"
                });
                jQuery(this).val('поиск');
            });

//            jQuery(".text-shadow").textShadow();
        });
    </script>

    <?php if(!empty($alert)) { ?>
    <div id="div-alert" title="<?php echo $alert['Alert']['caption'];?>">
        <div class="ui-state-highlight" style="padding: 3px 5px;">
            <?php echo $alert['Alert']['message'];?>
        </div>
    </div>
    <script type="text/javascript">
        $('#div-alert').dialog({
            modal: true,
            autoOpen: false,
            height: 'auto',
            draggable: false,
            resizeable: false,
            buttons: {
                'OK': function() {
                    $(this).dialog('close');
                }
            }
        });
        var al = jQuery.cookie('alert');
        if(al != <?php echo $alert['Alert']['id']?>) {
            $('#div-alert').dialog('open');

            jQuery.cookie('alert', '<?php echo $alert['Alert']['id']?>', {path: '/'});
        }
    </script>
    <?php } ?>
</body>
</html>