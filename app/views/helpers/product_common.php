<?php

class ProductCommonHelper extends AppHelper {
    var $helpers = array(
        'Common',
        'Javascript',
        'Html',
        'Form'
    );

    function js_product_dets($products) {
        $product_dets = array();
        foreach($products as $product) {
            if(empty($product['Producer']))
                $product['Producer']['name'] = 'не указан';

            foreach($product['ProductDet'] as $product_det_id => $product_det) {
                $p_d = array();

                $p_d['small_image_url'] = $this->webroot.'img/';
                if(empty($product_det['SmallImage']) || empty($product_det['SmallImage']['url']))
                    $p_d['small_image_url'] .= $product['SmallImage']['url'];
                else
                    $p_d['small_image_url'] .= $product_det['SmallImage']['url'];
                
                $p_d['big_image_url'] = $this->webroot.'img/';
                if(empty($product_det['BigImage']) || empty($product_det['BigImage']['url']))
                    $p_d['big_image_url'] .= $product['BigImage']['url'];
                else
                    $p_d['big_image_url'] .= $product_det['BigImage']['url'];

                if(empty($product_det['short_about']) || $product_det['short_about']=="")
                    $p_d['short_about'] = $product['Product']['short_about'];
                else
                    $p_d['short_about'] = $product_det['short_about'];
                if(empty($product_det['long_about']) || $product_det['long_about']=="")
                    $p_d['long_about'] = $product['Product']['long_about'];
                else
                    $p_d['long_about'] = $product_det['long_about'];

                $p_d['price'] = $product_det['price'];
                $p_d['cnt'] = $product_det['cnt'];
                $p_d['product_id'] = $product_det['product_id'];
                if(empty($product_det['Producer']))
                    $product_det['Producer']['name'] = $product['Producer']['name'];
                $p_d['producer_name'] = $product_det['Producer']['name'];

                $data = "";
                if(!empty($product['ProductParam3'])) {
                    foreach($product['ProductParam3'] as $product_param_id => $product_param) {
                        $product_param = $product_det['ProductDetParam'][$product_param_id];
                        $name = $product_param['ProductParam']['ProductParamType']['name'];
                        $postfix = $product_param['ProductParam']['ProductParamType']['postfix'];
                        $value = $product_param['ProductDetParamValue']['name'];

                        $data .= "<div>";
                        $data .= "$name:$value$postfix";
                        $data .= "</div>";
                    }
                }
                $p_d['short_about'] .= $data;
                $p_d['long_about'] .= $data;

                $p_d['is_special'] = $product_det['is_special'];

                $p_p = array();
                foreach($product_det['ProductDetParam'] as $product_param) {
                    $product_param_id = $product_param['ProductParam']['id'];
                    $product_det_param_value_id = $product_param['ProductDetParamValue']['id'];
                    $value = $product_param['ProductDetParamValue']['name'];
                    $p_p[$product_param_id] = array(
                        'id' => $product_det_param_value_id,
                        'value' => $value
                    );
                }
                $p_d['product_params'] = $p_p;

                $product_dets[$product_det_id] = $p_d;
            }
        }

        return $this->Javascript->object($product_dets);
    }

    function product_table($product) {
        if(empty($product['ProductParam']) &&
                empty($product['ProductDet'])) return "";
        $str = "";

        $str .= "<table class='table-product-det' ".
                "product_id='{$product['Product']['id']}'>";

        $str .= "<thead>";
        $str .= "<tr>";
        $str .= "<th class='text-shadow'></th>";//столбец с radiobutton
        if(!empty($product['ProductParam1'])) {
            foreach($product['ProductParam1'] as $product_param) {
                $str .= "<th>";
                $str .= $product_param['ProductParamType']['name'];
                $str .= "</th>";
            }
        }
        $str .= "<th>Цена</th>";
        $str .= "</tr>";
        $str .= "</thead>";

        $str .= "<tbody>";
        foreach($product['ProductDet'] as $product_det) {
            $tr = "";

            $product_param_str = "";
            foreach($product_det['ProductDetParam'] as $product_param_id => $product_param) {
                $value_id = $product_param['ProductDetParamValue']['id'];
                $product_param_str .= "p_$product_param_id='$value_id'";
            }

            $special_class = '';
            if($product_det['is_special'] == 1) {
                $special_class = 'tr-product-det-special';
            } else {
                $special_class = '';
            }

            $tr .= "<tr class='tr-product-det $special_class' $product_param_str ".
//                "product_id='{$product['Product']['id']}' ".
                "product_det_id='{$product_det['id']}'>";

            $tr .= "<td class='td-product-det-radio' width='20' align='center'>";
            $tr .= "<input type='radio' ".
                    "name='radio_product_{$product['Product']['id']}' ".
                    "class='radio-product-det'>";
            $tr .="</td>";

            if(!empty($product['ProductParam1'])) {
                foreach($product['ProductParam1'] as $product_param) {
                    $product_param_id = $product_param['id'];
                    $product_det_param = $product_det['ProductDetParam'][$product_param_id];

                    $name = $product_det_param['ProductDetParamValue']['name'];
                    $postfix = $product_det_param['ProductParam']['ProductParamType']['postfix'];
                    $value = $name.$postfix;

                    $tr .= "<td class='td-product-det' align='center'>$value</td>";
                }
            }
            $zakaz = true;
            if($product_det['cnt']>0) $zakaz = false;

            if($zakaz)
                $tr .= "<td class='td-product-det-price' align='right'>под заказ</td>";
            else
                $tr .= "<td class='td-product-det-price' align='right'>{$product_det['price']} руб.</td>";
            
            $tr .= "</tr>";

            $str .= $tr;
        }
        $str .= "</tbody>";

        $str .= "</table>";

        return $str;
    }

    function product_special_table($product) {
        if(empty($product['ProductParam']) &&
                empty($product['ProductDet'])) return "";
        $str = "";

        $str .= "<table class='table-product-det' ".
                "product_id='{$product['Product']['id']}'>";

        $str .= "<thead>";
        $str .= "<tr>";
        $str .= "<th class='text-shadow'></th>";//столбец с radiobutton
        if(!empty($product['ProductParam1'])) {
            foreach($product['ProductParam1'] as $product_param) {
                $str .= "<th>";
                $str .= $product_param['ProductParamType']['name'];
                $str .= "</th>";
            }
        }
        $str .= "<th>Цена</th>";
        $str .= "</tr>";
        $str .= "</thead>";

        $str .= "<tbody>";
        foreach($product['ProductDet'] as $product_det) {
            $tr = "";

            $product_param_str = "";
            foreach($product_det['ProductDetParam'] as $product_param_id => $product_param) {
                $value_id = $product_param['ProductDetParamValue']['id'];
                $product_param_str .= "p_$product_param_id='$value_id'";
            }

            $special_class = '';
            if($product_det['is_special'] == 1) {
                $special_class = 'tr-product-det-special';
            } else {
                $special_class = '';continue;
            }

            $tr .= "<tr class='tr-product-det $special_class' $product_param_str ".
//                "product_id='{$product['Product']['id']}' ".
                "product_det_id='{$product_det['id']}'>";

            $tr .= "<td class='td-product-det-radio' width='20' align='center'>";
            $tr .= "<input type='radio' ".
                    "name='radio_product_{$product['Product']['id']}' ".
                    "class='radio-product-det'>";
            $tr .="</td>";

            if(!empty($product['ProductParam1'])) {
                foreach($product['ProductParam1'] as $product_param) {
                    $product_param_id = $product_param['id'];
                    $product_det_param = $product_det['ProductDetParam'][$product_param_id];

                    $name = $product_det_param['ProductDetParamValue']['name'];
                    $postfix = $product_det_param['ProductParam']['ProductParamType']['postfix'];
                    $value = $name.$postfix;

                    $tr .= "<td class='td-product-det' align='center'>$value</td>";
                }
            }
            $zakaz = true;
            if($product_det['cnt']>0) $zakaz = false;

            if($zakaz)
                $tr .= "<td class='td-product-det-price' align='right'>под заказ</td>";
            else
                $tr .= "<td class='td-product-det-price' align='right'>{$product_det['price']} руб.</td>";

            $tr .= "</tr>";

            $str .= $tr;
        }
        $str .= "</tbody>";

        $str .= "</table>";

        return $str;
    }

    function product_print_table($product) {
        if(empty($product['ProductParam']) &&
                empty($product['ProductDet'])) return "";
        $str = "";

        $str .= "<table class='table-product-det' border='1'>";

        $str .= "<tr>";
        if(!empty($product['ProductParam'])) {
            foreach($product['ProductParam'] as $product_param) {
                $str .= "<td>";
                $str .= $product_param['ProductParamType']['name'];
                $str .= "</td>";
            }
        }
        $str .= "<td>Описание</td>";
        $str .= "<td>Цена</td>";
        $str .= "</tr>";

        foreach($product['ProductDet'] as $product_det) {
            $tr = "";

            $special_class = '';
            if($product_det['is_special'] == 1) {
                $special_class = 'tr-product-det-special';
            } else {
                $special_class = '';
            }
            $tr .= "<tr class='$special_class'>";

//        if(!empty($product['ProductParam'])) {
//            foreach($product['ProductParam'] as $product_param) {
//                $tr .= "<td>";
//                $tr .= $product_param['ProductParamType']['name'];
//                $tr .= "</td>";
//            }
//        }
            $product_param_str = "";
            foreach($product_det['ProductDetParam'] as $product_param_id => $product_param) {
                $tr .= "<td>";
                $tr .= $product_param['ProductDetParamValue']['name'].' '.
                    $product_param['ProductParam']['ProductParamType']['postfix'];
//                $tr .= "111";
                $tr .= "</td>";
            }

            $tr .= "<td>";
            $tr .= $product_det['short_about'];
            $tr .= "</td>";

            $zakaz = true;
            if($product_det['cnt']>0) $zakaz = false;

            if($zakaz)
                $tr .= "<td>под заказ</td>";
            else
                $tr .= "<td>{$product_det['price']} руб.</td>";

            $tr .= "</tr>";

            $str .= $tr;
        }

        $str .= "</table>";

        return $str;
    }

    function product_small_image($product) {
        $str = "";

        $str .= "<div>";

        $str .= "<a href='".$this->Html->url('/products/index/'.$product['Product']['id'])."' ".
                "class='link-product link-product-image link-product-small-image' ".
                "product_id='{$product['Product']['id']}'>";
        $str .= "<div class='div-small-image-product'>";
//        $str .= "<div class='div-small-image-product-1'>";
//        $str .= "<div class='div-small-image-product-2'>";
//        $str .= "<div class='div-small-image-product-3 div-small-image-product-background' style='".
//                "background: url({$this->webroot}img/{$product['SmallImage']['url']}) no-repeat center center'".
//                "product_id='{$product['Product']['id']}'>";
        $str .= $this->Html->image($product['SmallImage']['url'], array(
            'class' => 'img-product img-small-product',
            'product_id' => $product['Product']['id']
        ));
//        $str .= "</div>";
//        $str .= "</div>";
//        $str .= "</div>";
        $str .= "</div>";
        $str .= "</a>";

        $str .= "</div>";

        return $str;
    }

    function product_big_image($product) {
        $str = "";

        $str .= "<div>";

        $str .= "<a href='".$this->Html->url('/products/index/'.$product['Product']['id'])."' ".
                "class='link-product link-product-image link-product-big-image' ".
                "product_id='{$product['Product']['id']}'>";
        $str .= "<div class='div-big-image-product'>";
//        $str .= "<div class='div-big-image-product-1'>";
//        $str .= "<div class='div-big-image-product-2'>";
//        $str .= "<div class='div-big-image-product-3 div-big-image-product-background' style='".
//                "background: url({$this->webroot}img/{$product['BigImage']['url']}) no-repeat center center'".
//                "product_id='{$product['Product']['id']}'>";
        $str .= $this->Html->image($product['BigImage']['url'], array(
            'class' => 'img-product img-big-product',
            'product_id' => $product['Product']['id']
        ));
//        $str .= "</div>";
//        $str .= "</div>";
//        $str .= "</div>";
        $str .= "</div>";
        $str .= "</a>";

        $str .= "</div>";

        return $str;
//        $str = "";
//
//        $str .= "<div>";
//
//        $str .= "<a href='".$this->Html->url('/products/index/'.$product['Product']['id'])."' ".
//                "class='link-product link-product-image link-product-big-image' ".
//                "product_id='{$product['Product']['id']}'>";
//        $str .= $this->Html->image($product['BigImage']['url'], array(
//            'class' => 'img-product img-big-product bevel iradius32',
//            'product_id' => $product['Product']['id']
//        ));
//        $str .= "</a>";
//
//        $str .= "</div>";
//
//        return $str;
    }

    function product_comboboxes($product) {
        if(empty($product['ProductParam2'])) return "";
        $str = "";

        $str .= "<div class='div-product-comboboxes'>";

        foreach($product['ProductParam2'] as $product_param) {
            $str .= "<div class='div-product-combobox-label text-shadow'>";
            $str .= $product_param['ProductParamType']['name'];
            $str .= "</div>";

            //prepare list
            $postfix = $product_param['ProductParamType']['postfix'];
            $list = array();
            foreach($product_param['ProductDetParam'] as $product_det_param) {
                $id = $product_det_param['ProductDetParamValue']['id'];
                $name = $product_det_param['ProductDetParamValue']['name'];
                $value = $name.$postfix;
                $list[$id] = $value;
            }

            $str .= "<div class='div-product-combobox'>";
            $str .= $this->Form->select('', $list, null, array(
                'class' => 'select-product-param',
                'product_param_id' => $product_param['id'],
                'product_id' => $product['Product']['id']
            ), false);
            $str .= "</div>";
        }

        $str .= "</div>";
        return $str;
    }

    function product_name($product) {
        $str = "";

        $str .= "<a href='".$this->Html->url('/products/index/'.$product['Product']['id'])."'".
                "class='link-product' product_id='{$product['Product']['id']}'>";
        $str .= "<h3 class='h-product-name'>";
        $str .= "<span class='text-shadow'>";
        $str .= $product['Product']['name'];
        $str .= "</span>";
        $str .= "</h3>";
        $str .= "</a>";

        return $str;
    }

    function product_producer($product) {
        $str = "";

        $str .= "<h4 class='h-product-producer'>";
        $str .= "<span class='text-shadow'>";
        $str .= "Производитель: ";
        $str .= "</span>";
        $str .= "<span class='span-producer-name text-shadow' product_id='{$product['Product']['id']}'>";
        if(empty($product['Producer']['name']))
            $str .= "не указан";
        else
            $str .= $product['Producer']['name'];
        $str .= "</span>";
        $str .= "</h4>";

        return $str;
    }

    function product_data($product) {
        $str = "";

        $str .= "<div class='product-data'>";
        if(!empty($product['ProductData'])) {
            foreach($product['ProductData'] as $product_data) {
                $title = $product_data['ProductParamType']['name'];
                $postfix = $product_data['ProductParamType']['postfix'];
                $name = $product_data['ProductDetParamValue']['name'];
                $value = $name.$postfix;

                $str .= "<div class='div-product-data'>";
                $str .= "$title: $value";
                $str .= "</div>";
            }
        }
        $str .= "</div>";

        return $str;
    }

    function product_short_about($product) {
        $str = "";

        $str .= "<div class='div-product-short-about' ".
                "product_id='{$product['Product']['id']}'>";

        $str .= "<div>";
        $str .= $product['Product']['short_about'];
        $str .= "</div>";

        $str .= $this->product_data($product);

        $str .= "</div>";

        return $str;
    }

    function product_long_about($product) {
        $str = "";

        $str .= "<div class='div-product-long-about' ".
                "product_id='{$product['Product']['id']}'>";

        $str .= "<div>";
        $str .= $product['Product']['long_about'];
        $str .= "</div>";

        $str .= $this->product_data($product);

        $str .= "</div>";

        return $str;
    }

    function product_cost($product) {
        $str = "";

        $str .= "<div class='div-product-cost'>";

        $zakaz = true;
        if($product['Product']['cnt']>0)
            $zakaz = false;

        $price = $product['Product']['price'];
        if($zakaz) $price="под заказ";
        $price_value = $product['Product']['price'];
        if($zakaz) $price_value=-1;

        if($product['is_special'] == 1)
            $special_class = 'span-product-cost-sum-special';
        else
            $special_class = '';

        $str .= "<div class='div-product-cost-sum'>";
        $str .= "<span class='span-product-cost-sum $special_class'".
                "product_id='{$product['Product']['id']}'>";
        $str .= $this->Html->image('special-item-price-background.png', array(
            'class' => 'img-product-cost-sum-special iepngfix'
        ));

        $str .= "<span class='span-product-cost-sum1'>";
        $str .= "<span class='span-product-cost' ".
                "product_id='{$product['Product']['id']}' ".
                "value='$price_value'>";
        $str .= $price;
        $str .= "</span>";
        $display = 'inline';
        if($zakaz) $display = 'none';
        $str .= "<span class='span-product-cost-rub' style='display:$display' ".
                "product_id='{$product['Product']['id']}'>";
        $str .= " руб.";
        $str .= "</span>";
        $str .= "</span>";

        $str .= "<span class='span-product-cost-sum2'>";
        $str .= "<span class='span-product-cost' ".
                "product_id='{$product['Product']['id']}' ".
                "value='$price_value'>";
        $str .= $price;
        $str .= "</span>";
        $display = 'inline';
        if($zakaz) $display = 'none';
        $str .= "<span class='span-product-cost-rub' style='display:$display' ".
                "product_id='{$product['Product']['id']}'>";
        $str .= " руб.";
        $str .= "</span>";
        $str .= "</span>";

        $str .= "</span>";
        $str .= "</div>";

        $str .= "<div class='div-product-cost-label'>";
        $str .= "<span class='text-shadow'>";
        $str .= "Цена: ";
        $str .= "</span>";
        $str .= "</div>";

        $str .= "<div style='clear: both;'></div>";
        
        $str .= "</div>";

        return $str;
    }

    function product_zakaz_text($product, $zakaz_str) {
        $str = "";

        $display = "block";
        if($product['Product']['cnt']>0) $display = "none";

        $str .= "<div class='div-product-zakaz-text' ".
                "product_id='{$product['Product']['id']}' ".
                "style='display:$display'>";
        $str .= "<span class='text-shadow'>";
        $str .= $zakaz_str;
        $str .= "</span>";
        $str .= "</div>";

        return $str;
    }

    function product_count($product) {
        $str = "";

        $str .= "<div class='div-product-count'>";

        $str .= "<div class='div-product-count-edit'>";
        $str .= "<input type='edit' class='product-count textbox-int' ".
                "product_id='{$product['Product']['id']}' value='1'>";
        $str .= "</div>";

        $str .= "<div class='div-product-count-label'>";
        $str .= "<span class='text-shadow'>";
        $str .= "Количество: ";
        $str .= "</span>";
        $str .= "</div>";
        
        $str .= "<div style='clear: both;'></div>";

        $str .= "</div>";

        return $str;
    }

    function product_price($product) {
        $str = "";

        $str .= "<div class='div-product-price'>";

        $zakaz = true;
        if($product['Product']['cnt']>0)
            $zakaz = false;

        $price = $product['Product']['price'];
        if($zakaz) $price="под заказ";
        $price_value = $product['Product']['price'];
        if($zakaz) $price_value=-1;

        $str .= "<div class='div-product-price-sum'>";
        $str .= "<span class='span-product-price-sum'>";
        $str .= "<span class='span-product-sum' ".
                "product_id='{$product['Product']['id']}' ".
                "value='$price_value'>";
        $str .= $price;
        $str .= "</span>";

        $display = 'inline';
        if($zakaz) $display = 'none';
        $str .= "<span class='span-product-sum-rub' style='display:$display' ".
                "product_id='{$product['Product']['id']}'>";
        $str .= " руб.";
        $str .= "</span>";
        $str .= "</span>";
        $str .= "</div>";

        $str .= "<div class='div-product-price-label'>";
        $str .= "<span class='text-shadow'>";
        $str .= "Сумма: ";
        $str .= "</span>";
        $str .= "</div>";
        
        $str .= "<div style='clear: both;'></div>";
        
        $str .= "</div>";

        return $str;
    }

    function product_custom_button($product) {
        $str = "";

        $str .= "<div class='div-product-custom-button'>";
        $str .= "<input type='button' value='Заказать' class='btn-product-custom' ".
                "product_id='{$product['Product']['id']}'>";
        $str .= "</div>";

        return $str;
    }

    function product_custom($product, $zakaz_str) {
        return "<div class='div-product-custom-content'>".
                $this->product_cost($product).
                $this->product_count($product).
                $this->product_price($product).
                $this->product_custom_button($product).
                $this->product_zakaz_text($product, $zakaz_str).
                "</div>";
    }

    function small_product($product) {
        $str = "";

        $str .= "<div class='div-small-product div-product-content' product_id='{$product['Product']['id']}'>";

        $str .= "<table width='100%'>";
        $str .= "<tr>";

        $str .= "<td valign='top' width='150'>";
        $str .= $this->product_small_image($product);
        $str .= $this->product_comboboxes($product);
        $str .= "</td>";

        $str .= "<td valign='top'>";
        $str .= $this->product_name($product);
        $str .= $this->product_producer($product);
        $str .= $this->product_short_about($product);
        $str .= $this->product_table($product);
        $str .= "</td>";

        $str .= "</tr>";
        $str .= "</table>";

        $str .= "</div>";

        return $str;
    }

    function big_product($product) {
        $str = "";

        $str .= "<div class='div-big-product div-product-content' product_id='{$product['Product']['id']}'>";

        $str .= "<table width='100%'>";
        $str .= "<tr>";

        $str .= "<td valign='top' width='300'>";
        $str .= $this->product_big_image($product);
        $str .= "</td>";

        $str .= "<td valign='top'>";
        $str .= $this->product_name($product);
        $str .= $this->product_producer($product);
        $str .= $this->product_long_about($product);
        $str .= "<div style='width:150px;'>";
        $str .= $this->product_comboboxes($product);
        $str .= "</div>";

        $str .= "<div>";
        $str .= $this->product_table($product);
        $str .= "</div>";
        $str .= "</td>";

        $str .= "</tr>";
        $str .= "</table>";

        $str .= "</div>";

        return $str;
    }

    function special_product($product) {
        $str = "";

        $str .= "<div class='div-small-product div-product-content' product_id='{$product['Product']['id']}'>";

        $str .= "<div class='div-product-path'>";
        $str .= $this->Common->getPathStr($product['path']);
        $str .= "</div>";

        $str .= "<table width='100%'>";
        $str .= "<tr>";

        $str .= "<td valign='top' width='150'>";
        $str .= $this->product_small_image($product);
        $str .= $this->product_comboboxes($product);
        $str .= "</td>";

        $str .= "<td valign='top'>";
        $str .= $this->product_name($product);
        $str .= $this->product_producer($product);
        $str .= $this->product_short_about($product);
        $str .= $this->product_special_table($product);
        $str .= "</td>";

        $str .= "</tr>";
        $str .= "</table>";

        $str .= "</div>";

        return $str;
    }

    function dialog_made_custom() {
        $str = "";

        $str .= "<div id='dialog-made-custom'>";

        $str .= "<div id='dialog-made-custom-link'>";
        $str .= $this->Html->link('Перейти в корзину', '/basket/index/');
        $str .= "</div>";

        $str .= "</div>";

        return $str;
    }
}
?>
