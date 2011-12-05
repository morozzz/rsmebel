<?php

class UrlDescription extends AppModel {
    var $name = 'UrlDescription';
    var $order = 'UrlDescription.id desc';
    var $field_types = array(
        'url' => 'text',
        'description' => 'text'
    );
    var $caches = array(
        'url_descriptions'
    );

    function get_all() {
        if(($url_descriptions = Cache::read('url_descriptions')) === false) {
          $url_descriptions = $this->find('all', array(
              'contain' => array()
          ));
          Cache::write('url_descriptions', $url_descriptions);
        }
        $url_descriptions = Set::combine($url_descriptions, '{n}.UrlDescription.id', '{n}');
        return $url_descriptions;
    }
}

?>
