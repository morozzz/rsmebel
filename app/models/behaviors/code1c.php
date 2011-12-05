<?php

class Code1cBehavior extends ModelBehavior {
    var $name = 'Code1c';

    function setup(&$Model, $setting) {
        $setting = array_merge(array(
            'field' => 'code_1c',
            'template' => 'S_%id%'
        ), $setting);
        $this->setting = $setting;
    }

    function beforeSave(&$Model) {
        extract($this->setting);
        $this->needUpdate = false;
        if(!empty($Model->data)) {
            if(empty($Model->data[$field]) && empty($Model->data[$Model->name][$field])) {
                $this->needUpdate = true;
            }
        }
    }

    function afterSave(&$Model, $created) {
        extract($this->setting);
        if($created && $this->needUpdate) {
            $value = str_replace('%id%', $Model->id, $template);
            $Model->save(array(
                $field => $value
            ));
        }
        return true;
    }
}

?>
