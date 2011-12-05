<style type="text/css">
#news-header {
   font-family:Arial,Geneva,Helvetica,sans serif;
   font-size:12px;
   padding-left: 10px;
   border-bottom: 2px #A3A3D3 solid;
}
#news-wrapper {
  width: 100%;
  width: expression((documentElement.clientWidth||document.body.clientWidth)<995?'1000px':'');
  min-width: 1000px;
  padding: 0;
  background:none repeat scroll 0 0 #373637;
  text-shadow:0 -2px 4px black;
  color: white;
}
#news-container {
  width: 100%;
  font-family:Arial,Helvetica,sans serif;
  font-size:12px;
}
#news-content {
  width: 100%;
  text-align: center;
  padding-right: 1px;
}
.news-cell {
  width: 10%;
  float: left;
  margin-top: 5px;
}
.news-footer {
  text-align: left;
  margin-top: 5px;
  padding-left: 10px;
  padding-bottom: 10px;
  font-weight: bold;
}
#shop-rule-list {
  text-align: left;
  padding-left: 30px;
  width: 95%;
}
#shop-rule-list li{
  padding-top: 10px;
}
</style>

<?php
  if($shop_rules[0]['ShopRule']['id'] == 1)
    echo $common->caption('ПРАВИЛА РАБОТЫ ИНТЕРНЕТ-МАГАЗИНА');
  else if ($shop_rules[0]['ShopRule']['id'] == 2)
    echo $common->caption('КАК ДЕЛАТЬ ПОКУПКИ В ИНТЕРНЕТ-МАГАЗИНЕ');
?>

<div id="news-wrapper">

  <div id="news-container">

    <div id="news-content">
        <div class="news-cell" id="shop-rule-list">

          <?php
            foreach($shop_rules as $shop_rule) {
                echo "<li> ".$shop_rule['ShopRule']['body_text']."</li>";
            }
          ?>
        </div>
        <div class="clear-div"></div>
        </div>
      </div>
    </div>
</div>


