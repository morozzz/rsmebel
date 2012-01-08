<?php

class SpecialsController extends AppController {
    var $name = 'Specials';

    var $uses = array(
        'Special',
        'Catalog',
        'Product',
        'ProductDet',
        'ProductParam',
        'Image'
    );

    var $components = array(
        'AdminCommon',
        'ProductCommon'
    );

    var $helpers = array(
        'AdminCommon',
        'CatalogCommon',
        'ProductCommon'
    );
    var $actionJs = array(
        "jquery.fumodal",
        "common"
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('get_specials');
    }
    
    function get_specials() {
        $specials = $this->Special->find('all', array(
            'conditions' => array(
                'Special.enabled' => 1
            ),
            'contain' => array(
                'Image'
            )
        ));
        foreach($specials as &$special) {
            $special['Special']['url'] = $this->Product->get_url($special['Special']['product_id']);
        }
        
        if(isset($this->params['requested'])) {
            return $specials;
        }
    }

    function admin_index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Управление спецпредложениями';

        $specials = $this->Special->find('all', array(
          'contain' => array(
              'Image',
              'Product'
          )
        ));
        $specials = Set::combine($specials, '{n}.Special.id', '{n}');
        $this->set('specials', $specials);
        
        $catalog_list = $this->Catalog->find('list', array(
            'conditions' => array(
                'Catalog.catalog_type_id' => 1
            )
        ));
        $this->set('catalog_list', $catalog_list);
    }

    function admin_save_all() {
        $this->AdminCommon->save_all($this->data, $this->Special);
        $this->redirect($this->referer());
        die;
    }
    
    function admin_add() {
        $this->AdminCommon->add($this->data, $this->Special);
        die;
    }

    function delete_row() {
        $this->AdminCommon->delete($this->data, $this->Special);
        die;
    }

    function delete_list() {
        $this->AdminCommon->delete_list($this->data, $this->Special);
        die;
    }
}

?>
