<?php

class SettingController extends AppController {
    var $name = 'Setting';
    var $uses = array(
        'Setting'
    );

    var $components = array(
        'AdminCommon',
        'ProductCommon'
    );

    var $helpers = array(
        'AdminCommon'
    );
    
    function admin_index() {
        $this->set('current_menu_name', 'setting');
        $this->pageTitle = 'Администрирование - настройки';
        $this->layout = 'admin';
        
        $settings = $this->Setting->find('all', array(
            'contain' => array(
                'Image'
            )
        ));
        $settings = Set::combine($settings, '{n}.Setting.id', '{n}');
        $this->set('settings', $settings);
    }

    function admin_save_all() {
        $this->AdminCommon->save_all($this->data, $this->Setting);
        $this->redirect($this->referer());
    }
}

?>
