<?php
    echo $html->div('table-caption', 'Список заявок на дизайн');

    echo "<fieldset>";
    echo "<label for='DesignOrderStatusId'>Статус заявки:</label>";
    echo "<select id='DesignOrderStatusId' name='data[DesignOrder][status_id]'>";
    echo "<option value='0'>Все</option>";
    foreach ($design_order_statuses as $design_order_status) {
      echo "<option value='".$design_order_status['DesignOrderStatus']['id']."'>".$design_order_status['DesignOrderStatus']['status_name']."</option>";
    }
    echo "</select>";

    echo "<table class=\"data-table tree-table\" id=\"design-order-table\">";
    echo "<thead>";
    echo $html->tableHeaders(array(
        $html->div('design_header', 'N'),
        $html->div('design_header', 'Статус заявки'),
        $html->div('design_header', 'Создана'),
        $html->div('design_header', 'Изменена'),
        '',''
    ));
    echo "</thead>";

    echo "<tbody>";
    foreach($design_orders as $design_order) {

        if ($design_order['DesignOrder']['design_order_status_id'] == 3) {

            echo $html->tableCells(array(
                $design_order['DesignOrder']['id'],
                $design_order['DesignOrderStatus']['status_name'],
                $design_order[0]['created'],
                $design_order[0]['modified'],

                $html->div('action',
                        $html->link('просмотр', array(
                            'controller' => 'design_order_dets',
                            'action' => 'adm_show_order',
                            'edit',
                            $design_order['DesignOrder']['id']
                        ))
                ),
                ''
                ));
        }
        else {
            echo $html->tableCells(array(
                $design_order['DesignOrder']['id'],
                $design_order['DesignOrderStatus']['status_name'],
                $design_order[0]['created'],
                $design_order[0]['modified'],

                $html->div('action',
                        $html->link('просмотр', array(
                            'controller' => 'design_order_dets',
                            'action' => 'adm_show_order',
                            'edit',
                            $design_order['DesignOrder']['id']
                        ))
                ),
                $html->div('action',
                        $html->link('удалить', array(
                            'controller' => 'design_order_dets',
                            'action' => 'adm_show_order',
                            'delete',
                            $design_order['DesignOrder']['id']
                        ))
                )
                ));
        }
    }
    echo "</tbody>";
    echo "</table>";

    echo "</fieldset>";
?>

<script type="text/javascript">

   var status_id = <?php echo $order_status_id; ?>;

   $('#DesignOrderStatusId').attr('value', status_id);

   $('#DesignOrderStatusId').change(function(){

     var url = <?php echo "'".$this->webroot."design_order_dets/adm_index/'"; ?>;
     url = url + $('#DesignOrderStatusId').val();

     window.location = url;
   });

</script>
