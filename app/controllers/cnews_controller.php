<?php

class CnewsController extends AppController {
    var $name = 'Cnews';
    var $uses = array("Cnew", "SmallImage", "BigImage", "Image");
    var $components = array('Email', 'SendEmail');
    var $helpers = array(
        'paginator'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return ($this->curUser['User']['role_id'] == 2 ||
                    $this->curUser['User']['role_id'] == 3);
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

       // $this->Auth2->allow('*');
        $this->Auth2->allow('index');
        $this->Auth2->allow('view_new');
        $this->Auth2->allow('view');
    }

	function index() {
      $this->pageTitle = "Новости";

          $this->paginate = array(
                'Cnew' => array('fields' => array('date_format(Cnew.stamp, "%d.%m.%Y") AS stamp',
                                                                                   'Cnew.id',
                                                                                   'Cnew.news_header',
                                                                                   'Cnew.news_body',
                                                                                   'Cnew.news_footer',
                                                                                   'Cnew.small_image_id',
                                                                                   'Cnew.big_image_id',
                                                                                   'SmallImage.url',
                                                                                   'BigImage.url'),
                'order' => array('Cnew.stamp DESC','sort_order'),
                'limit' => 10
                                                                                   )
           );
          $cnews = $this->paginate('Cnew');
          $cnews = Set::combine($cnews, '{n}.Cnew.id', '{n}');

      $this->set('cnews', $cnews);

      $limit_array = $this->params['named'];
      $limit = (empty($limit_array['limit']))?10:$limit_array['limit'];
      $this->set('limit', $limit);

    }

	function view_new($id) {

      $cnews = $this->Cnew->find('all', array('fields' => array('date_format(Cnew.stamp, "%d.%m.%Y") AS stamp',
                                                                              'Cnew.id',
                                                                              'Cnew.news_header',
                                                                              'Cnew.news_body',
                                                                              'Cnew.news_footer',
                                                                              'Cnew.small_image_id',
                                                                              'Cnew.big_image_id',
                                                                              'SmallImage.url',
                                                                              'BigImage.url'),
                                              'order' => array('Cnew.stamp DESC','Cnew.sort_order')
       ));

      $i = 0;
      foreach($cnews as $new) {
        if ($cnews[$i]['Cnew']['id'] == $id) {
          $i++;
          break;
        }
        $i++;
      }
      
      $this->pageTitle = $cnews[$i]['Cnew']['news_header'];

      $this->redirect('/cnews/view/page:'.$i);
      
    }

	function view() {

      $this->paginate = array(
            'Cnew' => array('fields' => array('date_format(Cnew.stamp, "%d.%m.%Y") AS stamp',
                                                                               'Cnew.id',
                                                                               'Cnew.news_header',
                                                                               'Cnew.news_body',
                                                                               'Cnew.news_footer',
                                                                               'Cnew.small_image_id',
                                                                               'Cnew.big_image_id',
                                                                               'SmallImage.url',
                                                                               'BigImage.url'),
            'order' => array('Cnew.stamp DESC','Cnew.sort_order'),
            'limit' => 1
                                                                               )
       );

      $cnews = $this->paginate('Cnew');
      $cnews = Set::combine($cnews, '{n}.Cnew.id', '{n}');

      $this->set('cnews', $cnews);

      foreach($cnews as $new) {
        $this->pageTitle = $new['Cnew']['news_header'];
      }

      $limit_array = $this->params['named'];
      $limit = (empty($limit_array['limit']))?1:$limit_array['limit'];
      $this->set('limit', $limit);
    }
    
	function list_news() {
      $this->layout = 'admin';
      $this->pageTitle = 'Новости - редактирование';

      if(($cnews = Cache::read('cnews')) === false) {
          $cnews = $this->Cnew->find('all', array('fields' => array('date_format(Cnew.stamp, "%d.%m.%Y") AS stamp',
                                                                                  'Cnew.id',
                                                                                  'Cnew.news_header',
                                                                                  'Cnew.news_body',
                                                                                  'Cnew.news_footer',
                                                                                  'Cnew.small_image_id',
                                                                                  'Cnew.big_image_id',
                                                                                  'Cnew.sort_order',
                                                                                  'Cnew.small_image_id',
                                                                                  'Cnew.big_image_id',
                                                                                  'SmallImage.url',
                                                                                  'BigImage.url'),
                                                  'order' => array('Cnew.stamp DESC','Cnew.sort_order')
           ));
        Cache::write('cnews', $cnews);
      }
      $this->set('cnews', $cnews);
      
    }

    function add() {
      $this->layout = 'admin';
      $this->pageTitle = 'Новости - добавить';

      if(!empty($this->data)) {

        if(!empty($cnews['Cnew']['small_image_id'])) {
            $this->Cnew->update($this->data['Cnew']['small_image_file'],
                    $cnews['Cnew']['small_image_id']);
        } else {
            $image_id = $this->Image->add($this->data['Cnew']['small_image_file'], 1);
            if($image_id != 0) {
                $this->data['Cnew']['small_image_id'] = $image_id;
            }
        }
        if(!empty($cnews['Cnew']['big_image_id'])) {
            $this->Cnew->update($this->data['Cnew']['big_image_file'],
                    $cnews['Cnew']['big_image_id']);
        } else {
            $image_id = $this->Image->add($this->data['Cnew']['big_image_file'], 1);
            if($image_id != 0) {
                $this->data['Cnew']['big_image_id'] = $image_id;
            }
        }

        $this->Cnew->save($this->data);
        Cache::delete('cnews');
        Cache::delete('cnews_limit');

        //Новость добавили - делаем рассылку
        $cnt_users = $this->User->find('count', array('conditions' => array('User.role_id <> ' => 3, 'ClientInfo.on_news' => 1)));
        if ($cnt_users > 0) {

            // формируем список получателей
            $u_users = $this->User->find('all', array('conditions' => array('User.role_id <> ' => 3, 'ClientInfo.on_news' => 1)));
            foreach($u_users as $u_user_data) {
              $to  = $to.$u_user_data['User']['email'].', ';
            }

            $subject = "MTO Angelika. News";
            $body    = "Добрый день! Вас приветствует магазин торгового оборудования Анжелика.<br><br>";
            $body   .= "Новости:<br>";
            $body   .= $this->data['Cnew']['news_header']."<br><br>";
            $body   .= "Для просмотра вы можете перейти по ссылке:\n <a href='http://".$this->Session->host.$this->webroot."cnews/view_new/".$this->Cnew->id."'>http://".$this->Session->host.$this->webroot."cnews/view_new/".$this->Cnew->id."</a>\n\n";
            $body   .= "<br> Чтобы отменить подписку на наши новости вам необходимо зайти в \"Личный кабинет\" и снять галочку \"Подписаться на новости\"";
            $body   .= "<br><br> Желаем успеха!";

            // пробуем отправить
            if(!$this->SendEmail->send_img($to, $subject, $body))
            {
              $this->Dispatch->rollback();
              $this->Session->setFlash('Ошибка сервера. Невозможно отправить сообщение.', 'default', array('class' => 'info-message'));
              return;
            }
        }

        $this->redirect(array(
                    'controller' => 'cnews',
                    'action' => 'list_news'
                ));
      }
    }

    function edit($id) {
      $this->layout = 'admin';
      $this->pageTitle = 'Новости - редактирование';

      if(!empty($this->data)) {
        $cnews = $this->Cnew->id = $id;

        if(!empty($cnews['Cnew']['small_image_id'])) {
            $this->Cnew->update($this->data['Cnew']['small_image_file'],
                    $cnews['Cnew']['small_image_id']);
        } else {
            $image_id = $this->Image->add($this->data['Cnew']['small_image_file'], 1);
            if($image_id != 0) {
                $this->data['Cnew']['small_image_id'] = $image_id;
            }
        }
        if(!empty($cnews['Cnew']['big_image_id'])) {
            $this->Cnew->update($this->data['Cnew']['big_image_file'],
                    $cnews['Cnew']['big_image_id']);
        } else {
            $image_id = $this->Image->add($this->data['Cnew']['big_image_file'], 1);
            if($image_id != 0) {
                $this->data['Cnew']['big_image_id'] = $image_id;
            }
        }

        $this->Cnew->save($this->data);
        Cache::delete('cnews');
        Cache::delete('cnews_limit');
        $this->set('cnews', $this->Cnew->read());

        $this->redirect(array(
                    'controller' => 'cnews',
                    'action' => 'list_news'
                ));        
      }     
      else {
        $this->Cnew->id = $id;
        $this->data = $this->Cnew->read();
        $this->set('cnews', $this->Cnew->read());
      }
    }

    function delete($id = 0) {
      $this->layout = 'admin';
      $this->pageTitle = 'Новости - удаление';
      
      $cnews = $this->Cnew->id = $id;
      $this->set('cnews', $this->Cnew->read());

      if(!empty($this->data)) {
        if(!empty($cnews['Cnew']['small_image_id'])) {
            $this->Image->delete($cnews['Cnew']['small_image_id']);
        }
        if(!empty($cnews['Cnew']['big_image_id'])) {
            $this->Image->delete($cnews['Cnew']['big_image_id']);
        }

        $this->Cnew->delete();
        Cache::delete('cnews');
        Cache::delete('cnews_limit');

        $this->redirect(array(
                    'controller' => 'cnews',
                    'action' => 'list_news'
                ));
      }     
    }

    function save_list() {

      //debug($this->data);
        if(!empty($this->data)) {

            //секции
            if(!empty($this->data['Cnew'])) {
                foreach($this->data['Cnew'] as $cnew_id => $cnew) {
                    $data = array();

                    //сортировка
                    if(!empty($cnew['sort_order'])) {
                        $data['sort_order'] = $cnew['sort_order'];
                    }

                    //сохраняем
                    if(!empty($data)) {
                        $data['id'] = $cnew_id;
                        $this->Cnew->id = $cnew_id;
                        $this->Cnew->save($data, $validate = true, $fieldList = array('sort_order'));
                    }
                }
            }

            Cache::delete('cnews');
            Cache::delete('cnews_limit');
        }
        //перенапрявляем обратно
        $this->redirect($this->referer());
    }


}
?>