
<?php

   $home_news = $this->requestAction('home_news/home_news_box');

    foreach($home_news as $home_new) {
      echo "<h1>".$home_new['HomeNew']['news_header']."</h1>";
      echo $home_new['HomeNew']['news_body'];
    }
?>