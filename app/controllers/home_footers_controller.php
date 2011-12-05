<?php

class HomeFootersController extends AppController {
    var $name = 'HomeFooters';
    var $uses = array("HomeFooter");

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

	function index() {
      $this->layout = 'admin';
      $this->pageTitle = 'Подвал на главной странице';
    }

    function edit() {
      $this->layout = 'admin';
      $this->pageTitle = 'Подвал на главной странице - редактирование';

      if(!empty($this->data)) {
        $home_footers = $this->HomeFooter->id = 1;

        $this->HomeFooter->save($this->data);

        $home_footers = $this->HomeFooter->find('all');
        Cache::write('home_footers', $home_footers);
        clearCache();
        $this->set('home_footers', $home_footers);

        $this->redirect(array(
            'controller' => 'home_footers',
            'action' => 'edit'
        ));
      }
      else {

        if(($home_footers = Cache::read('home_footers')) === false) {
          $home_footers = $this->HomeFooter->find('all');
          Cache::write('home_footers', $home_footers);
        }
        $this->set('home_footers', $home_footers);          
      }
    }
}
?>