<?php

class TransportTypeAboutsController extends AppController {
    var $name = 'TransportTypeAbouts';
    var $uses = array(
        'TransportTypeAbout',
        'TransportType'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function index($transport_type_id) {
        $this->layout = 'admin';

        $transport_type = $this->TransportType->find('first', array(
            'conditions' => array(
                'id' => $transport_type_id,
                ),
            'recursive' => -1
        ));
        $this->set('transport_type', $transport_type);
        $this->pageTitle = 'Описания способа доставки "'.$transport_type['TransportType']['name'].'"';

        $transport_type_abouts = $this->TransportTypeAbout->find('all', array(
            'conditions' => array(
                'transport_type_id' => $transport_type_id
            )
        ));
        $this->set('transport_type_abouts', $transport_type_abouts);
    }

    function save() {
        if(!empty($this->data)) {
//            debug($this->data);die;
            if(!empty($this->data['TransportTypeAbout'])) {
                $real_transport_type_abouts = $this->TransportTypeAbout->find('all', array(
                    'recursive' => -1
                ));
                $transport_type_abouts = Set::combine($real_transport_type_abouts, '{n}.TransportTypeAbout.id', '{n}.TransportTypeAbout');
                foreach($this->data['TransportTypeAbout'] as $transport_type_about_id => $transport_type_about) {
                    if(empty($transport_type_abouts[$transport_type_about_id])) continue;

                    $real_transport_type_about = $transport_type_abouts[$transport_type_about_id];

                    if($real_transport_type_about['name'] == $transport_type_about['name']) continue;

                    $data = array(
                        'name' => $transport_type_about['name']
                    );
                    $this->TransportTypeAbout->id = $transport_type_about_id;
                    $this->TransportTypeAbout->save($data);
                }
            }

            if(!empty($this->data['TransportTypeAboutNew']) && !empty($this->data['transport_type_id'])) {
                $transport_type_id = $this->data['transport_type_id'];
                foreach($this->data['TransportTypeAboutNew'] as $transport_type_about) {
                    $data = array(
                        'name' => $transport_type_about['name'],
                        'text' => '',
                        'transport_type_id' => $transport_type_id
                    );

                    $this->TransportTypeAbout->create();
                    $this->TransportTypeAbout->save($data);
                }
            }
          Cache::delete('transport_types');
        }
        $this->redirect($this->referer());
    }

    function save_about_text() {
        if(!empty($this->data)) {
            $this->TransportTypeAbout->id = $this->data['transport_type_about_id'];
            $this->TransportTypeAbout->save(array(
                'text' => $this->data['text']
            ));
          Cache::delete('transport_types');
        }
        $this->redirect($this->referer());
    }

    function delete($id) {
        $this->TransportTypeAbout->id = $id;
        $this->TransportTypeAbout->delete();
        Cache::delete('transport_types');

        $this->redirect($this->referer());
    }

    function show($transport_type_about_id) {
        $transport_type_about = $this->TransportTypeAbout->findById($transport_type_about_id);
        $this->set('transport_type_about', $transport_type_about['TransportTypeAbout']);
        $this->pageTitle = $transport_type_about['TransportTypeAbout']['name'];
    }
}

?>
