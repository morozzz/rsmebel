<?php
//
App::import('Component', 'Auth');

//
//
//
class Auth2Component extends AuthComponent {

        function login($data = null) {
            //авторизация на форуме
            App::import('Vendor', '/phpbb_login/phpbb_login');
            $phpbb_login = new PHPBB_Login();
            if($phpbb_login->login($this->ForumData['username'], $this->ForumData['password']) != 1) {
//                $this->Session->setFlash($this->loginError, 'default', array(), 'auth');
//                $this->controller->redirect($this->controller->referer());die;
            }
            
            $login = parent::login($data);
            if($login == 1) {
                $user = $this->User();

                $this->controller->UserLog->create();
                $this->controller->UserLog->save(array(
                    'user_id' => $user['User']['id'],
                    'stamp' => date('d.m.Y H:i:s'),
                    'ip_addr' => $_SERVER['REMOTE_ADDR'],
                    'user_log_type_id' => 1
                ));

                $role_id = $user['User']['role_id'];
                if($role_id == 2) $this->Session->write('Auth.redirect', 'manager');
                if($role_id == 3) $this->Session->write('Auth.redirect', 'admin');
            }
            return $login;
        }

        function logout() {
            //выход из форума
            App::import('Vendor', '/phpbb_login/phpbb_login');
            $phpbb_login = new PHPBB_Login();
            $phpbb_login->logout();

            return parent::logout();
        }

	//
	// Initialize component 
	// and copy from controller property which handled by AuthComponent
	// This lets you not generate ugly beforeFilter initialization function but static definitions
	//
	function initialize(&$controller) {
            $this->controller = $controller;
            if(!empty($controller->data['User']))
                $this->ForumData = $controller->data['User'];
		//
	    $controller_reflection = new ReflectionObject($controller);
	    $controller_properties = $controller_reflection->getProperties();
        //
	    $parent_reflection = new ReflectionObject($this);

		//
  		foreach($controller_properties as $property){
  			//
  			$property_name = $property->getName();
  			if(!$parent_reflection->hasProperty($property_name))
  				continue;
            //
            if(isset($this->{$property_name}) && !empty($this->{$property_name}))
            	continue;
  			if(!isset($controller->{$property_name}) || empty($controller->{$property_name}))
  				continue;
  			//
  			$this->{$property_name} = $controller->{$property_name};
  		}

  		//
		return parent::initialize($controller);
	}

	//
	// Generates password string
	//
	function createPassword($length = 8, $allowed_symbols = '23456789abcdeghkmnpqsuvxyz') {
		$keystring       = '';
		
		// Next code taken and modified from kcaptcha
		// generating random keystring
		while(true){
			$keystring='';
			for($i=0;$i<$length;$i++){
				$keystring.=$allowed_symbols{mt_rand(0,strlen($allowed_symbols)-1)};
			}
			if(!preg_match('/cp|cb|ck|c6|c9|rn|rm|mm|co|do|cl|db|qp|qb|dp/', $keystring)) break;
		}

		//
		return $keystring;
	}
	
	//
	// You could define here your own way to hash password
	// Handy when has to support legacy applications
	//
	function password($password) {
		return parent::password($password);
	}
}
?>