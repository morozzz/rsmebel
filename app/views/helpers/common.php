<?php

class CommonHelper extends AppHelper {
    var $helpers = array(
        'Html',
        'Form'
    );

    function getWordEnd($cnt) {
        if($cnt%100>=11 && $cnt%100<=19) {
            return 'й';
        } else if($cnt%10==1) {
            return 'е';
        } else if($cnt%10>=2 && $cnt%10<=4) {
            return 'я';
        } else {
            return 'й';
        }
    }

    function getPathStr($links) {
        if(empty($links)) return "";
        $str = "";
        foreach($links as &$link) {
            $link = $this->Html->link($link['name'], $link['url']);
        }
        return implode(" >> ", $links);
    }

    function paginate_table($paginator, $model_name, $page_count = array(
        6 => '6',
        10 => '10',
        20 => '20',
        30 => '30'
    )) {
        $params = array_merge($this->params['pass'], $this->params['named']);
        unset($params['limit']);
        unset($params['page']);
        $paginator->options(array('url' => $params));
        if(empty($paginator->options['url'])) $paginator->options['url'] = array();
        $count = $paginator->params['paging'][$model_name]['count'];
        $limit = $paginator->params['paging'][$model_name]['options']['limit'];
        $str = "";

        $str .= "<table class='pagination' width='100%'><tbody><tr>";

        $str .= "<td class='pagination-count' width='34%'>";
        $str .= $paginator->counter('Всего %count% '.
                $paginator->link('(Показать все)', array(
                    'limit' => $count,
                    'page' => 1
                ), array(
                    'rel' => 'canonical',
                    'escape' => false
                )).', показано с %start% по %end%');
        $str .= "</td>";

        $str .= "<td class='pagination-prev' width='13%'>";
        $str .= $paginator->prev("<<< Назад", array(
            'rel' => 'prev'
        ));
        $str .= "</td>";

        $str .= "<td class='pagination-pages' width='20%'>";
        $str .= $paginator->numbers(array(
            'before' => 'Страницы ',
            'modulus' => 0,
            'separator' => ' '
        ));
        $str .= "</td>";

        $str .= "<td class='pagination-next' width='13%'>";
        $str .= $paginator->next("Вперед >>>", array(
            'rel' => 'next'
        ));
        $str .= "</td>";
        $str .= "<td class='pagination-limit' width='20%'>";
        $str .= "Количество на странице ";
        $page_count[$count] = 'Все';
        $str .= $this->Form->select('', $page_count, $limit, array(
            'class' => 'pagination-limit-select',
            'base_url' => $paginator->url(array_merge((array)$paginator->options['url'], array('limit' => null, 'page' => null)))
        ), false);
        $str .= "</td>";

        $str .= "</tr></tbody></table>";
        return $str;
    }

    function caption($text, $h='h1') {
        $str = "";
        $str .= "<div class='div-header'>";
//        $str .= "<div class='div-header-left'></div>";
        $str .= "<div class='div-header-center'>";
        $str .= "<$h class='header'><span class='text-shadow'>$text</span></$h>";
        $str .= "</div>";
//        $str .= "<div class='div-header-right'></div>";
        $str .= "</div>";
        return $str;
    }
}

?>
