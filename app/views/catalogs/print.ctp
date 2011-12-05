<h1><?php echo $catalog['Catalog']['name'];?></h1>
<table border="1"
       cellpadding="5"
       style="border-collapse: collapse; width: 100%;">
    <thead>
	<tr id="title">
            <td id="title-text" colspan="5">
                <?php echo $strs[8];?>
            </td>
	</tr>
        <tr>
            <th>Название</th>
            <th>Производитель</th>
            <th>Наличие на складе</th>
            <th>Дополнительно</th>
            <th>Цена</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($products as $product) {
            $dop = '';
            if(!empty($product['ProductData'])) {
                foreach($product['ProductData'] as $product_data) {
                    $product_param_name = $product_data['ProductParamType']['name'];
                    $value = $product_data['ProductDetParamValue']['name'];
                    $dop .= "$product_param_name: $value; ";
                }
            }

            if(empty($product['ProductDet'])) {
                echo "<tr>";
                echo "<td>".$product['Product']['name']."</td>";
                echo "<td>".$product['Producer']['name']."</td>";
                echo "<td>".(($product['Product']['cnt']>0)?'есть':'нет')."</td>";
                echo "<td>$dop</td>";
                $price = $product['Product']['price'];
                if(empty($price) || $price<=0) $price = 'под заказ';
                echo "<td>".$price."</td>";
                echo "</tr>";
            } else {
                foreach($product['ProductDet'] as $product_det) {
                    $dop2 = $dop;
                    foreach($product_det['ProductDetParam'] as $product_det_param) {
                        $product_param_name = $product_det_param['ProductParam']['ProductParamType']['name'];
                        $value = $product_det_param['ProductDetParamValue']['name'];

//                        $value = '';
//                        if(empty($product_det_param['ProductDetParam']['product_det_param_value_id'])) {
//                            $value = $product_det_param['ProductDetParam']['value'];
//                        } else {
//                            $value = $product_det_param['ProductDetParamValue']['name'];
//                        }
//
//                        $product_param_id = $product_det_param['ProductDetParam']['product_param_id'];
//                        $product_param = $product['ProductParam'][$product_param_id];
//                        $product_param_name = $product_param['ProductParamType']['name'];

                        $dop2 .= "$product_param_name: $value; ";
                    }

                    echo "<tr>";
                    echo "<td>".$product['Product']['name']."</td>";
                    echo "<td>".$product_det['Producer']['name']."</td>";
                    echo "<td>".(($product_det['cnt']>0)?'есть':'нет')."</td>";
                    echo "<td>".$dop2."</td>";
                    $price = $product_det['price'];
                    if(empty($price) || $price<=0) $price = 'под заказ';
                    echo "<td>".$price."</td>";
                    echo "</tr>";
                }
            }
        } ?>
    </tbody>
</table>