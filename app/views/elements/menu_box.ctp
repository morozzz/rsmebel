<?php
$links = array(
    array(
        'label' => 'главная',
        'url' => $html->url('/')
    ),
    array(
        'label' => 'о компании',
        'url' => $html->url('/company_infos/index/')
    ),
    array(
        'label' => 'новости',
        'url' => $html->url('/cnews/index/')
    ),
    array(
        'label' => 'статьи',
        'url' => $html->url('/articles/index/')
    ),
    array(
        'label' => 'каталог - заказ online',
        'url' => $html->url('/catalogs/index/')
    ),
//    array(
//        'type' => 'forum',
//        'label' => 'форум',
//        'url' => str_replace('/cake/', '', $this->webroot.'/forum/index.php')
//    ),
    array(
        'label' => 'дизайн',
        'url' => $html->url('/design_infos/index/')
    ),
    array(
        'label' => 'портфолио',
        'url' => $html->url('/projects/index/')
    ),
//    array(
//        'label' => 'вход',
//        'url' => $html->url('/users/login/')
//    ),
    array(
        'type' => 'search',
        'label' => 'поиск',
        'url' => $html->url('/searches/result/')
    )
);
?>

<table class="table-menu" width="100%" cellspacing="0" cellpadding="0" border="0">
    <tbody>
        <tr align="center">
            <?php foreach($links as $link) { ?>
            <td>
                <?php if(isset($link['type']) && $link['type'] == 'search') {

                    echo $form->create('Search', array(
                        'action' => 'result',
                        'id' => 'search-form-h-menu'
                    ));

                    echo $form->input('query_text', array(
                            'label'       => '', 'class' => 'input-search', 'id' => 'SearchQueryTextHMenu',
                            'value' => 'поиск', 'style' => 'color: gray; font-style: italic;'
                          ));
                    echo $form->hidden('catalog_on', array('value' => 1));
                    echo $form->hidden('product_on', array('value' => 1));
                    echo $form->hidden('article_on', array('value' => 1));
                    echo $form->hidden('project_on', array('value' => 1));
                    echo $form->hidden('news_on', array('value' => 1));
                    echo $form->hidden('forum_on', array('value' => 1));

                    echo $form->hidden('limitNews', array('value' => 10));
                    echo $form->hidden('limitCatalog', array('value' => 10));
                    echo $form->hidden('limitProduct', array('value' => 10));
                    echo $form->hidden('limitArticle', array('value' => 10));
                    echo $form->hidden('limitProject', array('value' => 10));
                    echo $form->hidden('limitForum', array('value' => 10));
                    echo $form->end();
                
                 }  else { ?>
                <div class="div-item-menu">
                    <a href="<?php echo $link['url'];?>">
                        <div class="div-item-menu-left"></div>
                        <div class="div-item-menu-right"></div>
                        <div class="div-item-menu-center">
                            <div class="div-item-menu-text">
                                <?php echo $link['label'];?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </td>
            <?php } ?>
        </tr>
    </tbody>
</table>

<script type="text/javascript">
    if(jQuery.browser.msie) {
        jQuery('.div-item-menu').hover(function() {
            $(this).find('.div-item-menu-left').css({
                background: 'url('+webroot+'img/menu-selected-left.png)'
            });
            $(this).find('.div-item-menu-right').css({
                background: 'url('+webroot+'img/menu-selected-right.png)'
            });
            $(this).find('.div-item-menu-center').css({
                background: 'url('+webroot+'img/menu-selected-center.png)'
            });
            $(this).find('.div-item-menu-left, .div-item-menu-right, .div-item-menu-center').addClass('iepngfix');
        }, function() {
            $(this).find('.div-item-menu-left, .div-item-menu-right, .div-item-menu-center').css({
                background: 'none'
            });
        })
    }
</script>