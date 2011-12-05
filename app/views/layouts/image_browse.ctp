<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php header("Content-Type:text/html;charset=utf-8"); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $html->charset(); ?>
<title><?php echo $title_for_layout?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"></link>
<!-- Подключаем внешние файлы и скрипты здесь (Смотрите HTML-хелпер для доп. информации) -->
<?php echo $scripts_for_layout ?>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/fckeditor/fckeditor.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/ckeditor_3.3.1/ckeditor.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/ckeditor_3.3.1/_samples/sample.js"> </script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>js/ckeditor_3.3.1/_samples/sample.css" />
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery-1.4.2.min.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.form.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.treeview.min.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.fumodal.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/common.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery-ui-1.8.5.custom.min.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.ui.datepicker-ru.js"> </script>
<?php echo $html->css("mto.css");
echo $html->css("jquery.treeview.css");
echo $html->css("fumodal.css");
echo $html->css("jquery-ui-1.8.5.custom.css");
if(isset($page_css)) {
    foreach($page_css as $css) {
        echo $html->css($css.".css");
    }
}
?>

</head>
<body>
<?php echo $content_for_layout;?>
</body>
</html>