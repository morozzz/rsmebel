<?php

class BannersController extends AppController {
    var $name = 'Banners';
    var $uses = array(
        'Banner',
        'Image'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function adm_index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Управление верхними баннерами';

        if(($banners = Cache::read('banners')) === false) {
          $banners = $this->Banner->find('all');
          Cache::write('banners', $banners);
        }

        $this->set('banners', $banners);
    }

    function save_list() {
        if(!empty($this->data)) {
            if(!empty($this->data['Banner'])) {
                foreach($this->data['Banner'] as $banner_id => $banner) {
                    $data = array();

                    foreach(array_keys($banner) as $key) {
                        if($key == 'image_file') {
                            $image_id = $this->Image->add($banner[$key], 4);
                            $data[$key] = $image_id;
                        } else if($key == 'sort_order' ||
                                  $key == 'link') {
                            $data[$key] = $banner[$key];
                        }
                    }

                    if(!empty($data)) {
                        $this->Banner->id = $banner_id;
                        $this->Banner->save($data);
                    }
                }
            }
            if(!empty($this->data['Image'])) {
                foreach($this->data['Image'] as $image_id => $image) {
                    $this->Image->update($image, $image_id);
                }
            }
          Cache::delete('banners');
          clearCache();
        }
        $this->redirect($this->referer());
    }

    function add() {
        if(!empty($this->data['Banner'])) {
            $min_sort_order = $this->Banner->find('first', array(
                'fields' => array(
                    'min(sort_order) AS min_sort_order'
                ),
                'recursive' => -1
            ));
            $min_sort_order = $min_sort_order[0]['min_sort_order'];

            $image_id = 0;
            if(!empty($this->data['Banner']['image_file'])) {
                $image_id = $this->Image->add($this->data['Banner']['image_file'], 4);
            }

            $link = $this->data['Banner']['link'];

            $data = array(
                'image_id' => $image_id,
                'link' => $link,
                'sort_order' => $min_sort_order-1
            );

            $this->Banner->create();
            $this->Banner->save($data);
            Cache::delete('banners');
            clearCache();
        }
        $this->redirect($this->referer());
    }

    function delete() {
        if(!empty($this->data)) {
            $banner = $this->Banner->findById($this->data['banner_id']);
            if(!empty($banner['Banner']['image_id'])) {
                $this->Image->delete($banner['Banner']['image_id']);
            }

            $this->Banner->id = $banner['Banner']['id'];
            $this->Banner->delete();
            Cache::delete('banners');
            clearCache();
        }

        $this->redirect($this->referer());
    }
}

?>
