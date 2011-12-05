
 <div class="articles-header-menu">
    <div class="articles-pages-left">
     <?php
       echo $paginator->prev('< < < Назад');
     ?>
    </div>
    <div class="articles-pages-all">
     <?php
        echo $paginator->counter('Всего статей %count%, показано с %start% по %end% ');
        echo "<div id='articles-list-page'>";
//            echo "Страницы ";
//            for ($i = 1; $i <= $paginator->params['paging']['Cnew']['pageCount']; $i++) {
//              echo $html->link($i, '/articles/index/page:'.$i)." ";
//            }

        echo $paginator->numbers(array(
            'before' => 'Страницы ',
            'modulus' => 0,
            'separator' => ' '
        ));
        echo "</div>";
     ?>
     </div>
    <div class="articles-pages-right">
     <?php
//        echo "<div id='articles-list-page'>";
//            echo "Страницы ";
//            for ($i = 1; $i <= $paginator->params['paging']['Cnew']['pageCount']; $i++) {
//              echo $html->link($i, '/carticles/index/page:'.$i)." ";
//            }
//        echo "</div>";
       echo $paginator->next('Вперед > > >');
     ?>
    </div>

    <div class="cnt-pages">
     <?php
        echo "Количество на странице:";
        $limit = $paginator->params['paging']['Article']['options']['limit'];
        
        //костыль: если количество статей = 10, то комбобокс косячит
        $all_cnt = $paginator->params['paging']['Article']['count'];
        if($all_cnt==5 || $all_cnt==10 || $all_cnt==20 || $all_cnt==30)
            $all_cnt++;
        //

        echo $form->select('', array(
            5 => '5',
            10 => '10',
            20 => '20',
            30 => '30',
            $all_cnt => 'Все'
        ), $limit, array(
            'class' => 'pagination-limit-select'
        ), false);
         ?>
    </div>
    <div class="clear-div"></div>
 </div>


<!--<div class="div-pagination-container">
    <div class="div-pagination pie" style="height: 40px;">
        <div style="line-height: 40px; width: 250px; float: left;">
            <label class="label-select-profile">Тематика</label>
            <?php echo $form->select('', $article_type_list, $article_type_id, array(
                'class' => 'select-article-type',
                'style' => 'width:150px'
            ), false); ?>
        </div>
        <div style="margin-left:250px;">
            <?php echo $common->paginate_table($paginator, 'Article');?>
        </div>
    </div>
</div>-->