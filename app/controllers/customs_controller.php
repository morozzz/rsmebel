<?php

class CustomsController extends AppController {
    var $name = 'Customs';
    var $uses = array(
        'Catalog',
        'ClientInfo',
        'CompanyType',
        'Custom',
        'CustomClientInfo',
        'CustomDet',
        'CustomStatus',
        'CustomStatusType',
        'Image',
        'PayType',
        'Product',
        'ProductDet',
        'TransportType',
        'User'
    );
    var $components = array(
        'Basket',
        'Session',
        'Email',
        'SendEmail'
    );
    var $actionJs = array(
        "jquery.dataTables.min",
        "jquery-ui-1.8.5.custom.min"
    );

    function beforeFilter() {
        parent::beforeFilter();
    }

    function isAuthorized() {
        if(!empty($this->curUser)) {
            if($this->action == 'adm_custom' || $this->action == 'adm_view' ||
                    $this->action == 'add_status' || $this->action == 'delete_status') {
                return ($this->curUser['User']['role_id'] == 2) ||
                        ($this->curUser['User']['role_id'] == 3);
            }
            return true;//$curUser['User']['role_id'] == 1;
        }
        return false;
    }

    function index() {
        $this->pageTitle = 'Архив заказов';

        $this->Custom->unbindModel(array(
            'hasMany' => array(
                'CustomStatus',
                'CustomDet'
            )
        ));

        $this->paginate = array('Custom' => array('conditions' => array('Custom.user_id' => $this->curUser['User']['id']),
                                                  'recursive' => 1, 'limit' => 20, 'order' => 'Custom.created'));

        $customs = $this->paginate('Custom');

//        $customs = $this->Custom->find('all', array(
//            'conditions' => array(
//                'Custom.user_id' => $this->curUser['User']['id']
//            ),
//            'recursive' => 1
//        ));

        if(($custom_status_types = Cache::read('custom_status_types')) === false) {

          $custom_status_types = $this->CustomStatusType->find('all');
          Cache::write('custom_status_types', $custom_status_types);
        }
        $custom_status_types = Set::combine($custom_status_types, '{n}.CustomStatusType.id', '{n}');

        if(($transport_types = Cache::read('transport_types')) === false) {
          $transport_types = $this->TransportType->find('all', array(
              'recursive' => -1
          ));
          Cache::write('transport_types', $transport_types);
        }
        $transport_types = Set::combine($transport_types, '{n}.TransportType.id', '{n}');

        foreach($customs as $custom_key => $custom) {
            $customs[$custom_key]['CustomStatusType']['Image'] = $custom_status_types[$custom['CustomStatusType']['id']]['Image'];
            $customs[$custom_key]['TransportType'] = $transport_types[$custom['TransportData']['transport_type_id']]['TransportType'];
        }

        $customs = Set::combine($customs, '{n}.Custom.id', '{n}');
        $this->set('customs', $customs);
        $limit_array = $this->params['named'];
        $limit = (empty($limit_array['limit']))?20:$limit_array['limit'];
        $this->set('limit', $limit);
    }

    function view($id, $type='simple') {
        //custom
        $this->Custom->unbindModel(array(
            'hasMany' => array(
                'CustomStatus'
            )
        ));
        $custom = $this->Custom->find('first', array(
            'conditions' => array(
                'Custom.id' => $id,
                'Custom.user_id' => $this->curUser['User']['id']
            )
        ));

        $company_types = $this->CompanyType->find('first', array('conditions' => array('CompanyType.id' => $custom['CustomClientInfo'][0]['company_type_id'])));

        if(empty($custom)) {
            $this->redirect(array(
                'controller' => 'customs',
                'action' => 'index'
            ));
        }
        $this->pageTitle = 'Заказ №' . $custom['Custom']['id'];

        //transport_data
        $transport_data = $this->TransportData->find('first', array(
            'conditions' => array(
                'TransportData.id' => $custom['TransportData']['id']
            )
        ));
        $custom += $transport_data;

        //custom_statuses
        $custom_statuses = $this->CustomStatus->find('all', array(
            'conditions' => array(
                'CustomStatus.custom_id' => $id
            )
        ));
        $custom['CustomStatus'] = $custom_statuses;
        
        if(($custom_status_types = Cache::read('custom_status_types')) === false) {

          $custom_status_types = $this->CustomStatusType->find('all');
          Cache::write('custom_status_types', $custom_status_types);
        }
        $custom_status_types = Set::combine($custom_status_types, '{n}.CustomStatusType.id', '{n}');

        foreach($custom['CustomStatus'] as $custom_status_key => $custom_status) {
            $custom['CustomStatus'][$custom_status_key] += $custom_status_types[$custom_status['CustomStatus']['custom_status_type_id']];
        }

        $this->set('custom', $custom);
        $this->set('company_types', $company_types);

        if($type=='print') {
            $this->render('print', 'print');
        }
    }

    function admin_custom() {
        $this->pageTitle = 'Список заказов';
        $this->layout = 'admin';
        $conditions = array();
        if(!empty($this->data)) {
            $this->Session->write('AdmCustom.Filter', $this->data['Filter']);
        }
        $filter = $this->Session->read('AdmCustom.Filter');
        if(!empty($filter)) {
            if(!empty($filter['username']) && $filter['username']!='') {
                $conditions['User.username'] = $filter['username'];
            }
            if(!empty($filter['custom_status_type_id']) && $filter['custom_status_type_id']>0) {
                $conditions['Custom.custom_status_type_id'] = $filter['custom_status_type_id'];
            }
            if(!empty($filter['date1'])) {
                $filter['date1'] = date('Y-m-d', strtotime($filter['date1'])).' 00:00:00';
                $conditions['Custom.created >='] = $filter['date1'];
            }
            if(!empty($filter['date2'])) {
                $filter['date2'] = date('Y-m-d', strtotime($filter['date2'])).' 23:59:59';
                $conditions['Custom.created <='] = $filter['date2'];
            }
            
        }
        $this->set('filter', $filter);
        
        $this->paginate = array(
            'Custom' => array(
                'conditions' => $conditions,
                'contain' => array(
                    'CustomClientInfo' => array(
                        'CompanyType',
                        'PayType',
                        'TransportType'
                    ),
                    'CustomStatusType' => array(
                        'Image'
                    ),
                    'User' => array(
                        'ClientInfo' => array(
                            'CompanyType'
                        )
                    )
                ),
                'limit' => '20'
            )
        );
        $customs = $this->paginate('Custom');

        $custom_status_types = $this->CustomStatusType->find('all', array(
            'contain' => array('Image')
        ));
        $custom_status_types = Set::combine($custom_status_types, '{n}.CustomStatusType.id', '{n}');
        foreach($custom_status_types as &$custom_status_type) {
            $custom_status_type['CustomStatusType']['custom_cnt'] = 0;
            $custom_status_type['customs'] = array();
        }
        foreach($customs as $custom) {
            $custom_status_type_id = $custom['Custom']['custom_status_type_id'];
            $custom_status_types[$custom_status_type_id]['CustomStatusType']['custom_cnt']++;
            $custom_status_types[$custom_status_type_id]['customs'][] = $custom;
        }
        $this->set('custom_status_types', $custom_status_types);
        
        $users = $this->User->find('list', array(
            'conditions' => array(
                'User.role_id' => 1
            ),
            'fields' => array('username')
        ));
        $this->set('users', $users);

        $custom_status_types_list = array(0 => 'Все');
        $custom_status_types_list += $this->CustomStatusType->find('list');
        $this->set('custom_status_type_list', $custom_status_types_list);
    }

    function admin_view($id, $type='simple') {
        $custom = $this->Custom->find('first', array(
            'conditions' => array(
                'Custom.id' => $id
            ),
            'contain' => array(
                'CustomClientInfo' => array(
                    'CompanyType',
                    'PayType',
                    'TransportType'
                ),
                'User',
                'CustomDet' => array(
                    'Product',
                    'ProductDet'
                ),
                'CustomStatus' => array(
                    'CustomStatusType' => array(
                        'Image'
                    ),
                    'User'
                ),
                'CustomStatusType'
            )
        ));

        if(empty($custom)) {
            $this->redirect(array(
                'controller' => 'customs',
                'action' => 'admin_custom'
            ));
        }
        
        foreach($custom['CustomDet'] as &$custom_det) {
            $custom_det['Product']['url'] = $this->Product->get_url($custom_det['Product']['id']);
        }
        $this->set('custom', $custom);
        
        $this->pageTitle = 'Заказ №' . $custom['Custom']['id'];
        $this->layout = 'admin';
        
        $custom_status_type_list = $this->CustomStatusType->find('list');
        $this->set('custom_status_type_list', $custom_status_type_list);

        if($type=='print') {
            $this->render('print', 'print');
        }
    }

    function add_status() {

      $custom_id = $this->data['Custom']['id'];
      $custom_status_type_id = $this->data['Custom']['custom_status_type_id'];

        $data = array(
            'custom_id' => $custom_id,
            'custom_status_type_id' => $custom_status_type_id,
            'user_id' => $this->curUser['User']['id']
        );
        $this->CustomStatus->create();
        $this->CustomStatus->save($data);

        $this->Custom->id = $custom_id;
        $this->Custom->save(array(
            'custom_id' => $custom_id,
            'custom_status_type_id' => $custom_status_type_id
        ));
        
        $this->redirect($this->referer());
    }

    function delete_status($custom_status_id) {
        $custom_status = $this->CustomStatus->find('first', array(
            'conditions' => array(
                'CustomStatus.id' => $custom_status_id
            )
        ));
        if(empty($custom_status)) $this->redirect($this->referer());
        
        $custom_id = $custom_status['CustomStatus']['custom_id'];
        
        $this->CustomStatus->id = $custom_status_id;
        $this->CustomStatus->delete();

        // смотрим новый статус
        $custom_status_type_new = $this->CustomStatus->find('first', array(
            'fields' => array('CustomStatus.custom_status_type_id'),
            'conditions' => array('CustomStatus.custom_id' => $custom_id),
            'contain' => array(),
            'order' => 'CustomStatus.created DESC'
        ));

        $this->Custom->id = $custom_id;
        $this->data['Custom']['custom_status_type_id'] = $custom_status_type_new['CustomStatus']['custom_status_type_id'];
        $this->Custom->save($this->data, $validate = true, $fieldList = array('custom_status_type_id'));
        
        $this->redirect($this->referer());
    }

}

?>
