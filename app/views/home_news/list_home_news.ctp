<?php
    echo $html->div('table-caption', 'Список статей на главной странице');

    echo $html->div('action',
            $html->link('Добавить статью', array(
                'controller' => 'home_news',
                'action' => 'add'
            ))
    );
    echo "<table class=\"data-table tree-table\" id=\"home_news-list-table\">";
    echo "<thead>";
    echo $html->tableHeaders(array(
        $html->div('home_news_header', 'Заголовок'),
        $html->div('home_news_header', 'Содержание статьи'),
        $html->div('home_news_header',  'Сортировка'),
        '', ''
    ));
    echo "</thead>";

    echo "<tbody>";
    foreach($home_news as $home_new) {

        echo $html->tableCells(array(
            $home_new['HomeNew']['news_header'],
            $home_new['HomeNew']['news_body'],

            $home_new['HomeNew']['priority'],

            $html->div('action',
                    $html->link('ред', array(
                        'controller' => 'home_news',
                        'action' => 'edit',
                        $home_new['HomeNew']['id']
                    ))
            ),
            $html->div('action',
                    $html->link('удал', array(
                        'controller' => 'home_news',
                        'action' => 'delete',
                        $home_new['HomeNew']['id']
                    ))
            )
            ));
    }
    echo "</tbody>";
    echo "</table>";

?>

<script type="text/javascript">
    enable_validation();
</script>