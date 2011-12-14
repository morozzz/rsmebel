<?php

class PageController extends AppController {
    var $name = 'Page';
    
    var $uses = array();

    function isAuthorized() {
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('get_menus');
    }
    
    function get_menus() {
        $menus = array(
            array(
                'name' => 'main',
                'label' => 'Главная',
                'url' => '/'
            ),
            array(
                'name' => 'company',
                'label' => 'Компания',
                'url' => array(
                    'controller' => 'company_infos',
                    'action' => 'index'
                )
            ),
            array(
                'name' => 'catalog',
                'label' => 'Каталог',
                'url' => array(
                    'controller' => 'catalogs',
                    'action' => 'index'
                )
            ),
            array(
                'name' => 'partners',
                'label' => 'Партнеры',
                'url' => '#'
            ),
            array(
                'name' => 'quest',
                'label' => 'Гостевая',
                'url' => '#'
            )
        );
        if(isset($this->params['requested'])) {
            return $menus;
        } else {
            $this->set('menus', $menus);
        }
    }
}

?>
