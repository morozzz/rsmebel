<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php header("Content-Type:text/html;charset=utf-8"); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $html->charset(); ?>
<title><?php echo $title_for_layout?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<meta content="<?php echo $strs[4];?>" name="keywords"/>
<meta content="<?php echo $strs[5];?>" name="description"/>
<?php echo $scripts_for_layout ?>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery-1.4.2.min.js"> </script>
<!--<script type="text/javascript" src="<?php echo $this->webroot; ?>js/bevel.js"> </script>-->
<?php foreach($page_js as $js) {
    $src = $this->webroot."js/".$js.".js";
?>
<script type="text/javascript" src="<?php echo $src; ?>"> </script>
<?php } ?>
<!--
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery-1.4.2.min.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.form.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.treeview.min.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.fumodal.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/common.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery-ui-1.8.4.custom.tabs.min.js"> </script>
-->
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

img {
    behavior: url("http://mto/cake/pngbehavior.htc");
}
    </style>
</head>
<body>

    <div id = "top-hd" style="display:none;"><?php echo $strs[1];?></div>

    <div id="top-lg">
        <?php /*echo $html->image('top-background.jpg', array('id' => 'img-top-background'));*/?>
        <div class="div-top-left">
            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="329" height="116" id="Лого2" align="middle">
                <param name="allowScriptAccess" value="sameDomain" />
                <param name="movie" value="Лого2.swf" />
                <param name="quality" value="high" />
                <param name="bgcolor" value="#ffffff" />
                <embed src="<?php echo $logo_path;?>" quality="high" bgcolor="#ffffff" width="329" height="116" name="Лого5" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
            </object>
        </div>
        <?php echo $html->image('top-left.png', array('id' => 'img-top-left'));?>
        <?php echo $html->image('top-right.png', array('id' => 'img-top-right'));?>
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
                            'class' => 'img-banner-top-reflex'
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

<?php echo $content_for_layout ?>

    <div id="bottom-menu" class="h-menu">
       <?php
         echo $this->element('menu_box');
       ?>
    </div>

    <div class="div-footer">
        <div class="div-footer-left"></div>
        <div class="div-footer-right"></div>
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

    <script type="text/javascript">
        var webroot = "<?php echo $this->webroot;?>";
        var forumroot = webroot.replace('cake', 'forum');
        jQuery(document).ready(function() {
            jQuery('#link-logout').click(function() {
                jQuery.ajax({
                    url: forumroot+'phpbb_logout.php',
                    success: function() {
                        window.location = jQuery('#link-logout').attr('href');
                    }
                })
                return false;
            })

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
        });
    </script>
</body>
</html>