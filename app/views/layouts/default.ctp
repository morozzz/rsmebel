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
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/iepngfix_tilebg.js"> </script>
<?php
//<script type="text/javascript" src="<?php echo $this->webroot; ? >js/jquery.textshadow.js"> </script>
?>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.cookie.js"> </script>
<?php foreach($page_js as $js) {
    $src = $this->webroot."js/".$js.".js";
?>
<script type="text/javascript" src="<?php echo $src; ?>"> </script>
<?php } ?>
<?php
echo $html->css("mto.css");
//echo $html->css("jquery.treeview.css");
//echo $html->css("fumodal.css");
//echo $html->css("jquery-ui-1.8.2.custom.css");
if(isset($page_css)) {
    foreach($page_css as $css) {
        $filename = 'css/'.$css.'.css';
        if(file_exists($filename))
            echo $html->css($css.".css");
    }
}
?>
<style type="text/css">
.iepngfix {
    behavior: url("<?php echo $this->webroot;?>htc/iepngfix.htc");
}
.pie {
    position: relative;
    behavior: url("<?php echo $this->webroot;?>htc/PIE.htc");
}
.div-header-center {
    -pie-background: url(<?php echo $this->webroot;?>img/caption-left-background.png) no-repeat right,
        url(<?php echo $this->webroot;?>img/caption-right-background.png) no-repeat left,
        url(<?php echo $this->webroot;?>img/caption-center-background-repeat.png) repeat;
}
/*body {
    behavior: url("<?php echo $this->webroot;?>/htc/csshover3.htc");
}*/
</style>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-7317393-5']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>

<!-- Yandex.Metrika counter -->
<div style="display:none;"><script type="text/javascript">
(function(w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter9436525 = new Ya.Metrika({id:9436525, enableAll: true});
        }
        catch(e) { }
    });
})(window, "yandex_metrika_callbacks");
</script></div>
<script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript" defer="defer"></script>
<noscript><div><img src="//mc.yandex.ru/watch/9436525" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

    <div id = "top-hd" style="display:none;"><?php echo $strs[1];?></div>

    <div id="top-lg">
        <?php echo $html->div('div-top-caption', $html->tag('h1', $strs[12]));?>
        <?php /*echo $html->image('top-background.jpg', array('id' => 'img-top-background'));*/?>
        <div class="div-top-left">
            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="327" height="116" id="Лого2" align="middle">
                <param name="allowScriptAccess" value="sameDomain" />
                <param name="movie" value="<?php echo $logo_path;?>" />
                <param name="wmode" value="transparent"/>
                <param name="quality" value="high" />
                <param name="bgcolor" value="#ffffff" />
                <embed src="<?php echo $logo_path;?>" wmode="transparent" quality="high" bgcolor="#ffffff" width="327" height="116" name="Лого5" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
            </object>
        </div>
        <div id="div-top-left-flash-link">
            <a href="<?php echo $html->url('/');?>">
                <?php echo $html->image('329-116-transparent.gif');?>
            </a>
        </div>
        <?php
        echo $html->image('top-left.png', array(
            'id' => 'img-top-left',
            'class' => 'iepngfix'
        ));
        echo $html->image('top-right.png', array(
            'id' => 'img-top-right',
            'class' => 'iepngfix'
        ));
        ?>
        <div id="div-banners">
            <table width="100%">
                <tr align="center">
                    <?php foreach($banners as $banner) { ?>
                    <td>
                        <?php
                        echo $html->image($banner['Image']['url'], array(
                            'url' => $banner['Banner']['link'],
                            'class' => 'img-banner-top'
                        ));
                        echo $html->image('banner-reflex.png', array(
                            'class' => 'img-banner-top-reflex iepngfix'
                        ));
                        ?>
                    </td>
                    <?php } ?>
                </tr>
            </table>
        </div>
    </div>
    <div id="top-menu" class="h-menu">
       <?php
         echo $this->element('menu_box');
       ?>
    </div>

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
        var forumroot = webroot.replace('cake', 'forum');
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