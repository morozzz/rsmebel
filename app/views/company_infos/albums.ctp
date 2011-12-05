<?php echo $common->caption('О КОМПАНИИ');?>

<div id="news-wrapper">

  <div id="news-container">

    <div id="news-content">
        <div class="news-cell pie" id="company-info-list">
          <?php
            foreach($company_infos as $company_info) {
                echo "<li class='text-shadow";
                if($company_info['CompanyInfo']['id'] == $com_infos['CompanyInfo']['id']) {
                    echo " li-current-company-info";
                }
                echo "'> ".$html->link($company_info['CompanyInfo']['news_header'], '/company_infos/index/'.$company_info['CompanyInfo']['id'])."</li>";
            }
          ?>
        </div>

        <div id="company-info-body" class="pie">
            <!--<div class="div-header">
                <div class="div-header-left"></div>
                <div class="div-header-center">
                  <h2 class="header"><?php echo $com_infos['CompanyInfo']['news_header']; ?></h2></div>
                <div class="div-header-right"></div>
            </div>-->
            <?php echo $common->caption($com_infos['CompanyInfo']['news_header']);?>
            <?php $session->flash();?>
           <div class="div-body pie">
               <div class="company_info_body">
                   <?php foreach($albums as $album) { ?>
                   <a href="<?php echo $html->url('/album_photos/index/'.$album['Album']['id']);?>"
                      target="_blank">
                       <div class="div-album">
                           <div class="div-album-photo">
                               <?php echo $html->image($album['SmallImage']['url']);?>
                           </div>
                           <div class="div-album-info">
                               <div class="div-album-name">
                                   <?php echo $album['Album']['name'];?>
                               </div>
                               <div class="div-album-short-about">
                                   <?php echo $album['Album']['short_about'];?>
                               </div>
                           </div>
                           <div style="clear: both"></div>
                       </div>
                   </a>
                   <?php } ?>
               </div>
           </div>
        </div>
    </div>
    <div class="clear-div"></div>
  </div>
</div>
