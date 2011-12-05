<?php

class ShopRulesController extends AppController {
    var $name = 'ShopRules';
    var $uses = array("ShopRule");

    var $cacheAction = array('index/1' => '1 month', 'index/2' => '1 month');

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('index');
        $this->Auth2->allow('get');
    }

	function index($id) {
      if ($id == 1)
        $this->pageTitle = "Правила работы интернет-магазина";
      else if ($id == 2)
        $this->pageTitle = "Как делать покупки в интернет-магазине";

      if (!empty($id)) {
        $shop_rules = $this->ShopRule->find('all', array('conditions' => array('ShopRule.id' => $id)));
        $this->set('shop_rules', $shop_rules);
      }
    }

    function get($shop_rule_id=null) {
        if(isset($this->params['requested'])) {
            $shop_rules = $this->ShopRule->find('all', array('conditions' => array(
                'ShopRule.id' => array(1,2)
            )));
            $shop_rules = Set::combine($shop_rules, '{n}.ShopRule.id', '{n}');
            return $shop_rules;
        } else if($this->params['isAjax'] == 1 && !empty($shop_rule_id)) {
            $this->layout = 'ajax';
            $shop_rule = $this->ShopRule->find('first', array(
                'conditions' => array(
                    'ShopRule.id' => $shop_rule_id
                ),
                'contain' => array()
            ));
            $this->set('shop_rule', $shop_rule);
        } else {
            die;
        }
    }

    function edit($id) {
      $this->layout = 'admin';
      if ($id == 1)
        $this->pageTitle = "Правила работы интернет-магазина - Редактирование";
      else if ($id == 2)
        $this->pageTitle = "Как делать покупки в интернет-магазине - Редактирование";

      $this->set('rule_header', $this->pageTitle);
      $this->set('shop_rule_id', $id);

      if (!empty($id)) {
          if(!empty($this->data)) {
            $shop_rules = $this->ShopRule->id = $id;

            $this->ShopRule->save($this->data);

            $this->ShopRule->id = $id;
            $this->data = $this->ShopRule->read();
            $this->set('shop_rules', $this->ShopRule->read());
          }
          else {
            $this->ShopRule->id = $id;
            $this->data = $this->ShopRule->read();
            $this->set('shop_rules', $this->ShopRule->read());
          }


      }
    }

}
?>