<?php

class UsersController extends AppController {
    var $name = 'Users';
    var $components = array('Captcha', 'Email', 'SendEmail', 'AdminCommon');
    var $allowedActions = array('register', 'restore', 'captcha', 'confirm', 'login', 'logout');
    var $uses = array("User", "UserLog", "CompanyType", "ClientType", "ProfilType", "ClientInfo", "Role");
    var $helpers = array('Form', 'Session', 'Ajax', 'Javascript', 'AdminCommon');
    var $actionJs = array(
        "jquery-ui-1.8.5.custom.min",
        "prototype",
        "scriptaculous.js?load=effects"
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('login');
        $this->Auth2->allow('logout');
        $this->Auth2->allow('register');
        $this->Auth2->allow('registr_end');
        $this->Auth2->allow('list_filials');
        $this->Auth2->allow('edit_filial');
        $this->Auth2->allow('delete_filial');
        $this->Auth2->allow('restore');
        $this->Auth2->allow('captcha');
        $this->Auth2->allow('confirm');
        $this->Auth2->allow('confirm_end');
        $this->Auth2->allow('sendd');
    }

    function sendd() {

        $tt = $this->SendEmail->sendd();
		if(!$tt)
        {
			$this->Session->setFlash('Сообщение успешно отправлено = '.$tt, 'default', array('class' => 'info-message'));
        }
        else {
        	$this->Session->setFlash('Ошибка сервера. Невозможно отправить сообщение. Обратитесь к администрации.'.$tt, 'default', array('class' => 'info-message'));
        }
    }

    //
    function login() {
        $this->pageTitle = "Авторизация пользователей";
        if($this->referer() == '/users/confirm_end')
            $this->Session->write('Auth.redirect', 'catalogs/index');
		// AuthComponent does magic for us!
    }
    function logout() {
    	$this->Auth2->logout();
    	$this->redirect('/catalogs');
    }

    function adm_index() {
      $this->layout = 'admin';
      $this->pageTitle = "Управление пользователями";

      if(empty($this->data['Filter'])) {
          $filter = array(
              'role_id' => 0,
              'is_active' => -1,
              'ip_addr' => ''
          );
      } else {
          $filter = array(
              'role_id' => $this->data['Filter']['role_id'],
              'is_active' => $this->data['Filter']['is_active'],
              'ip_addr' => $this->data['Filter']['ip_addr']
          );
      }
      $this->set('filter', $filter);

      $conditions = array();
      if($filter['role_id'] != 0) {
          $conditions['User.role_id'] = $filter['role_id'];
      }
      if($filter['is_active'] != -1) {
          $conditions['User.is_active'] = $filter['is_active'];
      }
      if($filter['ip_addr']) {
          $conditions['User.ip_addr'] = $filter['ip_addr'];
      }

        $u_users = $this->User->find('all', array(
            'conditions' => $conditions,
            'contain' => array(
                'Role'
            )
        ));
        $u_users = Set::combine($u_users, '{n}.User.id', '{n}');
        $this->set('u_users', $u_users);

        $role_list = $this->Role->find('list');
        $this->set('role_list', $role_list);

        $filter_role_list = array(0 => 'Все');
        $filter_role_list += $role_list;
        $this->set('filter_role_list', $filter_role_list);

        $is_active_list = array(
            -1 => 'Все',
            1 => 'Активные',
            0 => 'Неактивные'
        );
        $this->set('is_active_list', $is_active_list);

        $ip_addrs = $this->User->find('all', array(
            'fields' => array(
                'User.ip_addr'
            ),
            'group' => array(
                'User.ip_addr'
            )
        ));
        $js_ipaddrs = array();
        $ip_addrs = Set::combine($ip_addrs, '{n}.User.ip_addr', '{n}.User.ip_addr');
        foreach($ip_addrs as $ip_addr) $js_ipaddrs[] = $ip_addr;
        $this->set('ip_addrs', $js_ipaddrs);

        $cnt_active = $this->User->find('count', array(
            'conditions' => array(
                'User.is_active' => 1
            ),
            'contain' => array()
        ));
        $this->set('cnt_active', $cnt_active);

        $cnt_inactive = $this->User->find('count', array(
            'conditions' => array(
                'User.is_active' => 0
            ),
            'contain' => array()
        ));
        $this->set('cnt_inactive', $cnt_inactive);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->User);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->data['clean_password'] = $this->data['password'];
        $this->data['password'] = $this->Auth2->password($this->data['password']);
//        $this->data['password_confirm'] = $this->Auth2->password($this->data['password_confirm']);
//        debug($this->data);
        $this->AdminCommon->add($this->data, $this->User);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->User);
        die;
    }

    function change_password() {
        $this->User->id = $this->data['row_id'];
        $this->User->validate = array();
        $this->User->save(array(
            'id' => $this->data['row_id'],
            'password' => $this->Auth2->password($this->data['password'])
        ));
        die;
    }

    function delete_list() {
        $this->AdminCommon->delete_list($this->data, $this->User);
        die;
    }

    function user_logs($user_id) {
        $this->layout = 'admin';
        $this->pageTitle = 'Лог пользователя';

        $u_user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id
            )
        ));
        $this->set('u_user', $u_user);

        $user_logs = $this->UserLog->find('all', array(
            'conditions' => array(
                'UserLog.user_id' => $user_id
            ),
            'contain' => array(
                'UserLogType'
            )
        ));
        $user_logs = Set::combine($user_logs, '{n}.UserLog.id', '{n}');
        $this->set('user_logs', $user_logs);
    }

//    function adm_index($u_role_id = null) {
//      $this->layout = 'admin';
//      $this->pageTitle = "Управление пользователями";
//
//      if (empty($u_role_id)) {
//        $u_role_id = 0;
//      }
//
//      if(($u_roles = Cache::read('u_roles')) === false) {
//        $u_roles = $this->Role->find('all');
//        Cache::write('u_roles', $u_roles);
//      }
//      $this->set('u_roles', $u_roles);
//
//      $this->set('u_role_id', $u_role_id);
//
//      $this->User->unbindModel(array(
//          'hasOne' => array('ClientInfo')
//      ));
//
//      if ($u_role_id != 0) {
//        $u_users = $this->User->find('all', array('order' => 'role_id', 'conditions' => array('role_id' => $u_role_id)));
//      }
//      else {
//        if(($u_users = Cache::read('u_users')) === false) {
//          $u_users = $this->User->find('all', array('order' => 'role_id'));
//          Cache::write('u_users', $u_users);
//        }
//      }
//      $i = 0;
//      foreach ($u_users as $u_user) {
//        if ($u_users[$i]['User']['is_active'] == 1) {
//           $u_users[$i]['User']['active_value'] = "<img src='".$this->webroot."img/accept.png'>";
//        }
//        else {
//           $u_users[$i]['User']['active_value'] = "<img src='".$this->webroot."img/delete.png'>";
//        }
//        $i++;
//      }
//
//      $this->set('u_users', $u_users);
//
//    }

    function adm_reg_del($id = null) {
      $this->layout = 'admin';
      $this->pageTitle = "Управление пользователями - Удалить";

      if(($u_roles = Cache::read('u_u_roles')) === false) {
        $u_roles = $this->Role->find('all', array('conditions' => array('id <>' => 3)));
        Cache::write('u_u_roles', $u_roles);
      }
      $this->set('u_roles', $u_roles);

      if(!empty($this->data)) {
          
        $this->User->id = $id;
        $this->ClientInfo->deleteAll(array('ClientInfo.user_id' => $id));
        $this->User->delete($this->data);
        Cache::delete('u_users');
        Cache::delete('adm_users');

        $this->redirect(array('controller' => 'users', 'action' => 'adm_index'));

      }
      else if ($id <> null){

        $this->set('u_action', 'delete');

        $this->User->id = $id;
        $this->data = $this->User->read();
        $this->set('u_user', $this->User->read());

        $this->set('u_role_id', $this->data['User']['role_id']);
        $this->set('is_active', $this->data['User']['is_active']);
      }
    }

    function adm_registr($id = null) {

      $this->layout = 'admin';
      $this->pageTitle = "Управление пользователями - Добавить/Редактировать";

      if(($u_roles = Cache::read('u_u_roles')) === false) {
        $u_roles = $this->Role->find('all', array('conditions' => array('id <>' => 3)));
        Cache::write('u_u_roles', $u_roles);
      }
      $this->set('u_roles', $u_roles);

      if(!empty($this->data)) {

            if($id == null) {

                $this->set('u_action', 'insert');

                if($this->data['User']['password'] == 'e6368f2fa42edc4f72027f4c33e4fcb1d50fcca2'){
                    $this->User->invalidate('password', 'Введите пароль');
                    return;
                }

                $this->data['User']['password_confirm'] = $this->Auth2->password($this->data['User']['password_confirm']);

                $this->User->create();
                if(!$this->User->saveall($this->data))
                  return;

                Cache::delete('u_users');
                Cache::delete('adm_users');
                $this->redirect(array('controller' => 'users', 'action' => 'adm_registr/'.$this->User->id));
                $this->Session->setFlash('Пользователь успешно добавлен', 'default', array('class' => 'info-message'));

            }
            else {

                  $this->set('u_action', 'update');

                  $this->User->id = $id;
                  if($this->User->save($this->data, $validate = true, $fieldList = array('username', 'email', 'is_active', 'role_id'))) {
                      Cache::delete('u_users');
                      Cache::delete('adm_users');
                      if($this->User->ClientInfo->save($this->data)){
                        $this->User->id = $id;
                        $this->data = $this->User->read();
                        $this->set('u_user', $this->User->read());
                        $this->Session->setFlash('Данные сохранены успешно', 'default', array('class' => 'info-message'));
                      }
                  }
            }
      }
      else if ($id <> null){

        $this->set('u_action', 'update');
                  
//        $this->User->id = $id;
//        $this->data = $this->User->read();
//        $this->set('u_user', $this->User->read());

        $u_user = $this->User->find('first', array('conditions' => array('ClientInfo.user_id' => $id,
                                                                       'ClientInfo.filial_type_id' => 0)));

        $this->data = $u_user;
        $this->set('u_user', $u_user);

      }

      $this->set('u_role_id', $this->data['User']['role_id']);
      $this->set('is_active', $this->data['User']['is_active']);

    }

    function adm_pas_change($id = null) {

      $this->layout = 'admin';
      $this->pageTitle = "Управление пользователями - Сменить пароль";

      if(($u_roles = Cache::read('u_u_roles')) === false) {
        $u_roles = $this->Role->find('all', array('conditions' => array('id <>' => 3)));
        Cache::write('u_u_roles', $u_roles);
      }
      $this->set('u_roles', $u_roles);

      if(!empty($this->data)) {

            if($id <> null) {

              $this->set('u_action', 'update');

              if($this->data['User']['password'] == 'e6368f2fa42edc4f72027f4c33e4fcb1d50fcca2'){
                  $this->User->invalidate('password', 'Введите пароль');
                  return;
              }           

              $this->User->unbindModel(array(
                  'hasOne' => array('ClientInfo')
              ));
              $u_users = $this->User->find('all', array('conditions' => array('User.id' => $id)));
              $username = $u_users[0]['User']['username'];

              $this->User->id = $id;             
              $password = $this->data['User']['password'];
              $this->data['User']['password'] = $this->Auth2->password($this->data['User']['password']);
              $this->data['User']['password_confirm'] = $this->Auth2->password($this->data['User']['password_confirm']);

              if($this->User->save($this->data, $validate = true, $fieldList = array('password'))) {

//                App::import('Core', 'HttpSocket');
//                $forumroot = str_replace('cake', 'forum', $this->Session->host.$this->webroot);
//                $HttpSocket = new HttpSocket();
//                $results = $HttpSocket->post('http://'.$forumroot.'phpbb_password_restore.php', array(
//                    'username' => $username,
//                    'password' => $password
//                ));

                Cache::delete('u_users');
                Cache::delete('adm_users');
                $this->User->id = $id;
                $this->data = $this->User->read();
                $this->set('u_user', $this->User->read());
                $this->Session->setFlash('Пароль успешно изменен', 'default', array('class' => 'info-message'));
              }
              else {
                $this->User->id = $id;
                $this->data = $this->User->read();
                $this->set('u_user', $this->User->read());
                $this->Session->setFlash('Пароль и подтверждение не совпадают', 'default', array('class' => 'info-message'));
              }
            }
      }
      else if ($id <> null){

        $this->set('u_action', 'update');

//        $this->User->id = $id;
//        $this->data = $this->User->read();
//        $this->set('u_user', $this->User->read());

        $u_user = $this->User->find('first', array('conditions' => array('ClientInfo.user_id' => $id,
                                                                         'ClientInfo.filial_type_id' => 0)));

        $this->data = $u_user;
        $this->set('u_user', $u_user);

      }

      $this->set('u_role_id', $this->data['User']['role_id']);
      $this->set('is_active', $this->data['User']['is_active']);

    }

    function register() {

        $this->actionCss = array('basket');

        $this->pageTitle = "Персональные данные пользователя";

        if(($company_types = Cache::read('company_types')) === false) {
          $company_types = $this->CompanyType->find('list');
          Cache::write('company_types', $company_types);
        }
        $this->set('companyTypes', $company_types);

        if(($client_types = Cache::read('client_types')) === false) {
          $client_types = $this->ClientType->find('list');
          Cache::write('client_types', $client_types);
        }
        $this->set('clientTypes', $client_types);


        if(($profil_types = Cache::read('profil_types')) === false) {
          $profil_types = $this->ProfilType->find('list');
          Cache::write('profil_types', $profil_types);
        }
        $this->set('profilTypes', $profil_types);

        $id = $this->Session->read('Auth.User.id');
        if (empty($id)) { $id = null; }

        if(!empty($this->data)) {

//            $this->data['User']['captcha_confirm'] = $this->Session->read('captcha');
//
//            if ($this->data['User']['captcha_confirm'] <> $this->data['User']['captcha']) {
//              $this->Session->setFlash('Неверно введен код с картинки', 'default', array('class' => 'info-message'));
//              return;
//            }            
            if($id == null) {

                if($this->data['User']['password'] == 'e6368f2fa42edc4f72027f4c33e4fcb1d50fcca2'){
                    $this->User->invalidate('password', 'Введите пароль');
                    return;
                }
                if ($this->data['ClientInfo']['client_type_id'] <> 1) {
                    if(empty($this->data['ClientInfo']['name'])){
                        $this->ClientInfo->invalidate('name', 'Введите название организации');
                        return;
                    }
                }
                $password = $this->data['User']['password_confirm'];
                $this->data['User']['password_confirm'] = $this->Auth2->password($this->data['User']['password_confirm']);
                $this->data['User']['clean_password'] = $password;

                if ($this->data['User']['role_id'] == 1) {
                        
                    // Try to create user
                    $activation_token = $this->Auth2->createPassword(36);
                    $this->data['User']['activation_token'] = $activation_token;

                    $this->User->create();
                    if(!$this->User->saveall($this->data))
                      return;

                    Cache::delete('u_users');
                    Cache::delete('adm_users');
                    // Send an email with activation link
                    //if(1==2)
                    if(!$this->SendEmail->send_img($this->data['User']['email'],
                                               "RegionSibMebel. Registration",
                                               "Здравствуйте ".$data['User']['username']."!<br><br>
                                                Вы успешно зарегистрированы на сайте компании \"РегионСибМебель\".<br>
                                                <font color='red'>Для активации вашего логина пройдите по ссылке:\n <u><a href='http://".$this->Session->host.$this->webroot."users/confirm/".$activation_token."'>Активация</a></u></font><br>
                                                Для редактирования персональных данных и управления подпиской
                                                на новости вы можете войти в систему после активации.<br><br>
                                                Для этого Вам необходимо зайти на страницу\n <a href='http://".$this->Session->host.$this->webroot."users/login"."'>http://".$this->Session->host.$this->webroot."users/login</a><br>
                                                затем набрать ваш логин: ".$this->data['User']['username']."<br>
                                                и пароль: ".$password."<br><br>
                                                По всем возникающим вопросам обращайтесь: regionsibmebel@mail.ru"))
                    {
			          $this->User->rollback();
                      $this->ClientInfo->rollback();
			          $this->Session->setFlash('Ошибка сервера. Невозможно отправить сообщение. Обратитесь к администрации.', 'default', array('class' => 'info-message'));
                    }
                    else {
                        $this->User->commit();
                        //$this->Auth2->login($this->data);
                        $this->redirect('/users/registr_end/'.$this->data['User']['email']);
                    }
                }
                else {
         			$this->Session->setFlash('Нета роль!', 'default', array('class' => 'info-message'));
                }
            }
            else {
              
              $this->User->id = $id;
              $this->data['User']['password_confirm'] = $this->Auth2->password($this->data['User']['password_confirm']);
              
              if ($this->data['User']['password'] <> 'e6368f2fa42edc4f72027f4c33e4fcb1d50fcca2') {
                $save_data = $this->User->save($this->data, $validate = true, $fieldList = array('username', 'email', 'password'));
              }
              else {
                $save_data = $this->User->save($this->data, $validate = true, $fieldList = array('username', 'email'));
              }
              
              if($save_data) {
                  Cache::delete('u_users');
                  Cache::delete('adm_users');
                  if($this->User->ClientInfo->save($this->data)){
                    $this->User->id = $id;
                    $this->data = $this->User->read();
                    $this->set('u_user', $this->User->read());
         			$this->Session->setFlash('Ваши данные сохранены успешно', 'default', array('class' => 'info-message'));
                  }
              }
            }
        }
        else if ($id <> null){

              $u_user = $this->User->find('first', array('conditions' => array('ClientInfo.user_id' => $id,
                                                                               'ClientInfo.filial_type_id' => 0)));

              $this->data = $u_user;            

//              $this->User->id = $id;
//              $this->data = $this->User->read();
//              $u_user = $this->User->read();
//
//              debug($u_user);
            }
    }

    function registr_end($email) {
       $this->pageTitle = "Регистрация пользователя";
       $this->set('user_email', $email);

       $this->Session->setFlash("<font size = 4> Вы успешно зарегистрированы.</font><br>
                                 <font color=white> Данные для активации отправлены на </font><font color=yellow>".$email."</font><br>
                                 <font color=white>Для активации вашего логина, вам необходимо
                                 зайти в свой почтовый ящик и перейти по указанной ссылке. <font color=white><br>
                                 </font><font color=yellow> Добро пожаловать!</font>", 'default', array('class' => 'info-message'));

    }

    function list_filials() {
        $this->pageTitle = "Персональные данные пользователя - Филиалы";

        $this->actionCss = array('basket');

        $id = $this->Session->read('Auth.User.id');
        $filials = $this->ClientInfo->find('all', array('conditions' => array('ClientInfo.user_id' => $id),
                                                        'order' => array('ClientInfo.filial_type_id, ClientInfo.name')
                                                       ));

        $i = 0;
        foreach ($filials as $filial) {

          if ($filials[$i]['ClientInfo']['filial_type_id'] == 0) {
            $filials[$i]['ClientInfo']['filial_type_name'] = 'Основной';
          }
          else { $filials[$i]['ClientInfo']['filial_type_name'] = 'Дополнительный';  }
          $i++;
        }

        $this->set('filials', $filials);

    }

    function edit_filial($client_info_id = null) {

        $this->actionCss = array('basket');

        $this->pageTitle = "Персональные данные пользователя - Филиалы";

        if(($company_types = Cache::read('company_types')) === false) {
          $company_types = $this->CompanyType->find('list');
          Cache::write('company_types', $company_types);
        }
        $this->set('companyTypes', $company_types);


        if(($profil_types = Cache::read('profil_types')) === false) {
          $profil_types = $this->ProfilType->find('list');
          Cache::write('profil_types', $profil_types);
        }
        $this->set('profilTypes', $profil_types);

        if(($client_types = Cache::read('client_types')) === false) {
          $client_types = $this->ClientType->find('list');
          Cache::write('client_types', $client_types);
        }
        $this->set('clientTypes', $client_types);

        $id = $this->Session->read('Auth.User.id');
        if (!empty($id)) {

            if(!empty($this->data)) {

              $this->User->id = $id;

              if($this->User->ClientInfo->save($this->data)){

                Cache::delete('u_users');
                Cache::delete('adm_users');

                $this->redirect('/users/list_filials');
                //$this->Session->setFlash('Ваши данные сохранены успешно', 'default', array('class' => 'info-message'));
              }
            }
            else {

              if (empty($client_info_id)) {
                  $cnt_filial = $this->User->find('count', array('conditions' => array('ClientInfo.user_id' => $id,
                                                                                       'ClientInfo.filial_type_id' => 1)));

                  if ($cnt_filial == 0) { $filial_type_id = 0; } else { $filial_type_id = 1; }

                    $u_user = $this->User->find('first', array('conditions' => array('ClientInfo.user_id' => $id,
                                                                                     'ClientInfo.filial_type_id' => $filial_type_id)));

                $u_user['ClientInfo']['id'] = null;
                $u_user['ClientInfo']['name'] = null;
                $u_user['ClientInfo']['company_type_id'] = null;
                $u_user['ClientInfo']['profil_type_id'] = null;
                $u_user['ClientInfo']['client_type_id'] = null;
              }
              else {
                $u_user = $this->User->find('first', array('conditions' => array('ClientInfo.id' => $client_info_id,
                                                                                 'ClientInfo.filial_type_id' => 1)));
              }
              $this->data = $u_user;
            }
        }

    }

    function delete_filial($client_info_id) {

        $this->pageTitle = "Персональные данные пользователя - Филиалы";

        $this->actionCss = array('basket');

        if(($company_types = Cache::read('company_types')) === false) {
          $company_types = $this->CompanyType->find('list');
          Cache::write('company_types', $company_types);
        }
        $this->set('companyTypes', $company_types);


        if(($profil_types = Cache::read('profil_types')) === false) {
          $profil_types = $this->ProfilType->find('list');
          Cache::write('profil_types', $profil_types);
        }
        $this->set('profilTypes', $profil_types);

        if(($client_types = Cache::read('client_types')) === false) {
          $client_types = $this->ClientType->find('list');
          Cache::write('client_types', $client_types);
        }
        $this->set('clientTypes', $client_types);

        $id = $this->Session->read('Auth.User.id');
        if (!empty($client_info_id)) {

            if(!empty($this->data)) {

              $this->ClientInfo->id = $client_info_id;

              if($this->User->ClientInfo->delete($this->data)){

                Cache::delete('u_users');
                Cache::delete('adm_users');

                $this->redirect('/users/list_filials');
                //$this->Session->setFlash('Ваши данные сохранены успешно', 'default', array('class' => 'info-message'));
              }
            }
            else {

              $u_user = $this->User->find('first', array('conditions' => array('ClientInfo.id' => $client_info_id,
                                                                               'ClientInfo.filial_type_id' => 1)));
              $this->data = $u_user;
            }
        }
    }


	// Restore user password
    function restore() {

        $this->pageTitle = "Восстановление пароля пользователя";

    	if(empty($this->data))
    		return;

		// Check email is correct
		$data = $this->User->findByEmail($this->data['User']['email'], array('id', 'username', 'email'));
		if(!$data) {
			$this->User->invalidate('email', 'Электронный адрес не зарегистрирован');
			return;
		}

//        $this->data['User']['captcha_confirm'] = $this->Session->read('captcha');
//
//        if($this->data['User']['captcha_confirm'] <> $this->data['User']['captcha']){
//			$this->User->invalidate('captcha', 'Неверно введен код');
//			return;
//        }

		// Generate new password
		$password = $this->Auth2->createPassword();

		$data['User']['password']  =
		$data['User']['password_confirm'] = $this->Auth2->password($password);
                $data['User']['clean_password'] = $password;
		$this->User->begin();
		if(!$this->User->save($data)) {
			$this->User->rollback();
			return;
		}
        
        Cache::delete('u_users');
        Cache::delete('adm_users');
		// Send email
		if(!$this->SendEmail->send_img($data['User']['email'],
							       "RegionSibMebel. Restore password",
		                           "Здравствуйте ".$data['User']['username']."!<br><br>
                                    Вы успешно зарегистрированы на сайте компании \"РегионСибМебель\".<br>
                                    Для редактирования персональных данных и управления подпиской
                                    на новости вы можете войти в систему после активации.<br><br>
                                    Для этого Вам необходимо зайти на страницу\n <a href='http://".$this->Session->host.$this->webroot."users/login"."'>http://".$this->Session->host.$this->webroot."users/login</a><br>
                                    затем набрать ваш логин: ".$data['User']['username']."<br>
                                    и пароль: ".$password."<br><br>
                                    По всем возникающим вопросам обращайтесь: regionsibmebel@mail.ru"))
        {
			$this->User->rollback();
			$this->Session->setFlash('Ошибка сервера. Невозможно отправить сообщение. Обратитесь к администрации.', 'default', array('class' => 'info-message'));
		}
		else {
			$this->User->commit();
			$this->Session->setFlash('Новый пароль отправлен по адресу '.$data['User']['email'].'.', 'default', array('class' => 'info-message'));

		}

    }

	// Confirm user email by token
	function confirm($activation_token = '') {
		if($activation_token === '')
			$this->redirect('register');
		if(!($data = $this->User->findByActivationToken($activation_token, array('id', 'username', 'is_active', 'activation_token'))))
			$this->redirect('register');

		// Activate user account
		$data['User']['is_active'] = 1;
		$data['User']['activation_token'] = '';
		$this->User->save($data);
        Cache::delete('u_users');
        Cache::delete('adm_users');

        $this->redirect("/users/confirm_end");
	}

    function confirm_end() {
       $this->pageTitle = "Активация пользователя";

       $this->Session->setFlash("Ваш пользователь успешно активирован.<br>
                                 Пожалуйста выполните вход.<br>
                                 Для этого Вам необходимо пройти по ссылке\n <a href='http://".$this->Session->host.$this->webroot."users/login"."'>Вход для пользователей</a><br>
                                 и ввести свой логин и пароль.<br>
                                 Добро пожаловать!", 'default', array('class' => 'info-message'));
    }

	// Generates captcha image
    function captcha() {
   //   if($this->params['isAjax'] == 1) {
        $this->layout = 'ajax';
        App::import('Vendor', '/kcaptcha/kcaptcha');
        $kcaptcha = new KCAPTCHA();
        $this->Session->write('captcha', $kcaptcha->getKeyString());

       // return '/users/captcha';
    }
    
	// Sends an email
//	function _sendEmail($from, $to, $subj, $body) {
//		$this->Email->to   = $to;
//		$this->Email->from = $from;
//		$this->Email->subject = $subj;
//
//        /* SMTP Options */
//        include("email_config.php");
//
//        $this->Email->smtpOptions = $email_config;
//
//        #  /* Set delivery method */
//        $this->Email->delivery = 'smtp';
//        # /* Do not pass any args to send() */
//        # $this->Email->send();
//        # /* Check for SMTP errors. */
//        # $this->set('smtp-errors', $this->Email->smtpError);
//
//		// Attention! Message body going to be wrapped!!!!!	Damn you email component!!!!
//		$this->Email->lineLength = strlen($body);
//		// If want to you templates - dig it yourself
//		return $this->Email->send($body);
//     }
}
?>
