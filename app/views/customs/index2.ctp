
<?php echo $common->caption('АРХИВ ЗАКАЗОВ');
      echo $this->element('customs_control_box');
?>

<div id="div-background-custom-table">
<div id="div-custom-table">
<table id="custom-table">
    <thead>
        <tr>
            <th width="10%"></th>
            <th width="10%">Номер</th>
            <th width="15%">Текущий статус</th>
<?php
//            <th width="25%">Тип доставки</th>
?>
            <th width="10%">Кол-во товаров</th>
            <th width="15%">Стоимость товаров</th>
<?php
//            <th width="10%">Стоимость (с доставкой)</th>
?>
            <th width="10%">Дата создания</th>
            <th width="30%">Примечание</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($customs)) {
            foreach($customs as $custom) {
                echo "<tr>";
                echo "<td align='center'>".$html->image($custom['CustomStatusType']['Image']['url'])."</td>";
                echo "<td align='center'>".$custom['Custom']['id']."</td>";
                echo "<td>".$custom['CustomStatusType']['name']."</td>";
//                echo "<td>".$custom['TransportType']['name'];
//                    if($custom['TransportType']['price']>0) {
//                        echo " (".$custom['TransportType']['price']." руб.)";
//                    }
                echo "</td>";
                echo "<td align='right'>".$custom[0]['sum_cnt']."</td>";
                echo "<td align='right'>".$custom[0]['sum_price']."</td>";
//                echo "<td align='right'>".($custom[0]['sum_price']+$custom['TransportType']['price'])."</td>";
                echo "<td align='center'>".$custom[0]['created_date']."</td>";
                echo "<td>".$custom['Custom']['note']."</td>";
                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>
</div>
</div>

<?php 
      echo $this->element('customs_control_box');
?>


<script type="text/javascript">

   $('.new-pages-pagination').change(function(){

     var limit = $(this).val();

     var url = "<?php echo $paginator->url();?>";
     url += '/limit:'+limit;
     window.location = url;

   });

    var custom_table;
    var webroot = "<?php echo $this->webroot; ?>"
    $(document).ready(function() {
        custom_table = $('#custom-table').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": false,
            "bInfo": false,
            "bAutoWidth": false,
            "oLanguage" : {
                "sZeroRecords":  "Список заказов пуст"
            },
            'aoColumns': [
                null,
                null,
                null,
<?php
//                null,
?>
                null,
                {
                    'fnRender': function(oObj) {
                                return parseFloat(oObj.aData[oObj.iDataColumn]).toFixed(2) + ' руб.';
                    }
                },
<?php
//                {
//                    'fnRender': function(oObj) {
//                                return '<span id="td-total-price-'+oObj.aData[6]+'">'+parseFloat(oObj.aData[oObj.iDataColumn]).toFixed(2) + ' руб.</span>';
//                    }
//                },
?>
                null,
                null
            ]
        });

        $('#custom-table tbody tr').hover(function() {
            $(this).addClass('highlight-row');
        }, function() {
            $(this).removeClass('highlight-row');
        });

        $('#custom-table tbody tr').click(function() {
            var custom_id = custom_table.fnGetData(this)[1];
            document.location = webroot+'customs/view/'+custom_id;
        });

        $('#custom-table tr').find('td:first, th:first').addClass('td-first');
        $('#custom-table tr').find('td:last, th:last').addClass('td-last');
    });
</script>