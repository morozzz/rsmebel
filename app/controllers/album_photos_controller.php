<?php

class AlbumPhotosController extends AppController {
    var $name = 'AlbumPhotos';
    var $uses = array(
        'AlbumPhoto',
        'Album'
    );
    var $helpers = array(
        'AdminCommon'
    );
    var $components = array(
        'AdminCommon'
    );

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return ($this->curUser['User']['role_id'] == 3);
        }
        return true;
    }

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('index');
        $this->Auth2->allow('show');
    }

    function index($album_id = null) {
        $album = $this->Album->find('first', array(
            'conditions' => array(
                'Album.id' => $album_id
            ),
            'contain' => array()
        ));

        if(empty($album)) {
            $opts = array(
                'name' => 'Неверный номер альбома',
                'code' => 404,
                'message' => 'Данный альбом отсутствует',
                'base' => $this->base
            );
            $this->cakeError('error', array($opts));
        }
        $this->pageTitle = $album['Album']['name'];
        $this->set('album', $album);

        $album_photos = $this->AlbumPhoto->find('all', array(
            'conditions' => array(
                'AlbumPhoto.album_id' => $album_id
            ),
            'contain' => array(
                'SmallImage'
            )
        ));
        $album_photos = Set::combine($album_photos, '{n}.AlbumPhoto.id', '{n}');
        $this->set('album_photos', $album_photos);
    }

    function show($album_id, $photo_index) {
        $album = $this->Album->find('first', array(
            'conditions' => array(
                'Album.id' => $album_id
            ),
            'contain' => array()
        ));

        if(empty($album)) {
            $opts = array(
                'name' => 'Неверный номер альбома',
                'code' => 404,
                'message' => 'Данный альбом отсутствует',
                'base' => $this->base
            );
            $this->cakeError('error', array($opts));
        }
        $this->pageTitle = $album['Album']['name'];
        $this->set('album', $album);
        
        $album_photo = $this->AlbumPhoto->find('first', array(
            'conditions' => array(
                'AlbumPhoto.album_id' => $album_id
            ),
            'contain' => array(
                'BigImage'
            ),
            'page' => $photo_index
        ));
        $this->set('album_photo', $album_photo);

        $cnt = $this->AlbumPhoto->find('count', array(
            'conditions' => array(
                'AlbumPhoto.album_id' => $album_id
            )
        ));
        $this->set('cnt', $cnt);

        $this->set('photo_index', $photo_index);
    }

    function adm_index($album_id) {
        $this->layout = 'admin';
        $album = $this->Album->find('first', array(
            'conditions' => array(
                'Album.id' => $album_id
            ),
            'contain' => array()
        ));
        if(empty($album)) {
            $opts = array(
                'name' => 'Неверный номер альбома',
                'code' => 404,
                'message' => 'Данный альбом отсутствует',
                'base' => $this->base
            );
            $this->cakeError('error', array($opts));
        }
        $this->set('album', $album);
        $this->pageTitle = "Фотографии альбома  '{$album['Album']['name']}'";

        $album_photos = $this->AlbumPhoto->find('all', array(
            'conditions' => array(
                'AlbumPhoto.album_id' => $album_id
            ),
            'contain' => array(
                'SmallImage',
                'BigImage'
            )
        ));
        $album_photos = Set::combine($album_photos, '{n}.AlbumPhoto.id', '{n}');
        $this->set('album_photos', $album_photos);
    }

    function save_all() {
        $this->AdminCommon->save_all($this->data, $this->AlbumPhoto);
        $this->redirect($this->referer());
        die;
    }

    function add() {
        $this->AdminCommon->add($this->data, $this->AlbumPhoto);
        die;
    }

    function delete() {
        $this->AdminCommon->delete($this->data, $this->AlbumPhoto);
        die;
    }
}

?>
