<?php

class Catalog extends AppModel {
    var $name = 'Catalog';
    var $actsAs = array(
        'Image' => array(
            'images' => array(
                'small_image_id' => 'SmallImage',
                'big_image_id' => 'BigImage'
            )
        ),
        'SortOrder',
        'AdvancedTree',
        'Code1c'
    );
    var $hasMany = array(
        'Product' => array(
            'order' => 'Product.sort_order'
        )
    );
    var $belongsTo = array(
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
    var $order = 'Catalog.lft';
    var $caches = array(
        'catalogs',
        'catalog_list',
        'specials',
        'all_catalogs'
    );

    var $field_types = array(
        'name' => 'text',
        'eng_name' => 'text',
        'parent_id' => 'number',
        'producer_id' => 'number',
        'sort_order' => 'number',
        'short_about' => 'text',
        'long_about' => 'text',
        'SmallImage' => 'file',
        'BigImage' => 'file'
    );

    function get_list() {
        if(($catalog_list = Cache::read('catalog_list')) === false) {
            $catalogs = $this->generatetreelist(null, null, null,'', 1);
            $catalog_list = array();
            $catalog_list[0] = array(
                'value' => 0,
                'name' => 'Корень',
                'class' => 'option-0'
            );
            foreach($catalogs as $catalog_id => $catalog) {
                $catalog_list[$catalog_id] = array(
                    'value' => $catalog_id,
                    'name' => $catalog['Catalog']['name'],
                    'class' => 'option-'.($catalog['level']+1)
                );
            }
            Cache::write('catalog_list', $catalog_list);
        }
        return $catalog_list;
    }

    function beforeSave() {
        return true;
    }

    function afterAllSave($data) {
        $need_reorder = false;
        $catalog_id = null;
        foreach($data as $id => $row) {
            if(isset($row['sort_order'])) {
                $need_reorder = true;
                $catalog_id = $id;
                break;
            }
        }
        if($need_reorder) {
            $this->id = $catalog_id;
            $parent_id = $this->field('parent_id');
            $this->id = $parent_id;
            set_time_limit(600);
            $this->reorder(array(
                'id' => $parent_id,
                'field' => 'sort_order'
            ));
        }
    }

    function beforeDelete() {
        //если каталог не в корзине - не удаляем его, а переносим в корзину
        $catalog_id = $this->id;
        $catalog = $this->find('first', array(
            'conditions' => array(
                'Catalog.id' => $catalog_id
            ),
            'contain' => array()
        ));
        $recycle = $this->find('first', array(
            'conditions' => array(
                'Catalog.catalog_type_id' => 4
            ),
            'contain' => array()
        ));
        if($catalog['Catalog']['parent_id'] != $recycle['Catalog']['id']) {
            $this->changeCatalog($recycle['Catalog']['id']);
            return false;
        }

        //получаем текущий и дочерние каталоги
        $catalogs = $this->find('all', array(
            'conditions' => array(
                'Catalog.lft >= ' => $catalog['Catalog']['lft'],
                'Catalog.rght <= ' => $catalog['Catalog']['rght']
            ),
            'contain' => array()
        ));
        $catalogs_id = Set::combine($catalogs, '{n}.Catalog.id', '{n}.Catalog.id');

        //удаляем связанные товары
        $products = $this->Product->find('all', array(
            'conditions' => array(
                'Product.catalog_id' => $catalogs_id
            ),
            'contain' => array()
        ));
        foreach($products as $product) {
            $this->Product->delete($product['Product']['id'], false);
        }

        return parent::beforeDelete();
    }

    function changeCatalog($parent_id) {
        $catalog_id = $this->id;

        //родитель
        $parent = $this->find('first', array(
            'conditions' => array(
                'Catalog.id' => $parent_id
            ),
            'contain' => array()
        ));
        //каталог
        $catalog = $this->find('first', array(
            'conditions' => array(
                'Catalog.id' => $catalog_id
            ),
            'contain' => array()
        ));

        //каталог со своими потомками
        $catalogs = $this->find('all', array(
            'conditions' => array(
                'Catalog.lft >=' => $catalog['Catalog']['lft'],
                'Catalog.rght <=' => $catalog['Catalog']['rght']
            ),
            'contain' => array()
        ));
        
        //обновляем тип каталога
        $catalogs_id = Set::combine($catalogs, '{n}.Catalog.id', '{n}.Catalog.id');
        $this->updateAll(array(
            'Catalog.catalog_type_id' => $parent['Catalog']['catalog_type_id']
        ), array(
            'Catalog.id' => $catalogs_id
        ));

        //переносим каталог
        $min_sort_order = $this->getMinSortOrder(array(
            'Catalog.parent_id' => $parent_id
        ));
        $data = array(
            'id' => $catalog_id,
            'parent_id' => $parent_id,
            'sort_order' => $min_sort_order-1
        );
        $this->save($data);

        //пересортируем родителя
        set_time_limit(600);
        $this->reorder(array(
            'id' => $parent_id,
            'field' => 'sort_order'
        ));
    }
    
    //получение списка родителей каталога (с использование кэша)
    function get_parents($catalog = null, $catalog_id = null) {
        if(!empty($catalog)) $catalog_id = $catalog['Catalog']['id'];
        if(($catalogs = Cache::read("catalog_parents_$catalog_id")) === false) {
            if(empty($catalog)) {
                $catalog = $this->find('first', array(
                    'conditions' => array('Catalog.id' => $catalog_id),
                    'contain' => array()
                ));
            }
            $catalogs = $this->find('all', array(
                'conditions' => array(
                    'Catalog.lft <= ' => $catalog['Catalog']['lft'],
                    'Catalog.rght >= ' => $catalog['Catalog']['rght']
                ),
                'order' => 'Catalog.lft'
            ));
            
            if(($catalog_parents_log = Cache::read('catalog_parents_log'))===false) {
                $catalog_parents_log = array("catalog_parents_$catalog_id");
            } else {
                $catalog_parents_log[] = "catalog_parents_$catalog_id";
            }
            Cache::write('catalog_parents_log', $catalog_parents_log);
            Cache::write("catalog_parents_$catalog_id", $catalogs);
        }
        return $catalogs;
    }
    
    //возвращает текст ссылки на каталог
    function get_url($catalog = null, $catalog_id = null) {
        $catalogs = $this->get_parents($catalog, $catalog_id);
        
        $url = array();
        foreach($catalogs as $catalog) {
            $url[] = $catalog['Catalog']['eng_name'];
        }
        return implode('/',$url);
    }

    //возвращает массив хлебных крошек каталога
    function get_breadcrumb($catalog = null, $catalog_id = null) {
        $catalogs = $this->get_parents($catalog, $catalog_id);
        
        $breadcrumbs = array();
        $breadcrumb_url = array();
        foreach($catalogs as $catalog) {
            $breadcrumb_str[] = $catalog['Catalog']['eng_name'];
            $breadcrumbs[] = array(
                'label' => $catalog['Catalog']['name'],
                'url' => array(
                    'controller' => 'catalogs',
                    'action' => 'index',
                    implode('/',$breadcrumb_str)
                )
            );
        }
        
        return $breadcrumbs;
    }
}

?>
