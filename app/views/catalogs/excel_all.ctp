<?php 
//debug($catalogs);
?>
<style>
td {
    vertical-align: top;
}
</style>

<table border="1"
       cellpadding="5"
       style="border-collapse: collapse; width: 150mm;">
    <thead>
	<tr id="title"
            style="height: 130px;">
            <td id="title-image" colspan="<?php echo ($pic_type=='pic')?'3':'2';?>">
                <img src="<?php echo $url_to_image;?>lg.jpg" width="<?php echo ($pic_type=='pic')?'280':'280'?>"/>
            </td>
            <td id="title-text" colspan="3">
                <?php echo $strs[9];?>
            </td>
	</tr>
        <tr>
            <?php if($pic_type=='pic') { ?>
            <th style="width: 110px;">Изображение</th>
            <?php } ?>
            <th style="width: <?php echo ($pic_type=='pic')?'110':'140'?>px;">Название</th>
            <th style="width: <?php echo ($pic_type=='pic')?'90':'140'?>px;">Производитель</th>
            <th style="width: <?php echo ($pic_type=='pic')?'80':'90'?>px;">Наличие на складе</th>
            <th style="width: <?php echo ($pic_type=='pic')?'80':'90'?>px;">Дополнительно</th>
            <th style="width: <?php echo ($pic_type=='pic')?'80':'90'?>px;">Цена</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($catalogs as $catalog) {
            echo "<tr>";
            $colspan = 5;
            if($pic_type=='pic') $colspan = 6;
            echo "<td align='center' colspan='$colspan'><font size='4'><b>{$catalog['Catalog']['name']}</b></font></td>";
            echo "</tr>";

            foreach($catalog['Product'] as $product) {
                $dop = '';
                if(!empty($product['ProductData'])) {
                    foreach($product['ProductData'] as $product_data) {
                        $product_param_name = $product_data['ProductParamType']['name'];
                        $value = $product_data['ProductDetParamValue']['name'];
                        $dop .= "$product_param_name: $value; ";
                    }
                }

                if(empty($product['ProductDet'])) {
                    $style = '';
                    if($pic_type=='pic') $style = "style='height:110px;'";
                    echo "<tr $style>";

                    if($pic_type=='pic') {
                        echo "<td align='center' class='product-image'>";
                        if(empty($product['SmallImage'])) {
                            echo "<img height='100' width='100' src='".$url_to_image."nopic.gif'/>";
                        } else {
                            echo "<img height='100' width='100' src='".$url_to_image.$product['SmallImage']['url']."'/>";
                        }
                        echo "</td>";
                    }

                    echo "<td>".$product['name']."</td>";
                    $producer_name = (empty($product['Producer']))?'':$product['Producer']['name'];
                    echo "<td>".$producer_name."</td>";
                    echo "<td>".(($product['cnt']>0)?'есть':'нет')."</td>";
                    echo "<td>$dop</td>";
                    echo "<td>".$product['price']."</td>";
                    echo "</tr>";
                } else {
                    foreach($product['ProductDet'] as $product_det) {
                        $dop2 = $dop;
                        foreach($product_det['ProductDetParam'] as $product_det_param) {
                            $product_param_name = (empty($product_det_param['ProductParam']['ProductParamType']))?
                                '':$product_det_param['ProductParam']['ProductParamType']['name'];
                            //$product_param_name = $product_det_param['ProductParam']['ProductParamType']['name'];
                            $value = $product_det_param['ProductDetParamValue']['name'];

                            $dop2 .= "$product_param_name: $value; ";
                        }

                        $style = '';
                        if($pic_type=='pic') $style = "style='height:110px;'";
                        echo "<tr $style>";

                        if($pic_type=='pic') {
                            echo "<td align='center' class='product-image'>";
                            $small_image_url = null;
                            if(!empty($product['SmallImage']))
                                $small_image_url = $product['SmallImage']['url'];
                            if(!empty($product_det["SmallImage"]))
                                $small_image_url = $product_det['SmallImage']['url'];
                            if($small_image_url == null)
                                echo "<img height='100' width='100' src='".$url_to_image."nopic.gif'/>";
                            else
                                echo "<img height='100' width='100' src='".$url_to_image.$small_image_url."'/>";
                            echo "</td>";
                        }

                        echo "<td>".$product['name']."</td>";
                        $producer_name = (empty($product_det['Producer']))?'':$product_det['Producer']['name'];
                        echo "<td>".$producer_name."</td>";
                        echo "<td>".(($product_det['cnt']>0)?'есть':'нет')."</td>";
                        echo "<td>".$dop2."</td>";
                        echo "<td>".$product_det['price']."</td>";
                        echo "</tr>";
                    }
                }
            }
        }?>
    </tbody>
</table>