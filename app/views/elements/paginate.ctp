<?php if(!empty($paginator)) { ?>
<table class="table-paginate" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td width="30%">
                <?php
                echo $paginator->prev('<- назад', array(
                    'tag' => 'div',
                    'class' => 'paginate-prev'
                ), '<- назад', array(
                    'tag' => 'div',
                    'class' => 'paginate-prev paginate-disabled'
                ));
                ?>
            </td>
            <td width="40%">
                <?php
                echo $html->div('div-paginate-numbers', $paginator->numbers(array(
                    'modulus' => '5',
                    'separator' => '<span class="span-paginate-separator"> </span>',
                    'tag' => 'span',
                    'class' => 'link-number'
                )));
                ?>
            </td>
            <td width="30%">
                <?php
                echo $paginator->next('вперед ->', array(
                    'tag' => 'div',
                    'class' => 'paginate-next'
                ), 'вперед ->', array(
                    'tag' => 'div',
                    'class' => 'paginate-next paginate-disabled'
                ));
                ?>
            </td>
        </tr>
    </tbody>
    <?php
    ?>
</table>
<?php } ?>