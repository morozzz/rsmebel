<?php

class Image extends AppModel {
    var $name = 'Image';
    var $caches = array(
        'admin_product_dets'
    );

    var $belongsTo = array(
        'ImageType'
    );

    function add($file, $image_type_id) {
        if($this->isUploadedFile($file)){
            $data = array(
                $this->alias => array(
                    'url' => '',
                    'real_url' => '',
                    'image_type_id' => $image_type_id
                )
            );
            $this->create();
            $this->save($data);

            $path_info = pathinfo($file['name']);
            $filename = 'image-'.$this->id.'.'.$path_info['extension'];

            $image_type = $this->ImageType->find('first', array(
                'conditions' => array(
                    'ImageType.id' => $image_type_id
                ),
                'contain' => array(
                    'ImageTemplate' => array(
                        'Image'
                    )
                )
            ));
            $real_filename = $image_type['ImageType']['real_prefix'].$filename;
            $filename = $image_type['ImageType']['prefix'].$filename;

//            if($image_type_id == 1) {
//                $filename = 'catalog/'.$filename;
//            } else if($image_type_id == 2) {
//                $filename = 'notes/'.$filename;
//            } else if($image_type_id == 3) {
//                $filename = 'design/'.$filename;
//            } else if($image_type_id == 4) {
//                $filename = 'banners/'.$filename;
//            } else if($image_type_id == 5) {
//                $filename = 'article/'.$filename;
//            }

            $data = array(
                $this->alias => array(
                    'url' => $filename,
                    'real_url' => $real_filename
                )
            );
            $this->save($data);

            $img_filename = 'img/'.$filename;
            $img_real_filename = 'img/'.$real_filename;

            move_uploaded_file($file['tmp_name'], $img_filename);
            copy($img_filename, $img_real_filename);

//            if(!empty($image_type['ImageTemplate'])) {
//                $this->ImageType->ImageTemplate->apply(
//                        $image_type['ImageTemplate']['Image']['url'],
//                        $real_filename,
//                        $filename,
//                        $image_type['ImageTemplate']['percent']);
//            }
            return $this->id;
        }
        return 0;
    }

    function update($file, $id) {
        if($this->isUploadedFile($file)) {
            $this->order = '';
            $image = $this->find('first', array(
                'conditions' => array(
                    $this->alias.'.id' => $id
                ),
                'contain' => array(
                    'ImageType' => array(
                        'ImageTemplate' => array(
                            'Image'
                        )
                    )
                )
            ));
            $url = 'img/'.$image[$this->alias]['url'];
            unlink($url);
            $url = 'img/'.$image[$this->alias]['real_url'];
            unlink($url);

            $path_info = pathinfo($file['name']);
            $filename = 'image-'.$image[$this->alias]['id'].'.'.$path_info['extension'];

            $real_filename = $image['ImageType']['real_prefix'].$filename;
            $filename = $image['ImageType']['prefix'].$filename;

            $data = array(
                $this->alias => array(
                    'url' => $filename,
                    'real_url' => $real_filename
                )
            );
            $this->id = $image[$this->alias]['id'];
            $this->save($data);

            $img_filename = 'img/'.$filename;
            $img_real_filename = 'img/'.$real_filename;

            move_uploaded_file($file['tmp_name'], $img_filename);
            copy($img_filename, $img_real_filename);

//            if(!empty($image['ImageType']['ImageTemplate'])) {
//                $this->ImageType->ImageTemplate->apply(
//                        $image['ImageType']['ImageTemplate']['Image']['url'],
//                        $real_filename,
//                        $filename,
//                        $image['ImageType']['ImageTemplate']['percent']);
//            }
        }
    }

    function delete($id) {
        $this->order = '';
        $image = $this->find('first', array(
            'conditions' => array(
                $this->alias.'.id' => $id
            ),
            'contain' => array()
        ));
        $url = 'img/'.$image[$this->alias]['url'];
        unlink($url);
        $url = 'img/'.$image[$this->alias]['real_url'];
        unlink($url);

        $this->id = $id;
        $this->remove($id);
    }

    var $order = 'Image.id DESC';
}

?>
