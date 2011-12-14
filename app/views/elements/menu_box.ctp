<?php $menus = $this->requestAction('/page/get_menus');?>

<table class="menu" width="100%" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
    <?php foreach($menus as $menu) { ?>
    <td><?php
    if(!empty($current_menu_name) && $current_menu_name==$menu['name']) {
        echo $html->div('current-menu', $menu['label']);
    } else {
        echo $html->link($menu['label'], $menu['url']);
    }
    ?></td>
    <?php } ?>
</tr></tbody></table>