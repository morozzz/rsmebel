<?php

class ProjectSlidesController extends AppController {
    var $name = 'ProjectSlides';

    var $uses = array(
        'ProjectSlide',
        'Project',
        'Image',
        'ProjectSlideCatalog',
        'Catalog'
    );

    var $components = array(
        'Common'
    );

    var $helpers = array(
        'Javascript',
        'CatalogCommon'
    );

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('index');
    }

    function isAuthorized() {
        if($this->action=='adm_index' ||
                $this->action=='save_list' ||
                $this->action=='add' ||
                $this->action=='edit_about' ||
                $this->action=='delete') {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function adm_index($project_id) {
        $this->layout = 'admin';

        $project = $this->Project->find('first', array(
            'conditions' => array(
                'Project.id' => $project_id
            ),
            'recursive' => -1
        ));
        $this->set('project', $project);
        $this->pageTitle = 'Изображения проекта "'.$project['Project']['name'].'"';

        $this->ProjectSlide->unbindModel(array(
            'belongsTo' => array(
                'Project'
            )
        ));
        $this->ProjectSlide->bindModel(array(
            'hasMany' => array(
                'ProjectSlideCatalog'
            )
        ));
        $project_slides = $this->ProjectSlide->find('all', array(
            'conditions' => array(
                'ProjectSlide.project_id' => $project_id
            )
        ));
        $this->Common->RepairImage($project_slides);
        $this->set('project_slides', $project_slides);

        if(($catalog_list = Cache::read('catalog_list')) === false) {
            $catalogs = $this->Catalog->generatetreelist(null, null, null,'', 1);
            $catalog_list[0] = array(
                'value' => 0,
                'name' => 'Корень',
                'class' => 'option-0'
            );
            foreach($catalogs as $catalog_id => $catalog) {
                $catalog_list[$catalog_id] = array(
                    'value' => $catalog_id,
                    'name' => $catalog['Catalog']['name'],
                    'class' => 'option-'.($catalog['level']+1)
                );
            }
          Cache::write('catalog_list', $catalog_list);
        }
        $this->set('catalog_list', $catalog_list);
    }

    function save_list() {
        if(!empty($this->data)) {
            if(!empty($this->data['ProjectSlide'])) {
                foreach($this->data['ProjectSlide'] as $project_slide_id => $project_slide) {
                    $data = array();

                    //сортировка
                    if(!empty($project_slide['sort_order'])) {
                        $data['sort_order'] = $project_slide['sort_order'];
                    }

                    //маленькое изображение
                    if(!empty($project_slide['small_image_file'])) {
                        $image_id = $this->Image->add($project_slide['small_image_file'], 1);
                        $data['small_image_id'] = $image_id;
                    }

                    //большое изображение
                    if(!empty($project_slide['big_image_file'])) {
                        $image_id = $this->Image->add($project_slide['big_image_file'], 1);
                        $data['big_image_id'] = $image_id;
                    }

                    if(!empty($data)) {
                        $data['id'] = $project_slide_id;
                        $this->ProjectSlide->id = $project_slide_id;
                        $this->ProjectSlide->save($data);
                    }
                }
            }

            //изображения
            if(!empty($this->data['Image'])) {
                foreach($this->data['Image'] as $image_id => $image) {
                    $this->Image->update($image, $image_id);
                }
            }
          Cache::delete('projects');
        }
        $this->redirect($this->referer());
    }

    function add() {
        if(!empty($this->data['ProjectSlide'])) {
            $project_id = $this->data['project_id'];

            $min_sort_order = $this->ProjectSlide->find('first', array(
                'conditions' => array(
                    'ProjectSlide.project_id' => $project_id
                ),
                'fields' => array(
                    'min(sort_order) AS min_sort_order'
                ),
                'recursive' => -1
            ));
            $min_sort_order = $min_sort_order[0]['min_sort_order'];

            $data = array(
                'sort_order' => $min_sort_order - 1,
                'project_id' => $project_id
            );

            //маленькое изображение
            if(!empty($this->data['ProjectSlide']['small_image_file'])) {
                $image_id = $this->Image->add($this->data['ProjectSlide']['small_image_file'], 1);
                $data['small_image_id'] = $image_id;
            }

            //большое изображение
            if(!empty($this->data['ProjectSlide']['big_image_file'])) {
                $image_id = $this->Image->add($this->data['ProjectSlide']['big_image_file'], 1);
                $data['big_image_id'] = $image_id;
            }

            $this->ProjectSlide->create();
            $this->ProjectSlide->save($data);
            Cache::delete('projects');
        }
        $this->redirect($this->referer());
    }

    function edit_about() {
        if(!empty($this->data)) {
            $data = array(
                'id' => $this->data['project_slide_id']
            );

            if(!empty($this->data['about'])) {
                $data['about'] = $this->data['about'];
            }

            $this->ProjectSlide->save($data);
            Cache::delete('projects');
        }

        $this->redirect($this->referer());
    }

    function delete() {
        if(!empty($this->data)) {
            $project_slide = $this->ProjectSlide->find('first', array(
                'conditions' => array(
                    'ProjectSlide.id' => $this->data['project_slide_id']
                ),
                'recursive' => -1
            ));
            
            if(!empty($project_slide['ProjectSlide']['small_image_id'])) {
                $this->Image->delete($project_slide['ProjectSlide']['small_image_id']);
            }
            if(!empty($project_slide['ProjectSlide']['big_image_id'])) {
                $this->Image->delete($project_slide['ProjectSlide']['big_image_id']);
            }

            $this->ProjectSlide->id = $project_slide['ProjectSlide']['id'];
            $this->ProjectSlide->delete();
            Cache::delete('projects');
        }

        $this->redirect($this->referer());
    }

    function connect_with_catalogs() {
        if(!empty($this->data)) {
            $project_slide_id = $this->data['project_slide_id'];
            if(!empty($this->data['actions'])) {
                foreach($this->data['actions'] as $action) {
                    $catalog_id = $action['catalog_id'];
                    if($action['type'] == 'add') {
                        $cnt = $this->ProjectSlideCatalog->find('count', array(
                            'conditions' => array(
                                'ProjectSlideCatalog.project_slide_id' => $project_slide_id,
                                'ProjectSlideCatalog.catalog_id' => $catalog_id
                            )
                        ));
                        if($cnt <= 0) {
                            $data = array(
                                'project_slide_id' => $project_slide_id,
                                'catalog_id' => $catalog_id
                            );
                            $this->ProjectSlideCatalog->create();
                            $this->ProjectSlideCatalog->save($data);
                        }
                    } else if($action['type'] == 'delete') {
                        $this->ProjectSlideCatalog->deleteAll(array(
                            'project_slide_id' => $project_slide_id,
                            'catalog_id' => $catalog_id
                        ));
                    }
                }
            }
           Cache::delete('projects');   
        }
        $this->redirect($this->referer());
    }

    function index($slide_id) {
        $slide = $this->ProjectSlide->find('first', array(
            'conditions' => array(
                'ProjectSlide.id' => $slide_id
            )
        ));
        $this->set('slide', $slide);
        $this->pageTitle = $slide['Project']['name'].' - Галерея';

        $slide_catalogs = $this->ProjectSlideCatalog->find('all', array(
            'conditions' => array(
                'ProjectSlideCatalog.project_slide_id' => $slide_id
            ),
            'recursive' => -1
        ));
        foreach($slide_catalogs as &$slide_catalog) {
            $catalog_id = $slide_catalog['ProjectSlideCatalog']['catalog_id'];
            $path = $this->Catalog->getpath($catalog_id);
            $path = Set::combine($path, '{n}.Catalog.id', '{n}.Catalog.name');
            $slide_catalog['path'] = $path;
        }
        $slide_catalogs = Set::combine($slide_catalogs, '{n}.ProjectSlideCatalog.catalog_id', '{n}.path');
        $this->set('slide_catalogs', $slide_catalogs);

        $neighbors = $this->ProjectSlide->find('neighbors', array(
            'conditions' => array(
                'ProjectSlide.project_id' => $slide['Project']['id']
            ),
            'field' => 'ProjectSlide.sort_order',
            'value' => $slide['ProjectSlide']['sort_order']
        ));
        if(empty($neighbors['prev'])) unset($neighbors['prev']);
        if(empty($neighbors['next'])) unset($neighbors['next']);
        $this->set('neighbors', $neighbors);

        $slide_cnt = $this->ProjectSlide->find('count', array(
            'conditions' => array(
                'ProjectSlide.project_id' => $slide['Project']['id']
            )
        ));
        $this->set('slide_cnt', $slide_cnt);
    }
}

?>
