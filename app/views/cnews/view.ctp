<?php echo $this->element('caption', array(
    'caption_name' => 'НОВОСТИ',
    'caption_tag' => 'h1'
)); ?>
<div id="news-wrapper">

  <div class="news-header-menu">
    <div class="news-header"> </div>
    <div class="news-pages">
     <?php
       echo $paginator->prev('< < < Назад');
     ?>
     </div>
    <div class="news-pages" id="div-all-news">
     <?php
        echo $paginator->counter('Всего новостей %count%, показано %start%');
     ?>
     </div>
    <div class="news-pages">
     <?php
       echo $paginator->next('Вперед > > >');
     ?>
    </div>
    <div id="archive-pages">
        <?php echo $html->link('Лента новостей', '/cnews');?>
    </div>

    <div class="clear-div"></div>
</div>
</div>

<div id="news-data">
   <li>
   <?php
     foreach($cnews as $new) {
       echo "<ul>".$new[0]['stamp']."</ul>";
     }
   ?>
   </li>
</div>

<div class="wrapper2">
<div class="container2" style="border:none;">
    <div class="fixed">
        <?php
            foreach($cnews as $new) {
              echo "<div class='left2-header'>";
                echo "<span class='text-shadow'>";
                echo $new['Cnew']['news_header'];
                echo "</span>";
              echo "</div>";
              echo "<div class='left2-image'>";
                echo $html->image($new['BigImage']['url']);
                echo $new['Cnew']['news_body'];
              echo "</div>";
            }
        ?>
        <div style="clear: both;"></div>
    </div>
</div>
<div class="clear-div"></div>
</div>
  <?php /*echo "<hr color = '#A3A3D3'> </hr>";*/ ?>

  <div class="news-header-menu">
    <div class="news-header"> </div>
    <div class="news-pages">
     <?php
       echo $paginator->prev('< < < Назад');
     ?>
     </div>
    <div class="news-pages" id="div-all-news2">
     <?php
        echo $paginator->counter('Всего новостей %count%, показано %start%');
     ?>
     </div>
    <div class="news-pages">
     <?php
       echo $paginator->next('Вперед > > >');
     ?>
    </div>
    <div id="archive-pages">
        <?php echo $html->link('Лента новостей', '/cnews');?>
    </div>

    <div class="clear-div"></div>
  </div>

<script type="text/javascript">
    $('.top-header').hide();
</script>
