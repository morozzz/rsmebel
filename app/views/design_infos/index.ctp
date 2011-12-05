<?php echo $this->element('caption', array(
    'caption_name' => 'ДИЗАЙН ИНТЕРЬЕРА МАГАЗИНОВ И БУТИКОВ',
    'caption_tag' => 'h1'
)); ?>
<div id="news-wrapper">


  <div id="news-container">

    <div id="news-content">
    <div class="news-cell" id="design-info-list">
      <div id="design-order">
         <ul> <li>
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
            if($design_info['DesignInfo']['id'] == $des_infos['DesignInfo']['id']) {
                echo " li-current-design-info";
            }
            echo "'> ";
            if($des_order_num>0)
                echo $html->link($design_info['DesignInfo']['news_header'], '/design_infos/index/'.$design_info['DesignInfo']['id'])."</li>";
            else
                echo $html->link($design_info['DesignInfo']['news_header'], '/design_infos/index/')."</li>";
        }
      ?>
    </div>
    <div id="design-info-body">
        <?php echo $this->element('caption', array(
            'caption_name' => $des_infos['DesignInfo']['news_header'],
            'caption_tag' => 'h2'
        )); ?>
        <div class="div-body">
          <?php
             echo $html->div('design_info_body', $des_infos['DesignInfo']['news_body']);
          ?>
        </div>
    </div>

  </div>
</div>
</div>
<div style="clear:both;"></div>

