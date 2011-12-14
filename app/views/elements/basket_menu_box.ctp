<?php $curUser = $this->requestAction('basket/user_info');?>
        <table>
        <tr>
          <td style="padding-left: 20px; width: 380px;">
              <div class="div-top-header-basket">

                  <?php
                    echo $this->element('basket_box');
                  ?>
              </div>
              <div class="div-top-header-basket-papers">
                <?php echo $html->link('Как делать покупки', '#', array(
                                           'class' => 'link-shop-rules',
                                           'shop_rule_dialog_id' => 'div-shop-rule-2-dialog'
                                       ));
                ?>
                /
                <?php echo $html->link('Правила работы интернет-магазина', '#', array(
                                           'class' => 'link-shop-rules',
                                           'shop_rule_dialog_id' => 'div-shop-rule-1-dialog'
                                       ));
                ?>
              </div>
          </td>
          <td style="width: 250px;"><b>
            <a href="<?php echo $html->url('/catalogs/excel_all/nopic');?>"
               class="link-print-catalog-small">
                <?php echo $html->image('printer.png');?>
                 Печатный каталог торгового оборудования
                 <?php echo date('Y');?> (0.5Мб)
            </a>
            <a href="<?php echo $html->url('/catalogs/excel_all/pic');?>"
               class="link-print-catalog-big">
                <?php echo $html->image('excel.gif');?>
                (7Мб - с изображениями)
            </a>
          </b></td>
          <?php if(!empty($curUser)) { ?>
          <td style="padding-left: 20px;">
              <div>Пользователь: <?php echo $curUser['User']['username'];?></div>
              <div id = "archive_orders">
                  <?php
                  if($curUser['User']['role_id'] == 1) {
                      echo $html->link('Архив заказов', '/customs/index/');
                  } else if($curUser['User']['role_id'] == 2) {
                      echo $html->link('Страница менеджера', '/manager/');
                  } else if($curUser['User']['role_id'] == 3) {
                      echo $html->link('Страница администратора', '/admin/');
                  }
                  ?>
              </div>
          </td>
          <?php } ?>
          <td> </td>
          <td style='text-align: right; padding-right: 20px;'>
              <?php
                 $id = $session->read('Auth.User.id');
                 if (empty($id)) {

                     echo "<p> <b>";
                     echo $html->link('Вход для пользователей ', '/users/login', array('class' => 'link-user-login'));
                     echo " / ";
                     echo $html->link('Регистрация', array('controller' => 'users', 'action' => 'register'));
                     echo "</b> </p>";
                 }
                 else {

                     echo "<p> <b>";
                     echo $html->link('Страница Ваших персональных данных ', array('controller' => 'users', 'action' => 'register'));
                     echo "</b> </p>";

                     echo "<p> <b>";
                     echo $html->link('Выход из авторизованого режима ',
                             array('controller' => 'users', 'action' => 'logout'),
                             array('id' => 'link-logout'));
                     echo "</b> </p>";

                 }
              ?>
            <p>
                <b>
              <?php
                 echo $html->link(' Напишите Ваше мнение, задайте вопрос', '#', array(
                     'class' => 'link-shop-rules',
                     'shop_rule_dialog_id' => 'div-question-dialog'
                 ));
              ?>
                </b>
            </p>
          </td>
        </tr>
      </table>

<?php if(!defined('LOAD_USER_LOGIN_DIALOG')) { ?>

<div id="div-user-login-dialog"
     title="Авторизация"
     style="display: none;">
    <?php
    echo $form->create('User', array(
        'action' => 'login',
        'id' => 'user-login-form-dialog'
    ));
    echo $form->input('User.username', array('label' => 'Логин:   '));
    echo $form->input('User.password', array('label' => 'Пароль:   '));
    echo $form->submit('Войти', array(
        'id' => 'user-login-form-submit'
    ));
    echo "<div style='clear:both;'></div>";
    echo $form->end();
    ?>
</div>

<script type="text/javascript">
//    jQuery(function() {
//        jQuery('#div-user-login-dialog').dialog({
//            autoOpen: false,
//            draggable: false,
//            height: 140,
//            modal: true,
//            resizable: true,
//            width: 250
//        });
//        jQuery('.link-user-login').click(function() {
//            jQuery('#div-user-login-dialog').dialog('open');
//            return false;
//        });
//    })
</script>

<?php define('LOAD_USER_LOGIN_DIALOG', true);?>
<?php } ?>

<?php if(!defined('LOAD_SHOP_RULES_DIALOG')) { ?>
<?php $shop_rules = $this->requestAction('shop_rules/get');?>
<div id="div-shop-rule-1-dialog"
     title="Правила работы интернет-магазина"
     url="<?php echo $html->url('/shop_rules/get/1');?>"
     opened="0"
     style="display: none;">
    <?php
    echo $html->div('div-shop-rule-dialog-content', '');
    //echo $shop_rules['1']['ShopRule']['body_text'];
    ?>
</div>

<div id="div-shop-rule-2-dialog"
     title="Как делать покупки в интернет-магазине"
     url="<?php echo $html->url('/shop_rules/get/2');?>"
     opened="0"
     style="display: none;">
    <?php
    echo $html->div('div-shop-rule-dialog-content', '');
    //echo $shop_rules['2']['ShopRule']['body_text'];
    ?>
</div>

<div id="div-question-dialog"
     title="Обратная связь"
     url="<?php echo $html->url('/questions/form');?>"
     opened="0"
     style="display: none;">
    <?php
    echo $html->div('div-shop-rule-dialog-content', '');
    ?>
</div>

<script type="text/javascript">
    jQuery(function() {
        jQuery('#div-shop-rule-1-dialog,#div-shop-rule-2-dialog').dialog({
            autoOpen: false,
            draggable: false,
            height: 'auto',
            modal: true,
            resizable: true,
            width: 1000,
            buttons: {
                'Закрыть': function() {
                    jQuery(this).dialog('close');
                }
            }
        });
        jQuery('#div-question-dialog').dialog({
            autoOpen: false,
            draggable: false,
            height: 'auto',
            modal: true,
            resizable: true,
            width: 480
        });
        jQuery('.link-shop-rules').click(function() {
            var dlg_id = jQuery(this).attr('shop_rule_dialog_id');
            if(jQuery('#'+dlg_id).attr('opened')==0) {
                var url = jQuery('#'+dlg_id).attr('url');
                jQuery('#'+dlg_id+' .div-shop-rule-dialog-content').load(url, function() {
                    jQuery('#'+dlg_id).attr('opened', 1);
                    jQuery('#'+dlg_id).dialog('open');
                });
            } else {
                jQuery('#'+dlg_id).dialog('open');
            }
            return false;
        });
    })
</script>
<?php define('LOAD_SHOP_RULES_DIALOG', true);?>
<?php } ?>