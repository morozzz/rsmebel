<?php

class CompanyInfosController extends AppController {
    var $name = 'CompanyInfos';
    var $uses = array("CompanyInfo", 'Album');

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth2->allow('index');
    }

	function index($id = null) {
      $this->pageTitle = "О Компании";

      if(($company_infos = Cache::read('company_infos')) === false) {
          $company_infos = $this->CompanyInfo->find('all', array('order' => 'CompanyInfo.sort_order'));
        Cache::write('company_infos', $company_infos);
      }
      $this->set('company_infos', $company_infos);

      if (empty($id)) {
        $id = $company_infos[0]['CompanyInfo']['id'];
      }

      $this->CompanyInfo->id = $id;
      $com_infos = $this->CompanyInfo->read();
      $this->set('com_infos', $com_infos);

      if($com_infos['CompanyInfo']['news_header'] == 'Фотоальбом') {
        $albums = $this->Album->find('all', array(
            'contain' => array(
                'SmallImage'
            )
        ));
        $this->set('albums', $albums);
        $this->actionCss = array('albums/index');
        $this->render('albums');
      }

      //debug($this->companyInfo->read());
    }

	function list_company_infos() {
      $this->layout = 'admin';
      $this->pageTitle = 'О Компании';
      if(($company_infos = Cache::read('company_infos')) === false) {
        $company_infos = $this->CompanyInfo->find('all');
        Cache::write('company_infos', $company_infos);
      }
      $this->set('company_infos', $company_infos);
    }

    function add() {
      $this->layout = 'admin';
      $this->pageTitle = 'О Компании - добавить';

      if(!empty($this->data)) {

        $this->CompanyInfo->save($this->data);
        Cache::delete('company_infos');

        $this->redirect(array(
                    'controller' => 'company_infos',
                    'action' => 'list_company_infos'
                ));
      }
    }

    function edit($id = null) {
      $this->layout = 'admin';
      $this->pageTitle = 'О Компании - редактирование';

      if(!empty($this->data)) {
        $company_infos = $this->CompanyInfo->id = $id;

        $this->CompanyInfo->save($this->data);
        Cache::delete('company_infos');

        $this->redirect(array(
                    'controller' => 'company_infos',
                    'action' => 'list_company_infos'
                ));
      }
      else {
        $this->CompanyInfo->id = $id;
        $this->data = $this->CompanyInfo->read();
        $this->set('company_infos', $this->CompanyInfo->read());
      }
    }

    function delete($id = 0) {
      $this->layout = 'admin';
      $this->pageTitle = 'О Компании - удалить';

      $company_infos = $this->CompanyInfo->id = $id;
      $this->set('company_infos', $this->CompanyInfo->read());

      if(!empty($this->data)) {

        $this->CompanyInfo->delete();
        Cache::delete('company_infos'); 

        $this->redirect(array(
                    'controller' => 'company_infos',
                    'action' => 'list_company_infos'
                ));
      }
    }

}
?>