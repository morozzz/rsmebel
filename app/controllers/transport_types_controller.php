<?php

class TransportTypesController extends AppController {
    var $name = 'TransportTypes';
    var $uses = array(
        'TransportType'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function index() {
        $this->layout = 'admin';
        if(($transport_types = Cache::read('transport_types')) === false) {
          $transport_types = $this->TransportType->find('all', array(
              'recursive' => -1
          ));
          Cache::write('transport_types', $transport_types);
        }        
        $this->set('transport_types', $transport_types);
        $this->pageTitle = 'Типы доставки';
    }

    function save() {
        if(!empty($this->data)) {
//            debug($this->data);die;
            if(!empty($this->data['TransportType'])) {
                $real_transport_types = $this->TransportType->find('all', array(
                    'recursive' => -1
                ));
                $transport_types = Set::combine($real_transport_types, '{n}.TransportType.id', '{n}.TransportType');
                foreach($this->data['TransportType'] as $transport_type_id => $transport_type) {
                    if(empty($transport_types[$transport_type_id])) continue;

                    $real_transport_type = $transport_types[$transport_type_id];

                    if($real_transport_type['name'] == $transport_type['name'] &&
                            $real_transport_type['price'] == $transport_type['price']) continue;

                    $data = array(
                        'name' => $transport_type['name'],
                        'price' => $transport_type['price']
                    );
                    $this->TransportType->id = $transport_type_id;
                    $this->TransportType->save($data);
                }
            }

            if(!empty($this->data['TransportTypeNew'])) {
                foreach($this->data['TransportTypeNew'] as $transport_type) {
                    $data = array(
                        'name' => $transport_type['name'],
                        'price' => $transport_type['price']
                    );

                    $this->TransportType->create();
                    $this->TransportType->save($data);
                }
            }
          Cache::delete('transport_types');
        }
        $this->redirect(array(
            'controller' => 'transport_types',
            'action' => 'index'
        ));
    }

    function delete($id) {
        $this->TransportTypeAbout->deleteAll(array(
            'transport_type_id' => $id
        ));

        $this->TransportType->id = $id;
        $this->TransportType->delete();
        Cache::delete('transport_types');

        $this->redirect(array(
            'controller' => 'transport_types',
            'action' => 'index'
        ));
    }
}

?>
