<?php

class ProductDet extends AppModel {
    var $name = 'ProductDet';
    var $actsAs = array(
        'Image' => array(
            'images' => array(
                'small_image_id' => 'SmallImage',
                'big_image_id' => 'BigImage'
            ),
            'image_type_id' => 7
        ),
        'Code1c',
        'SortOrder',
        'Special'
    );
    var $belongsTo = array(
        'Product',
        'SmallImage' => array(
            'className' => 'Image',
            'foreignKey' => 'small_image_id'
        ),
        'BigImage' => array(
            'className' => 'Image',
            'foreignKey' => 'big_image_id'
        ),
        'Producer'
    );
    var $hasMany = array(
        'ProductDetParam'
    );
    var $hasAndBelongsToMany = array(
        'ProductParam' => array(
            'className' => 'ProductParam',
            'with' => 'ProductDetParam',
            'order' => 'ProductParam.sort_order',
            'unique' => true
        )
    );
    var $hasOne = array(
        'Special'
    );
    var $caches = array(
        'all_catalogs'
    );
    var $order = 'ProductDet.sort_order';

    var $field_types = array(
        'product_id' => 'number',
        'article' => 'text',
        'fix_price' => 'number',
        'fix_cnt' => 'number',
        'price' => 'number',
        'cnt' => 'number',
        'sort_order' => 'number',
        'code_1c' => 'text',
        'short_about' => 'text',
        'long_about' => 'text',
        'producer_id' => 'number',
        'ProductDetParam' => 'array',
        'SmallImage' => 'file',
        'BigImage' => 'file'
    );

    function beforeSave() {
        if(!empty($this->data['ProductDet']['ProductDetParam'])) {
            $this->CommonData = array();
            $this->CommonData['ProductDetParam'] = $this->data['ProductDet']['ProductDetParam'];
            unset($this->data['ProductDet']['ProductDetParam']);
        }

        return true;
    }

    function afterSave($created) {
        $product_det = $this->find('first', array(
            'conditions' => array(
                'ProductDet.id' => $this->id
            ),
            'contain' => array()
        ));
        $product_det_id = $product_det['ProductDet']['id'];
        $product_id = $product_det['ProductDet']['product_id'];

        $product_params = $this->ProductParam->find('all', array(
            'conditions' => array(
                'ProductParam.product_id' => $product_id
            ),
            'contain' => array()
        ));
        foreach($product_params as $product_param) {
            $product_param_id = $product_param['ProductParam']['id'];
            
            if(empty($this->CommonData['ProductDetParam'][$product_param_id]) &&
                    !$created) continue;

            $value = "";
            if(!empty($this->CommonData['ProductDetParam'][$product_param_id]))
                    $value = $this->CommonData['ProductDetParam'][$product_param_id];

            $this->ProductDetParam->save(array(
                'product_det_id' => $product_det_id,
                'product_param_id' => $product_param_id,
                'value' => $value
            ));
        }
    }

    function beforeDelete() {
        $product_det_params = $this->ProductDetParam->find('all', array(
            'conditions' => array(
                'ProductDetParam.product_det_id' => $this->id
            ),
            'contain' => array()
        ));
        foreach($product_det_params as $product_det_param) {
            $this->ProductDetParam->delete(
                    $product_det_param['ProductDetParam']['id'], false);
        }

        $specials = $this->Special->find('all', array(
            'conditions' => array(
                'Special.product_det_id' => $this->id
            ),
            'contain' => array()
        ));
        foreach($specials as $special) {
            $this->Special->delete(
                    $special['Special']['id'], false);
        }

        return parent::beforeDelete();
    }

    function move_to_product($product_det_id, $catalog_id) {
        $min_sort_order = $this->Product->getMinSortOrder(array(
            'Product.catalog_id' => $catalog_id
        ));

        $product_det = $this->find('first', array(
            'conditions' => array(
                'ProductDet.id' => $product_det_id
            ),
            'contain' => array(
                'Special'
            )
        ));

        $this->Behaviors->detach('Image');
        $this->delete($product_det_id, false);

        if(empty($product_det['ProductDet']['name'])) {
            $product_det['ProductDet']['name'] = "Детализация №$product_det_id";
        }
        $data = array(
            'catalog_id' => $catalog_id,
            'sort_order' => $min_sort_order-1,
            'code_1c' => $product_det['ProductDet']['code_1c'],
            'name' => $product_det['ProductDet']['name'],
            'name_1c' => $product_det['ProductDet']['name_1c'],
            'short_about' => $product_det['ProductDet']['short_about'],
            'long_about' => $product_det['ProductDet']['long_about'],
            'price' => $product_det['ProductDet']['price'],
            'cnt' => $product_det['ProductDet']['cnt'],
            'article' => $product_det['ProductDet']['article'],
            'small_image_id' => $product_det['ProductDet']['small_image_id'],
            'big_image_id' => $product_det['ProductDet']['big_image_id'],
            'producer_id' => $product_det['ProductDet']['producer_id']
        );
        $this->Product->create();
        $this->Product->save($data);

        //перенаправляем спецпредложения
        if(!empty($product_det['Special']['id'])) {
            $data = array(
                'id' => $product_det['Special']['id'],
                'product_det_id' => null,
                'product_id' => $this->Product->id
            );
            $this->Special->id = $product_det['Special']['id'];
            $this->Special->save($data);
        }
    }

    function getPathLink($product_det_id, $product_det_action='index',
            $product_action='index', $catalog_action='index') {
        if(empty($product_det_id)) return null;
        $product_det = $this->find('first', array(
            'conditions' => array(
                'ProductDet.id' => $product_det_id
            ),
            'contain' => array()
        ));

        $path_links = $this->Product->getPathLink($product_det['ProductDet']['product_id'],
                $product_action, $catalog_action);
        $path_links = array_merge($path_links, array(
            'product_det' => array(
                'name' => 'детализация №'.$product_det_id,
                'url' => '/product_dets/'.$product_det_action.'/'.$product_det_id
            )
        ));
        return $path_links;
    }
}

?>
