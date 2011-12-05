<?php

class ProductCommonComponent extends Object {
    var $components = array(
        "Common"
    );

    function prepareProduct(&$product) {
        if(empty($product['Producer']['name']))
            $product['Producer']['name'] = 'не указан';
        
        $product['ProductDet'] = Set::combine(
                $product['ProductDet'], '{n}.id', '{n}');
        $product['ProductParam'] = Set::combine(
                $product['ProductParam'], '{n}.id', '{n}');
        foreach($product['ProductDet'] as &$product_det) {
            $product_det['ProductDetParam'] = Set::combine(
                $product_det['ProductDetParam'], '{n}.ProductParam.id', '{n}');
            if(empty($product_det['Special']) || empty($product_det['Special']['id'])) {
                $product_det['is_special'] = 0;
            } else {
                $product_det['is_special'] = 1;
            }
            if(empty($product['Special']) || empty($product['Special']['id'])) {
                $product['is_special'] = 0;
            } else {
                $product['is_special'] = 1;
            }
            if($product['is_special']==1) $product_det['is_special'] = 1;

            if(empty($product_det['Producer']['name'])) {
                if(!empty($product['Producer']['name'])) {
                    $product_det['Producer']['name'] = $product['Producer']['name'];
                }
            }
        }

        foreach($product['ProductParam'] as $product_param) {
            $product_param_id = $product_param['id'];
            $product_param_show_type_id = $product_param['product_param_show_type_id'];
            $product["ProductParam$product_param_show_type_id"][$product_param_id] = $product_param;
        }
    }

//    function GetProductsDet(&$products) {
//        $products = Set::combine($products, '{n}.Product.id', '{n}');
//        $this->Common->repairImage($products);
//        $products_id = Set::classicExtract($products, '{n}.Product.id');
//
//        $det_array = $this->PrepareProductDet($products_id);
//        $product_dets = $det_array['product_dets'];
//        $product_params = $det_array['product_params'];
//        $product_det_params = $det_array['product_det_params'];
//
//        /*comboboxes and columns
//        /**********************************************************************/
//        foreach($product_dets as $product_det) {
//            $product_id = $product_det['ProductDet']['product_id'];
//            $product =& $products[$product_id];
//            $product['hasTable'] = true;
//        }
//
//        foreach($product_params as $product_param_id => $product_param) {
//            $product_id = $product_param['ProductParam']['product_id'];
//            $product =& $products[$product_id];
//
//            if($product_param['ProductParam']['product_param_show_type_id'] == 1) {
//                $column = array(
//                    'product_param_id' => $product_param_id,
//                    'name' => $product_param['ProductParamType']['name']
//                );
//                $product['columns'][] = $column;
//            } else if($product_param['ProductParam']['product_param_show_type_id'] == 2) {
//                $combobox = array(
//                    'name' => $product_param['ProductParamType']['name'],
//                    'product_param_id' => $product_param_id,
//                    'values' => Set::combine($product_param['ProductDetParam'],
//                                            '{n}.ProductDetParamValue.id',
//                                            '{n}.ProductDetParamValue.name')
//                );
//
//                $product['comboboxes'][] = $combobox;
//            }
//        }
//
//        /*and again columns
//        /**********************************************************************/
//        foreach($products as $product_id => &$product) {
//            if(!empty($product['hasTable']) && $product['hasTable']==true) {
//                if(empty($product['columns'])) {
//                    $product['columns'] = array();
//                }
//
//                $this->array_insert($product['columns'], 0, array(
//                    '0' => array(
//                        'product_param_id' => -1,
//                        'name' => ''
//                    )
//                ));
//
//                $product['columns'][] = array(
//                    'product_param_id' => -1,
//                    'name' => 'Цена'
//                );
//            }
//
//            /*product special*/
//            /******************************************************************/
//            $is_special = 0;
//            if(!empty($product['Special']) && !empty($product['Special']['id'])) {
//                $date1 = strtotime($product['Special']['date1']);
//                if(empty($date1)) $date1 = strtotime('now');
//
//                $date2 = strtotime($product['Special']['date2']);
//                if(empty($date2)) $date2 = strtotime('now');
//
//                $now = strtotime('now');
//
//                if( ($date1 <= $now) && ($now <= $date2) ) {
//                    $is_special = 1;
//                }
//            }
//            $product['is_special'] = $is_special;
//            /******************************************************************/
//            $product['ProductParam'] = $product_params;
//        }
//        /**********************************************************************/
//
//        /*table and tables*/
//        /**********************************************************************/
//        foreach($product_dets as $product_det_id => $product_det) {
//            $product_id = $product_det['ProductDet']['product_id'];
//            $product =& $products[$product_id];
//            $product['ProductDet'][$product_det_id] = $product_det;
//
//            if(empty($product['comboboxes'])) {
//                //если нет комбобоксов, то тупо таблица
//                if(empty($product['table'])) {
//                    $product['table'] = array(
//                        'product_id' => $product_id,
//                        'rows' => array()
//                    );
//                }
//
//                $row = array(
//                    'product_det_id' => $product_det_id,
//                    'cells' => array()
//                );
//
//                foreach($product_params as $product_param_id => $product_param) {
//                    if(empty($product_det['ProductDetParam'][$product_param_id])) continue;
//                    $product_det_param = $product_det['ProductDetParam'][$product_param_id];
//                    $cell = array(
//                        'product_param_id' => $product_param_id,
//                        'value' => $product_det_param['ProductDetParam']['value']
//                    );
//
//                    $row['cells'][] = $cell;
//                }
//
//                $this->array_insert($row['cells'], 0, array(
//                    '0' => array(
//                        'product_param_id' => -1,
//                        'value' => '<input type="radio" name="radio_'.$product_id.'">'
//                    )
//                ));
//
//                $value = '';
//                if($product_det['ProductDet']['cnt'] > 0) {
//                    $value = '<span class="product-table-price">'.
//                               number_format($product_det['ProductDet']['price'], 2, '.', '').
//                               ' руб.'.
//                               '</span>';
//                } else {
//                    $value = '<span class="product-table-price">'.
//                               'под заказ'.
//                               '</span>';
//                }
//
//                $row['cells'][] = array(
//                    'product_param_id' => -1,
//                    'value' => $value
//                );
//
//                $product['table']['rows'][] = $row;
//            } else {
//                $cur_product_det_params = Set::combine($product_det['ProductDetParam'],
//                        '{n}.ProductDetParam.product_param_id',
//                        '{n}.ProductDetParam.product_det_param_value_id');
//                $comboboxes_value = array();
//                foreach($product['comboboxes'] as $combobox) {
//                    $comboboxes_value[] = array(
//                        'product_param_id' => $combobox['product_param_id'],
//                        'value' => $cur_product_det_params[$combobox['product_param_id']]
//                    );
//                }
//
//                $table_key = -1;
//                if(empty($product['tables'])) {
//                    $product['tables'] = array();
//                }
//                $tables =& $product['tables'];
//                foreach($tables as $cur_table_key => $cur_table) {
//                    if($cur_table['comboboxes_value'] == $comboboxes_value) {
//                        $table_key = $cur_table_key;
//                        break;
//                    }
//                }
//
//                if($table_key == -1) {
//                    $table = array(
//                        'product_id' => $product_id,
//                        'rows' => array()
//                    );
//                    $tables[] = array(
//                        'comboboxes_value' => $comboboxes_value,
//                        'table' => $table
//                    );
//                    $table_key = count($tables)-1;
//                }
//
//                $row = array(
//                    'product_det_id' => $product_det_id,
//                    'cells' => array()
//                );
//                $comboboxes_value = Set::combine($comboboxes_value, '{n}.product_param_id', '{n}');
//                foreach($product_params as $product_param_id => $product_param) {
//                    if(empty($product_det['ProductDetParam'][$product_param_id])) continue;
//                    $product_det_param = $product_det['ProductDetParam'][$product_param_id];
//
//                    if(!empty($comboboxes_value[$product_param_id])) {
//                        continue;
//                    }
//
//                    $cell = array(
//                        'product_param_id' => $product_param_id,
//                        'value' => $product_det_param['ProductDetParam']['value']
//                    );
//
//                    $row['cells'][] = $cell;
//                }
//
//                $this->array_insert($row['cells'], 0, array(
//                    '0' => array(
//                        'product_param_id' => -1,
//                        'value' => '<input type="radio" name="radio_'.$product_id.'">'
//                    )
//                ));
//
//                if($product_det['ProductDet']['cnt'] > 0) {
//                    $row['cells'][] = array(
//                        'product_param_id' => -1,
//                        'value' => '<span class="product-table-price">'.
//                                   number_format($product_det['ProductDet']['price'], 2, '.', '').
//                                   ' руб.'.
//                                   '</span>'
//                    );
//                } else {
//                    $row['cells'][] = array(
//                        'product_param_id' => -1,
//                        'value' => '<span class="product-table-price">'.
//                                   'под заказ'.
//                                   '</span>'
//                    );
//                }
//                $tables[$table_key]['table']['rows'][] = $row;
//            }
//        }
//
//        /*repair image*/
//        foreach($products as &$product) {
//            if(empty($product['ProductDet'])) continue;
//            foreach($product['ProductDet'] as &$product_det) {
//                if(empty($product_det['ProductDet']['small_image_id']))
//                    $product_det['SmallImage']['url'] = $product['SmallImage']['url'];
//                if(empty($product_det['ProductDet']['big_image_id']))
//                    $product_det['BigImage']['url'] = $product['BigImage']['url'];
//                if(empty($product_det['ProductDet']['short_about']))
//                    $product_det['ProductDet']['short_about'] = $product['Product']['short_about'];
//                if(empty($product_det['ProductDet']['long_about']))
//                    $product_det['ProductDet']['long_about'] = $product['Product']['long_about'];
//            }
//        }
////        debug($products);die;
//    }
//
//    function array_insert (&$array, $position, $insert_array) {
//        $first_array = array_splice ($array, 0, $position);
//        $array = array_merge ($first_array, $insert_array, $array);
//    }
//
//    function PrepareProductDet($products_id) {
//        $this->ProductDet =& new ProductDet();
//        $this->ProductParam =& new ProductParam();
//        $this->ProductDetParam =& new ProductDetParam();
//
//        /*product det*/
//        /**********************************************************************/
//        $this->ProductDet->unbindModel(array(
//            'belongsTo' => array(
//                'Product'
//            ),
//            'hasAndBelongsToMany' => array(
//                'ProductParam'
//            )
//        ));
//        $product_dets = $this->ProductDet->find('all', array(
//            'conditions' => array(
//                'ProductDet.product_id' => $products_id
//            )
//        ));
//        //$this->Common->repairImage($product_dets);
//        $product_dets = Set::combine($product_dets, '{n}.ProductDet.id', '{n}');
//        /**********************************************************************/
//
//        /*product param*/
//        /**********************************************************************/
//        $this->ProductParam->unbindModel(array(
//            'belongsTo' => array(
//                'Product'
//            ),
//            'hasAndBelongsToMany' => array(
//                'ProductDet'
//            )
//        ));
//        $product_params = $this->ProductParam->find('all', array(
//            'conditions' => array(
//                'ProductParam.product_id' => $products_id
//            )
//        ));
//        $product_params = Set::combine($product_params, '{n}.ProductParam.id', '{n}');
//        /**********************************************************************/
//
//        /*product det param*/
//        /**********************************************************************/
//        $this->ProductDetParam->unbindModel(array(
//            'belongsTo' => array(
//                'ProductParam',
//                'ProductDet'
//            )
//        ));
//        $product_det_params = $this->ProductDetParam->find('all', array(
//            'conditions' => array(
//                'ProductDetParam.product_det_id' =>
//                    Set::classicExtract($product_dets, '{n}.ProductDet.id'),
//                'ProductDetParam.product_param_id' =>
//                    Set::classicExtract($product_params, '{n}.ProductParam.id')
//            )
//        ));
//        $product_det_params = Set::combine($product_det_params, '{n}.ProductDetParam.id', '{n}');
//        /**********************************************************************/
//
//        /*prepare product det and product param*/
//        /**********************************************************************/
//        foreach($product_det_params as $product_det_param_id => $product_det_param) {
//            $product_param_id = $product_det_param['ProductDetParam']['product_param_id'];
//
//            $product_det_id = $product_det_param['ProductDetParam']['product_det_id'];
//            $product_dets[$product_det_id]['ProductDetParam'][$product_param_id] =
//                $product_det_param;
//
//            $product_param_id = $product_det_param['ProductDetParam']['product_param_id'];
//            $product_params[$product_param_id]['ProductDetParam'][$product_det_param_id] =
//                $product_det_param;
//        }
//        /**********************************************************************/
//
//        return array(
//            'product_dets' => $product_dets,
//            'product_params' => $product_params,
//            'product_det_params' => $product_det_params
//        );
//    }
}

?>
