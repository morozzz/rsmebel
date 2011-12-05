<?php

class ImagesController extends AppController {
    var $name = 'Images';
    var $uses = array(
        'Image'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Изображения';

        if(($images = Cache::read('images')) === false) {
            $images = $this->Image->find('all', array(
                'conditions' => array(
                    'Image.image_type_id' => 2
                )
            ));
          Cache::write('images', $images);
        }
        $this->set('images', $images);
    }

    function save() {
        if(!empty($this->data)) {
            if(!empty($this->data['Image'])) {
                foreach($this->data['Image'] as $image_id => $image) {
                    $this->Image->update($image['image_file'], $image_id);
                }
            }

            if(!empty($this->data['ImageNew'])) {
                foreach($this->data['ImageNew'] as $image) {
                    $this->Image->add($image['image_file'], 2);
                }
            }
         Cache::delete('images');
        }
        $this->redirect($this->referer());
    }

    function delete($id) {
        $this->Image->delete($id);
        Cache::delete('images');

        $this->redirect($this->referer());
    }

    function browser() {
        $this->layout = 'image_browse';
        $this->pageTitle = 'Выбор изображения';
        
        $this->set('params', $this->params['url']);

        if(($images = Cache::read('images')) === false) {
            $images = $this->Image->find('all', array(
                'conditions' => array(
                    'Image.image_type_id' => 2
                )
            ));
          Cache::write('images', $images);
        }
        
        $this->set('images', $images);
    }

    function upload() {
        Configure::write('debug',0);
        if(!empty($this->params['form']['upload'])) {
            $file = $this->params['form']['upload'];
            $image_id = $this->Image->add($file, 2);
            $image = $this->Image->findById($image_id);
            $url = $this->webroot.'img/'.$image['Image']['url'];

            $funcNum = $this->params['url']['CKEditorFuncNum'];

            $message = '';
            if($image_id <= 0) {
                $message = 'Не удалось закачать изображение на сервер';
            }

            echo "  <script type='text/javascript'>
                        window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');
                    </script>";
        }
        die;
    }
}

?>