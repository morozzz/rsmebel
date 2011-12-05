<?php

class UrlTitle extends AppModel {
    var $name = 'UrlTitle';
    var $order = 'UrlTitle.id desc';
    var $field_types = array(
        'url' => 'text',
        'title' => 'text'
    );
    var $caches = array(
        'url_titles'
    );

    function get_all() {
        if(($url_titles = Cache::read('url_titles')) === false) {
          $url_titles = $this->find('all', array(
              'contain' => array()
          ));
          Cache::write('url_titles', $url_titles);
        }
        $url_titles = Set::combine($url_titles, '{n}.UrlTitle.id', '{n}');
        return $url_titles;
    }
}

?>
