<?php

class Producer extends AppModel {
    var $name = 'Producer';
    var $caches = array(
        'all_catalogs'
    );

    function get_list() {
        if(($producer_list = Cache::read('producer_list')) === false) {
          $producer_list = $this->find('list');
           Cache::write('producer_list', $producer_list);
        }
        return $producer_list;
    }
}

?>
