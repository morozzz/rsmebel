<?php

class Setting extends AppModel {
    var $name = 'Setting';
    var $belongsTo = array(
        'Image'
    );
    var $actsAs = array(
        'Image' => array(
            'images' => array(
                'image_id' => 'Image'
            ),
            'image_type_id' => 1
        ),
    );
    
    var $order = 'Setting.id';

    var $field_types = array(
        'name' => 'text',
        'Image' => 'file',
        'value_str' => 'text',
        'value_text' => 'text'
    );
    
    function get_setting($setting_id) {
        $setting = $this->find('first', array(
            'conditions' => array(
                'Setting.id' => $setting_id
            ),
            'contain' => array(
                'Image'
            )
        ));
        return $setting;
    }
    
    function get_footer_text() {
        $value = $this->get_setting(1);
        if(empty($value)) return ''; else return $value['Setting']['value_text'];
    }
    
    function get_link_top_email() {
        $value = $this->get_setting(2);
        if(empty($value)) return ''; else return $value['Setting']['value_str'];
    }
}

?>
