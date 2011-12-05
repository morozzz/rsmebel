<?php

class HomeNewsController extends AppController {
    var $name = 'HomeNews';
    var $uses = array("HomeNew", "Cnew", "Catalog", "Special", "Image", "Slide");

    var $helpers = array('Cache');
    var $cacheAction = array('index' => '1 week',
                             'list_home_news' => '1 week');
    var $commonCss = array();
    var $actionJs = array("jquery.cycle.min");

   // var $persistModel = true;

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('index');
        $this->Auth2->allow('cnews_box');
        $this->Auth2->allow('home_news_box');
        $this->Auth2->allow('specials_box');
    }

    function cnews_box() {

       if(($cnews = Cache::read('cnews_limit')) === false) {
          $cnews = $this->Cnew->find('all', array('limit' => 5, 'fields' => array('date_format(Cnew.stamp, "%d.%m.%Y") AS stamp',
                                                                                  'Cnew.id',
                                                                                  'Cnew.news_header',
                                                                                  'Cnew.news_body',
                                                                                  'Cnew.news_footer',
                                                                                  'Cnew.small_image_id',
                                                                                  'Cnew.big_image_id',
                                                                                  'SmallImage.url'),
                                                  'order' => array('Cnew.stamp DESC','sort_order')));

          Cache::write('cnews_limit', $cnews);
        }

          if (isset($this->params['requested'])) {
            return $cnews;
          } else {
            $this->set(compact('cnews'));
          }
    }

    function home_news_box() {

      if(($home_news = Cache::read('home_news')) === false) {
        $home_news = $this->HomeNew->find('all');
        Cache::write('home_news', $home_news);
      }

      if (isset($this->params['requested'])) {
        return $home_news;
      } else {
        $this->set(compact('home_news'));
      }
    }

    function specials_box() {

      //спецпредложения
      /***************************************************************/

        $specials;
      if(($specials = Cache::read('specials')) === false) {

          $specials = $this->Special->find('all', array(
              'conditions' => array(
                  array(
                      'or' => array(
                          'Special.date2 >= ' => date('Y.m.d'),
                          'Special.date2' => null
                      )
                  ),
                  array(
                      'or' => array(
                          'Special.date1 <= ' => date('Y.m.d'),
                          'Special.date1' => null
                      )
                  )
              )
          ));
          Cache::write('specials', $specials);
      }
          $specials5 = array();
          $spec_cnt = count($specials);
          if($spec_cnt>5) $spec_cnt = 5;
          for($i=0; $i<$spec_cnt; $i++) {
              $special = $specials[rand(0, $spec_cnt-1)];
              if(empty($specials5[$special['Special']['id']])) {
                  $specials5[$special['Special']['id']] = $special;
              } else {
                  $i--;
              }
          }
          $images_id = Set::combine($specials5, '{n}.Product.small_image_id', '{n}.Product.small_image_id');
          $images = $this->Image->find('all', array(
              'conditions' => array(
                  'Image.id' => $images_id
              )
          ));
          $images = Set::combine($images, '{n}.Image.id', '{n}.Image.url');
          foreach($specials5 as &$special) {
              if(empty($special['Product']['small_image_id'])) {
                  $special['SmallImage']['url'] = 'nopic.gif';
              } else {
                  $special['SmallImage']['url'] = $images[$special['Product']['small_image_id']];
              }
          }
      //$this->set('specials', $specials5);
      /***************************************************************/

          if (isset($this->params['requested'])) {
            return $specials5;
          } else {
            $this->set(compact('specials'));
          }
    }

	function index() {
      $this->pageTitle = "Торговое оборудование / Витрины, оборудование для магазинов, банкетки, рекламные стойки - Анжелика";

      /*слайдшоу*/
      /***************************************************************/
      if( ($slides = Cache::read('slideshow')) === false) {
          $slides = $this->Slide->find('all');
      }
      $this->set('slides', $slides);
      /***************************************************************/

      /*каталог посерединке*/
      /***************************************************************/
       if(($path_trees = Cache::read('path_trees')) === false) {

          $this->Catalog->unbindModel(array(
              'hasMany' => array('Product')
          ));
          $path_tree = $this->Catalog->generatetreelist(array(
              'Catalog.catalog_type_id' => 1
          ), null, null,'', 1,
              array(
                  'SmallImage.url'
              )
          );
          $last_node = null;
          $last_node_id = null;
          foreach($path_tree as $id=>$node) {
              if($node['level'] >= 2) {
                  unset($path_tree[$id]);
                  continue;
              }
              $path_tree[$id]['hasChild'] = 0;
              $path_tree[$id]['finishBlock'] = 0;

              if($last_node == null) {
                  $last_node = $node;
                  $last_node_id = $id;
                  continue;
              }

              if($node['level'] > $last_node['level']) {
                  $path_tree[$last_node_id]['hasChild'] = 1;
              }
              if($node['level'] < $last_node['level']) {
                  $path_tree[$last_node_id]['finishBlock'] = $last_node['level'] - $node['level'];
              }

              $last_node = $node;
              $last_node_id = $id;
          }
          $path_tree[$last_node_id]['finishBlock'] = $last_node['level'];

          //теперь разбить список на два списка
          $path_trees = array(
              0 => array(),
              1 => array()
          );
          $i = -1;
          foreach($path_tree as $id=>$node) {
              if($node['level']==0) $i++;
              $path_trees[$i%2][$id] = $node;
          }
          Cache::write('path_trees', $path_trees);
       }
      $this->set('path_trees', $path_trees);
      /***************************************************************/

    }

	function list_home_news() {
      $this->layout = 'admin';
      $this->pageTitle = 'Информация на главной странице';

      if(($home_news = Cache::read('home_news')) === false) {
        $home_news = $this->HomeNew->find('all');
        Cache::write('home_news', $home_news);
      }
      $this->set('home_news', $home_news);
    }

    function add() {
      $this->layout = 'admin';
      $this->pageTitle = 'Информация на главной странице - добавить';

      if(!empty($this->data)) {

        $this->HomeNew->save($this->data);
        Cache::delete('home_news');
        clearCache();

        $this->redirect(array(
                    'controller' => 'home_news',
                    'action' => 'list_home_news'
                ));
      }
    }

    function edit($id = null) {
      $this->layout = 'admin';
      $this->pageTitle = 'Информация на главной странице - редактирование';

      if(!empty($this->data)) {
        $home_news = $this->HomeNew->id = $id;

        $this->HomeNew->save($this->data);
        Cache::delete('home_news');
        clearCache();

        $this->set('home_news', $this->HomeNew->read());

        $this->redirect(array(
            'controller' => 'home_news',
            'action' => 'list_home_news'
        ));
      }
      else {
        $this->HomeNew->id = $id;
        $this->data = $this->HomeNew->read();
        $this->set('home_news', $this->HomeNew->read());
      }
    }

    function delete($id = 0) {
      $this->layout = 'admin';
      $this->pageTitle = 'Информация на главной странице - удалить';

      $home_news = $this->HomeNew->id = $id;
      $this->set('home_news', $this->HomeNew->read());

      if(!empty($this->data)) {

        $this->HomeNew->delete();
        Cache::delete('home_news');
        clearCache();

        $this->redirect(array(
            'controller' => 'home_news',
            'action' => 'list_home_news'
        ));
      }
    }

}
?>