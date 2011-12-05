<?php

class ImageTemplatesController extends AppController {
    var $name = 'ImageTemplate';
    var $uses = array(
        'Image',
        'ImageTemplate',
        'ImageType'
    );
    var $helpers = array(
        'AdminCommon'
    );
    var $components = array(
        'AdminCommon'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return ($this->curUser['User']['role_id'] == 3);
        }
        return true;
    }

    function index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Шаблоны изображений - редактирование';
        $image_templates = $this->ImageTemplate->find('all', array(
            'contain' => array(
                'Image'
            )
        ));
        $image_templates = Set::combine($image_templates, '{n}.ImageTemplate.id', '{n}');
        $this->set('image_templates', $image_templates);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->ImageTemplate);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->ImageTemplate);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->ImageTemplate);
        die;
    }

    function apply() {
        set_time_limit(600);
        $image_template_id = $this->data['row_id'];
        $type = $this->data['type'];

        $images = $this->Image->find('all', array(
            'conditions' => array(
                'Image.image_type_id' => $type
            ),
            'contain' => array()
        ));

        $image_template = $this->ImageTemplate->find('first', array(
            'conditions' => array(
                'ImageTemplate.id' => $image_template_id
            ),
            'contain' => array('Image')
        ));

        $this->ImageType->save(array(
            'id' => $type,
            'image_template_id' => $image_template_id
        ));

        foreach($images as $image) {
            $this->ImageTemplate->apply(
                    $image_template['Image']['url'],
                    $image['Image']['real_url'],
                    $image['Image']['url'],
                    $image_template['ImageTemplate']['percent']);
        }
        die;
    }

    function migration() {
        $images = $this->Image->find('all', array(
            'conditions' => array(
                'Image.image_type_id' => 1
            ),
            'contain' => array()
        ));

        foreach($images as $image) {
            $src = $image['Image']['url'];
            $dst = 'real/'.$src;

            $img_src = 'img/'.$src;
            $img_dst = 'img/'.$dst;

            if(file_exists($img_src)) {
                echo $img_src.'-'.$img_dst;
                copy($img_src, $img_dst);

                $this->Image->save(array(
                    'id' => $image['Image']['id'],
                    'real_url' => $dst
                ));

                echo "$img_src<br>";
            }
        }
        die;
    }
}

?>
