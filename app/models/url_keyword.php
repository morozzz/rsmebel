<?php

class UrlKeyword extends AppModel {
    var $name = 'UrlKeyword';
    var $order = 'UrlKeyword.id desc';
    var $field_types = array(
        'url' => 'text',
        'keyword' => 'text'
    );
    var $caches = array(
        'url_keywords'
    );

    function get_all() {
        if(($url_keywords = Cache::read('url_keywords')) === false) {
          $url_keywords = $this->find('all', array(
              'contain' => array()
          ));
          Cache::write('url_keywords', $url_keywords);
        }
        $url_keywords = Set::combine($url_keywords, '{n}.UrlKeyword.id', '{n}');
        return $url_keywords;
    }
}

?>
