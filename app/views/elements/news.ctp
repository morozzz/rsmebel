<?php $cnews = $this->requestAction('/cnews/get_cnews'); ?>
<?php if(!empty($cnews)) { ?>
<h1><?php echo $html->link('Новости', array(
    'controller' => 'cnews',
    'action' => 'index'
));?></h1>
<?php foreach($cnews as $cnew) { ?>
<div class="div-new">
    <?php
    echo $html->link($cnew['Cnew']['stamp'], array(
        'controller' => 'cnews',
        'action' => 'view',
        $cnew['Cnew']['eng_name']
    ), array(
        'class' => 'link-new-stamp'
    ));
    echo $html->div('div-new-caption', $cnew['Cnew']['caption']);
    ?>
</div>
<?php } ?>
<?php } ?>
