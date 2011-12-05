<?php

class StringsController extends AppController {
    var $name = 'String';
    var $uses = array(
        'Str',
        'StringType'
    );
    var $components = array(
        'AdminCommon'
    );
    var $helpers = array(
        'AdminCommon'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Тексты';

        $strings = $this->Str->find('all');
        $strings = Set::combine($strings, '{n}.Str.id', '{n}');
        $this->set('strings', $strings);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->Str);
        $this->redirect($this->referer());
        die;
    }

//    function edit($id = null) {
//        if(empty($this->data)) {
//            $this->layout = 'admin';
//            $str = $this->Str->findById($id);
//            $this->pageTitle = $str['Str']['str'] . ' - редактирование';
//            $this->set('str', $str);
//        } else {
//            $data = array(
//                'id' => $this->data['id'],
//                'str' => $this->data['str']
//            );
//            $this->Str->id = $this->data['id'];
//            $this->Str->save($data);
//
//            clearCache();
//            Cache::delete('strs');
//
//            $this->redirect('/strings/index');
//        }
//    }
}

?>
