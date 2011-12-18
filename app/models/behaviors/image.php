<?php

class ImageBehavior extends ModelBehavior {
    var $name = 'Image';
    
    function setup(&$Model, $setting) {
        $setting = array_merge(array(
            'default_image_url' => 'nopic.gif',
            'url_field' => 'url',
            'image_type_id' => 1,
            'images' => array()
        ), $setting);
        $Model->image_setting = $setting;
    }

    function afterFind(&$Model, $results, $primary) {
        extract($Model->image_setting);

        //для всех ненайденных изображений ставим изображение по умолчанию
        if($primary) {
            foreach($results as &$result) {
                foreach($images as $image_key => $image_class_name) {
                    if(isset($result[$image_class_name]) && empty($result[$image_class_name][$url_field])) {
                        $result[$image_class_name][$url_field] = $default_image_url;
                    }
                }
            }
        } else {
            foreach($images as $image_key => $image_class_name) {
                if(isset($results[$image_class_name]) && empty($results[$image_class_name][$url_field])) {
                    $results[$image_class_name][$url_field] = $default_image_url;
                }
            }
        }
        return $results;
    }

    function beforeSave(&$Model) {
        extract($Model->image_setting);
        $row = null;
        if(!empty($Model->data[$Model->name]['id'])) {
            $row = $Model->find('first', array(
                'conditions' => array(
                    "{$Model->name}.{$Model->primaryKey}" => $Model->data[$Model->name]['id']
                ),
                'recursive' => -1
            ));
        }
        foreach($images as $image_key => $image_class_name) {
            if(!empty($Model->data[$Model->name][$image_class_name])) {
                $image_model = $Model->{$image_class_name};
                $image_file = $Model->data[$Model->name][$image_class_name];
                
                if(empty($row) || empty($row[$Model->name][$image_key])) {
                    //создать изображение
                    $image_id = $image_model->add($image_file, $image_type_id);
                    $Model->data[$Model->name][$image_key] = $image_id;
                } else {
                    //обновить изображение
                    $image_id = $row[$Model->name][$image_key];
                    $image_model->update($image_file, $image_id);
                }
                unset($Model->data[$Model->name][$image_class_name]);
            }
        }
        return true;
    }

    function beforeDelete(&$Model) {
        extract($Model->image_setting);
        if(empty($Model->data)) {
            $Model->data = $Model->findById($Model->id);
        }
        foreach($images as $image_key => $image_class_name) {
            if(!empty($Model->data[$Model->name][$image_key])) {
                $image_model = $Model->{$image_class_name};
                $image_id = $Model->data[$Model->name][$image_key];
                $image_model->delete($image_id);
            }
        }
        return true;
    }
}

?>