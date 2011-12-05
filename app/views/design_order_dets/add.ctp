<?php echo $this->element('caption', array(
    'caption_name' => 'ЗАЯВКА НА ДИЗАЙН МАГАЗИНА',
    'caption_tag' => 'h1'
)); ?>
<div id="wrapper">

  <div id="container">
    <div class="news-cell" id="design-info-list">
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

    <div id="content">

      <?php
        echo "<div> ";
          $session->flash();
        echo "</div>";
      ?>

      <div id="text">

       <?php
//          echo $headers[0]['DesignOrderHeader']['header'];
       echo $strs[10];

                echo $form->create('DesignOrderDet', array(
                    'action' => 'add',
                    'id' => 'design_order-edit-form',
                    'type' => 'file'
                ));

                foreach($sections as $section) {
                  echo "<div class='section'>";

                    echo "<div class='section-value'>";
                    ///// формируем combobox
                    if ($section['Section']['section_type_id'] == 1) {
                      $i = 0;
                      echo "<select name='data[DesignOrderDet][".$section['Section']['id']."][".$i."][param_value]'>";
                      echo "<option value = ''> Выберете из списка </option>";
                      foreach($section_dets as $section_det) {
                        if($section_det['SectionDet']['section_id'] == $section['Section']['id']) {
                           echo "<option value='".$section_det['SectionDet']['id']."'>".$section_det['SectionDet']['param_name']."</option>";                        
                        }
                      }
                      echo "</select>";
                    }
                    //// формируем текстовое поле
                    else if ($section['Section']['section_type_id'] == 2) {
                      $i = 0;
                      foreach($section_dets as $section_det) {
                        if($section_det['SectionDet']['section_id'] == $section['Section']['id']) {
                          echo "<p>";
                          echo "<input type='text' value='' maxlength='40' size='40' name='data[DesignOrderDet][".$section['Section']['id']."][".$i."][param_value]'>";
                          echo "<input type='hidden' value='".$section_det['SectionDet']['id']."' name='data[DesignOrderDet][".$section['Section']['id']."][".$i."][section_det_id]'>";
                          echo "</p>";
                          $i++;
                        }
                      }
                    }
                    // радиокнопки
                    else if ($section['Section']['section_type_id'] == 3) {
                      $i = 0;
                      foreach($section_dets as $section_det) {
                        if($section_det['SectionDet']['section_id'] == $section['Section']['id']) {
                          echo "<p>";
                          echo "<input type='radio' value='".$section_det['SectionDet']['id']."' name='data[DesignOrderDet][".$section['Section']['id']."][param_value]'>";
                          echo $section_det['SectionDet']['param_name'];
                          echo "</p>";
                          $i++;
                        }
                      }
                    }
                    // чекбоксы
                    else if ($section['Section']['section_type_id'] == 4) {
                      $i = 0;
                      foreach($section_dets as $section_det) {
                        if($section_det['SectionDet']['section_id'] == $section['Section']['id']) {
                          echo "<p>";
                          echo "<input type='checkbox' value='".$section_det['SectionDet']['id']."' name='data[DesignOrderDet][".$section['Section']['id']."][".$i."][param_value]'>";
                          echo "<input type='hidden' value='".$section_det['SectionDet']['id']."' name='data[DesignOrderDet][".$section['Section']['id']."][".$i."][section_det_id]'>";
                          echo $section_det['SectionDet']['param_name'];
                          echo "</p>";
                          $i++;
                        }
                      }
                    }
                    // Календарь
                    else if ($section['Section']['section_type_id'] == 5) {
                      $i = 0;
                      foreach($section_dets as $section_det) {
                        if($section_det['SectionDet']['section_id'] == $section['Section']['id']) {
                          echo "<input type='text' value='' class ='calendar-date' maxlength='10' size='20' name='data[DesignOrderDet][".$section['Section']['id']."][".$i."][param_value]'>";
                          echo "<input type='hidden' value='".$section_det['SectionDet']['id']."' name='data[DesignOrderDet][".$section['Section']['id']."][".$i."][section_det_id]'>";
                          echo "<img src='../img/calendar.png'>";
                          $i++;
                        }
                      }
                    }
                    /// подцепляем файл
                    else if ($section['Section']['section_type_id'] == 6) {
                      $i = 0;
                      foreach($section_dets as $section_det) {
                        if($section_det['SectionDet']['section_id'] == $section['Section']['id']) {
                          echo "<p>";
                          echo "<input type='file' value='' name='data[DesignOrderDet][".$section['Section']['id']."][".$i."]'>";
                          echo "<input type='hidden' value='".$section_det['SectionDet']['id']."' name='data[DesignOrderDet][".$section['Section']['id']."][".$i."][section_det_id]'>";
                          echo "</p>";
                          $i++;
                        }
                      }
                    }
                    /// textarea
                    else if ($section['Section']['section_type_id'] == 7) {
                      $i = 0;
                      foreach($section_dets as $section_det) {
                        if($section_det['SectionDet']['section_id'] == $section['Section']['id']) {
                          echo "<p>";
                          echo "<textarea wrap='virtual' rows='6' cols='33' name='data[DesignOrderDet][".$section['Section']['id']."][".$i."][param_value]' type='text'></textarea>";
                          echo "<input type='hidden' value='".$section_det['SectionDet']['id']."' name='data[DesignOrderDet][".$section['Section']['id']."][".$i."][section_det_id]'>";
                          echo "</p>";
                          $i++;
                        }
                      }
                    }
                  echo "</div>";

                  echo "<div class='section-label'>";
                  if ($section['Section']['section_mode_id'] == 1) {
                    echo "<font color=red>*</font>";
                  }

                  if ($section['Section']['section_type_id'] == 8) {
                    echo "  ".$section['Section']['section_name'];
                  } else {
                    echo "  ".$section['Section']['section_name'].":";
                    echo "<p class='p-section-note'>".$section['Section']['note']."</p>";
                  }
                  echo "</div>"; 
//                  echo "<div class='clear-div'></div>";                 
                  echo "</div>";
                }
                echo $form->hidden('id');

                echo $form->submit('Отправить');

                echo $form->end();
            ?>
      </div>
    </div>

    <div class="clear-div"></div>
  </div>

</div>

<script type="text/javascript">
   $('.calendar-date').datepicker();
</script>
