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
            'id' => 'form-search-top'
        ));
        echo $form->input('search_str', array(
            'id' => 'input-search-top-text',
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
                if(!empty($found['Search']['about']))
                    echo $html->div('div-search-about', $found['Search']['about'], array(
                        'escape' => false
                    ));
                echo "</div>";
                echo "</div>";
            }
            if($search_type != '') echo "</div>";
            ?>
        </div>
    <?php } ?>
</div>
