<?php

class ProjectsController extends AppController {
    var $name = 'Project';

    var $uses = array(
        'Project',
        'ProjectProfile',
        'ProjectCatalog',
        'ProjectSlide',
        'Image',
        'Catalog'
    );

    var $components = array(
        'Common'
    );

    var $helpers = array(
        'Javascript',
        'CatalogCommon'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('index');
        $this->Auth2->allow('show');
    }

//    function isAuthorized() {
//        if($this->action=='adm_index' ||
//                $this->action=='save_list' ||
//                $this->action=='add' ||
//                $this->action=='edit_about' ||
//                $this->action=='delete' ||
//                $this->action=='connect_with_catalogs') {
//            return $this->curUser['User']['role_id'] == 3;
//        }
//        return true;
//    }

    function adm_index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Редактирование портфолио';

        if(($projects = Cache::read('projects')) === false) {

            $this->Project->bindModel(array(
                'hasMany' => array(
                    'ProjectCatalog'
                )
            ));
            $projects = $this->Project->find('all');
            $this->Common->RepairImage($projects);
            Cache::write('projects', $projects);
        }
        $this->set('projects', $projects);

        if(($project_profile_list = Cache::read('project_profile_list')) === false) {
          $project_profile_list = $this->ProjectProfile->find('list');
            Cache::write('project_profile_list', $project_profile_list);
        }
        $this->set('project_profile_list', $project_profile_list);

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
            if(!empty($this->data['Project'])) {
                foreach($this->data['Project'] as $project_id => $project) {
                    $data = array();

                    //название
                    if(!empty($project['name'])) {
                        $data['name'] = $project['name'];
                    }

                    //профиль
                    if(!empty($project['profile_id'])) {
                        $data['project_profile_id'] = $project['profile_id'];
                    }

                    //адрес
                    if(!empty($project['address'])) {
                        $data['address'] = $project['address'];
                    }

                    //сортировка
                    if(!empty($project['sort_order'])) {
                        $data['sort_order'] = $project['sort_order'];
                    }

                    //маленькое изображение
                    if(!empty($project['small_image_file'])) {
                        $image_id = $this->Image->add($project['small_image_file'], 1);
                        $data['small_image_id'] = $image_id;
                    }

                    //большое изображение
                    if(!empty($project['big_image_file'])) {
                        $image_id = $this->Image->add($project['big_image_file'], 1);
                        $data['big_image_id'] = $image_id;
                    }

                    if(!empty($data)) {
                        $data['id'] = $project_id;
                        $this->Project->id = $project_id;
                        $this->Project->save($data);
                        Cache::delete('projects');
                    }
                }
            }

            //изображения
            if(!empty($this->data['Image'])) {
                foreach($this->data['Image'] as $image_id => $image) {
                    $this->Image->update($image, $image_id);
                }
            }
        }
        $this->redirect($this->referer());
    }

    function add() {
        if(!empty($this->data['Project'])) {
            $min_sort_order = $this->Project->find('first', array(
                'fields' => array(
                    'min(sort_order) AS min_sort_order'
                ),
                'recursive' => -1
            ));
            $min_sort_order = $min_sort_order[0]['min_sort_order'];

            $data = array(
                'name' => $this->data['Project']['name'],
                'sort_order' => $min_sort_order - 1
            );

            $this->Project->create();
            $this->Project->save($data);
            Cache::delete('projects');
        }
        $this->redirect($this->referer());
    }

    function edit_about() {
        if(!empty($this->data)) {
            $data = array(
                'id' => $this->data['project_id']
            );

            if(!empty($this->data['about'])) {
                $data['about'] = $this->data['about'];
            }

            $this->Project->save($data);
            Cache::delete('projects');
        }

        $this->redirect($this->referer());
    }

    function delete() {
        if(!empty($this->data)) {
            $project = $this->Project->findById($this->data['project_id']);
            if(!empty($project['Project']['small_image_id'])) {
                $this->Image->delete($project['Project']['small_image_id']);
            }
            if(!empty($project['Project']['big_image_id'])) {
                $this->Image->delete($project['Project']['big_image_id']);
            }

            $this->Project->id = $project['Project']['id'];
            $this->Project->delete();
            Cache::delete('projects');
        }

        $this->redirect($this->referer());
    }

    function connect_with_catalogs() {
        if(!empty($this->data)) {
            $project_id = $this->data['project_id'];
            if(!empty($this->data['actions'])) {
                foreach($this->data['actions'] as $action) {
                    $catalog_id = $action['catalog_id'];
                    if($action['type'] == 'add') {
                        $cnt = $this->ProjectCatalog->find('count', array(
                            'conditions' => array(
                                'ProjectCatalog.project_id' => $project_id,
                                'ProjectCatalog.catalog_id' => $catalog_id
                            )
                        ));
                        if($cnt <= 0) {
                            $data = array(
                                'project_id' => $project_id,
                                'catalog_id' => $catalog_id
                            );
                            $this->ProjectCatalog->create();
                            $this->ProjectCatalog->save($data);
                        }
                    } else if($action['type'] == 'delete') {
                        $this->ProjectCatalog->deleteAll(array(
                            'project_id' => $project_id,
                            'catalog_id' => $catalog_id
                        ));
                    }
                }
            }
           Cache::delete('projects');
        }
        $this->redirect($this->referer());
    }

    function index($profile_id = 0) {
        $this->pageTitle = 'Портфолио';

//        $project_profile_list = array(
//            0 => 'Все'
//        );
//        $project_profile_list += $this->ProjectProfile->find('list');

        if(($project_profile_list = Cache::read('project_profile_list')) === false) {
          $project_profile_list = $this->ProjectProfile->find('list');
          Cache::write('project_profile_list', $project_profile_list);
        }

        $project_profile_list_all = array(
            0 => 'Все'
        );

        $project_profile_list += $project_profile_list_all;

        $this->set('project_profile_list', $project_profile_list);

        $conditions = array();
        if($profile_id != 0) {
            $conditions['Project.project_profile_id'] = $profile_id;
        }

        $this->paginate = array(
            'Project' => array(
                'conditions' => $conditions,
                'limit' => 9
            )
        );
        $projects = $this->paginate('Project');
        $this->Common->RepairImage($projects);
        $projects = Set::combine($projects, '{n}.Project.id', '{n}');
        $this->set('projects', $projects);

        $limit_array = $this->params['named'];
        $limit = (empty($limit_array['limit']))?9:$limit_array['limit'];
        $this->set('limit', $limit);

        $this->set('profile_id', $profile_id);
    }

    function show($project_id = 0) {
        if($project_id == 0) {
            $this->redirect(array(
                'controller' => 'projects',
                'action' => index
            ));
        }

        $project = $this->Project->find('first', array(
            'conditions' => array(
                'Project.id' => $project_id
            )
        ));
        $this->set('project', $project);

        $this->pageTitle = $project['Project']['name'].' - Галерея';

        $project_catalogs = $this->ProjectCatalog->find('all', array(
            'conditions' => array(
                'ProjectCatalog.project_id' => $project_id
            ),
            'recursive' => -1
        ));
        foreach($project_catalogs as &$project_catalog) {
            $catalog_id = $project_catalog['ProjectCatalog']['catalog_id'];
            $path = $this->Catalog->getpath($catalog_id);
            $path = Set::combine($path, '{n}.Catalog.id', '{n}.Catalog.name');
            $project_catalog['path'] = $path;
        }
        $project_catalogs = Set::combine($project_catalogs, '{n}.ProjectCatalog.catalog_id', '{n}.path');
        $this->set('project_catalogs', $project_catalogs);

        $this->ProjectSlide->unbindModel(array(
            'belongsTo' => array(
                'Project',
                'BigImage'
            )
        ));
        $project_slides = $this->ProjectSlide->find('all', array(
            'conditions' => array(
                'ProjectSlide.project_id' => $project_id
            )
        ));
        $project_slides = Set::combine($project_slides, '{n}.ProjectSlide.id', '{n}');
        $this->Common->RepairImage($project_slides);
        $this->set('project_slides', $project_slides);

        $neighbors = $this->Project->find('neighbors', array(
            'field' => 'Project.sort_order',
            'value' => $project['Project']['sort_order']
        ));
        if(empty($neighbors['prev'])) unset($neighbors['prev']);
        if(empty($neighbors['next'])) unset($neighbors['next']);
        $this->set('neighbors', $neighbors);

        $project_cnt = $this->Project->find('count');
        $this->set('project_cnt', $project_cnt);
    }
}

?>
