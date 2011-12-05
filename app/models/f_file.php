<?php

class FFile extends AppModel {
    var $name = 'FFile';
    var $useTable = 'files';

    var $field_types = array(
        'filename' => 'text',
        'file' => 'file',
        'stamp' => 'text'
    );
    var $order = 'FFile.stamp DESC, FFile.id DESC';

    function beforeSave() {
        if(empty($this->id)) {
            if(!empty($this->data['FFile']['stamp'])) {
                    $this->data['FFile']['stamp'] = date('Y.m.d',
                            strtotime($this->data['FFile']['stamp']));
            } else {
                $this->data['FFile']['stamp'] = date('Y.m.d');
            }

            $file = $this->data['FFile']['file'];
            if($this->isUploadedFile($file)) {
                $path_info = pathinfo($file['name']);
                $filename = 'files/'.$this->data['FFile']['filename'].'.'.$path_info['extension'];
                move_uploaded_file($file['tmp_name'], $filename);

                $this->data['FFile']['extension'] = $path_info['extension'];
            }
        } else {
            if(!empty($this->data['FFile']['filename'])) {
                $file = $this->find('first', array(
                    'conditions' => array(
                        'FFile.id' => $this->id
                    ),
                    'contain' => array()
                ));
                if($file['FFile']['filename'] != $this->data['FFile']['filename']) {
                    rename('files/'.$file['FFile']['filename'].'.'.$file['FFile']['extension'],
                            'files/'.$this->data['FFile']['filename'].'.'.$file['FFile']['extension']);
                }
            }
        }
        return true;
    }

    function afterFind($results, $primary) {
        foreach($results as &$result) {
            if(!empty($result['FFile']['stamp']))
                $result['FFile']['stamp'] =
                    date('d.m.Y', strtotime($result['FFile']['stamp']));

            if(empty($this->webroot)) $this->webroot = '';
            $result['FFile']['link'] = $this->webroot.'files/'.
                    $result['FFile']['filename'].'.'.
                    $result['FFile']['extension'];
        }
        return $results;
    }

    function beforeDelete() {
        $file = $this->find('first', array(
            'conditions' => array(
                'FFile.id' => $this->id
            ),
            'contain' => array()
        ));
        unlink('files/'.$file['FFile']['filename'].'.'.$file['FFile']['extension']);

        return true;
    }

    function upload($id, $new_file) {
        $file = $this->find('first', array(
            'conditions' => array(
                'FFile.id' => $id
            ),
            'contain' => array()
        ));

        if($this->isUploadedFile($new_file)) {
            $path_info = pathinfo($new_file['name']);
            if($path_info['extension'] != $file['FFile']['extension']) {
                $this->error = 'Неверное расширение закачиваемого файла';
                return;
            }
            move_uploaded_file($new_file['tmp_name'], 'files/'.$file['FFile']['filename'].'.'.
                    $file['FFile']['extension']);
        }
    }
}

?>
