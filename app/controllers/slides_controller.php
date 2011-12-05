<?php

class SlidesController extends AppController {
    var $name = 'Slides';
    var $uses = array(
        'Slide',
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
        $this->pageTitle = 'Управление слайдшоу';

        if(($slides = Cache::read('slides')) === false) {
          $slides = $this->Slide->find('all');
          Cache::write('slides', $slides);
        }

        $this->set('slides', $slides);
    }

    function save_list() {
        if(!empty($this->data)) {
            if(!empty($this->data['Slide'])) {
                foreach($this->data['Slide'] as $slide_id => $slide) {
                    $data = array();

                    foreach(array_keys($slide) as $key) {
                        if($key == 'image_file') {
                            $image_id = $this->Image->add($slide[$key], 4);
                            $data[$key] = $image_id;
                        } else if($key == 'sort_order' ||
                                  $key == 'link') {
                            $data[$key] = $slide[$key];
                        }
                    }

                    if(!empty($data)) {
                        $this->Slide->id = $slide_id;
                        $this->Slide->save($data);
                    }
                }
            }
            if(!empty($this->data['Image'])) {
                foreach($this->data['Image'] as $image_id => $image) {
                    $this->Image->update($image, $image_id);
                }
            }
          Cache::delete('slides');
          clearCache();
        }
        $this->redirect($this->referer());
    }

    function add() {
        if(!empty($this->data['Slide'])) {
            $min_sort_order = $this->Slide->find('first', array(
                'fields' => array(
                    'min(sort_order) AS min_sort_order'
                ),
                'recursive' => -1
            ));
            $min_sort_order = $min_sort_order[0]['min_sort_order'];

            $image_id = 0;
            if(!empty($this->data['Slide']['image_file'])) {
                $image_id = $this->Image->add($this->data['Slide']['image_file'], 4);
            }

            $link = $this->data['Slide']['link'];

            $data = array(
                'image_id' => $image_id,
                'link' => $link,
                'sort_order' => $min_sort_order-1
            );

            $this->Slide->create();
            $this->Slide->save($data);
            Cache::delete('slides');
            clearCache();
        }
        $this->redirect($this->referer());
    }

    function delete() {
        if(!empty($this->data)) {
            $slide = $this->Slide->findById($this->data['slide_id']);
            if(!empty($slide['Slide']['image_id'])) {
                $this->Image->delete($slide['Slide']['image_id']);
            }

            $this->Slide->id = $slide['Slide']['id'];
            $this->Slide->delete();
            Cache::delete('slides');
            clearCache();
        }

        $this->redirect($this->referer());
    }
}

?>
