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
<?php foreach($page_js as $js) { ?>
<script type="text/javascript" src="<?php echo "{$this->webroot}js/$js.js";?>"> </script>
<?php }?>
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
    <div id="top-menu"><?php echo $this->element('menu_box');?></div>
    <?php echo $this->element('breadcrumb');?>
    <div id="div-content-for-layout"><?php $session->flash();?><?php echo $content_for_layout;?></div>
    <div id="bottom-menu"><?php echo $this->element('menu_box');?></div>
    <div id="footer"><?php echo $this->element('footer');?></div>
</body>
</html>