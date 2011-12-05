<?php

class HomeNewsController extends AppController {
    var $name = 'HomeNews';
    var $uses = array(
        "HomeNew",
        "Cnew",
        "Catalog",
        "Special",
        "Image",
        "Slide",
        "ShortLink"
    );

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
        $this->Auth2->allow('index2');
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
//      if(($specials = Cache::read('specials')) === false) {
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
              ),
              'contain' => array(
                  'Product' => array(
                      'SmallImage'
                  ),
                  'ProductDet' => array(
                      'SmallImage',
                      'Product' => array(
                          'SmallImage'
                      ),
                      'ProductDetParam' => array(
                          'ProductParam' => array(
                              'ProductParamType'
                          ),
                          'ProductDetParamValue'
                      )
                  )
              )
          ));
          foreach($specials as &$special) {
              $data = array('special_id' => $special['Special']['id']);
              if(empty($special['Product']['id'])) {
                  $data['name'] = $special['ProductDet']['Product']['name'];
                  foreach($special['ProductDet']['ProductDetParam'] as $product_det_param) {
                      $name = $product_det_param['ProductParam']['ProductParamType']['name'];
                      $value = (empty($product_det_param['value']))
                        ?$product_det_param['ProductDetParamValue']['name']
                        :$product_det_param['value'];
                      $data['name'] .= " $name:$value";
                  }
                  if(!empty($special['ProductDet']['small_image_id'])) {
                      $data['image_url'] = $special['ProductDet']['SmallImage']['url'];
                  } else if(!empty($special['ProductDet']['Product']['small_iamge_id'])) {
                      $data['image_url'] = $special['ProductDet']['Product']['SmallImage']['url'];
                  } else {
                      $data['image_url'] = 'nopic.gif';
                  }
                  $data['product_id'] = $special['ProductDet']['product_id'];
                  $data['price'] = $special['ProductDet']['price'];
              } else {
                  $data['name'] = $special['Product']['name'];
                  if(empty($special['Product']['small_image_id'])) {
                      $data['image_url'] = 'nopic.gif';
                  } else {
                      $data['image_url'] = $special['Product']['SmallImage']['url'];
                  }
                  $data['product_id'] = $special['Product']['id'];
                  $data['price'] = $special['Product']['price'];
              }
              $data['prob'] = $special['Special']['prob'];
              $special = $data;
          }
//          Cache::write('specials', $specials);
//      }
          $specials5 = array();
          $spec_cnt = count($specials);
          if($spec_cnt>5) $spec_cnt = 5;
          for($i=0; $i<$spec_cnt; $i++) {
              $temp_special_id = $this->_random_specials($specials);
              $specials5[$temp_special_id] = $specials[$temp_special_id];
              unset($specials[$temp_special_id]);
          }
      /***************************************************************/

          if (isset($this->params['requested'])) {
            return $specials5;
          } else {
            $this->set(compact('specials'));
          }
    }

    function _random_specials($specials) {
        $prob_sum = 0;
        foreach($specials as $special)
            $prob_sum += $special['prob'];
        $rand_prob_sum = mt_rand(0, $prob_sum);
        $cur_prob_sum = 0;
        foreach($specials as $special_id => $special) {
            $cur_prob_sum += $special['prob'];
            if($cur_prob_sum>=$rand_prob_sum) return $special_id;
        }
    }

	function index() {
      $this->pageTitle = "Торговое оборудование / Витрины, оборудование для магазинов, банкетки, рекламные стойки - Анжелика";

      /*слайдшоу*/
      /***************************************************************/
      if( ($slides = Cache::read('slideshow')) === false) {
          $slides = $this->Slide->find('all');
          Cache::write('slideshow', $slides);
      }
      $this->set('slides', $slides);
      /***************************************************************/

      /*быстрые ссылки*/
      /***************************************************************/
      if(($short_links = Cache::read('short_links')) === false) {
          $short_links = $this->ShortLink->find('all');
          Cache::write('short_links', $short_links);
      }
      $this->set('short_links', $short_links);
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
    
	function index2() {
      $this->pageTitle = "Торговое оборудование / Витрины, оборудование для магазинов, банкетки, рекламные стойки - Анжелика";
      $this->layout = 'default2';


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