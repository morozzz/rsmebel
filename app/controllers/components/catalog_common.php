<?php

class CatalogCommonComponent extends Object {
    function GetCatalogTree($show_private = true) {
        $this->Catalog =& new Catalog();
        
        $this->Catalog->unbindModel(array(
            'hasMany' => array('Product'),
            'belongsTo' => array(
                'BigImage'
            )
        ));

        if($show_private)
            $catalog_tree = $this->Catalog->generatetreelist(null, null, null,'', 1, array('SmallImage.url'));
        else
            $catalog_tree = $this->Catalog->generatetreelist(
                    array('Catalog.catalog_type_id' => 1), null, null,'', 1, array('SmallImage.url'));
        
        $last_node = null;
        $last_node_id = null;
        foreach($catalog_tree as $id=>$node) {
            $catalog_tree[$id]['hasChild'] = 0;
            $catalog_tree[$id]['finishBlock'] = 0;

            if($last_node == null) {
                $last_node = $node;
                $last_node_id = $id;
                continue;
            }

            if($node['level'] > $last_node['level']) {
                $catalog_tree[$last_node_id]['hasChild'] = 1;
            }
            if($node['level'] < $last_node['level']) {
                $catalog_tree[$last_node_id]['finishBlock'] = $last_node['level'] - $node['level'];
            }

            $last_node = $node;
            $last_node_id = $id;
        }
        $catalog_tree[$last_node_id]['finishBlock'] = $last_node['level'];

        return $catalog_tree;
    }
}

?>
