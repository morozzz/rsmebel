
<?php $specials = $this->requestAction('home_news/specials_box'); ?>

<?php foreach($specials as $special) { ?>
    <a href="<?php echo $html->url(array(
        'controller' => 'products',
        'action' => 'index',
        $special['Product']['id']
    ));?>"
        <li class="li-special">
            <div class="special-name">
                <?php echo $special['Product']['name'];?>
            </div>
            <div class="special-image">
                <?php //echo $html->image($special['SmallImage']['url']);?>
            </div>
            <div class="special-price">
                <div class="special-price-sum">
                    <?php echo $special['Product']['price'];?>р.
                </div>
                <div class="special-price-label">Цена: </div>
            </div>
        </li>
    </a>
<?php } ?>
