<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php header("Content-Type:text/html;charset=utf-8"); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $html->charset(); ?>
<title><?php echo $title_for_layout?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<meta content="<?php echo '';?>" name="keywords"/>
<meta content="<?php echo '';?>" name="description"/>
<?php echo $scripts_for_layout ?>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery-1.4.2.min.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.cookie.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/slimbox2.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.blockUI.js"> </script>
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
<script type="text/javascript">
    $(function() {
        $.blockUI.defaults.message = '<?php echo $html->image('busy.gif');?>';
        $.blockUI.defaults.css = {top:'50%',left:'50%',background:'transparent',cursor:'wait'};
        $.blockUI.defaults.overlayCSS = {backgroundColor:'#fff',opacity:0.8};
        
        $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
    });
</script>
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