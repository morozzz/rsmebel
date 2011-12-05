<?php

class CustomStatusTypesController extends AppController {
    var $name = 'CustomStatusTypes';
    var $uses = array(
        'CustomStatusType',
        'Image'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function index() {
        $this->layout = 'admin';

        if(($custom_status_types = Cache::read('custom_status_types')) === false) {
          $custom_status_types = $this->CustomStatusType->find('all');
          Cache::write('custom_status_types', $custom_status_types);
        }

        $this->set('custom_status_types', $custom_status_types);
        $this->pageTitle = 'Статусы заказов';
    }

    function save() {
        if(!empty($this->data)) {
            //debug($this->data);die;\
            if(!empty($this->data['CustomStatusType'])) {
                $real_custom_status_types = $this->CustomStatusType->find('all', array(
                    'recursive' => -1
                ));
                $custom_status_types = Set::combine($real_custom_status_types, '{n}.CustomStatusType.id', '{n}.CustomStatusType');
                foreach($this->data['CustomStatusType'] as $custom_status_type_id => $custom_status_type) {
                    if(empty($custom_status_types[$custom_status_type_id])) continue;
                    
                    $real_custom_status_type = $custom_status_types[$custom_status_type_id];

                    if(!empty($real_custom_status_type['image_id'])) {
                        $this->Image->update($custom_status_type['image_file'],
                                $real_custom_status_type['image_id']);
                    } else {
                        $image_id = $this->Image->add($custom_status_type['image_file'], 1);
                        if($image_id != 0) {
                            $custom_status_type['image_id'] = $image_id;
                        }
                    }

                    if($real_custom_status_type['name'] == $custom_status_type['name'] &&
                            empty($custom_status_type['image_id'])) continue;

                    $data = array(
                        'name' => $custom_status_type['name']
                    );
                    if(!empty($custom_status_type['image_id']))
                        $data['image_id'] = $custom_status_type['image_id'];
                    $this->CustomStatusType->id = $custom_status_type_id;
                    $this->CustomStatusType->save($data);
                }
            }

            if(!empty($this->data['CustomStatusTypeNew'])) {
                foreach($this->data['CustomStatusTypeNew'] as $custom_status_type) {
                    $data = array(
                        'name' => $custom_status_type['name']
                    );

                    $image_id = $this->Image->add($custom_status_type['image_file'], 1);
                    if($image_id != 0) {
                        $data['image_id'] = $image_id;
                    }

                    $this->CustomStatusType->create();
                    $this->CustomStatusType->save($data);
                }
            }
           Cache::delete('custom_status_types');
        }
        $this->redirect(array(
            'controller' => 'custom_status_types',
            'action' => 'index'
        ));
    }

    function delete($id) {
        $catalog_status_type = $this->CustomStatusType->find('first', array(
            'conditions' => array(
                'id' => $id
            ),
            'recursive' => -1
        ));

        if(!empty($catalog_status_type['CatalogStatusType']['image_id'])) {
            $this->Image->delete($catalog_status_type['CatalogStatusType']['image_id']);
        }
        $this->CustomStatusType->id = $id;
        $this->CustomStatusType->delete();
        Cache::delete('custom_status_types');

        $this->redirect(array(
            'controller' => 'custom_status_types',
            'action' => 'index'
        ));
    }
}

?>