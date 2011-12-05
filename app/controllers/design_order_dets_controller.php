<?php

class DesignOrderDetsController extends AppController {
    var $name = 'DesignOrderDets';
    var $uses = array("DesignOrderDet", "DesignOrder", "DesignOrderStatus", "Section", "SectionType", "SectionDet", "DesignOrderHeader", "Image", "DesignInfo");
    var $actionJs = array(
        "jquery-ui-1.8.5.custom.min"
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return ($this->curUser['User']['role_id'] == 3) ||
                    ($this->curUser['User']['role_id'] == 2);
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('add');
        $this->Auth2->allow('end');
    }

    function adm_design_order_edit($action = null) {
      $this->layout = 'admin';

      if (!empty($action)) {
         $this->DesignOrder->id = $this->data['DesignOrder']['id'];

         if ($action == 'edit') {
              if(!empty($this->data)) {
                $this->DesignOrder->save($this->data, $validate = true, $fieldList = array('design_order_status_id'));
                Cache::delete('design_orders');
              }
         }
         else if ($action == 'delete') {
            $this->DesignOrderDet->deleteAll(array('DesignOrderDet.design_order_id' => $this->data['DesignOrder']['id']));
            $this->DesignOrder->delete($this->data);
            Cache::delete('design_orders');

         }
      }
      $this->redirect(array(
                  'controller' => 'design_order_dets',
                  'action' => 'adm_index'
              ));
    }

    function adm_show_order($action = null, $design_order_id = null) {
      $this->layout = 'admin';
      $this->pageTitle = "Детализация заявки на дизайн";

      $this->set('action', $action);

      $this->Section->unbindModel(array(
          'hasMany' => array('SectionDet')
      ));

      if(($sections = Cache::read('sections')) === false) {
        $sections = $this->Section->find('all', array('order' => 'Section.sort_order'));
        Cache::write('sections', $sections);
      }
      $this->set('sections', $sections);

      if(($design_order_statuses = Cache::read('design_order_statuses')) === false) {
        $design_order_statuses = $this->DesignOrderStatus->find('all', array('order' => 'DesignOrderStatus.id'));
        Cache::write('design_order_statuses', $design_order_statuses);
      }
      $this->set('design_order_statuses', $design_order_statuses);

      $design_order_dets = $this->DesignOrderDet->find('all', array('conditions' => array('design_order_id' => $design_order_id), 'order' => 'DesignOrderDet.section_id'));
      $this->set('design_order_dets', $design_order_dets);
      $this->set('design_order_id', $design_order_id);

      $design_orders = $this->DesignOrder->find('all', array('fields' => array('DesignOrder.design_order_status_id'),
                                                             'order' => 'DesignOrder.created DESC',
                                                             'conditions' => array('DesignOrder.id' => $design_order_id)));

      $this->set('order_status_id', $design_orders[0]['DesignOrder']['design_order_status_id']);

    }

	function adm_index($order_status_id = null) {
      $this->layout = 'admin';
      $this->pageTitle = "Заявки на дизайн";

      if (empty($order_status_id)) {
        $order_status_id = 0;
      }

      $this->set('order_status_id', $order_status_id);

      if(($design_order_statuses = Cache::read('design_order_statuses')) === false) {
        $design_order_statuses = $this->DesignOrderStatus->find('all', array('order' => 'DesignOrderStatus.id'));
        Cache::write('design_order_statuses', $design_order_statuses);
      }
      $this->set('design_order_statuses', $design_order_statuses);

      if ($order_status_id != 0) {
          $design_orders = $this->DesignOrder->find('all', array('fields' => array('date_format(DesignOrder.created, "%d.%m.%Y") AS created',
                                                                                   'date_format(DesignOrder.modified, "%d.%m.%Y") AS modified',
                                                                                   'DesignOrder.id',
                                                                                   'DesignOrder.design_order_status_id',
                                                                                   'DesignOrderStatus.status_name'),
                                                                 'order' => 'DesignOrder.created DESC',
                                                                 'conditions' => array('DesignOrder.design_order_status_id' => $order_status_id)));
      }
      else {
        if(($design_orders = Cache::read('design_orders')) === false) {

          $design_orders = $this->DesignOrder->find('all', array('fields' => array('date_format(DesignOrder.created, "%d.%m.%Y") AS created',
                                                                                   'date_format(DesignOrder.modified, "%d.%m.%Y") AS modified',
                                                                                   'DesignOrder.id',
                                                                                   'DesignOrder.design_order_status_id',
                                                                                   'DesignOrderStatus.status_name'),
                                                                 'order' => 'DesignOrder.created DESC'));
          Cache::write('design_orders', $design_orders);
        }
      }

      $this->set('design_orders', $design_orders);
    }

	function add() {
      $this->pageTitle = 'Магазин для магазинов';

      if(($design_infos = Cache::read('design_infos')) === false) {
        $design_infos = $this->DesignInfo->find('all', array('order' => 'DesignInfo.sort_order'));
        Cache::write('design_infos', $design_infos);
      }
      $this->set('design_infos', $design_infos);

      if(($sections = Cache::read('sections')) === false) {
        $sections = $this->Section->find('all', array('order' => 'Section.sort_order'));
        Cache::write('sections', $sections);
      }
      $this->set('sections', $sections);

      if(($section_dets = Cache::read('section_dets')) === false) {
          $section_dets = $this->SectionDet->find('all', array('order' => 'SectionDet.section_id, SectionDet.sort_order, SectionDet.param_name'));
          Cache::write('section_dets', $section_dets);
      }
      $this->set('section_dets', $section_dets);

      if(($headers = Cache::read('headers')) === false) {
          $headers = $this->DesignOrderHeader->find('all');
          Cache::write('headers', $headers);
      }
      $this->set('headers', $headers);
      if(!empty($this->data)) {

        //проверяем входные данные
        foreach($sections as $section) {
          if (($section['Section']['section_type_id'] == 2)||($section['Section']['section_type_id'] == 7)){

            if (!empty($this->data['DesignOrderDet'][$section['Section']['id']])) {
                foreach($this->data['DesignOrderDet'][$section['Section']['id']] as $n) {
                  if (empty($n['param_value'])) {
                    if ($section['Section']['section_mode_id'] == 1) {
                      //debug($section['Section']['section_name']);
                      $this->Session->setFlash('Не все обязательные поля заполнены', 'default', array('class' => 'info-message'));
                      return;
                    }
                  }
                }
            }
          }
        }

        $this->DesignOrder->create();
        $this->DesignOrder->save($this->data);
        Cache::delete('design_orders');
        
        $design_order_id = $this->DesignOrder->id;

        // идем по всем секциям
        foreach($sections as $section) {
          if (($section['Section']['section_type_id'] == 1)||($section['Section']['section_type_id'] == 4)){

            if (!empty($this->data['DesignOrderDet'][$section['Section']['id']])) {
            /// идем по всем параметрам внутри соответствующей секции(combobox)
                foreach($this->data['DesignOrderDet'][$section['Section']['id']] as $n) {
                  if (!empty($n['param_value'])) {
                      $this->DesignOrderDet->create();
                      $this->data['DesignOrderDet']['id'] = null;
                      $this->data['DesignOrderDet']['design_order_id'] = $design_order_id;
                      $this->data['DesignOrderDet']['section_id']      = $section['Section']['id'];
                      $this->data['DesignOrderDet']['section_det_id']  = $n['param_value'];
                      $ns = $this->SectionDet->findById($n['param_value']);
                      $this->data['DesignOrderDet']['param_value']     = $ns['SectionDet']['param_name'];
                      $this->data['DesignOrderDet']['big_image_id'] = null;
                      $this->DesignOrderDet->save($this->data);
                  }
                }
            }
          }
          else if ($section['Section']['section_type_id'] == 3){

            if (!empty($this->data['DesignOrderDet'][$section['Section']['id']])) {

                  if (!empty($this->data['DesignOrderDet'][$section['Section']['id']]['param_value'])) {
                      $this->DesignOrderDet->create();
                      $this->data['DesignOrderDet']['id'] = null;
                      $this->data['DesignOrderDet']['design_order_id'] = $design_order_id;
                      $this->data['DesignOrderDet']['section_id']      = $section['Section']['id'];
                      $this->data['DesignOrderDet']['section_det_id']  = $this->data['DesignOrderDet'][$section['Section']['id']]['param_value'];
                      $ns = $this->SectionDet->findById($this->data['DesignOrderDet'][$section['Section']['id']]['param_value']);
                      $this->data['DesignOrderDet']['param_value']     = $ns['SectionDet']['param_name'];
                      $this->data['DesignOrderDet']['big_image_id'] = null;
                      $this->DesignOrderDet->save($this->data);
                  }
            }
          }
          else if (($section['Section']['section_type_id'] == 2)||($section['Section']['section_type_id'] == 5)
                    ||($section['Section']['section_type_id'] == 7)) {

            if (!empty($this->data['DesignOrderDet'][$section['Section']['id']])) {
            /// идем по всем параметрам внутри соответствующей секции(текстовое поле)
                foreach($this->data['DesignOrderDet'][$section['Section']['id']] as $n) {
                  if (!empty($n['param_value'])) {
                      $this->DesignOrderDet->create();
                      $this->data['DesignOrderDet']['id'] = null;
                      $this->data['DesignOrderDet']['design_order_id'] = $design_order_id;
                      $this->data['DesignOrderDet']['section_id']      = $section['Section']['id'];
                      $this->data['DesignOrderDet']['section_det_id']  = $n['section_det_id'];
                      $this->data['DesignOrderDet']['param_value']     = $n['param_value'];
                      $this->data['DesignOrderDet']['big_image_id'] = null;
                      $this->DesignOrderDet->save($this->data);
                  }
                }
            }
          }
          else if ($section['Section']['section_type_id'] == 6) {
            if (!empty($this->data['DesignOrderDet'][$section['Section']['id']])) {
            /// идем по всем параметрам внутри соответствующей секции(текстовое поле)
                $i = 0;
                foreach($this->data['DesignOrderDet'][$section['Section']['id']] as $n) {
                if ($n['error'] == 0) {

                    $this->DesignOrderDet->create();

                    $image_id = $this->Image->add($this->data['DesignOrderDet'][$section['Section']['id']][$i], 3);
                    if($image_id != 0) {
                        $this->data['DesignOrderDet']['big_image_id'] = $image_id;
                    }
                    $this->data['DesignOrderDet']['id'] = null;
                    $this->data['DesignOrderDet']['design_order_id'] = $design_order_id;
                    $this->data['DesignOrderDet']['section_id']      = $section['Section']['id'];
                    $this->data['DesignOrderDet']['section_det_id']  = $n['section_det_id'];
                    $this->data['DesignOrderDet']['param_value']     = $n['name'];
                    $this->DesignOrderDet->save($this->data);
                }
                $i++;
               }
            }
          }
        }

        $this->redirect(array(
                    'controller' => 'design_order_dets',
                    'action' => 'end'
                ));

       // debug($this->data['DesignOrderDet']);
      }
    }

	function end() {
      $this->pageTitle = 'Магазин для магазинов';

      if(($design_infos = Cache::read('design_infos')) === false) {
        $design_infos = $this->DesignInfo->find('all', array('order' => 'DesignInfo.sort_order'));
        Cache::write('design_infos', $design_infos);
      }
      $this->set('design_infos', $design_infos);
    }

    function adm_design_section()
    {
      $this->layout = 'admin';
      $this->pageTitle = "Настройка заявки на дизайн";

      if(($sections = Cache::read('sections')) === false) {

        $this->Section->unbindModel(array(
           'hasMany' => array('SectionDet')
        ));

        $sections = $this->Section->find('all', array('order' => 'Section.sort_order'));
        Cache::write('sections', $sections);
      }
      $this->set('sections', $sections);
    }

    function save_list() {

      //debug($this->data);
        if(!empty($this->data)) {

            //секции
            if(!empty($this->data['Section'])) {
                foreach($this->data['Section'] as $section_id => $section) {
                    $data = array();

                    //название
                    if(!empty($section['section_name'])) {
                        $data['section_name'] = $section['section_name'];
                    }

                    //тип секции
                    if(!empty($section['section_type_id'])) {
                        $data['section_type_id'] = $section['section_type_id'];
                    }

                    //обязательное для ввода
                    if(!empty($section['section_mode_id'])) {
                        $data['section_mode_id'] = $section['section_mode_id'];
                    }

                    //Комментарий
                    if(!empty($section['note'])) {
                        $data['note'] = $section['note'];
                    }

                    //сортировка
                    if(!empty($section['sort_order'])) {
                        $data['sort_order'] = $section['sort_order'];
                    }

                    //если что-то надо изменить - сохраняем
                    if(!empty($data)) {
                        $data['id'] = $section_id;
                        $this->Section->id = $section_id;
                        $this->Section->save($data);
                    }
                }
            }

            Cache::delete('sections');
        }
        //перенапрявляем обратно
        $this->redirect($this->referer()); 
    }

    function adm_section_det($section_id = null) {
      $this->layout = 'admin';
      $this->pageTitle = "Настройка секции заявки на дизайн";

      if (!empty($section_id)) {
         $section_dets = $this->SectionDet->find('all', array('conditions' => array('Section.id' => $section_id), 'order' => 'SectionDet.sort_order'));
         $this->set('section_dets', $section_dets);

         $this->set('section_name', $section_dets[0]['Section']['section_name']);
      }
    }

    function save_list_section_det() {

      //debug($this->data);
        if(!empty($this->data)) {

            //секции
            if(!empty($this->data['SectionDet'])) {
                foreach($this->data['SectionDet'] as $section_det_id => $section_det) {
                    $data = array();

                    //название
                    if(!empty($section_det['param_name'])) {
                        $data['param_name'] = $section_det['param_name'];
                    }

                    //секция
                    if(!empty($section_det['section_id'])) {
                        $data['section_id'] = $section_det['section_id'];
                    }

                    //сортировка
                    if(!empty($section_det['sort_order'])) {
                        $data['sort_order'] = $section_det['sort_order'];
                    }

                    //если что-то надо изменить - сохраняем
                    if(!empty($data)) {
                        $data['id'] = $section_det_id;
                        $this->SectionDet->id = $section_det_id;
                        $this->SectionDet->save($data);
                    }
                }
            }
            Cache::delete('section_dets');
        }
        //перенапрявляем обратно
        $this->redirect($this->referer());
    }

}
?>
