<yml_catalog date="<?php echo date('Y-m-d H:i');?>">
    <shop>
        <name>Анжелика</name>
        <company>Магазин торгового оборудования</company>
        <url>http://www.mto24.ru</url>
        
        <currencies>
            <currency id="RUR" rate="1"/>
        </currencies>
        <categories>
<?php foreach($catalogs as $catalog) {
            echo "            <category id=\"{$catalog['Catalog']['id']}\"";
            if(!empty($catalog['Catalog']['parent_id']))
                echo " parentId=\"{$catalog['Catalog']['parent_id']}\"";
            echo ">{$catalog['Catalog']['name']}</category>\n";
        } ?>
        </categories>
        <offers>
<?php foreach($products as $product) { ?>
<?php if(empty($product['ProductDet'])) {?>
<?php if($product['Product']['price'] <= 0) continue;?>
            <offer id="<?php echo $product['Product']['id'];?>" available="<?php echo ($product['Product']['cnt']>0)?'true':'false';?>">
                <url><?php echo $html->url('/products/index/'.$product['Product']['id'], true);?></url>
                <price><?php echo $product['Product']['price'];?></price>
                <currencyId>RUR</currencyId>
                <categoryId><?php echo $product['Product']['catalog_id'];?></categoryId>
<?php if(!empty($product['SmallImage'])) { ?>
                <picture><?php echo $html->url('/img/'.$product['SmallImage']['url'], true);?></picture>
<?php } ?>
                <delivery>false</delivery>
                <name><?php echo $product['Product']['name'];?></name>
<?php if(!empty($product['Product']['short_note'])) { ?>
                <description><?php echo $product['Product']['short_note'];?></description>
<?php } ?>
                <vendor><?php echo (empty($product['Producer']['name']))?'не указан':$product['Producer']['name'];?></vendor>
            </offer>
<?php } else { ?>
<?php foreach($product['ProductDet'] as $product_det) { ?>
<?php if($product_det['price'] <= 0) continue;?>
            <offer id="d_<?php echo $product_det['id'];?>" available="<?php echo ($product_det['cnt']>0)?'true':'false';?>">
                <url><?php echo $html->url('products/index/'.$product['Product']['id'].'/'.$product_det['id'], true);?></url>
                <price><?php echo $product_det['price'];?></price>
                <currencyId>RUR</currencyId>
                <categoryId><?php echo $product['Product']['catalog_id'];?></categoryId>
<?php if(!empty($product_det['SmallImage'])) { ?>
                <picture><?php echo $html->url('/img/'.$product_det['SmallImage']['url'], true);?></picture>
<?php } ?>
                <delivery>false</delivery>
                <name><?php echo $product['Product']['name'];?></name>
<?php if(!empty($product_det['short_note'])) { ?>
                <description><?php echo $product_det['short_note'];?></description>
<?php } else if(!empty($product['Product']['short_note'])) { ?>
                <description><?php echo $product['Product']['short_note'];?></description>
<?php } ?>
                <vendor><?php
                if(!empty($product_det['Producer']['name']))
                    echo $product_det['Producer']['name'];
                else if(!empty($product['Producer']['name']))
                    echo $product['Producer']['name'];
                else
                    echo 'не указан';
                ?></vendor>
            </offer>
<?php } ?>
<?php } ?>
<?php } ?>
        </offers>
    </shop>
</yml_catalog>