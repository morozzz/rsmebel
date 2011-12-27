<?php

class CompanyInfosController extends AppController {
    var $name = 'CompanyInfos';
    var $uses = array(
        'CompanyInfo'
    );
    var $helpers = array(
        'AdminCommon'
    );
    var $components = array(
        'AdminCommon'
    );

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
    
    function admin_index() {
        $this->pageTitle = 'Администрирование - о компании';
        $this->layout = 'admin';
        
        $company_infos = $this->CompanyInfo->find('all', array(
            'contain' => array()
        ));
        $company_infos = Set::combine($company_infos, '{n}.CompanyInfo.id', '{n}');
        $this->set('company_infos', $company_infos);
    }

    function admin_save_all() {
        $this->AdminCommon->save_all($this->data, $this->CompanyInfo);
        $this->redirect($this->referer());
        die;
    }

    function admin_add() {
        $this->AdminCommon->add($this->data, $this->CompanyInfo);
        die;
    }

    function admin_delete() {
        $this->AdminCommon->delete($this->data, $this->CompanyInfo);
        die;
    }
    
    function index($name = null) {
        $this->set('current_menu_name', 'company');
        
        $company_info = null;
        if(!empty($name)) {
            $company_info = $this->CompanyInfo->find('first', array(
                'conditions' => array(
                    'CompanyInfo.enabled' => 1,
                    'CompanyInfo.eng_name' => $name
                ),
                'contain' => array()
            ));
        }
        if(empty($company_info)) {
            $this->set('breadcrumb', array(
                array('url'=>'/','label'=>'Главная'),
                array('url'=>array('controller'=>'company_infos','action'=>'index'),'label'=>'Компания')
            ));
            
            $company_info = $this->CompanyInfo->find('first', array(
                'conditions' => array(
                    'CompanyInfo.enabled' => 1
                ),
                'contain' => array()
            ));
        } else {
            $this->set('breadcrumb', array(
                array('url'=>'/','label'=>'Главная'),
                array('url'=>array('controller'=>'company_infos','action'=>'index'),'label'=>'Компания'),
                array('url'=>array('controller'=>'company_infos','action'=>'index',$company_info['CompanyInfo']['eng_name']),
                    'label'=>$company_info['CompanyInfo']['caption'])
            ));
        }
        $this->set('current_company_info', $company_info);
        $this->pageTitle = $company_info['CompanyInfo']['caption'];
        
        $company_infos = $this->CompanyInfo->find('all', array(
            'conditions' => array(
                'CompanyInfo.enabled' => 1
            ),
            'contain' => array()
        ));
        $this->set('company_infos', $company_infos);
    }
}
?>