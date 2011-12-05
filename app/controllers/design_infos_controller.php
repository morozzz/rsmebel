<?php

class DesignInfosController extends AppController {
    var $name = 'DesignInfos';
    var $uses = array("DesignInfo");

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return ($this->curUser['User']['role_id'] == 2 ||
                    $this->curUser['User']['role_id'] == 3);
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth2->allow('index');
    }

	function index($id = null) {
      $this->pageTitle = "Дизайн магазина / Интерьер магазина, проект магазина";

      if(($design_infos = Cache::read('design_infos')) === false) {
        $design_infos = $this->DesignInfo->find('all', array('order' => 'DesignInfo.sort_order'));
        Cache::write('design_infos', $design_infos);
      }
      if (empty($id)) {
        $id = $design_infos[0]['DesignInfo']['id'];
      }
      $this->set('design_infos', $design_infos);

      $this->DesignInfo->id = $id;
      $this->set('des_infos', $this->DesignInfo->read());

      //debug($this->DesignInfo->read());
    }

	function list_design_infos() {
      $this->layout = 'admin';
      $this->pageTitle = 'Дизайн магазинов/бутиков';

      if(($design_infos = Cache::read('design_infos')) === false) {
          $design_infos = $this->DesignInfo->find('all', array('order' => 'DesignInfo.sort_order'));
          Cache::write('design_infos', $design_infos);
      }
      $this->set('design_infos', $design_infos);
    }

    function add() {
      $this->layout = 'admin';
      $this->pageTitle = 'Дизайн магазинов/бутиков - добавить';

      if(!empty($this->data)) {

        $this->DesignInfo->save($this->data);
        Cache::delete('design_infos');
        $this->redirect(array(
                    'controller' => 'design_infos',
                    'action' => 'list_design_infos'
                ));
      }
    }

    function edit($id = null) {
      $this->layout = 'admin';
      $this->pageTitle = 'Дизайн магазинов/бутиков - редактирование';

      if(!empty($this->data)) {
        $design_infos = $this->DesignInfo->id = $id;

        $this->DesignInfo->save($this->data);
        Cache::delete('design_infos');
        $this->set('design_infos', $this->DesignInfo->read());

        $this->redirect(array(
                    'controller' => 'design_infos',
                    'action' => 'list_design_infos'
                ));
      }
      else {
        $this->DesignInfo->id = $id;
        $this->data = $this->DesignInfo->read();
        $this->set('design_infos', $this->DesignInfo->read());
      }
    }

    function delete($id = 0) {
      $this->layout = 'admin';
      $this->pageTitle = 'Дизайн магазинов/бутиков - удалить';

      $design_infos = $this->DesignInfo->id = $id;
      $this->set('design_infos', $this->DesignInfo->read());

      if(!empty($this->data)) {

        $this->DesignInfo->delete();
        Cache::delete('design_infos');

        $this->redirect(array(
                    'controller' => 'design_infos',
                    'action' => 'list_design_infos'
                ));
      }
    }

}
?>