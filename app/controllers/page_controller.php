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
        $this->Auth2->allow('main');
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
                'url' => array(
                    'controller' => 'partners',
                    'action' => 'index'
                )
            ),
            array(
                'name' => 'guestbook',
                'label' => 'Гостевая',
                'url' => array(
                    'controller' => 'guestbooks',
                    'action' => 'index'
                )
            )
        );
        if(isset($this->params['requested'])) {
            return $menus;
        } else {
            $this->set('menus', $menus);
        }
    }
    
    function main() {
        $this->pageTitle = 'РегионСибМебель. Магазин домашнего уюта';
        $this->set('current_menu_name', 'main');
//        debug($this->Session->read());
    }
}

?>
