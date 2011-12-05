
<?php

    echo "<table id =\"catalogs-razdel-table\">";
    echo "<tr> <td> КАТАЛОГ ТОРГОВОГО ОБОРУДОВАНИЯ </td> </tr>";
    echo "</table>";
    echo "<table id=\"catalogs-index-table\"><tr>";
    echo "<table><tr>";
    echo "<td id=\"catalogs-show-path-tree\">";
    $show_level_2 = false;
    foreach($path_tree as $id => $path_node) {
        if($path_node['level'] == 1) {
            $show_level_2 = $path_node['show_sub_level'];
        }
        if($path_node['level'] == 2 and !$show_level_2) continue;

        $path_node_link = array(
            'controller' => 'catalogs',
            'action' => 'show',
            $id
        );

        echo $html->div(
                (($catalog['Catalog']['id'] == $id)?'catalogs-show-path-tree-node-selected ':'').
                    'catalogs-show-path-tree-node catalogs-show-path-tree-node-'.
                    $path_node['level'],
                (($path_node['level']==2)?'<li>':'').
                $html->link($path_node['Catalog']['name'], $path_node_link));
        if($path_node['level'] == 0) {
            echo $html->image($path_node['SmallImage']['url'], array(
                'class' => 'catalogs-show-path-tree-node-0-image',
                'url' => $path_node_link
            ));
        }
    }
    echo "</td>";

    echo "<td id=\"catalogs-show-catalogs\">";
    $path_str = '';
    for($i=0; $i<count($path); $i++) {
        $path_str .= $html->link($path[$i]['Catalog']['name'] . ' >> ', array(
            'controller' => 'catalogs',
            'action' => 'show',
            $path[$i]['Catalog']['id']
        ));
    }
    echo $html->div('catalogs-show-path', $path_str);
    
    echo $html->div('', $catalog['Catalog']['name'], array(
        'id' => 'catalogs-show-catalogs-catalog-caption'
    ));
    foreach($childs as $child) {
        $link_to_child = array(
            'controller' => 'catalogs',
            'action' => 'show',
            $child['Catalog']['id']
        );
        echo $html->div('catalogs-show-catalogs-child-caption',
                '<li>'.$html->link($child['Catalog']['name'], $link_to_child));
        echo "<table class = \"catalogs-show-catalogs-child-image-about\"><tr>";
        echo "<td class = \"catalogs-show-catalogs-child-image\">";
        if(empty($child['SmallImage']['url'])) {
            echo $html->image('nopic.gif', array(
                'url' => $link_to_child
            ));
        } else {
            echo $html->image($child['SmallImage']['url'], array(
                'url' => $link_to_child
            ));
        }
        echo $html->div('catalogs-show-catalogs-childs-image-link',
                $html->link('модельный ряд', $link_to_child));
        echo "</td><td class = \"catalogs-show-catalogs-child-about\">";
        echo $child['Catalog']['short_about'];
        echo "</td>";
        echo "</tr></table>";
    }
    echo "</td>";

    echo "</tr></table>";
?>