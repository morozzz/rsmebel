<?php

class ProducersController extends AppController {
    var $name = 'Producer';

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function index() {
        $this->layout = 'admin';
        if(($producers = Cache::read('producers')) === false) {
          $producers = $this->Producer->find('all');
          Cache::write('producers', $producers);
        }  
        $this->set('producers', $producers);
        $this->pageTitle = 'Производители';
    }

    function save() {
        if(!empty($this->data)) {
            //debug($this->data);die;\
            if(!empty($this->data['Producer'])) {
                $real_producers = $this->Producer->find('all');
                $producers = Set::combine($real_producers, '{n}.Producer.id', '{n}.Producer');
                foreach($this->data['Producer'] as $producer_id => $producer) {
                    if(empty($producers[$producer_id])) continue;

                    $real_producer = $producers[$producer_id];

                    if($real_producer['name'] == $producer['name']) continue;

                    $data = array(
                        'name' => $producer['name']
                    );
                    $this->Producer->id = $producer_id;
                    $this->Producer->save($data);
                }
            }

            if(!empty($this->data['ProducerNew'])) {
                foreach($this->data['ProducerNew'] as $producer) {
                    $data = array(
                        'name' => $producer['name']
                    );

                    $this->Producer->create();
                    $this->Producer->save($data);
                }
            }
          Cache::delete('producers');
          Cache::delete('producer_list');
        }
        $this->redirect(array(
            'controller' => 'producers',
            'action' => 'index'
        ));
    }

    function delete($id) {
        $this->Producer->id = $id;
        $this->Producer->delete();

        Cache::delete('producers');
        Cache::delete('producer_list');

        $this->redirect(array(
            'controller' => 'producers',
            'action' => 'index'
        ));
    }
}

?>
