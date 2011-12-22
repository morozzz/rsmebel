<?php if(!empty($paginator)) { ?>
<div class="div-paginator">
    <?php
    echo $paginator->prev('< < < Назад');
    echo $paginator->next('Вперед > > >');
    ?>
</div>
<?php } ?>