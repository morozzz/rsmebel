<div class="div-left-column">
    <div id="div-basket"><?php echo $this->element('basket');?></div>
    <div class="div-specials"><?php echo $this->element('specials');?></div>
    <div class="div-news"><?php echo $this->element('news');?></div>
</div>
<div class="div-right-column">
    <div class="div-catalogs">
        <?php echo $this->element('catalog', array(
            'catalog_id' => $current_catalog['Catalog']['id'],
            'caption' => $current_catalog['Catalog']['name']
        ));?>
    </div>
</div>
