<div class="div-news">
<h1>Новости</h1>
<?php echo $this->element('paginate');?>
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
</div>