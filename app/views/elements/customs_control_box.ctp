
 <div id="news-header-menu">

    <div class="news-pages-left">
     <?php
       echo $paginator->prev('< < < Назад');
     ?>
    </div>
    <div class="news-pages-all">
     <?php
        echo $paginator->counter('Всего заказов %count%, показано с %start% по %end% ');
        echo "<div id='news-list-page'>";
        echo $paginator->numbers(array(
            'before' => 'Страницы ',
            'modulus' => 0,
            'separator' => ' '
        ));
        echo "</div>";
     ?>
     </div>
    <div class="news-pages-right">
     <?php
       echo $paginator->next('Вперед > > >');
     ?>
    </div>

    <div class="cnt-pages">
     <?php
        echo "Количество на странице:";
        echo $form->select('', array(
            20 => '20',
            30 => '30',
            40 => '40',
            $paginator->params['paging']['Custom']['count'] => 'Все'
        ), $limit, array(
            'class' => 'new-pages-pagination'
        ), false);
         ?>
    </div>
    <div class="clear-div"></div>
 </div>
