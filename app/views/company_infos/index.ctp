<?php echo $this->element('caption', array(
    'caption_name' => 'О КОМПАНИИ',
    'caption_tag' => 'h1'
)); ?>

<div id="news-wrapper">

  <div id="news-container">

    <div id="news-content">
        <div class="news-cell" id="company-info-list">
          <?php
            foreach($company_infos as $com_order_num => $company_info) {
                echo "<li class='text-shadow";
                if($company_info['CompanyInfo']['id'] == $com_infos['CompanyInfo']['id']) {
                    echo " li-current-company-info";
                }
                echo "'> ";
                if($com_order_num>0)
                    echo $html->link($company_info['CompanyInfo']['news_header'], '/company_infos/index/'.$company_info['CompanyInfo']['id'])."</li>";
                else
                    echo $html->link($company_info['CompanyInfo']['news_header'], '/company_infos/index/')."</li>";
            }
          ?>
        </div>

        <div id="company-info-body">
            <?php echo $this->element('caption', array(
                'caption_name' => $com_infos['CompanyInfo']['news_header'],
                'caption_tag' => 'h2'
            )); ?>
            <?php $session->flash();?>
           <div class="div-body">
              <?php
                 echo $html->div('company_info_body', $com_infos['CompanyInfo']['news_body']);
              ?>
           </div>
        </div>
    </div>
    <div class="clear-div"></div>
  </div>
</div>
