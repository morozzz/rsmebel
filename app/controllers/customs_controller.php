<?php

class CustomsController extends AppController {
    var $name = 'Customs';
    var $uses = array(
        'Custom',
        'Image',
        'CustomDet',
        'CustomStatus',
        'CustomStatusType',
        'TransportAddress',
        'TransportData',
        'TransportType',
        'TransportTypeAbout',
        'ProductDet',
        'Product',
        'Catalog',
        'User',
        'ClientInfo',
        'CompanyType',
        'CustomClientInfo',
        'PayType'
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
    
    function order($client_info_id = null) {
        if(!empty($this->data)) {
            debug($this->data);die;
        }
        $this->pageTitle = 'Оформление заказа';
        $basket_data = $this->Basket->prepareBasketData();
        if(empty($basket_data)) {
            $this->Session->setFlash('Нельзя оформить заказ при пустой корзине');
            $this->redirect('/basket/index/');
        }

        if(!empty($this->data)) {
            
            // -- сначала проверяем данные
            if (empty($this->data['ClientInfo']['name'])) {
              $this->Session->setFlash('Введите наименование покупателя(фирмы)');
              $this->redirect($this->referer());
            }
            if (empty($this->data['User']['email'])) {
              $this->Session->setFlash('Введите E-mail');
              $this->redirect($this->referer());
            }
            if (empty($this->data['ClientInfo']['fio'])) {
              $this->Session->setFlash('Введите контактное лицо');
              $this->redirect($this->referer());
            }

            //custom
            $data = array(
                'user_id' => $this->curUser['User']['id'],
                'custom_status_type_id' => 1,
                'note' => $this->data['note'],
                'created' => date('Y.m.d H:i:s'),
                'pay_type_id' => $this->data['pay_type_id']
            );
            $this->Custom->create();
            $this->Custom->save($data);
            Cache::delete('customs');

            $custom_id = $this->Custom->id;

            //custom_client_info
            if (empty($this->data['ClientInfo']['reg_num'])) { $reg_num = ''; }
              else { $reg_num = $this->data['ClientInfo']['reg_num']; }
            if (empty($this->data['ClientInfo']['KPP'])) { $KPP = '';  }
              else { $KPP = $this->data['ClientInfo']['KPP']; }

            $data = array(
                'custom_id' => $custom_id,
                'fio' => $this->data['ClientInfo']['fio'],
                'email' => $this->data['User']['email'],
                'post_index' => '',
                'post_region' => '',
                'post_city' => '',
                'post_street' => '',
                'post_hnumber' => '',
                'post_office' => '',
                'name' => $this->data['ClientInfo']['name'],
                'company_type_id' => $this->data['ClientInfo']['company_type_id'],
                'reg_num' => $reg_num,
                'profil_type_id' => null,
                'activity' => '',
                'phone_kod' => $this->data['ClientInfo']['phone_kod'],
                'phone' => $this->data['ClientInfo']['phone'],
                'fax_kod' => $this->data['ClientInfo']['fax_kod'],
                'fax' => $this->data['ClientInfo']['fax'],
                'jur_index' => $this->data['ClientInfo']['jur_index'],
                'jur_region' => $this->data['ClientInfo']['jur_region'],
                'jur_city' => $this->data['ClientInfo']['jur_city'],
                'jur_street' => $this->data['ClientInfo']['jur_street'],
                'jur_hnumber' => $this->data['ClientInfo']['jur_hnumber'],
                'jur_office' => $this->data['ClientInfo']['jur_office'],
                'INN' => $this->data['ClientInfo']['INN'],
                'KPP' => $KPP,
                'operating_account' => $this->data['ClientInfo']['operating_account'],
                'correspondent_account' => $this->data['ClientInfo']['correspondent_account'],
                'BIK' => $this->data['ClientInfo']['BIK'],
                'OKPO' => $this->data['ClientInfo']['OKPO'],
                'OKVED' => $this->data['ClientInfo']['OKVED'],
                'on_news' => 0
            );
            $this->CustomClientInfo->create();
            $this->CustomClientInfo->save($data);
                                 
            //custom_status
            $data = array(
                'custom_id' => $custom_id,
                'user_id' => $this->curUser['User']['id'],
                'custom_status_type_id' => 1,
                'created' => date('Y.m.d H:i:s')
            );
            $this->CustomStatus->create();
            $this->CustomStatus->save($data);
            Cache::delete('custom_statuses');

            //custom_det
            if(!empty($basket_data)) {
                foreach($basket_data as $product) {
                    $product_id = (empty($product['product_id']))?null:$product['product_id'];
                    $product_det_id = (empty($product['product_det_id']))?null:$product['product_det_id'];
                    $code_1c = (empty($product['code_1c']))?null:$product['code_1c'];
                    $name_1c = (empty($product['name_1c']))?null:$product['name_1c'];
                    $data = array(
                        'custom_id' => $custom_id,
                        'product_id' => $product_id,
                        'product_det_id' => $product_det_id,
                        'code_1c' => $code_1c,
                        'name_1c' => $name_1c,
                        'name' => $product['name'],
                        'cnt' => $product['cnt'],
                        'price' => (!empty($product['price']))?$product['price']:0
                    );
                    $this->CustomDet->create();
                    $this->CustomDet->save($data);
                }
            }

            //transport_data
            $data = array(
                'custom_id' => $custom_id,
                'transport_type_id' => $this->data['transport_type_id']
            );
            $this->TransportData->create();
            $this->TransportData->save($data);
            $transport_data_id = $this->TransportData->id;

            //transport_address
            $data = array(
                'transport_data_id' => $transport_data_id,
                'post_index' => $this->data['TransportAddress']['post_index'],
                'region'     => $this->data['TransportAddress']['region'],
                'city'       => $this->data['TransportAddress']['city'],
                'street'     => $this->data['TransportAddress']['street'],
                'house'      => $this->data['TransportAddress']['house'],
                'flat'       => $this->data['TransportAddress']['flat'],
            );
            $this->TransportAddress->create();
            $this->TransportAddress->save($data);

            $this->Basket->clear();

            $this->redirect(array(
                'controller' => 'customs',
                'action' => 'index'
            ));
        } else {

            $basket_data = $this->Basket->prepareBasketData();
            $this->set('basket_data', $basket_data);

            $transport_types = $this->TransportType->find('all');
            $this->set('transport_types', $transport_types);

            $pay_type_list = $this->PayType->find('list');
            $this->set('pay_type_list', $pay_type_list);

            if(($company_types = Cache::read('company_types')) === false) {
              $company_types = $this->CompanyType->find('list');
              Cache::write('company_types', $company_types);
            }
            $this->set('companyTypes', $company_types);

            $id = $this->Session->read('Auth.User.id');
            $client_infos = $this->ClientInfo->find('all', array('conditions' => array('ClientInfo.user_id' => $id),
                                                                 'order' => array('ClientInfo.filial_type_id')));
            $this->set('client_infos', $client_infos);

            if (!empty($client_info_id)) {
              $custom_client_infos = $this->User->find('first', array('conditions' => array('ClientInfo.id' => $client_info_id)));
              $this->data = $custom_client_infos;
              $this->set('client_info_id', $client_info_id);
            }
            else {
              $this->set('client_info_id', $client_infos[0]['ClientInfo']['id']);
              $this->redirect('/customs/order/'.$client_infos[0]['ClientInfo']['id']);
            }
        }
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

    function adm_custom() {
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
                    'PayType',
                    'CustomStatusType' => array(
                        'Image'
                    ),
                    'TransportData' => array(
                        'TransportType'
                    ),
                    'User' => array(
                        'ClientInfo' => array(
                            'CompanyType'
                        )
                    )
                ),
                'limit' => '100'
            )
        );
        $customs = $this->paginate('Custom');

//        $users_id = Set::combine($customs, '{n}.User.id', '{n}.User.id');
//        $client_infos = $this->ClientInfo->find('all', array(
//            'conditions' => array(
//                'ClientInfo.user_id' => $users_id
//            )
//        ));
//        $company_types = Set::combine($client_infos, '{n}.ClientInfo.user_id', '{n}.CompanyType.type_name');
//
//        if(($custom_status_types = Cache::read('custom_status_types')) === false) {
//
//          $custom_status_types = $this->CustomStatusType->find('all');
//          Cache::write('custom_status_types', $custom_status_types);
//        }
//        $custom_status_types = Set::combine($custom_status_types, '{n}.CustomStatusType.id', '{n}');
//
//        if(($transport_types = Cache::read('transport_types')) === false) {
//          $transport_types = $this->TransportType->find('all', array(
//              'recursive' => -1
//          ));
//          Cache::write('transport_types', $transport_types);
//        }
//        $transport_types = Set::combine($transport_types, '{n}.TransportType.id', '{n}');
//
//        foreach($customs as $custom_key => $custom) {
//            $customs[$custom_key]['CustomStatusType']['Image'] = $custom_status_types[$custom['CustomStatusType']['id']]['Image'];
//            $customs[$custom_key]['TransportType'] = $transport_types[$custom['TransportData']['transport_type_id']]['TransportType'];
//            $customs[$custom_key]['CompanyType']['type_name'] = $company_types[$custom['Custom']['user_id']];
//        }


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

        $limit_array = $this->params['named'];
        $limit = (empty($limit_array['limit']))?100:$limit_array['limit'];
        $this->set('limit', $limit);

//        $users = array(0 => 'Все');
        $users = $this->User->find('list', array(
            'conditions' => array(
                'User.role_id' => 1
            ),
            'fields' => array('username')
        ));

        $this->set('users', $users);

        $custom_status_types_list = array(0 => 'Все');
        $custom_status_types_list += $this->CustomStatusType->find('list');
        //$custom_status_types_list += Set::combine($custom_status_types, '{n}.CustomStatusType.id', '{n}.CustomStatusType.name');
        $this->set('custom_status_type_list', $custom_status_types_list);
    }

    function adm_view($id, $type='simple') {
        $this->pageTitle = 'Заказ №'.$id;
        $this->layout = 'admin';
        //custom
        $this->Custom->unbindModel(array(
            'hasMany' => array(
                'CustomStatus'
            )
        ));
        $custom = $this->Custom->find('first', array(
            'conditions' => array(
                'Custom.id' => $id
            ),
            'contain' => array(
                'CustomStatusType',
                'User',
                'PayType',
                'TransportData',
                'CustomDet' => array(
                    'Product',
                    'ProductDet'
                ),
                'CustomClientInfo'
            )
        ));

        $company_types = $this->CompanyType->find('first', array('conditions' => array('CompanyType.id' => $custom['CustomClientInfo'][0]['company_type_id'])));

        if(empty($custom)) {
            $this->redirect(array(
                'controller' => 'customs',
                'action' => 'adm_custom'
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
            if($this->curUser['User']['role_id'] == 3) {
                $custom['CustomStatus'][$custom_status_key]['can_delete'] = true;
            } else {
                $custom['CustomStatus'][$custom_status_key]['can_delete'] =
                    $custom['CustomStatus'][$custom_status_key]['User']['id'] == $this->curUser['User']['id'];
            }
        }
        
        foreach($custom['CustomDet'] as &$custom_det) {
            if(!empty($custom_det['ProductDet'])) {
                $custom_det['code_1c'] = $custom_det['ProductDet']['code_1c'];
                $custom_det['name_1c'] = $custom_det['ProductDet']['name_1c'];
            } else if(!empty($custom_det['Product'])) {
                $custom_det['code_1c'] = $custom_det['Product']['code_1c'];
                $custom_det['name_1c'] = $custom_det['Product']['name_1c'];
            }
        }

        $this->set('custom', $custom);
        $this->set('company_types', $company_types);

        $custom_status_types = Set::combine($custom_status_types, '{n}.CustomStatusType.id', '{n}.CustomStatusType.name');
        $this->set('custom_status_types', $custom_status_types);

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
            'created' => date('Y.m.d H:i:s'),
            'user_id' => $this->curUser['User']['id']
        );
        $this->CustomStatus->create();
        $this->CustomStatus->save($data);
        Cache::delete('custom_status');

        $this->Custom->id = $custom_id;
        $this->data['Custom']['custom_status_type_id'] = $custom_status_type_id;
        if ($this->Custom->save($this->data, $validate = true, $fieldList = array('custom_status_type_id'))) {
          Cache::delete('custom');
        }

        $custom_status_id = $this->CustomStatus->id;
        $this->set('custom_status_id', $custom_status_id);

        $custom_status_type = $this->CustomStatusType->find('first', array(
            'conditions' => array(
                'CustomStatusType.id' => $custom_status_type_id
            )
        ));

        $this->set('custom_status_type', $custom_status_type);

        //отправка email уведомления о смене статуса
        $custom = $this->Custom->find('first', array(
            'conditions' => array(
                'Custom.id' => $custom_id
            ),
            'contain' => array(
                'User'
            )
        ));
        $email = $custom['User']['email'];
        $new_custom_status_name = $custom_status_type['CustomStatusType']['name'];

        if(!empty($email)) {
            $this->SendEmail->send_img($email,
                    "MTO Angelika. Custom modification",
                    "Здравствуйте, {$custom['User']['username']}!<br><br>
                    \"Склад Магазин Торгового Оборудования\" Анжелика уведомляет вас
                    о смене статуса одного из ваших заказов на \"{$new_custom_status_name}\".
                    Просмотреть информацию о заказе вы можете по адресу: <br><br>
                    <a href='http://".$this->Session->host.$this->webroot."customs/view/$custom_id"."'>http://".$this->Session->host.$this->webroot."customs/view/$custom_id</a><br><br>
                    По всем возникающим вопросам обращайтесь: mto24@mail.ru");
        }

        $this->redirect('adm_view/'.$custom_id);

    }

    function delete_status($custom_status_id, $custom_id) {
        //удалить статус у заказа

        $can_update = true;

        if($this->curUser['User']['role_id'] != 3) {
            $custom_status = $this->CustomStatus->find('first', array(
                'conditions' => array(
                    'CustomStatus.id' => $custom_status_id
                ),
                'recursive' => -1
            ));
            if($custom_status['CustomStatus']['user_id'] != $this->curUser['User']['id']) {
                $can_update = false;
            }
        }

        if($can_update) {
            $this->CustomStatus->id = $custom_status_id;
            $this->CustomStatus->delete();
            Cache::delete('custom_statuses');

            // смотрим новый статус
            $custom_status_type_new = $this->CustomStatus->find('first', array(
                'fields' => array('CustomStatus.custom_status_type_id'),
                'conditions' => array('CustomStatus.custom_id' => $custom_id),
                'recursive' => -1,
                'order' => 'CustomStatus.created DESC'
            ));

            $this->Custom->id = $custom_id;
            $this->data['Custom']['custom_status_type_id'] = $custom_status_type_new['CustomStatus']['custom_status_type_id'];
            if ($this->Custom->save($this->data, $validate = true, $fieldList = array('custom_status_type_id'))) {
              Cache::delete('custom');
            }

        }

        $this->set('can_update', $can_update);
        $this->redirect('adm_view/'.$custom_id);
    }

}

?>
