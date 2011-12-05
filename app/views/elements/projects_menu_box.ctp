
<div class="div-pagination pie" style="height: 25px;">
    <div style="line-height: 20px; width: 300px; float: left;">
        <label class="label-select-profile">Профиль</label>
        <?php echo $form->select('', $project_profile_list, $profile_id, array(
            'class' => 'select-profile'
        ), false); ?>
    </div>
    <div style="margin-left:300px; font-size:12px;">

        <table class='pagination' width='100%'><tbody><tr>
        <td class='pagination-prev' width='15%'>
          <?php echo $paginator->prev("<<< Назад"); ?>
        </td>
        <td class='pagination-count' width='30%'>
        <?php

            echo $paginator->counter('Всего %count% '.
                                     $paginator->link('(Показать все)', array(
                                            'limit' => $paginator->params['paging']['Project']['count'],
                                            'page' => 1
                                        ), array(
                                            'escape' => false
                                        )).', показано с %start% по %end%');
        ?>
        </td>
        <td class='pagination-pages' width='10%'>
          <?php echo $paginator->numbers(array(
                                                'before' => 'Страницы ',
                                                'modulus' => 0,
                                                'separator' => ' '
                                            ));
          ?>
        </td>
        <td class='pagination-next' width='15%'>
          <?php echo $paginator->next("Вперед >>>"); ?>
        </td>
        <td class='pagination-limit' width='20%'>
           Количество на странице
           <?php
                echo $form->select('', array(
                    6  => '6',
                    10 => '10',
                    20 => '20',
                    30 => '30',
                    $paginator->params['paging']['Project']['count'] => 'Все'
                ), $limit, array(
                    'class' => 'pagination-limit-select'
                ), false);

          ?>
        </td>
        </tr></tbody></table>   
    </div>
</div>

