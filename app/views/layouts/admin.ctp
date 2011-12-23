<?php
$role_id = 1;
if(!empty($curUser) && !empty($curUser['User']) && !empty($curUser['User']['role_id']))
    $role_id = $curUser['User']['role_id'];

$menu = array(
    'На сайт' => array(
        'li_id' => 'admin-menu-main-site',
        'link' => '/',
        'role_id' => 2,
        'group' => 0
    ),
    'Управление пользователями' => array(
        'li_id' => 'admin-menu-users-control',
        'link' => '/users/adm_index',
        'role_id' => 3,
        'group' => 1
    ),
    'Рассылка' => array(
        'li_id' => 'admin-dispatches-control',
        'link' => '/dispatches/list_dispatches',
        'role_id' => 2,
        'group' => 1
    ),

    'Каталог' => array(
        'li_id' => 'admin-menu-catalog',
        'link' => $html->url(array('controller'=>'catalogs','action'=>'admin_index')),
        'role_id' => 3,
        'group' => 2
    ),
    'Загрузка каталога' => array(
        'li_id' => 'admin-menu-load_catalog',
        'link' => '/load_catalogs/index',
        'role_id' => 3,
        'group' => 2
    ),
//    'Производители' => array(
//        'li_id' => 'admin-menu-producer',
//        'link' => '/producers',
//        'role_id' => 3,
//        'group' => 2
//    ),
    'Спецпредложения' => array(
        'li_id' => 'admin-menu-spec',
        'link' => '/specials/admin_index',
        'role_id' => 3,
        'group' => 2
    ),

//    'Новости ассортимента' => array(
//        'li_id' => 'admin-menu-catalog-news',
//        'link' => '/catalog_news/adm_index/',
//        'role_id' => 3,
//        'group' => 2
//    ),
//    'Типы новостей ассортимента' => array(
//        'li_id' => 'admin-menu-catalog-new-types',
//        'link' => '/catalog_new_types/adm_index/',
//        'role_id' => 3,
//        'group' => 2
//    ),
//
//    'Портфолио' => array(
//        'li_id' => 'admin-menu-project',
//        'link' => '/projects/adm_index',
//        'role_id' => 3,
//        'group' => 3
//    ),
//    'Профили портфолио' => array(
//        'li_id' => 'admin-menu-project-profile',
//        'link' => '/project_profiles',
//        'role_id' => 3,
//        'group' => 3
//    ),

    'Заказы' => array(
        'li_id' => 'admin-menu-custom',
        'link' => '/customs/adm_custom',
        'role_id' => 2,
        'group' => 4
    ),
//    'Статусы заказов' => array(
//        'li_id' => 'admin-menu-custom-status-type',
//        'link' => '/custom_status_types',
//        'role_id' => 3,
//        'group' => 4
//    ),
//    'Типы доставки' => array(
//        'li_id' => 'admin-menu-transport-type',
//        'link' => '/transport_types',
//        'role_id' => 3,
//        'group' => 4
//    ),
//    'Способы оплаты' => array(
//        'li_id' => 'admin-menu-pay-type',
//        'link' => '/pay_types/adm_index',
//        'role_id' => 3,
//        'group' => 4
//    ),

//    'Информация по дизайну' => array(
//        'li_id' => 'admin-menu-design_info',
//        'link' => '/design_infos/list_design_infos',
//        'role_id' => 2,
//        'group' => 5
//    ),
//    'Заявки на дизайн' => array(
//        'li_id' => 'admin-design-order',
//        'link' => '/design_order_dets/adm_index',
//        'role_id' => 2,
//        'group' => 5
//    ),
//    'Настройка заявки на дизайн' => array(
//        'li_id' => 'admin-design-order-tools',
//        'link' => '/design_order_dets/adm_design_section',
//        'role_id' => 3,
//        'group' => 5
//    ),

//    'Статьи' => array(
//        'li_id' => 'admin-menu-articles',
//        'link' => '/articles/adm_index',
//        'role_id' => 2,
//        'group' => 6
//    ),
//    'Тематика статей' => array(
//        'li_id' => 'admin-menu-article-types',
//        'link' => '/article_types/adm_index',
//        'role_id' => 2,
//        'group' => 6
//    ),
    'Новости' => array(
        'li_id' => 'admin-menu-news',
        'link' => '/cnews/admin_index',
        'role_id' => 2,
        'group' => 6
    ),
//    'Инфо на главной' => array(
//        'li_id' => 'admin-menu-info',
//        'link' => '/home_news/list_home_news',
//        'role_id' => 3,
//        'group' => 6
//    ),
    'О компании' => array(
        'li_id' => 'admin-menu-company-info',
        'link' => '/company_infos/admin_index',
        'role_id' => 3,
        'group' => 6
    ),
//    'Фотоальбомы' => array(
//        'li_id' => 'admin-menu-album',
//        'link' => '/albums/adm_index',
//        'role_id' => 3,
//        'group' => 6
//    ),
//    'Заявки от поставщиков' => array(
//        'li_id' => 'admin-menu-diler',
//        'link' => '/diler',
//        'role_id' => 2,
//        'group' => 6,
//    ),
//    'Баннеры на главной' => array(
//        'li_id' => 'admin-menu-banners',
//        'link' => '/banners/adm_index',
//        'role_id' => 3,
//        'group' => 6
//    ),
//    'Слайдшоу на главной' => array(
//        'li_id' => 'admin-menu-slides',
//        'link' => '/slides/adm_index',
//        'role_id' => 3,
//        'group' => 6
//    ),
//    'Быстрые ссылки' => array(
//        'li_id' => 'admin-menu-short-links',
//        'link' => '/short_links/index',
//        'role_id' => 3,
//        'group' => 6
//    ),
//    'Подвал на главной' => array(
//        'li_id' => 'admin-menu-home-footer',
//        'link' => '/home_footers/edit',
//        'role_id' => 3,
//        'group' => 6
//    ),
    'Изображения' => array(
        'li_id' => 'admin-menu-image',
        'link' => '/images',
        'role_id' => 3,
        'group' => 6
    ),
//    'Шаблоны изображений' => array(
//        'li_id' => 'admin-menu-image-template',
//        'link' => '/image_templates',
//        'role_id' => 3,
//        'group' => 6
//    ),
    'Тексты' => array(
        'li_id' => 'admin-menu-strings',
        'link' => '/strings/index',
        'role_id' => 3,
        'group' => 6
    ),
    'Файлы' => array(
        'li_id' => 'admin-menu-files',
        'link' => '/files/adm_index',
        'role_id' => 3,
        'group' => 6
    ),
    'Keywords' => array(
        'li_id' => 'admin-menu-url-keywords',
        'link' => '/url_keywords/adm_index',
        'role_id' => 3,
        'group' => 6
    ),
    'Descriptions' => array(
        'li_id' => 'admin-menu-url-descriptions',
        'link' => '/url_descriptions/adm_index',
        'role_id' => 3,
        'group' => 6
    ),
    'Title' => array(
        'li_id' => 'admin-menu-url-titles',
        'link' => '/url_titles/adm_index',
        'role_id' => 3,
        'group' => 6
    ),
    'Настройки' => array(
        'li_id' => 'admin-menu-url-setting',
        'link' => '/setting/admin_index',
        'role_id' => 3,
        'group' => 6
    ),
//    'Информационное сообщение' => array(
//        'li_id' => 'admin-menu-alerts',
//        'link' => '/alerts/adm_index',
//        'role_id' => 3,
//        'group' => 6
//    ),
//    'Правила интернет-магазина' => array(
//        'li_id' => 'admin-menu-shop_rule',
//        'link' => '/shop_rules/edit/1',
//        'role_id' => 3,
//        'group' => 7
//    ),
//    'Как делать покупки в интернет-магазине' => array(
//        'li_id' => 'admin-menu-purchase_rule',
//        'link' => '/shop_rules/edit/2',
//        'role_id' => 3,
//        'group' => 7
//    ),
    'Сообщения/отзывы от пользователей' => array(
        'li_id' => 'admin-menu-questions',
        'link' => '/questions/adm_index',
        'role_id' => 2,
        'group' => 8
    )

);
?>

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
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/ckeditor_3.3.1/ckeditor.js"> </script>
<script type="text/javascript">CKEDITOR.config.baseHref = "<?php echo $this->webroot;?>";</script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery-1.4.2.min.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/ckeditor_3.3.1/adapters/jquery.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.form.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.treeview.min.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.fumodal.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/common.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/fast_about_dialog.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery-ui-1.8.5.custom.min.all.js"> </script>
<script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.ui.datepicker-ru.js"> </script>
<?php
//echo $html->css("all.css");
echo $html->css("admin.css");
echo $html->css("table_admin.css");
echo $html->css("jquery.treeview.css");
echo $html->css("fumodal.css");
echo $html->css("jquery-ui-1.8.5.custom.all.css");
if(isset($page_css)) {
    foreach($page_css as $css) {
        $filename = 'css/'.$css.'.css';
        if(file_exists($filename))
            echo $html->css($css.".css");
    }
}?>
</head>
<body>
    <script type="text/javascript">
    var webroot = "<?php echo $this->webroot;?>";
    </script>
    <?php if(!empty($curClientInfo)) { ?>
    <div class="div-user-info">
        Здравствуйте, <?php echo $curClientInfo['ClientInfo']['fio'];?> (<?php echo $curUser['User']['username'];?>)
    </div>
    <?php } ?>
    <div id = "top-hd">
      Анжелика - режим администрирования
    </div>

    <div id="top-lg">
        <div id="admin-img-lg" class="div-image-lg">
            <?php
//                echo $html->image("admin_icon.jpg");
            ?>
            <h1 id="admin-lg-text">Режим администрирования сайта</h1>
        </div>
    </div>

    <div id="top-header" class="hide-menu">
      <table>
        <tr>
          <td> </td>
          <td> </td>
          <td style='text-align: right; padding-right: 20px;'>
              <?php
                 $id = $session->read('Auth.User.id');
                 if (empty($id)) {

                     echo "<p>";
                     echo $html->link('Вход для пользователей ', array('controller' => 'users', 'action' => 'login'));
                     echo " / ";
                     echo $html->link('Регистрация', array('controller' => 'users', 'action' => 'register'));
                     echo "</p>";
                 }
                 else {

                     echo "<p>";
                     echo $html->link('Страница Ваших персональных данных ', array('controller' => 'users', 'action' => 'register'));
                     echo "</p>";

                     echo "<p>";
                     echo $html->link('Выход из авторизованого режима ', array('controller' => 'users', 'action' => 'logout'));
                     echo "</p>";

                 }
              ?>
          </td>
        </tr>
      </table>

    </div>

    <div id="main">
        <div id="admin-left-menu">
            <ul id="ul-admin-left-menu">
                <?php
                $last_group = -1;
                foreach($menu as $label => $config) {
                    $access = false;
                    if($role_id == 3) $access = true;
                    if($role_id == 2 && $config['role_id'] == 2) $access = true;
                    if(!$access) continue;

                    $group = $config['group'];
                    if($last_group != $group) { ?>
                <li style="display:block;width:150px;height:1px;border-bottom:1px dotted black;"></li>
                    <?php }
                    $last_group = $group;
                ?>
                <li id="<?php echo $config['li_id'];?>">
                    <?php echo $html->link($label, $config['link']);?>
                </li>
                <?php } ?>
                <li style="display:block;width:150px;height:1px;border-bottom:1px dotted black;"></li>
            </ul>
        </div>
        <div id="admin-content">
        <?php
            echo $content_for_layout
        ?>
        </div>
    </div>

<script type="text/javascript">
/***
 * Pacth for dialog-fix ckeditor problem [ by ticket #4727 ]
 * 	http://dev.jqueryui.com/ticket/4727
 */
$.extend($.ui.dialog.overlay, { create: function(dialog){
	if (this.instances.length === 0) {
		// prevent use of anchors and inputs
		// we use a setTimeout in case the overlay is created from an
		// event that we're going to be cancelling (see #2804)
		setTimeout(function() {
			// handle $(el).dialog().dialog('close') (see #4065)
			if ($.ui.dialog.overlay.instances.length) {
				$(document).bind($.ui.dialog.overlay.events, function(event) {
					var parentDialog = $(event.target).parents('.ui-dialog');
					if (parentDialog.length > 0) {
						var parentDialogZIndex = parentDialog.css('zIndex') || 0;
						return parentDialogZIndex > $.ui.dialog.overlay.maxZ;
					}

					var aboveOverlay = false;
					$(event.target).parents().each(function() {
						var currentZ = $(this).css('zIndex') || 0;
						if (currentZ > $.ui.dialog.overlay.maxZ) {
							aboveOverlay = true;
							return;
						}
					});

					return aboveOverlay;
				});
			}
		}, 1);

		// allow closing by pressing the escape key
		$(document).bind('keydown.dialog-overlay', function(event) {
			(dialog.options.closeOnEscape && event.keyCode
					&& event.keyCode == $.ui.keyCode.ESCAPE && dialog.close(event));
		});

		// handle window resize
		$(window).bind('resize.dialog-overlay', $.ui.dialog.overlay.resize);
	}

	var $el = $('<div></div>').appendTo(document.body)
		.addClass('ui-widget-overlay').css({
		width: this.width(),
		height: this.height()
	});

	(dialog.options.stackfix && $.fn.stackfix && $el.stackfix());

	this.instances.push($el);
	return $el;
}});
</script>
</body>
</html>