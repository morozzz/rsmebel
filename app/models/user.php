<?php

class User extends AppModel {
    var $name = 'User';
    var $belongsTo = array(
        'Role'
    );
    var $hasOne = array(
        'ClientInfo' => array(
            'className' => 'ClientInfo',
            'conditions' => array(
                'ClientInfo.filial_type_id' => 0
            )
        )
    );

    var $transactional = true;

    var $field_types = array(
        'username' => 'text',
        'password' => 'text',
        'clean_password' => 'text',
        'email' => 'text',
        'role_id' => 'number',
        'is_active' => 'number'
    );
    var $order = 'User.role_id, User.created DESC, User.username';

    var $validate = array(

        'username' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => 'Введите логин',
                'last' => true
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Такой логин уже существует',
                'last' => true
            )
         ),

        'email' => array(
            'notempty' => array(
                'rule' => 'notEmpty',
                'message' => 'Введите адрес электронной почты',
                'last' => true
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Электронный адрес уже существует',
                'last' => true
            ),
            'email' => array(
                'rule' => 'email',
                'message' => 'Неверный адрес электронной почты',
                'last' => true
            )
         ),

        'password' => array(
            'notempty' => array(
                'rule' => VALID_NOT_EMPTY,
                'message' => 'Введите пароль',
                'last' => true
            ),
            'conf' => array(
                'rule' => VALID_HAS_PAIR,
                'message' => 'Пароль и подтверждение не совпадают',
                'last' => true
            )
         ),

        'captcha' => array(
            'cap' => array(
                'rule' => VALID_HAS_PAIR,
                'message' => 'Неверно введен код',
                'last' => true
            )
         )

    );

    function beforeSave() {
        if(empty($this->id) && empty($this->data['User']['id'])) {
            //сохраняем IP
            $this->data['User']['ip_addr'] = $_SERVER['REMOTE_ADDR'];

            //регистрация на форуме
            App::import('Vendor', '/phpbb_login/phpbb_login');
            $phpbb_login = new PHPBB_Login();
            $username = $this->data['User']['username'];
            $email = $this->data['User']['email'];
            $password = $this->data['User']['clean_password'];
            return $phpbb_login->register($username, $password, $email);
        } else {
            if(!empty($this->data['User']['clean_password'])) {
                //смена пароля на форуме
                App::import('Vendor', '/phpbb_login/phpbb_login');
                $phpbb_login = new PHPBB_Login();
                $username = $this->data['User']['username'];
                $password = $this->data['User']['clean_password'];
                $query = $phpbb_login->change_password($username, $password);
                $this->query($query);
            }
        }
        return true;
    }

    function afterSave($created) {
        if($created) {
            //проверяем наличие информации о клиенте
            if($created) {
                $cnt = $this->ClientInfo->find('count', array(
                    'conditions' => array(
                        'ClientInfo.id' => $this->id
                    )
                ));
                if($cnt==0) {
                    $this->ClientInfo->create();
                    $this->ClientInfo->save(array(
                        'user_id' => $this->id
                    ));
                }
            }
        }
    }

    function afterFind($results, $primary) {
        foreach($results as &$result) {
            if(!empty($result['User']) && !empty($result['User']['created']))
                $result['User']['created'] =
                    date('d.m.Y', strtotime($result['User']['created']));
            if(!empty($result['User']) && !empty($result['User']['updated']))
                $result['User']['updated'] =
                    date('d.m.Y', strtotime($result['User']['updated']));
        }
        return $results;
    }
}

?>
