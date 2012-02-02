<div class="div-left-column">
    <div id="div-basket"><?php echo $this->element('basket');?></div>
    <div class="div-specials"><?php echo $this->element('specials');?></div>
    <div class="div-news"><?php echo $this->element('news');?></div>
</div>
<div class="div-right-column">
    <div id="div-search-form" class="div-form">
        <?php
        echo $html->tag('h1', 'Поиск');
        echo $form->create('Search', array(
            'url' => array(
                'controller' => 'searches',
                'action' => 'index'
            ),
            'id' => 'form-search-top',
            'type' => 'GET'
        ));
        echo $form->input('search_str', array(
            'id' => 'input-search-top-text',
            'value' => $search_str,
            'label' => false
        ));
        echo $form->submit('поиск');
        echo $form->end();

        ?>
    </div>
    <?php if(!empty($founds)) { ?>
    <div id="div-search-result" class="div-form">
        <?php
        echo $html->tag('h1', 'Результаты поиска');
        $paginator->options(array('url' => $this->params['pass']));
        echo $this->element('paginate');
        $search_type = '';
        foreach($founds as $found) {
            if($search_type != $found['Search']['type']) {
                if($search_type != '') echo "</div>";
                echo "<div class='div-search-type'>";
                $search_type = $found['Search']['type'];
                echo $html->tag('h2', $found['Search']['caption']);
            }
            echo "<div class='div-search'>";
            if(!empty($found['Image']) && !empty($found['Image']['url'])) {
                echo $html->image($found['Image']['url'], array(
                    'class' => 'image-search',
                    'url' => $found['Search']['url']
                ));
            }
            echo "<div class='div-search-info'>";
            echo $html->link($found['Search']['name'], $found['Search']['url'], array(
                'class' => 'link-search',
                'escape' => false
            ));
            if(!empty($found['Search']['breadcrumb'])) {
                echo "<div class='div-search-breadcrumb'>";
                $breadcrumb_links = array();
                foreach($found['Search']['breadcrumb'] as $breadcrumb) {
                    $breadcrumb_links[] = $html->link($breadcrumb['label'], $breadcrumb['url']);
                }
                echo implode($breadcrumb_links, ' > ');
                echo "</div>";
            }
            if(!empty($found['Search']['about']))
                echo $html->div('div-search-about', $found['Search']['about'], array(
                    'escape' => false
                ));
            echo "</div>";
            echo "</div>";
        }
        if($search_type != '') echo "</div>";
        echo $this->element('paginate');
        ?>
    </div>
    <?php } else if(!empty($search_str)) { ?>
    <div id="div-search-result" class="div-form">
        К сожалению, по запросу "<?php echo $search_str;?>" ничего не найдено
    </div>
    <?php } ?>
</div>
