
<?php

   $cnews = $this->requestAction('home_news/cnews_box');

   foreach($cnews as $new) {
      echo "<div class='left2-date'>";
        echo "<li style='list-style-type: square;'> ".$new['0']['stamp']."</li>";
      echo "</div>";
      echo "<div class='left2-header'>";
        echo $html->link($new['Cnew']['news_header'], '/cnews/view_new/'.$new['Cnew']['id']);
      echo "</div>";
      echo "<div class='left2-image'>";
       // echo $html->image($new['SmallImage']['url'], array('url' => '/cnews/view_new/'.$new['Cnew']['id']));
      echo "</div>";
      echo "<div class='left2-footer'>";
        echo $new['Cnew']['news_footer'];
      echo "</div>";
    }
?>