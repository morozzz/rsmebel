<?php echo $this->element('caption', array(
    'caption_name' => 'ЗАЯВКА НА ДИЗАЙН МАГАЗИНА',
    'caption_tag' => 'h1'
)); ?>
<div id="wrapper">
    <div class="news-cell pie" id="design-info-list">
      <div id="design-order">
         <ul> <li class="li-current-design-info">
         <?php
           echo $html->link('Заявка на дизайн магазина', '/design_order_dets/add', array(
               'class' => 'text-shadow'
           ));
         ?>
         </li>
         </ul>
      </div>
      <?php
        foreach($design_infos as $des_order_num => $design_info) {
            echo "<li class='text-shadow";
            echo "'> ";
            if($des_order_num>0)
                echo $html->link($design_info['DesignInfo']['news_header'], '/design_infos/index/'.$design_info['DesignInfo']['id'])."</li>";
            else
                echo $html->link($design_info['DesignInfo']['news_header'], '/design_infos/index/')."</li>";
        }
      ?>
    </div>

  <div id="container">

    <div id="content">
      <div id="text">
        <p> Спасибо за заполнение заявки! </p>
        <p> В ближайшее время менеджер свяжется с Вами для уточнения деталей Вашего проекта. </p>
      </div>
    </div>

    <div id="left">
    </div>

    <div id="right">
    </div>

    <div class="clear-div"></div>
  </div>

  <div id="footer">  footer </div>
</div>

<script type="text/javascript">
</script>
