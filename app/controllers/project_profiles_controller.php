<?php

class ProjectProfilesController extends AppController {
    var $name = 'ProjectProfile';

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function index() {
        $this->layout = 'admin';
        $this->pageTitle = 'Профили портфолио';
        if(($project_profiles = Cache::read('project_profiles')) === false) {
          $project_profiles = $this->ProjectProfile->find('all');
          Cache::write('project_profiles', $project_profiles);
        }
        $this->set('project_profiles', $project_profiles);
    }

    function save() {
        if(!empty($this->data)) {
//            debug($this->data);die;
            if(!empty($this->data['ProjectProfile'])) {
                $real_project_profiles = $this->ProjectProfile->find('all');
                $project_profiles = Set::combine($real_project_profiles, '{n}.ProjectProfile.id', '{n}.ProjectProfile');
                foreach($this->data['ProjectProfile'] as $project_profile_id => $project_profile) {
                    if(empty($project_profiles[$project_profile_id])) continue;

                    $real_project_profile = $project_profiles[$project_profile_id];

                    if($real_project_profile['name'] == $project_profile['name']) continue;

                    $data = array(
                        'name' => $project_profile['name']
                    );
                    $this->ProjectProfile->id = $project_profile_id;
                    $this->ProjectProfile->save($data);
                }
            }

            if(!empty($this->data['ProjectProfileNew'])) {
                foreach($this->data['ProjectProfileNew'] as $project_profile) {
                    $data = array(
                        'name' => $project_profile['name']
                    );

                    $this->ProjectProfile->create();
                    $this->ProjectProfile->save($data);
                }
            }
          Cache::delete('project_profiles');
          Cache::delete('project_profile_list');
          Cache::delete('projects');
        }
        $this->redirect(array(
            'controller' => 'project_profiles',
            'action' => 'index'
        ));
    }

    function delete($id) {
        $this->ProjectProfile->id = $id;
        $this->ProjectProfile->delete();

        Cache::delete('project_profiles');
        Cache::delete('project_profile_list');
        Cache::delete('projects');

        $this->redirect(array(
            'controller' => 'project_profiles',
            'action' => 'index'
        ));
    }
}

?>
