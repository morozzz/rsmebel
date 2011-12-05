<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php header("Content-Type:text/html;charset=utf-8"); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $html->charset(); ?>
<title><?php echo $title_for_layout?></title>
</head>
<body style="width: 180mm;">
<?php echo $content_for_layout; ?>
</body>
</html>