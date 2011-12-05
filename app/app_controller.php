<?php
class AppController extends Controller{
    var $pageCss = array();
    var $actionCss = array();
    var $actionJs = array(
//        "jquery-1.4.2.min",
//        "jquery.dataTables.min",
//        "jquery.form",
//        "jquery.treeview.min",
//        "jquery.fumodal",
//        "common",
//        "jquery-ui-1.8.4.custom.tabs.min"
    );
    var $commonCss = array(
        "jquery.treeview",
        "fumodal",
        "jquery-ui-1.8.5.custom"
    );
    var $components = array('Auth2', 'RequestHandler', 'Cookie');
    var $uses = array(
        'User',
        'HomeFooter',
        'Banner',
        'Str',
        'ClientInfo',
        'Alert',
        'UrlKeyword',
        'UrlDescription',
        'UrlTitle'
    );
    var $helpers = array(
        'Common',
        'Html',
        'Form',
        'Javascript',
        'Cache'
    );

    // Parameters for AuthComponent
    var $loginRedirect = '/catalogs';
    var $userScope = array('User.is_active = 1');


    function isAuthorized() {
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

        //не выводить дебаг информацию, если это аякс запрос
        if ($this->RequestHandler->isAjax()) {
            Configure::write('debug',0);
        }

        $this->Auth2->authorize = 'controller';
        $this->Auth2->loginError = 'Ошибка доступа. Неверный логин или пароль.';
        $this->Auth2->authError = 'Ошибка. Вы не авторизованы.';
        $this->Auth2->loginRedirect = '/catalogs';
        $this->Auth2->logoutRedirect = '/catalogs';

        if($this->Auth2->user()) {
            //$this->set('curUser', $this->User->findById($this->Auth2->user('id')));
            $this->set('curUser', $this->Session->read('Auth'));
            $this->curUser = $this->Session->read('Auth');
            $client_info = $this->ClientInfo->find('first', array(
                'conditions' => array(
                    'ClientInfo.user_id' => $this->curUser['User']['id']
                )
            ));
            $this->set('curClientInfo', $client_info);
        }

        //получение подвала на главной странице
        if(($home_footers = Cache::read('home_footers')) === false) {
          $home_footers = $this->HomeFooter->find('all');
          Cache::write('home_footers', $home_footers);
        }
        $this->set('home_footers', $home_footers);

        //верхние баннеры
        if(($banners = Cache::read('banners')) === false) {
          $banners = $this->Banner->find('all');
          Cache::write('banners', $banners);
        }
        $this->set('banners', $banners);

        //тексты
        if(($strs = Cache::read('strs')) === false) {
            $strs = $this->Str->find('all', array(
                'recursive' => -1
            ));
            $strs = Set::combine($strs, '{n}.Str.id', '{n}.Str.str');
            Cache::write('strs', $strs);
        }
        $this->set('strs', $strs);

        //logo
        //удалить, когда определимся с логотипом
        $logos = array(
            1 => $this->webroot.'swf/logo1.swf',
            2 => $this->webroot.'swf/logo2.swf',
            3 => $this->webroot.'swf/logo3.swf',
            4 => $this->webroot.'swf/logo4.swf',
            5 => $this->webroot.'swf/logo5.swf',
            6 => $this->webroot.'swf/logo6.swf',
            7 => $this->webroot.'swf/logo7.swf',
            8 => $this->webroot.'swf/logo8.swf',
            9 => $this->webroot.'swf/logo9.swf',
            10 => $this->webroot.'swf/logo10.swf',
            11 => $this->webroot.'swf/logo11.swf',
            12 => $this->webroot.'swf/logo12.swf'
        );
        $logo_num = 9;
        if(!empty($this->params['named']) && !empty($this->params['named']['logo'])) {
            $temp_logo_num = $this->params['named']['logo'];
            if(!empty($logos[$temp_logo_num]))
                $logo_num = $temp_logo_num;
        }
        $logo_path = $logos[$logo_num];
        $this->set('logo_path', $logo_path);

        $alert = $this->Alert->find('first', array(
            'conditions' => array(
                'Alert.enabled' => 1
            ),
            'contain' => array()
        ));
        $this->set('alert', $alert);

        if(!empty($alert)) {
            $this->actionJs[] = "jquery-ui-1.8.5.custom.min";
            $this->commonCss[] = "jquery-ui-1.8.5.custom";
        }

        $url_keywords = $this->UrlKeyword->get_all();
        $keyword = $strs[4];
        foreach($url_keywords as $url_keyword) {
            if($this->here == $url_keyword['UrlKeyword']['url']) {
                $keyword = $url_keyword['UrlKeyword']['keyword'];
            }
        }
        $this->set('url_keyword', $keyword);
        $url_descriptions = $this->UrlDescription->get_all();
        $description = $strs[5];
        foreach($url_descriptions as $url_description) {
            if($this->here == $url_description['UrlDescription']['url']) {
                $description = $url_description['UrlDescription']['description'];
            }
        }
        $this->set('url_description', $description);
    }

    function beforeRender() {
        $pageCss = array_merge($this->pageCss, $this->actionCss);
        if($this->layout == 'default') $pageCss = array_merge($pageCss, $this->commonCss);
        $pageCss[] = $this->params['controller'];
        $pageCss[] = $this->params['controller'].'/'.$this->params['action'];
        $this->set('page_css', $pageCss);

        $this->set('page_js', $this->actionJs);

        $url_titles = $this->UrlTitle->get_all();
        $title = null;
        foreach($url_titles as $url_title) {
            if($this->here == $url_title['UrlTitle']['url']) {
                $title = $url_title['UrlTitle']['title'];
            }
        }
        if(!empty($title)) {
            $this->set('main_title_for_layout', $title);
        }

        parent::beforeRender();
    }

    function translit($str)
    {
        $tr = array(
            "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
            "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
            "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
            "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
            "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
            "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
            "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
            "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
            "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
            "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
            "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
            "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
            "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya"
        );
        return strtr($str,$tr);
    }
}
?>
