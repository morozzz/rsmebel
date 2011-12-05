
<?php

    echo "<table id =\"catalogs-razdel-table\">";
    echo "<tr> <td> КАТАЛОГ ТОРГОВОГО ОБОРУДОВАНИЯ </td> </tr>";
    echo "</table>";
    echo "<table id=\"catalogs-index-table\"><tr>";
    echo "<td id=\"catalogs-show-path-tree\">";
    foreach($path_tree as $id => $path_node) {
        if($path_node['level'] == 2) continue;
        $path_node_link = array(
            'controller' => 'catalogs',
            'action' => 'show',
            $id
        );

        echo $html->div(
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

    echo "<td id=\"catalogs-index-catalogs\">";
    echo "<table cellspacing=\"0\" id=\"catalogs-index-catalogs-table\">";
        $count_in_row = 0;
        foreach($path_tree as $id => $path_node) {
            $path_node_link = array(
                'controller' => 'catalogs',
                'action' => 'show',
                $id
            );

            if($path_node['level'] == 0) {
                echo "<tr><td colspan=4 class=\"catalogs-index-catalog-caption\">";
                echo $html->link($path_node['Catalog']['name'], $path_node_link);
                echo "</td></tr>";
                $count_in_row = 0;
            } else if($path_node['level'] == 1) {
                if($count_in_row == 0) {
                    echo "<tr><td width=5px></td>";
                }
                echo "<td class=\"catalogs-index-catalog-body\">";
                echo "<li>".$html->link(
                        $path_node['Catalog']['name']."<br>".
                        ((!empty($path_node['SmallImage']['url']))?
                                $html->image($path_node['SmallImage']['url']):
                                $html->image('nopic.gif')),
                    $path_node_link, null, null, false);
                echo "</td>";
                $count_in_row++;
                if($count_in_row==3) {
                    $count_in_row = 0;
                    echo "</td>";
                }
            }
        }
    echo "</table>";
    echo "</td>";

    echo "</tr></table>";

?>