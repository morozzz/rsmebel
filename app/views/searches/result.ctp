
<?php

    echo $common->caption('ПОИСК');

    echo "<div id='div-search'>";
    //echo "<div id='div-search-body'>";
    echo $form->create('Search', array(
        'action' => 'result',
        'id' => 'search-form'
    ));
    echo "<div id='search-param'>";
      echo "<div id='search-param-label'>";
        echo "Искать в разделах:";
      echo "</div>";
      echo "<div class='search-param-checkbox'>";

        echo $form->input('catalog_on', array(
                'label'       => 'Каталог',
                'type' => 'checkbox'              
              ));
        echo $form->input('product_on', array(
                'label'       => 'Товары',
                'type' => 'checkbox'
              ));
      echo "</div>";
      echo "<div class='search-param-checkbox'>";
        echo $form->input('project_on', array(
                'label'       => 'Галерея',
                'type' => 'checkbox',
                'class' => 'input-checkbox'
              ));
        echo $form->input('article_on', array(
                'label'       => 'Статьи',
                'type' => 'checkbox',
                'class' => 'input-checkbox'
              ));
      echo "</div>";
      echo "<div class='search-param-checkbox'>";
        echo $form->input('news_on', array(
                'label'       => 'Новости',
                'type' => 'checkbox'
              ));
//        echo $form->input('forum_on', array(
//                'label'       => 'Форум',
//                'type' => 'checkbox',
//                'class' => 'input-checkbox'
//              ));
      echo "</div>";
      echo "<div style='clear:both;'></div>";
      echo "<div class='search-param-producer'>";
      echo $form->input('Catalog.producer_id', array('label' => 'Производитель:', 'empty' => 'Все', 'type' => 'select'));
      echo "</div>";
    echo "</div>";

    echo "<div id='search-text'>";
    echo $form->input('query_text', array(
            'label'       => ''
          ));

    echo $form->hidden('limitNews', array('value' => 10, 'id' => 'txtLimitNews'));
    echo $form->hidden('limitCatalog', array('value' => 10, 'id' => 'txtLimitCatalog'));
    echo $form->hidden('limitProduct', array('value' => 10, 'id' => 'txtLimitProduct'));
    echo $form->hidden('limitArticle', array('value' => 10, 'id' => 'txtLimitArticle'));
    echo $form->hidden('limitProject', array('value' => 10, 'id' => 'txtLimitProject'));
    echo $form->hidden('limitForum', array('value' => 10, 'id' => 'txtLimitForum'));
    echo $form->submit('Найти', array('id' => 'btnSearch'));
    echo "</div>";

    echo $form->end();

    $CnewParams = $paginator->params('Cnew');
    $CatalogParams = $paginator->params('Catalog');
    $ProductParams = $paginator->params('Product');
    $ArticleParams = $paginator->params('Article');
    $ProjectParams = $paginator->params('Project');
    $PostParams = $paginator->params('Post');
    $cnt = $CatalogParams['count']+$CnewParams['count']+$ProjectParams['count']+$PostParams['count'];

    if (!empty($query_text)) {
      echo $html->div('info-message', 'Вы искали: '.'<strong>'.$query_text.'</strong>', array('id' => 'info-message-note'));
      echo "<div class='clear-div3'></div>";
      echo $html->div('info-message', 'Найдено ссылок всего: '.'<strong>'.$cnt.'</strong>', array('id' => 'info-message-count-info'));
    }
    
    if (($catalog_on > 0)&($CatalogParams['count'] > 0)) {
      echo "<div class='clear-div'></div>";
      echo "<div class='news-string'>";
      echo "НАЙДЕНО В КАТАЛОГЕ (всего ".$CatalogParams['count'].", показано ".$CatalogParams['current']." ссылок):";
      echo "</div>";

      $i = 1;
      foreach($result_catalogs as $rc) {
        echo "<div class=section>";
          echo "<div class='left-image'>";
            echo $html->image($rc['SmallImage']['url'], array('url' => '/catalogs/index/'.$rc['Catalog']['id']));
          echo "</div>";
          echo "<div class='header-center'>";
              echo "<div class='catalog-name'>";
                echo $i.". ";
                echo $html->link($rc['Catalog']['name'], '/catalogs/index/'.$rc['Catalog']['id']);
              echo "</div>";
                foreach($rc['catalog_abouts'] as $kk) {
//                  if($kk) continue;
                  echo "<div class=catalog-note>".$kk."</div>";
                }
              echo "</div>";
            echo "</div>";
          echo "<div class='clear-div3'></div>";
          $i++;
      }
      echo "<div class='news-string'>";
      echo $html->link('Все, что найдено в КАТАЛОГЕ ('.$CatalogParams['count'].' ссылок)>>>', '#', array('class' => 'allResult', 'id' => 'allResultCatalog'));
      echo "</div>";
    }
    if (($product_on > 0)&($ProductParams['count'] > 0)) {
      echo "<div class='clear-div'></div>";
      echo "<div class='news-string'>";
      echo "НАЙДЕНО В ТОВАРАХ (всего ".$ProductParams['count'].", показано ".$ProductParams['current']." ссылок):";
      echo "</div>";

      $i = 1;
      foreach($result_products as $rc) {
        echo "<div class=section>";
          echo "<div class='left-image'>";
            echo $html->image($rc['SmallImage']['url'], array('url' => '/products/index/'.$rc['Product']['id']));
          echo "</div>";
          echo "<div class='header-center'>";
              echo "<div class='catalog-name'>";
                echo $i.". ";
                echo $html->link($rc['Product']['name'], '/products/index/'.$rc['Product']['id']);
              echo "</div>";
                foreach($rc['product_abouts'] as $kk) {
//                  if($kk) continue;
                  echo "<div class=catalog-note>".$kk."</div>";
                }
              echo "</div>";
            echo "</div>";
          echo "<div class='clear-div3'></div>";
          $i++;
      }
      echo "<div class='news-string'>";
      echo $html->link('Все, что найдено в ТОВАРАХ ('.$ProductParams['count'].' ссылок)>>>', '#', array('class' => 'allResult', 'id' => 'allResultProduct'));
      echo "</div>";
    }
    if (($article_on > 0)&($ArticleParams['count'] > 0)) {
      echo "<div class='clear-div'></div>";
      echo "<div class='news-string'>";
      echo "НАЙДЕНО В СТАТЬЯХ (всего ".$ArticleParams['count'].", показано ".$ArticleParams['current']." ссылок):";
      echo "</div>";

      $i = 1;
      foreach($result_articles as $rc) {
        echo "<div class=section>";
          echo "<div class='left-image'>";
            echo $html->image($rc['SmallImage']['url'], array('url' => '/article_pages/index/'.$rc['Article']['id'].'/1'));
          echo "</div>";
          echo "<div class='header-center'>";
              echo "<div class='catalog-name'>";
                echo $i.". ";
                echo $html->link($rc['Article']['caption'], '/article_pages/index/'.$rc['Article']['id'].'/1');
              echo "</div>";
                foreach($rc['article_abouts'] as $kk) {
//                  if($kk) continue;
                  echo "<div class=catalog-note>".$kk."</div>";
                }
              echo "</div>";
            echo "</div>";
          echo "<div class='clear-div3'></div>";
          $i++;
      }
      echo "<div class='news-string'>";
      echo $html->link('Все, что найдено в СТАТЬЯХ ('.$ArticleParams['count'].' ссылок)>>>', '#', array('class' => 'allResult', 'id' => 'allResultArticle'));
      echo "</div>";
    }
    if (($news_on > 0)&($CnewParams['count'] > 0)) {
      echo "<div class='clear-div'></div>";
      echo "<div class='news-string'>";
      echo "НАЙДЕНО В НОВОСТЯХ (всего ".$CnewParams['count'].", показано ".$CnewParams['current']." ссылок):";
      echo "</div>";

      $i = 1;
      foreach($result_cnews as $rc) {
        echo "<div class=section>";
          echo "<div class='left-image'>";
            echo $html->image($rc['SmallImage']['url'], array('url' => '/cnews/view_new/'.$rc['Cnew']['id']));
          echo "</div>";
          echo "<div class='header-center'>";
          echo "<div class='catalog-name'>";
            echo $i.". ";
            echo $html->link($rc['Cnew']['news_header'], '/cnews/view_new/'.$rc['Cnew']['id']);
          echo "</div>";
            foreach($rc[0] as $kk) {
              echo "<div class=catalog-note>".$kk."</div>";
            }
          echo "</div>";
          echo "</div>";
          echo "<div class='clear-div3'></div>";
          $i++;
      }
      echo "<div class='news-string'>";
      echo $html->link('Все, что найдено в НОВОСТЯХ ('.$CnewParams['count'].' ссылок)>>>', '#', array('class' => 'allResult', 'id' => 'allResultNews'));
      //echo $html->div('allResult', 'Все что найдено в НОВОСТЯХ('.$CnewParams['count'].' ссылок)>>>');
      echo "</div>";
    }

    if (($project_on > 0)&($ProjectParams['count'] > 0)) {
      echo "<div class='clear-div'></div>";
      echo "<div class='news-string'>";
      echo "НАЙДЕНО В ГАЛЕРЕЕ ПРОЕКТОВ (всего ".$ProjectParams['count'].", показано ".$ProjectParams['current']." ссылок):";
      echo "</div>";

      $i = 1;
      foreach($result_projects as $rc) {
        echo "<div class=section>";
          echo "<div class='left-image'>";
            echo $html->image($rc['SmallImage']['url'], array('url' => '/projects/show/'.$rc['Project']['id']));
          echo "</div>";
          echo "<div class='header-center'>";
              echo "<div class='catalog-name'>";
                echo $i.". ";
                echo $html->link($rc['Project']['name'], '/projects/show/'.$rc['Project']['id']);
              echo "</div>";
                foreach($rc[0] as $kk) {
                  echo "<div class=catalog-note>".$kk."</div>";
                }
          echo "</div>";
          echo "</div>";
          echo "<div class='clear-div3'></div>";
          $i++;
      }

      echo "<div class='news-string'>";
      echo $html->link('Все, что найдено в ГАЛЕРЕЕ ПРОЕКТОВ ('.$ProjectParams['count'].' ссылок)>>>', '#', array('class' => 'allResult', 'id' => 'allResultProject'));
      //echo $html->div('allResult', 'Все что найдено в НОВОСТЯХ('.$CnewParams['count'].' ссылок)>>>');
      echo "</div>";
    }

    if (($forum_on > 0)&($PostParams['count'] > 0)) {
      echo "<div class='clear-div'></div>";
      echo "<div class='news-string'>";
      echo "НАЙДЕНО В ФОРУМЕ (всего ".$PostParams['count'].", показано ".$PostParams['current']." ссылок):";
      echo "</div>";

      $i = 1;
      foreach($result_posts as $rc) {
        echo "<div class=section>";
          echo "<div class='left-image'>";
            //echo $html->image($rc['SmallImage']['url'], array('url' => '/projects/show/'.$rc['Post']['post_id']));
          echo "</div>";
          echo "<div class='header-center'>";
              echo "<div class='catalog-name'>";
                echo $i.". ";
                echo "<a href='".str_replace('cake', 'forum', $this->webroot).'viewtopic.php?f='.$rc['Post']['forum_id'].'&t='.$rc['Post']['topic_id']."'>";
                echo $rc['Post']['post_subject'];
                echo "</a>";
              echo "</div>";
                foreach($rc[0] as $kk) {
                  echo "<div class=catalog-note>".$kk."</div>";
                }
          echo "</div>";
        echo "</div>";
          echo "<div class='clear-div3'></div>";
          $i++;
      }

      echo "<div class='news-string'>";
      echo $html->link('Все, что найдено в ФОРУМЕ ('.$PostParams['count'].' ссылок)>>>', '#', array('class' => 'allResult', 'id' => 'allResultPost'));
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }

?>

<script type="text/javascript">

var CnewsParamsCnt = <?php if(!empty($CnewParams['count'])) { echo $CnewParams['count']; } else { echo '0'; } ?>;
var CatalogParamsCnt = <?php if(!empty($CatalogParams['count'])) { echo $CatalogParams['count']; } else { echo '0'; } ?>;
var ProductParamsCnt = <?php if(!empty($ProductParams['count'])) { echo $ProductParams['count']; } else { echo '0'; } ?>;
var ArticleParamsCnt = <?php if(!empty($ArticleParams['count'])) { echo $ArticleParams['count']; } else { echo '0'; } ?>;
var ProjectParamsCnt = <?php if(!empty($ProjectParams['count'])) { echo $ProjectParams['count']; } else { echo '0'; } ?>;
var PostParamsCnt = <?php if(!empty($PostParams['count'])) { echo $PostParams['count']; } else { echo '0'; } ?>;

   <?php

   if (($CnewParams['count'] == 0)&($CatalogParams['count'] == 0)&($ProjectParams['count'] == 0)&($PostParams['count'] == 0)&($ArticleParams['count']==0)&($ProductParams['count']==0)) {
     echo " $('#SearchCatalogOn').attr('checked', 'true'); ";
     echo " $('#SearchNewsOn').attr('checked', 'true'); ";
     echo " $('#SearchProductOn').attr('checked', 'true'); ";
     echo " $('#SearchArticleOn').attr('checked', 'true'); ";
     echo " $('#SearchProjectOn').attr('checked', 'true'); ";
     echo " $('#SearchForumOn').attr('checked', 'true'); ";
   }

   if (!empty($catalog_on)) {
     if ($catalog_on == 1) {
       echo " $('#SearchCatalogOn').attr('checked', 'true'); ";
     }
     else {
       echo " $('#SearchCatalogOn').attr('checked', 'false'); ";
     }
   }

   if (!empty($product_on)) {
     if ($product_on == 1) {
       echo " $('#SearchProductOn').attr('checked', 'true'); ";
     }
     else {
       echo " $('#SearchProductOn').attr('checked', 'false'); ";
     }
   }

   if (!empty($article_on)) {
     if ($product_on == 1) {
       echo " $('#SearchArticleOn').attr('checked', 'true'); ";
     }
     else {
       echo " $('#SearchArticleOn').attr('checked', 'false'); ";
     }
   }

   if (!empty($news_on)) {
     if ($news_on == 1) {
       echo " $('#SearchNewsOn').attr('checked', 'true'); ";
     }
     else {
       echo " $('#SearchNewsOn').attr('checked', 'false'); ";
     }
   }

   if (!empty($project_on)) {
     if ($project_on == 1) {
       echo " $('#SearchProjectOn').attr('checked', 'true'); ";
     }
     else {
       echo " $('#SearchProjectOn').attr('checked', 'false'); ";
     }
   }

   if (!empty($forum_on)) {
     if ($forum_on == 1) {
       echo " $('#SearchForumOn').attr('checked', 'true'); ";
     }
     else {
       echo " $('#SearchForumOn').attr('checked', 'false'); ";
     }
   }

   ?>

   $('#allResultNews').click(function(){

     $('#txtLimitNews').attr('value', CnewsParamsCnt);
     $('#txtLimitCatalog').attr('value', '0');
     $('#txtLimitProduct').attr('value', '0');
     $('#txtLimitArticle').attr('value', '0');
     $('#txtLimitProject').attr('value', '0');
     $('#txtLimitForum').attr('value', '0');
     $('#btnSearch').click();

   });

   $('#allResultCatalog').click(function(){

     $('#txtLimitNews').attr('value', '0');
     $('#txtLimitCatalog').attr('value', CatalogParamsCnt);
     $('#txtLimitProduct').attr('value', '0');
     $('#txtLimitArticle').attr('value', '0');
     $('#txtLimitProject').attr('value', '0');
     $('#txtLimitForum').attr('value', '0');
     $('#btnSearch').click();

   });

   $('#allResultProduct').click(function(){

     $('#txtLimitNews').attr('value', '0');
     $('#txtLimitCatalog').attr('value', '0');
     $('#txtLimitProduct').attr('value', ProductParamsCnt);
//     console.log(ProductParamsCnt);
//     console.log($('#txtLimitProduct').attr('value'));
     $('#txtLimitArticle').attr('value', '0');
     $('#txtLimitProject').attr('value', '0');
     $('#txtLimitForum').attr('value', '0');
     $('#btnSearch').click();
   });

   $('#allResultArticle').click(function(){

     $('#txtLimitNews').attr('value', '0');
     $('#txtLimitCatalog').attr('value', '0');
     $('#txtLimitProduct').attr('value', '0');
     $('#txtLimitArticle').attr('value', ArticleParamsCnt);
     $('#txtLimitProject').attr('value', '0');
     $('#txtLimitForum').attr('value', '0');
     $('#btnSearch').click();
   });

   $('#allResultProject').click(function(){

     $('#txtLimitNews').attr('value', '0');
     $('#txtLimitCatalog').attr('value', '0');
     $('#txtLimitProduct').attr('value', '0');
     $('#txtLimitArticle').attr('value', '0');
     $('#txtLimitProject').attr('value', ProjectParamsCnt);
     $('#txtLimitForum').attr('value', '0');
     $('#btnSearch').click();

   });

   $('#allResultPost').click(function(){

     $('#txtLimitNews').attr('value', '0');
     $('#txtLimitCatalog').attr('value', '0');
     $('#txtLimitProduct').attr('value', '0');
     $('#txtLimitArticle').attr('value', '0');
     $('#txtLimitProject').attr('value', '0');
     $('#txtLimitForum').attr('value', PostParamsCnt);
     $('#btnSearch').click();

   });


</script>


