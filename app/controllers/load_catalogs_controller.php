<?php

class LoadCatalogsController extends AppController {
    var $name = 'LoadCatalogs';
    var $uses = array("LoadCatalog", "LoadCatalogDet", "User", "Catalog", "Product", "ProductDet");
    var $helpers = array('Form', 'Session');

    function isAuthorized() {
        if(!empty($this->curUser)) {
            return $this->curUser['User']['role_id'] == 3;
        }
        return true;
    }

    function index() {
      $this->pageTitle = "Загрузка каталога из файла";
      $this->layout = 'admin';

      if(($lcatalogs = Cache::read('l_catalogs')) === false) {

          $this->LoadCatalog->unbindModel(array(
            'hasMany' => array('LoadCatalogDet')
          ));

          $lcatalogs = $this->LoadCatalog->find('all', array('fields' => array('date_format(LoadCatalog.created, "%d.%m.%Y") AS created',
                                                                               'LoadCatalog.status_id',
                                                                               'LoadCatalog.id',
                                                                               'LoadCatalog.note',
                                                                               'LoadCatalog.file_name',
                                                                               'User.username'),
                                                             'order' => 'LoadCatalog.created DESC'));

          $i = 0;
          foreach($lcatalogs as $lcatalog) {
            if($lcatalogs[$i]['LoadCatalog']['status_id'] == 0) {
              $lcatalogs[$i]['LoadCatalog']['status_name'] = 'Не загружен';
            }
            else if($lcatalogs[$i]['LoadCatalog']['status_id'] == 1) {
              $lcatalogs[$i]['LoadCatalog']['status_name'] = 'Файл залит';
            }
            else if($lcatalogs[$i]['LoadCatalog']['status_id'] == 2) {
              $lcatalogs[$i]['LoadCatalog']['status_name'] = 'Загружен';
            }

            $lcatalog_cnt = $this->LoadCatalogDet->find('count', array('conditions' => array('LoadCatalogDet.load_catalog_id' => $lcatalogs[$i]['LoadCatalog']['id'])));
            $lcatalog_err_cnt = $this->LoadCatalogDet->find('count', array('conditions' => array('LoadCatalogDet.load_catalog_id' => $lcatalogs[$i]['LoadCatalog']['id'],
                                                                                                 'LoadCatalogDet.status_id < ' => 0)));

            $lcatalog_proc_cnt = $this->LoadCatalogDet->find('count', array('conditions' => array('LoadCatalogDet.load_catalog_id' => $lcatalogs[$i]['LoadCatalog']['id'],
                                                                                                 'LoadCatalogDet.status_id ' => 1)));

            $lcatalogs[$i]['LoadCatalog']['proc_cnt'] = $lcatalog_proc_cnt;
            $lcatalogs[$i]['LoadCatalog']['err_cnt'] = $lcatalog_err_cnt;
            $lcatalogs[$i]['LoadCatalog']['cnt'] = $lcatalog_cnt;

            $i++;
          }
      
          Cache::write('l_catalogs', $lcatalogs);      
      }
      $this->set('l_catalogs', $lcatalogs);

      //debug($lcatalogs);
    }

    function add() {

      $this->layout = 'admin';
      $this->pageTitle = 'Загрузки - добавить';

      if(!empty($this->data)) {

        $this->data['LoadCatalog']['user_id'] = $this->Session->read('Auth.User.id');
        $this->data['LoadCatalog']['file_name'] = $this->data['LoadCatalog']['add_file']['name'];

        if($this->LoadCatalog->save($this->data)) {
          $path_info = pathinfo($this->data['LoadCatalog']['add_file']['name']);
          $file_name = $this->data['LoadCatalog']['add_file']['name'];
          $extension = $path_info['extension'];

          $file_name = "../webroot/doc/catalog/".$file_name;

          if (($extension == 'txt')||($extension == 'csv')) {
            move_uploaded_file($this->data['LoadCatalog']['add_file']['tmp_name'], iconv("UTF-8", "WINDOWS-1251", $file_name));
          }
          Cache::delete('l_catalogs');
        }

        $this->redirect(array(
                    'controller' => 'load_catalogs',
                    'action' => 'index'
                ));
      }
    }

    function delete($id = 0) {
      $this->layout = 'admin';
      $this->pageTitle = 'Загрузки - удаление';

      $lcatalogs = $this->LoadCatalog->id = $id;
      $this->set('lcatalogs', $this->LoadCatalog->read());

      if(!empty($this->data)) {

        if($this->LoadCatalogDet->deleteall(array('load_catalog_id' => $id))) {
          $this->LoadCatalog->delete();
          Cache::delete('l_catalogs');
        }
       
        $this->redirect(array(
                    'controller' => 'load_catalogs',
                    'action' => 'index'
                ));
      }
    }

    function load_file() {
        if($this->params['isAjax'] == 1) {
            $this->layout = 'ajax';

            $data = $this->params['form'];
            $load_catalogs_id = $data['id'];
            $file_name = $data['file_name'];

            $file_name = "../webroot/doc/catalog/".$file_name;

            $fd = fopen($file_name, "r");

            if (!empty($fd)) {
                //while (($arr = fgetcsv($fd, 1024, ";")) !== FALSE) {
                while (!feof($fd)) {
                  $buffer = fgets($fd, 4096);
                  $arr = split(';', $buffer);
                  if (empty($arr[0])) { $arr[0] = 0; }
                  if (empty($arr[1])) { $arr[1] = ''; }
                  if (empty($arr[2])) { $arr[2] = ''; }
                  if (empty($arr[3])) { $arr[3] = ''; }
                  if (empty($arr[4])) { $arr[4] = 0; }
                  if (empty($arr[5])) { $arr[5] = 0; }

                  $this->data['LoadCatalogDet']['id'] = null;
                  $this->data['LoadCatalogDet']['load_catalog_id'] = $load_catalogs_id;
                  $this->data['LoadCatalogDet']['status_id'] = 0;
                  $this->data['LoadCatalogDet']['flag'] = $arr[0];
                  $this->data['LoadCatalogDet']['1c_kod_catalog'] = iconv("WINDOWS-1251", "UTF-8", $arr[1]);
                  $this->data['LoadCatalogDet']['1c_kod_product'] = iconv("WINDOWS-1251", "UTF-8", $arr[2]);
                  $this->data['LoadCatalogDet']['pname'] = iconv("WINDOWS-1251", "UTF-8", $arr[3]);
                  $this->data['LoadCatalogDet']['price'] = $arr[4];
                  $this->data['LoadCatalogDet']['cnt'] = $arr[5];

                  $this->LoadCatalog->LoadCatalogDet->save($this->data);
                }

                $this->LoadCatalog->id = $load_catalogs_id;
                $this->data['LoadCatalog']['status_id'] = 1;
                if($this->LoadCatalog->save($this->data, $fieldList = array('LoadCatalog.status_id'))) {

                     echo "window.location = 'load_catalogs';";
             //      echo "load_catalog_list_table.fnUpdate('Файл залит', tr, 5); ";
             //      echo "load_catalog_list_table.fnUpdate('', tr, 8); ";
             //      echo "load_catalog_list_table.fnUpdate('<a href=\'/cake/load_catalog_dets/show/".$load_catalogs_id."\'>просмотр</a>', tr, 9); ";
             //      echo "load_catalog_list_table.fnUpdate('', tr, 10); ";
             //      echo "load_catalog_list_table.fnUpdate('<div class=\'link-load-catalogs\'><a href=\'#\'>загрузить в каталог</a></div>', tr, 11); ";
                }

               Cache::delete('l_catalogs');
            } else {
               echo "alert('Невозможно открыть файл ".$file_name."'); ";
            }
        }
    }

    function load() {
        if($this->params['isAjax'] == 1) {
            $this->layout = 'ajax';

             set_time_limit(6000);

            $data = $this->params['form'];
            $load_catalog_id = $data['id'];

            //$load_catalog_id = 33;

            /////////////////////// находим служебный - каталоги
            $catalog = $this->Catalog->find('all',  array('conditions' => array('catalog_type_id' => 2, 'code_1c' => null, 'parent_id' => null)));
            $catalog_office_id = $catalog[0]['Catalog']['id'];
            ///////////////////////

            /////////////////////// находим служебный - товары
            $catalog = $this->Catalog->find('all',  array('conditions' => array('catalog_type_id' => 3, 'code_1c' => null, 'parent_id' => null)));
            $catalog_product_id = $catalog[0]['Catalog']['id'];
            ///////////////////////


            /////////////////////// сначала обрабатываем новые каталоги
            //////////////////////// (верхний уровень, затем подкаталоги)
            $lcatalog_dets = $this->LoadCatalogDet->find('all', array('conditions' => array('LoadCatalogDet.load_catalog_id' => $load_catalog_id,
                                                                                            'LoadCatalogDet.status_id' => 0,
                                                                                            'LoadCatalogDet.flag' => 1
                                                                                            ),
                                                                      'order' => '1c_kod_catalog'
                                                         ));

            $i = 0; $cnt = 0;
            foreach($lcatalog_dets as $lcatalog_det) {

              $code_1c = $lcatalog_dets[$i]['LoadCatalogDet']['1c_kod_product'];

              //echo "alert(".$code_1c.");";F

              if ($code_1c <> '') {
                $lcatalog_cnt = $this->Catalog->find('count', array('conditions' => array('code_1c' => $code_1c)));

                if($lcatalog_cnt == 0) {

                  $this->Catalog->create();
                  $this->data['Catalog']['name'] = $lcatalog_dets[$i]['LoadCatalogDet']['pname'];
                  $this->data['Catalog']['name_1c'] = $lcatalog_dets[$i]['LoadCatalogDet']['pname'];

                    ///// если каталог верхнего уровня, то отправляем его в служебный, иначе - согласно иерархии
                    if($lcatalog_dets[$i]['LoadCatalogDet']['1c_kod_catalog'] == '') {
                      $this->data['Catalog']['parent_id'] = $catalog_office_id;
                      //  $this->data['Catalog']['parent_id'] = null;
                    } else {

                      /////////////////////// находим каталог куда запихнуть(пихаем только в служебные каталоги)
                      $catalog = $this->Catalog->find('all',  array('conditions' => array('code_1c' => $lcatalog_dets[$i]['LoadCatalogDet']['1c_kod_catalog'],
                                                                                          'catalog_type_id' => 2,
                                                                                          'parent_id <>' => null)));
                      if (!empty($catalog)) {
                        $parent_catalog_id = $catalog[0]['Catalog']['id'];
                      } else {
                        $parent_catalog_id = $catalog_office_id;
                      }
                      ///////////////////////

                      $this->data['Catalog']['parent_id'] = $parent_catalog_id;
                    }
                  $this->data['Catalog']['sort_order'] = 1;
                  $this->data['Catalog']['catalog_type_id'] = 2;
                  $this->data['Catalog']['code_1c'] = $code_1c;

                  if($this->Catalog->save($this->data)) {
                    $this->Catalog->commit();

                    //помечаем строку как обработанную
                    $this->LoadCatalogDet->id = $lcatalog_dets[$i]['LoadCatalogDet']['id'];
                    $this->data['LoadCatalogDet']['status_id'] = 1;
                  }
                  else {
                    $this->LoadCatalogDet->id = $lcatalog_dets[$i]['LoadCatalogDet']['id'];
                    $this->data['LoadCatalogDet']['status_id'] = -2;
                  }
                  /////////признак добавления нового каталога
                  $cnt = 1;
                }
                else {
                  $this->Catalog->updateAll(array(
                      'Catalog.name_1c' => $lcatalog_dets[$i]['LoadCatalogDet']['pname']
                  ), array(
                      'Catalog.code_1c' => $code_1c
                  ));

                  $this->LoadCatalogDet->id = $lcatalog_dets[$i]['LoadCatalogDet']['id'];
                  $this->data['LoadCatalogDet']['status_id'] = 1;
                }

                $this->LoadCatalog->LoadCatalogDet->save($this->data, $fieldList = array('status_id'));
              }
              $i++;
            }
           /////////////////////////////////////////////////////////////////

            //////////////////////// обрабатываем товары
            $lcatalog_dets = $this->LoadCatalogDet->find('all', array('conditions' => array('LoadCatalogDet.load_catalog_id' => $load_catalog_id,
                                                                                            'LoadCatalogDet.status_id' => 0,
                                                                                            'LoadCatalogDet.flag' => 0
                                                                                            ),
                                                                      'order' => '1c_kod_catalog'
                                                         ));

            $i = 0;
            foreach($lcatalog_dets as $lcatalog_det) {

              $code_1c = $lcatalog_dets[$i]['LoadCatalogDet']['1c_kod_product'];

              if ($code_1c <> '') {

                $product_cnt = $this->Product->find('count', array('conditions' => array('Product.code_1c' => $code_1c)));
                $product_det_cnt = $this->ProductDet->find('count', array('conditions' => array('ProductDet.code_1c' => $code_1c)));

             //   echo "alert('product_cnt=".$product_cnt.");";
             //   echo "alert('product_det_cnt=".$product_det_cnt.");";

               // break;
                /////// если товара нет нигде, тогда добавляем новый
                if(($product_det_cnt == 0)&&($product_cnt == 0)){

                  $this->Product->create();
                  $this->data['Product']['name'] = $lcatalog_dets[$i]['LoadCatalogDet']['pname'];
                  $this->data['Product']['name_1c'] = $lcatalog_dets[$i]['LoadCatalogDet']['pname'];

                    ///// ищем в какой каталог запихнуть товар
                    if($lcatalog_dets[$i]['LoadCatalogDet']['1c_kod_catalog'] == '') {
                      $this->data['Product']['catalog_id'] = $catalog_product_id;
                    } else {

                      /////////////////////// находим каталог куда запихнуть(пихаем только в служебные каталоги)
                      $catalog = $this->Catalog->find('all',  array('conditions' => array('code_1c' => $lcatalog_dets[$i]['LoadCatalogDet']['1c_kod_catalog'],
                                                                                          'catalog_type_id' => 2,
                                                                                          'parent_id <>' => null)));
                      if (!empty($catalog)) {
                        $parent_catalog_id = $catalog[0]['Catalog']['id'];
                      } else {
                        $parent_catalog_id = $catalog_product_id;
                      }
                      ///////////////////////

                      $this->data['Product']['catalog_id'] = $parent_catalog_id;
                    }

              //    echo "alert('catalog_id=".$this->data['Product']['catalog_id'].");";

                  $this->data['Product']['sort_order'] = null;
                  $this->data['Product']['price'] = $lcatalog_dets[$i]['LoadCatalogDet']['price'];
                  $this->data['Product']['cnt'] = $lcatalog_dets[$i]['LoadCatalogDet']['cnt'];
                  $this->data['Product']['article'] = null;
                  $this->data['Product']['small_image_id'] = null;
                  $this->data['Product']['big_image_id'] = null;
                  $this->data['Product']['code_1c'] = $code_1c;
                  $this->data['Product']['short_about'] = null;
                  $this->data['Product']['long_about'] = null;

                  if($this->Product->save($this->data)) {
                    $this->Product->commit();

                    //помечаем строку как обработанную
                    $this->LoadCatalogDet->id = $lcatalog_dets[$i]['LoadCatalogDet']['id'];
                    $this->data['LoadCatalogDet']['status_id'] = 1;
                  }
                  else {
                    $this->LoadCatalogDet->id = $lcatalog_dets[$i]['LoadCatalogDet']['id'];
                    $this->data['LoadCatalogDet']['status_id'] = -3;
                  }
                }
                //////////////  если товар как товар, то обновляем price и cnt
                else if(($product_det_cnt == 0)&&($product_cnt == 1)) {

                  $product = $this->Product->find('all', array('conditions' => array('Product.code_1c' => $code_1c)));

                  $this->Product->id = $product[0]['Product']['id'];
                  $this->data['Product']['name'] =  $product[0]['Product']['name'];
                  $this->data['Product']['catalog_id'] = $product[0]['Product']['catalog_id'];
                  $this->data['Product']['sort_order'] = $product[0]['Product']['sort_order'];
                  $this->data['Product']['cnt'] = $lcatalog_dets[$i]['LoadCatalogDet']['cnt'];
                  $this->data['Product']['name_1c'] = $lcatalog_dets[$i]['LoadCatalogDet']['pname'];
                  $this->data['Product']['sort_order'] = $product[0]['Product']['sort_order'];
                  $this->data['Product']['article'] = $product[0]['Product']['article'];;
                  $this->data['Product']['small_image_id'] = $product[0]['Product']['small_image_id'];;
                  $this->data['Product']['big_image_id'] = $product[0]['Product']['big_image_id'];;
                  $this->data['Product']['code_1c'] = $product[0]['Product']['code_1c'];;
                  $this->data['Product']['short_about'] = $product[0]['Product']['short_about'];;
                  $this->data['Product']['long_about'] = $product[0]['Product']['long_about'];;

                  if($product[0]['Product']['fix_price'] == 0) {
                      $this->data['Product']['price'] = $lcatalog_dets[$i]['LoadCatalogDet']['price'];
                  } else {
                      $this->data['Product']['price'] = $product[0]['Product']['price'];
                  }
                  if($product[0]['Product']['fix_cnt'] == 0) {
                      $this->data['Product']['cnt'] = $lcatalog_dets[$i]['LoadCatalogDet']['cnt'];
                  } else {
                      $this->data['Product']['cnt'] = $product[0]['Product']['cnt'];
                  }

                  if($this->Product->save($this->data, $fieldList = array('Product.price', 'Product.cnt'))) {
                    $this->LoadCatalogDet->id = $lcatalog_dets[$i]['LoadCatalogDet']['id'];
                    $this->data['LoadCatalogDet']['status_id'] = 1;
                  } else {
                    $this->LoadCatalogDet->id = $lcatalog_dets[$i]['LoadCatalogDet']['id'];
                    $this->data['LoadCatalogDet']['status_id'] = -5;
                  }
                }
                //////////////  если товар как детализация, то обновляем price и cnt
                else if(($product_det_cnt == 1)&&($product_cnt == 0)) {

                  $product_det = $this->ProductDet->find('all', array('conditions' => array('ProductDet.code_1c' => $code_1c)));

                  $this->ProductDet->id = $product_det[0]['ProductDet']['id'];
                  $this->data['ProductDet']['cnt'] = $lcatalog_dets[$i]['LoadCatalogDet']['cnt'];
                  $this->data['ProductDet']['name_1c'] = $lcatalog_dets[$i]['LoadCatalogDet']['pname'];

                  if($product_det[0]['ProductDet']['fix_price'] == 0) {
                      $this->data['ProductDet']['price'] = $lcatalog_dets[$i]['LoadCatalogDet']['price'];
                  } else {
                      $this->data['ProductDet']['price'] = $product_det[0]['ProductDet']['price'];
                  }
                  if($product_det[0]['ProductDet']['fix_cnt'] == 0) {
                      $this->data['ProductDet']['cnt'] = $lcatalog_dets[$i]['LoadCatalogDet']['cnt'];
                  } else {
                      $this->data['ProductDet']['cnt'] = $product_det[0]['ProductDet']['cnt'];
                  }
                  
                  if($this->ProductDet->save($this->data, $fieldList = array('ProductDet.price', 'ProductDet.cnt'))) {
                    $this->LoadCatalogDet->id = $lcatalog_dets[$i]['LoadCatalogDet']['id'];
                    $this->data['LoadCatalogDet']['status_id'] = 1;
                  } else {
                    $this->LoadCatalogDet->id = $lcatalog_dets[$i]['LoadCatalogDet']['id'];
                    $this->data['LoadCatalogDet']['status_id'] = -6;
                  }
                }
                else if (($product_det_cnt > 1)||($product_cnt > 1)) {
                  $this->LoadCatalogDet->id = $lcatalog_dets[$i]['LoadCatalogDet']['id'];
                  $this->data['LoadCatalogDet']['status_id'] = -7;
                }
                else {
                  $this->LoadCatalogDet->id = $lcatalog_dets[$i]['LoadCatalogDet']['id'];
                  $this->data['LoadCatalogDet']['status_id'] = -4;
                }

                $this->LoadCatalog->LoadCatalogDet->save($this->data, $fieldList = array('status_id'));
              }
              $i++;
            }
           /////////////////////////////////////////////////////////////////
           
           ////////// если были добавлены новые каталоги, то перестраиваем дерево
           if ($cnt == 1) {

             $this->Catalog->recover("parent");

             $this->Catalog->reorder(array(
                'id' => null,
                'field' => 'sort_order'
             ));
           }

           /////////// меняем статус реестра
            $this->LoadCatalog->id = $load_catalog_id;
            $this->data['LoadCatalog']['status_id'] = 2;
            if($this->LoadCatalog->save($this->data, $fieldList = array('LoadCatalog.status_id'))) {
                 echo "window.location = 'load_catalogs';";
            }
        }
        Cache::delete('l_catalogs');
        Cache::delete('catalogs');
        Cache::delete('catalog_list');
        clearCache();
    }

    function show($id = 0) {
      $this->layout = 'admin';
      $this->pageTitle = 'Детализация загрузки каталога';

      $lcatalog_dets = $this->LoadCatalogDet->find('all', array('conditions' => array('LoadCatalogDet.load_catalog_id' => $id),
                                                                'order' => 'LoadCatalogDet.status_id DESC, flag DESC'));

      $i = 0;
      foreach($lcatalog_dets as $lcatalog_det) {
        if($lcatalog_dets[$i]['LoadCatalogDet']['status_id'] == 1) {
          $lcatalog_dets[$i]['LoadCatalogDet']['status_name'] = 'Загружено';
        }
        else if($lcatalog_dets[$i]['LoadCatalogDet']['status_id'] == 0) {
          $lcatalog_dets[$i]['LoadCatalogDet']['status_name'] = 'Не загружено';
        }
        else {
          $lcatalog_dets[$i]['LoadCatalogDet']['status_name'] = 'Ошибка';
        }

        if($lcatalog_dets[$i]['LoadCatalogDet']['flag'] == 1) {
          $lcatalog_dets[$i]['LoadCatalogDet']['flag_name'] = 'Каталог';
        }
        else if($lcatalog_dets[$i]['LoadCatalogDet']['flag'] == 0) {
          $lcatalog_dets[$i]['LoadCatalogDet']['flag_name'] = 'Товар';
        }
        else {
          $lcatalog_dets[$i]['LoadCatalogDet']['flag_name'] = 'Неизвестно';
        }        
        $i++;
      }

      $this->set('lcatalog_dets', $lcatalog_dets);
    }

}
?>