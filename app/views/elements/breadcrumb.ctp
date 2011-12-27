<?php if(!empty($breadcrumb)) { ?>
<div class="div-breadcrumb">
    <?php
    $breadcrumb_links = array();
    foreach($breadcrumb as $b) $breadcrumb_links[] = $html->link($b['label'], $b['url']);
    echo implode($breadcrumb_links, ' > ');
    ?>
</div>
<?php } ?>
