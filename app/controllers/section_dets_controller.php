<?php

class SectionDetsController extends AppController {
    var $name = 'SectionDets';
    var $uses = array("SectionDet");

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

   function add_section_det($section_id = null) {
     $this->layout = 'admin';
     $this->pageTitle = 'Параметры секции - добавить';

     if (!empty($section_id)) {
       $this->set('cur_section_id', $section_id);

       if (!empty($this->data)) {

          $this->SectionDet->save($this->data);
          Cache::delete('section_dets');

          $this->redirect(array(
                'controller' => 'design_order_dets',
                'action' => 'adm_section_det/'.$section_id
            ));
       }
     }

   }

    function delete_section_det($id = 0) {
      $this->layout = 'admin';
      $this->pageTitle = 'Параметры секции - удалить';

      $section_dets = $this->SectionDet->id = $id;
      $section_dets = $this->SectionDet->read();
      $this->set('section_dets', $section_dets);

      if(!empty($this->data)) {

        $this->SectionDet->delete();
        Cache::delete('section_dets');

      //  debug($section_dets);
        $this->redirect(array(
            'controller' => 'design_order_dets',
            'action' => 'adm_section_det/'.$section_dets['SectionDet']['section_id']
        ));
      }
    }

}
?>