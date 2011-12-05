<?php

    //debug($design_order_dets);

    echo $html->div('table-caption', 'Детализация заявки на дизайн');

    echo "<fieldset class = 'fDesignOrder'>";
    echo "<legend>"."Заявка на дизайн N".$design_order_id."</legend>";

    echo $form->create('DesignOrderDet', array(
        'action' => 'adm_design_order_edit/'.$action,
        'id' => 'design_order-edit-form',
        'type' => 'file'
    ));

    echo "<label for='DesignOrderStatusId'>Статус заявки:</label>";
    echo "<select id='DesignOrderStatusId' name='data[DesignOrder][design_order_status_id]'>";
    foreach ($design_order_statuses as $design_order_status) {
      echo "<option value='".$design_order_status['DesignOrderStatus']['id']."'>".$design_order_status['DesignOrderStatus']['status_name']."</option>";
    }
    echo "</select>";

    echo $form->hidden('DesignOrder.id', array('value' => $design_order_id));
    echo "<br>";

    echo "<hr color = '#A3A3D3'> </hr>";
    if ($action == 'edit') {
      echo $form->submit('Сохранить');
    }
    else if ($action == 'delete') {
      echo $form->submit('Удалить');
    }

    echo "<div id = 'divCancel'>";
      echo $form->button('Отмена', array('id' => 'btnCancel', 'onclick' => 'come_back();'));
    echo "</div>";

    echo "</fieldset>";

    echo $form->end();

    echo "<fieldset class = 'fDesignOrder'>";
    echo "<legend>Детализация заявки</legend>";
    $i = 0;
    foreach ($sections as $section) {
      echo "<fieldset id = 'fDesignOrderDet'>";
      echo "<legend>".$section['Section']['section_name']."</legend>";
        foreach($design_order_dets as $design_order_det) {
          if ($design_order_det['DesignOrderDet']['section_id'] == $section['Section']['id']) {
            if ($section['SectionType']['id'] == 6) {

                $big_image_url = (empty($design_order_det['BigImage']['url']))?'nopic.gif':$design_order_det['BigImage']['url'];
                echo "<p>Фото<p>";
                echo $html->image($big_image_url, array('class' => 'table-image',
                    'id' => 'big-image-'.$design_order_det['DesignOrderDet']['big_image_id'],
                    'onclick' => 'show_image("big-image-'.$design_order_det['DesignOrderDet']['big_image_id'].'");'
                ));
            } else {
              echo $html->div('section-body', $design_order_det['DesignOrderDet']['param_value']);
            }
          }
          $i++;
        }
      echo "</fieldset>";
    }
    echo "</fieldset>";
?>

<script type="text/javascript">
    enable_validation();

    function show_image(image_name) {
        var url = document.getElementById(image_name).src;

        var image = new Image();
        image.src = url;
        $.fumodal({
            'width' : image.width,
            'height' : image.height,
            'style' : false,
            'overlayColor' : '#555599',
            'overlayOpacity' : 0.8,
            'content' : '<img src="' + url + '" title="Нажмите, чтобы закрыть" style="cursor:pointer;" onClick="$.fumodal_close()"/>'
        });
    }

    function come_back() {
      var url = <?php echo "'".$this->webroot."design_order_dets/adm_index'"; ?>;
      window.location = url;
    }

   var status_id = <?php echo $order_status_id; ?>;
   $('#DesignOrderStatusId').attr('value', status_id);

   var action = <?php echo "'".$action."'"; ?>;

   if (action == 'edit') {
     $('#DesignOrderStatusId').attr('disabled', '');
   }
   else if (action == 'delete') {
     $('#DesignOrderStatusId').attr('disabled', 'true');
   }


</script>
