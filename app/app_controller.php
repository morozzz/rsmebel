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
    );
    var $components = array(
        'Auth2',
        'Cookie',
        'RequestHandler',
        'Session'
    );
    var $uses = array(
        'User',
        'Str',
        'ClientInfo',
        'UrlKeyword',
        'UrlDescription',
        'UrlTitle',
        'Setting'
    );
    var $helpers = array(
        'Cache',
        'Common',
        'Html',
        'Form',
        'Javascript',
        'Session'
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
        $footer_text = $this->Setting->get_footer_text();
        $this->set('footer_text', $footer_text);

        //тексты
        if(($strs = Cache::read('strs')) === false) {
            $strs = $this->Str->find('all', array(
                'recursive' => -1
            ));
            $strs = Set::combine($strs, '{n}.Str.id', '{n}.Str.str');
            Cache::write('strs', $strs);
        }
        $this->set('strs', $strs);

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
        
        /*получаем тип цены (оптовую или розничную)*/
        $this->set('is_opt_price', true);
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
    
    function http_error($name, $code, $message) {
        $opts = array(
            'name' => $name,
            'code' => $code,
            'message' => $message,
            'base' => $this->base
        );
        $this->cakeError('error', array($opts));
    }
}
?>
