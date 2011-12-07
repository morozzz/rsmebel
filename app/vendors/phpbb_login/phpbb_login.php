<?php

class PHPBB_Login {
    function login($username, $password) {
        define('IN_PHPBB', true);
        define('PHPBB_ROOT_PATH', '../../forum/');
        global $db, $cache, $config, $user, $phpbb_root_path, $phpEx, $template, $auth;
        $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../forum';

        $phpEx = substr(strrchr(__FILE__, '.'), 1);
        include($phpbb_root_path . 'common.' . $phpEx);

        //// Start session management
        $user->session_begin();
        $auth->acl($user->data);
        $user->setup('ucp');

        $config['max_login_attempts'] = false;//отменяем капчу при многократных попытках захода
        $login = $auth->login($username, $password, false);

        if($login['status'] == LOGIN_SUCCESS) {
            return 1;
        } else {
            return 0;
        }
    }

    function logout() {
        define('IN_PHPBB', true);
        define('PHPBB_ROOT_PATH', '../../forum/');
        global $db, $cache, $config, $user, $phpbb_root_path, $phpEx, $template, $auth;
        $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../forum';

        $phpEx = substr(strrchr(__FILE__, '.'), 1);
        include($phpbb_root_path . 'common.' . $phpEx);

        //// Start session management
        $user->session_begin();
        $auth->acl($user->data);
        $user->setup('ucp');

        $user->session_kill();
    }

    function register($username, $password, $email) {
        define('IN_PHPBB', true);
        define('PHPBB_ROOT_PATH', '../../forum/');
        global $db, $cache, $config, $user, $phpbb_root_path, $phpEx, $template, $auth;
        $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../forum';

        $phpEx = substr(strrchr(__FILE__, '.'), 1);
        include($phpbb_root_path . 'common.' . $phpEx);
        require($phpbb_root_path . 'includes/functions_user.' . $phpEx);

        //// Start session management
        $user->session_begin();
        $auth->acl($user->data);
        $user->setup('ucp');

        $user_data = array(
            'username' => $username,
            'user_password' => phpbb_hash($password),
            'user_email' => $email,
            'group_id' => 0,
            'user_type' => 0
        );
        $user_id = user_add($user_data);
        return $user_id;
    }

    function change_password($username, $new_password) {
        define('IN_PHPBB', true);
        define('PHPBB_ROOT_PATH', '../../forum/');
        global $db, $cache, $config, $user, $phpbb_root_path, $phpEx, $template, $auth;
        $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../forum';

        $phpEx = substr(strrchr(__FILE__, '.'), 1);
        include($phpbb_root_path . 'common.' . $phpEx);

        //// Start session management
        $user->session_begin();
        $auth->acl($user->data);
        $user->setup('ucp');

        $username = $db->sql_escape($username);
        $new_password_hash = phpbb_hash($new_password);
        $query = "UPDATE `phpbb_users` SET `user_password` = '$new_password_hash' WHERE `username` = '$username';";
        return $query;

    }
}


?>