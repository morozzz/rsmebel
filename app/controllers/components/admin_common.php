<?php

class AdminCommonComponent extends Object {
    var $components = array(
        'Session'
    );
    
    function save_all($rows, &$model, $model_name=null, $fields=null, $default_values = array()) {
        if($model_name==null) $model_name = $model->name;
        if($fields==null) $fields = $model->field_types;
        if(!empty($rows) && !empty($rows[$model_name])) {
            $rows = $rows[$model_name];
            foreach($rows as $model_id => $row) {
                $data = array(
                    'id' => $model_id
                );
                foreach($row as $field => $value) {
                    if(isset($fields[$field])) {
                        $type = $fields[$field];
                        if($type=='text' ||
                                $type=='number' ||
                                $type=='array' ||
                                $type=='file') {
                            $data[$field] = $value;
                        }
                    }
                }
                foreach($default_values as $field => $value) {
                    $data[$field] = $value;
                }
                $model->id = $model_id;
                $data = array(
                    $model->name => $data
                );
                if($model->save($data) == false) {
                    if(!empty($model->error)) {
                        $this->Session->setFlash($model->error);
                    }
                    return;
                }
            }
            if(method_exists($model, 'afterAllSave')) {
                $model->afterAllSave($rows);
            }
        }

        $this->clearModelCache($model);
    }

    function add($row, &$model, $fields=null) {
        if($fields == null) $fields = $model->field_types;
        if(!empty($row)) {
            $data = array();
            foreach($row as $field => $value) {
                if(isset($fields[$field])) {
                    $type = $fields[$field];
                    if($type=='text' ||
                                $type=='number' ||
                                $type=='array' ||
                                $type=='file') {
                        $data[$field] = $value;
                    }
                }
            }

            $model->create();
            $data = array(
                $model->name => $data
            );
            if($model->save($data) == false) {
                if(!empty($model->error)) {
                    $this->Session->setFlash($model->error);
                }
                return;
            }
        }

        $this->clearModelCache($model);
    }

    function delete($data, &$model) {
        if(!empty($data)) {
            $row_id = $data['row_id'];
            $res = $model->delete($row_id, false);
            if($res == false) {
                if(!empty($model->error)) {
                    $this->Session->setFlash($model->error);
                }
            }
        }

        $this->clearModelCache($model);
    }

    function delete_list($data, &$model) {
        if(!empty($data)) {
            if(!empty($data['rows_id'])) {
                foreach($data['rows_id'] as $row_id) {
                    $model->id = $row_id;
                    $res = $model->delete($row_id, false);
                    if($res == false) {
                        if(!empty($model->error)) {
                            $this->Session->setFlash($model->error);
                            die;
                        }
                    }
                }
            }
        }
    }

    function clearModelCache(&$model) {
        if(empty($model->clearCache) || $model->clearCache==true) {
            clearCache();
        }
        if(isset($model->caches)) {
            foreach($model->caches as $ch) {
                Cache::delete($ch);
            }
        }

        //удаляем сформированные ексель-файлы
        $handle = opendir('xls');
        if($handle) {
            while(($file = readdir($handle)) !== false) {
                if($file!='.' && $file!='..') {
                    $info = pathinfo($file);
                    if($info['extension'] == 'xls') {
                        unlink("xls/$file");
                    }
                }
            }
        }
    }
}

?>