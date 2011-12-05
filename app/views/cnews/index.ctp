<?php echo $this->element('caption', array(
    'caption_name' => 'ЛЕНТА НОВОСТЕЙ',
    'caption_tag' => 'h1'
)); ?>

<div id="news-wrapper">

  <?php
    echo $this->element('cnews_control_box');
  ?>


  <div id="news-container">

    <div id="news-content">

          <table id="table-news" width="100%" cellspacing="20">
            <?php
               $row_cnt = 0;
               foreach($cnews as $new) {
                 if ($row_cnt == 0) { echo "<tr>"; }
                 echo "<td class='td-new' valign='top'>";
                 echo "<a href='".$html->url('/cnews/view_new/'.$new['Cnew']['id'])."'>";
                      echo "<div class='div-article'>";
                            echo "<div class='div-article-date'>";
//                              echo $html->link($new['0']['stamp'], '/cnews/view_new/'.$new['Cnew']['id']);
                            echo $new['0']['stamp'];
                              echo "<br/>";
//                              echo $html->link($new['Cnew']['news_header'], '/cnews/view_new/'.$new['Cnew']['id']);
                            echo $new['Cnew']['news_header'];
                            echo "</div>";
                        echo "<div class='div-article-image'>";
                          echo "<div class='div-article-image-1'>";
                            echo "<div class='div-article-image-2'>";
                              echo "<div class='div-article-image-3' style=\"background: url(".$this->webroot."img/".$new['SmallImage']['url'].") no-repeat center center\">";
                                            echo $html->image($new['SmallImage']['url']);
                              echo "</div>";
                              echo "</div>";
                              echo "</div>";
                            echo "</div>";
                            echo "<div class='div-article-note'>";
                              echo $new['Cnew']['news_footer'];
                            echo "</div>";
                        echo "</div>";
                        echo "<div class='div-article-note div-podrobno'>";
                          //echo $html->link('Подробно', '/cnews/view_new/'.$new['Cnew']['id']);
                          echo 'Подробно';
                        echo "</div>";

                 echo "</a>";
                 echo "</td>";
                 $row_cnt++;
                 if ($row_cnt%5 == 0) {
                   echo "</tr>";
                   $row_cnt = 0;
                 }
               }
               if ($row_cnt <> 0) {
                   for($i=$row_cnt+1; $i <= 5; $i++) {
                     echo "<td class='td-new'></td>";
                   }
               }
            ?>

          </table>
      </div>
    </div>

    <div class="clear-div"></div>
  </div>

  <?php
    echo $this->element('cnews_control_box');
  ?>

<script type="text/javascript">

   $('.new-pages-pagination').change(function(){

     var limit = $(this).val();

     var url = "<?php echo $paginator->url();?>";
     url += '/limit:'+limit;
     window.location = url;

   });

</script>

