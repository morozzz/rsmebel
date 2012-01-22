<?php

class Product extends AppModel {
    var $name = 'Product';
    var $actsAs = array(
        'Image' => array(
            'images' => array(
                'small_image_id' => 'SmallImage',
                'big_image_id' => 'BigImage'
            ),
            'image_type_id' => 7
        ),
        'SortOrder',
        'Code1c'
    );
    var $belongsTo = array(
        'Catalog',
        'SmallImage' => array(
            'className' => 'Image',
            'foreignKey' => 'small_image_id'
        ),
        'BigImage' => array(
            'className' => 'Image',
            'foreignKey' => 'big_image_id'
        )
    );
    var $hasOne = array(
        'Special'
    );
    var $hasMany = array(
        'ProductDet' => array(
            'order' => 'ProductDet.sort_order'
        ),
        'ProductImage' => array(
            'order' => 'ProductImage.sort_order'
        )
    );
    var $order = 'Product.sort_order';
    var $caches = array(
        'catalogs',
        'catalog_list',
        'specials',
        'all_catalogs'
    );

    var $field_types = array(
        'name' => 'text',
        'eng_name' => 'text',
        'catalog_id' => 'number',
        'about' => 'text',
        'sort_order' => 'number',
        'article' => 'number',
        'fix_price' => 'number',
        'fix_cnt' => 'number',
        'price' => 'number',
        'opt_price' => 'number',
        'cnt' => 'number',
        'SmallImage' => 'file',
        'BigImage' => 'file'
    );

    function beforeSave() {
        return true;
    }

    function beforeDelete() {
        //если товар не в корзине - не удаляем его, а переносим в корзину
        $finallDelete = false;
        if(isset($this->finallDelete)) $finallDelete = $this->finallDelete;

        if(!$finallDelete) {
            $product = $this->find('first', array(
                'conditions' => array(
                    'Product.id' => $this->id
                ),
                'contain' => array(
                    'Catalog'
                )
            ));

            if($product['Catalog']['catalog_type_id'] == 5)
                $finallDelete = true;
        }

        if(!$finallDelete) {
            //удаляем связанные спецпредложения
            $specials = $this->Special->find('all', array(
                'conditions' => array(
                    'Special.product_id' => $this->id
                ),
                'contain' => array()
            ));
            foreach($specials as $special) {
                $this->Special->delete(
                        $special['Special']['id'], false);
            }

            $recycle = $this->Catalog->find('first', array(
                'conditions' => array(
                    'Catalog.catalog_type_id' => 5
                ),
                'contain' => array()
            ));
            $this->changeCatalog($recycle['Catalog']['id']);
            return false;
        }

        //удаляем связанные строки
        $product_dets = $this->ProductDet->find('all', array(
            'conditions' => array(
                'ProductDet.product_id' => $this->id
            ),
            'contain' => array()
        ));
        foreach($product_dets as $product_det) {
            $this->ProductDet->delete(
                    $product_det['ProductDet']['id'], false);
        }

        //удаляем связанные столбцы
//        $product_params = $this->ProductParam->find('all', array(
//            'conditions' => array(
//                'ProductParam.product_id' => $this->id
//            ),
//            'contain' => array()
//        ));
//        foreach($product_params as $product_param) {
//            $this->ProductParam->delete(
//                    $product_param['ProductParam']['id'], false);
//        }

        //удаляем связанные спецпредложения
        $specials = $this->Special->find('all', array(
            'conditions' => array(
                'Special.product_id' => $this->id
            ),
            'contain' => array()
        ));
        foreach($specials as $special) {
            $this->Special->delete(
                    $special['Special']['id'], false);
        }

        return parent::beforeDelete();
    }

    function changeCatalog($catalog_id) {
        $min_sort_order = $this->getMinSortOrder(array(
            'Product.catalog_id' => $catalog_id
        ));
        $data = array(
            'id' => $this->id,
            'catalog_id' => $catalog_id,
            'sort_order' => $min_sort_order-1
        );
        $this->save($data);
    }

    function move_to_param($moving_product_id, $product_id) {
        $product_to_move = $this->find('first', array(
            'conditions' => array(
                'Product.id' => $moving_product_id
            ),
            'contain' => array(
                'Special'
            )
        ));
        $min_sort_order = $this->ProductDet->getMinSortOrder(array(
            'ProductDet.product_id' => $product_id
        ));

        $data = array(
            'product_id' => $product_id,
            'article' => $product_to_move['Product']['article'],
            'code_1c' => $product_to_move['Product']['code_1c'],
            'name' => $product_to_move['Product']['name'],
            'name_1c' => $product_to_move['Product']['name_1c'],
            'price' => $product_to_move['Product']['price'],
            'cnt' => $product_to_move['Product']['cnt'],
            'sort_order' => $min_sort_order-1,
            'short_about' => $product_to_move['Product']['short_about'],
            'long_about' => $product_to_move['Product']['long_about'],
            'small_image_id' => $product_to_move['Product']['small_image_id'],
            'big_image_id' => $product_to_move['Product']['big_image_id']
        );
        $this->ProductDet->create();
        $this->ProductDet->save($data);
        $product_det_id = $this->ProductDet->id;

        //перенаправляем спецпредложения
        if(!empty($product_to_move['Special']['id'])) {
            $data = array(
                'id' => $product_to_move['Special']['id'],
                'product_id' => null,
                'product_det_id' => $product_det_id
            );
            $this->Special->id = $product_to_move['Special']['id'];
            $this->Special->save($data);
        }

        $this->Behaviors->detach('Image');
        $this->finallDelete = true;
        $this->delete($moving_product_id);

        return $product_det_id;
    }
    
    //получение товара по ID (с использованием кэша)
    function get_product_by_id($product_id, $contain = array()) {
        if(($product = Cache::read("product_$product_id")) === false) {
            $product = $this->find('first', array(
                'conditions' => array(
                    'Product.id' => $product_id
                ),
                'contain' => $contain
            ));
            
            if(($product_log = Cache::read('product_log'))===false) {
                $product_log = array("product_$product_id");
            } else {
                $product_log[] = "product_$product_id";
            }
            Cache::write('product_log', $product_log);
            Cache::write("product_$product_id", $product);
        }
        return $product;
    }
    
    //возвращает текст ссылки на товар
    function get_url($product_id) {
        $product = $this->get_product_by_id($product_id);
        $catalog_url = $this->Catalog->get_url(null, $product['Product']['catalog_id']);
        return "$catalog_url/{$product['Product']['eng_name']}";
    }

    //возвращает массив хлебных крошек товара
    function get_breadcrumb($product_id) {
        $product = $this->get_product_by_id($product_id);
        $catalog_breadcrumbs = $this->Catalog->get_breadcrumb(null, $product['Product']['catalog_id']);
        $catalogs = $this->Catalog->get_parents(null, $product['Product']['catalog_id']);
        $catalogs = Set::combine($catalogs, '{n}.Catalog.id', '{n}.Catalog.eng_name');
        $product_breadcrumbs = array(
            array(
                'label' => $product['Product']['name'],
                'url' => array(
                    'controller' => 'products',
                    'action' => 'index',
                    implode('/', $catalogs).'/'.$product['Product']['eng_name']
                )
            )
        );
        return array_merge($catalog_breadcrumbs,$product_breadcrumbs);
    }

    function getPathLink($product_id, $product_action='index', $catalog_action='index') {
        if(empty($product_id)) return null;
        $product = $this->find('first', array(
            'conditions' => array(
                'Product.id' => $product_id
            ),
            'Contain' => array()
        ));

        $path_links = $this->Catalog->getPathLink($product['Product']['catalog_id'], $catalog_action);

        if($product_action != 'admin') {
            $path_links = array_merge($path_links, array(
                'product' => array(
                    'name' => $product['Product']['name'],
                    'url' => '/products/'.$product_action.'/'.$product['Product']['id']
                )
            ));
        } else {
            $path_links = array_merge($path_links, array(
                'det' => array(
                    'name' => $product['Product']['name']." (строки)",
                    'url' => '/product_dets/index/'.$product['Product']['id']
                ),
                'param' => array(
                    'name' => $product['Product']['name']." (столбцы)",
                    'url' => '/product_params/index/'.$product['Product']['id']
                )
            ));
        }
        return $path_links;
    }
}

?>
