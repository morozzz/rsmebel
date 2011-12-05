
 <div id="news-header-menu">

    <div class="news-pages-left">
     <?php
       echo $paginator->prev('< < < Назад');
     ?>
    </div>
    <div class="news-pages-all">
     <?php
        echo $paginator->counter('Всего новостей %count%, показано с %start% по %end% ');
        echo "<div id='news-list-page'>";
//            echo "Страницы ";
//            for ($i = 1; $i <= $paginator->params['paging']['Cnew']['pageCount']; $i++) {
//              echo $html->link($i, '/cnews/index/page:'.$i)." ";
//            }
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
//        echo "<div id='news-list-page'>";
//            echo "Страницы ";
//            for ($i = 1; $i <= $paginator->params['paging']['Cnew']['pageCount']; $i++) {
//              echo $html->link($i, '/cnews/index/page:'.$i)." ";
//            }
//        echo "</div>";
       echo $paginator->next('Вперед > > >');
     ?>
    </div>

    <div class="cnt-pages">
     <?php
        echo "Количество на странице:";
        echo $form->select('', array(
            10 => '10',
            20 => '20',
            30 => '30',
            $paginator->params['paging']['Cnew']['count'] => 'Все'
        ), $limit, array(
            'class' => 'new-pages-pagination'
        ), false);
         ?>
    </div>
    <div class="clear-div"></div>
 </div>
