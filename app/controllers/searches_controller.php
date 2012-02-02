<?php

class SearchesController extends AppController {
    var $name = 'Searches';
    var $uses = array(
        "Catalog",
        "Product",
        'Search'
    );
    var $helpers = array(
        'paginator'
    );

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('*');
    }

    function index($search_str = null) {
        $this->pageTitle = "Поиск";
        if(!empty($this->params) && !empty($this->params['url']) && !empty($this->params['url']['search_str'])) {
            $search_str = $this->params['url']['search_str'];
            $this->redirect(array(
                'controller' => 'searches',
                'action' => 'index',
                $search_str
            ));
        }
        $this->set('search_str', $search_str);
        
        if(!empty($search_str)) {
            
            $search_str = htmlspecialchars(mb_strtoupper($search_str, 'UTF-8'));
            $search_list = split(" ", $search_str);
            
            $conditions = array('OR' => array());
            foreach($search_list as $l) {
                $conditions['OR'][] = "upper(Search.name) like '%$l%'";
                $conditions['OR'][] = "upper(Search.about) like '%$l%'";
            }
            
            $this->paginate = array(
                'Search' => array(
                    'conditions' => $conditions,
                    'contain' => array(
                        'Image'
                    ),
                    'limit' => 10
                )
            );
            $founds = $this->paginate('Search');
            foreach($founds as &$found) {
                if($found['Search']['type']=='catalog') {
                    $found['Search']['url'] = array(
                        'controller' => 'catalogs',
                        'action' => 'index',
                        $this->Catalog->get_url(null, $found['Search']['id'])
                    );
                    $found['Search']['breadcrumb'] = array(array('label'=>'Каталог', 'url'=>array('controller'=>'catalogs','action'=>'index')));
                    $found['Search']['breadcrumb'] = array_merge($found['Search']['breadcrumb'], $this->Catalog->get_breadcrumb(null, $found['Search']['id']));
                } else if($found['Search']['type']=='product') {
                    $found['Search']['url'] = array(
                        'controller' => 'products',
                        'action' => 'index',
                        $this->Product->get_url($found['Search']['id'])
                    );
                    $found['Search']['breadcrumb'] = array(array('label'=>'Каталог', 'url'=>array('controller'=>'catalogs','action'=>'index')));
                    $found['Search']['breadcrumb'] += $this->Product->get_breadcrumb($found['Search']['id']);
                }
                
                $found['Search']['name'] = $this->_prepare_search_result($found['Search']['name'], $search_list);
                $found['Search']['about'] = $this->_prepare_search_result($found['Search']['about'], $search_list);
            }
            
            $this->set('founds', $founds);
        }
    }

    function result() {
//        $this->data['Search']['forum_on'] = 0;

        $this->pageTitle = "Поиск";
        //debug($this->data);

        if(($producers = Cache::read('producers')) === false) {
            $producers = $this->Producer->find('list');
            Cache::write('producers', $producers);
        }
        $this->set('producers', $producers);

        $this->set('query_text', $this->data['Search']['query_text']);
        $this->set('catalog_on', $this->data['Search']['catalog_on']);
        $this->set('product_on', $this->data['Search']['product_on']);
        $this->set('article_on', $this->data['Search']['article_on']);
        $this->set('news_on', $this->data['Search']['news_on']);
        $this->set('project_on', $this->data['Search']['project_on']);
//        $this->set('forum_on', $this->data['Search']['forum_on']);

        $limitNews = $this->data['Search']['limitNews'];
        $limitCatalog = $this->data['Search']['limitCatalog'];
        $limitProduct = $this->data['Search']['limitProduct'];
        $limitArticle = $this->data['Search']['limitArticle'];
        $limitProject = $this->data['Search']['limitProject'];
//        $limitForum = $this->data['Search']['limitForum'];

        if (empty($this->data['Catalog']['producer_id'])) {
            $producer_id = 0;
        }
        else {
          $producer_id = $this->data['Catalog']['producer_id'];
        }

        $this->data['Search']['query_text'] = trim($this->data['Search']['query_text']);
        if ($this->data['Search']['query_text'] <> '') {
            $this->data['Search']['query_text'] = preg_replace('/\s\s+/', ' ', $this->data['Search']['query_text']);
            $list = split(" ", $this->data['Search']['query_text']);


            $orCatalogName = array();
            $orCatalogShortAbout = array();
            $orCatalogLongAbout = array();
            $orProductName = array();
            $orProductShortAbout = array();
            $orProductLongAbout = array();
            $orProductDet = array();
            $orArticleCaption = array();
            $orArticleShortNote = array();
            $orArticlePage = array();
            $orNewsHeader = array();
            $orNewsBody = array();
            $orProjectName = array();
            $orProjectAbout = array();
            $orPostName = array();
            $orPostText = array();

            $fieldsCatalog = array(
                'Catalog.id',
                'Catalog.name',
                'SmallImage.url',
                "(Catalog.short_about) as search_str1",
                "(Catalog.long_about) as search_str2"
            );
            $fieldsProduct = array(
                'Product.id',
                'Product.name',
                'SmallImage.url',
                "(Product.short_about) as search_str1",
                "(Product.long_about) as search_str2"
            );
            $fieldsArticle = array(
                'Article.id',
                'Article.caption',
                'SmallImage.url',
                "(Article.short_note) as search_str1"
            );
            $fieldsCnew = array('Cnew.id', 'Cnew.news_header', 'SmallImage.url');
            $fieldsProject = array('Project.id', 'Project.name', 'Project.about', 'SmallImage.url');
//            $fieldsPost = array('Post.post_id', 'Post.post_subject', 'Post.topic_id', 'Post.forum_id');

            $i = 0;
            $count_list = count($list);

            foreach($list as $l) {
                $count_list = $count_list + $i;

                array_push($fieldsCnew, "CASE WHEN instr(Cnew.news_body, '".$l."') < 20 and instr(Cnew.news_body, '".$l."') >0 THEN substring(Cnew.news_body, instr(Cnew.news_body, '".$l."')-instr(Cnew.news_body, '".$l."')+1, 70)
                                              WHEN instr(Cnew.news_body, '".$l."') >= 0 AND instr(Cnew.news_body, '".$l."') > 20 THEN
                                                   substring(Cnew.news_body, instr(Cnew.news_body, '".$l."')-20, 70)
                                              ELSE ''
                                              END as t".$i);

                array_push($fieldsProject, "CASE WHEN instr(Project.about, '".$l."') < 20 and instr(Project.about, '".$l."') >0 THEN substring(Project.about, instr(Project.about, '".$l."')-instr(Project.about, '".$l."')+1, 70)
                                                 WHEN instr(Project.about, '".$l."') >= 0 AND instr(Project.about, '".$l."') > 20 THEN
                                                     substring(Project.about, instr(Project.about, '".$l."')-20, 70)
                                                 ELSE ''
                                                 END as t".$i);

//                array_push($fieldsPost, "CASE WHEN instr(Post.post_text, '".$l."') < 20 and instr(Post.post_text, '".$l."') >0 THEN substring(Post.post_text, instr(Post.post_text, '".$l."')-instr(Post.post_text, '".$l."')+1, 70)
//                                                 WHEN instr(Post.post_text, '".$l."') >= 0 AND instr(Post.post_text, '".$l."') > 20 THEN
//                                                     substring(Post.post_text, instr(Post.post_text, '".$l."')-20, 70)
//                                                 ELSE ''
//                                                 END as t".$i);

                array_push($orCatalogName, array("Catalog.name like " => "%$l%"));
                array_push($orCatalogShortAbout, array("Catalog.short_about like " => "%$l%"));
                array_push($orCatalogLongAbout, array("Catalog.long_about like " => "%$l%"));
    //            $orCatalogName[] = "Catalog.name like '%$l%'";
    //            $orCatalogShortAbout[] = "Catalog.short_about like '%$l%'";
    //            $orCatalogLongAbout[] = "Catalog.long_about like '%$l%'";

                array_push($orProductName, array('Product.name like ' => "%$l%"));
                array_push($orProductShortAbout, array('Product.short_about like ' => "%$l%"));
                array_push($orProductLongAbout, array('Product.long_about like ' => "%$l%"));
                array_push($orProductDet, 
                        array("EXISTS(SELECT 1 FROM cake_product_dets pd WHERE pd.product_id = Product.id AND (producer_id IN (0, (CASE WHEN pd.producer_id>0 THEN pd.producer_id ELSE Product.producer_id END))) AND (pd.short_about like '%$l%' OR pd.long_about like '%$l%' OR EXISTS(SELECT 1 FROM cake_product_det_params pdp, cake_product_det_param_values pdpv WHERE pdp.product_det_id = pd.id AND pdp.product_det_param_value_id = pdpv.id AND pdpv.name like '%$l%')))"));

                array_push($orArticleCaption, array('Article.caption like ' => "%$l%"));
                array_push($orArticleShortNote, array('Article.short_note like ' => "%$l%"));
                array_push($orArticlePage,
                        array("EXISTS(SELECT 1 FROM cake_article_pages ap WHERE ap.article_id = Article.id AND ap.page like '%$l%')"));

                array_push($orNewsHeader, array('Cnew.news_header like ' => "%".$l."%"));
                array_push($orNewsBody, array('Cnew.news_body like ' => "%".$l."%"));

                array_push($orProjectName, array('Project.name like ' => "%".$l."%"));
                array_push($orProjectAbout, array('Project.about like ' => "%".$l."%"));

                array_push($orPostName, array('Post.post_subject like ' => "%".$l."%"));
                array_push($orPostText, array('Post.post_text like ' => "%".$l."%"));

                $i++;
            }

            $query = array();
            if ($this->data['Search']['catalog_on'] == 1) {
                $query['Catalog'] = array(
                    'fields' => $fieldsCatalog,
                    'conditions' => array(
                        'OR' => array_merge(
                            $orCatalogName,
                            $orCatalogShortAbout,
                            $orCatalogLongAbout
                        ),
                        'Catalog.catalog_type_id' => '1',
                        "$producer_id IN (0, coalesce(Catalog.producer_id, 0))"
                    ),
                    'order' => 'Catalog.parent_id',
                    'limit' => $limitCatalog,
                    'contain' => array(
                        'SmallImage'
                    )
                );
            }

            if($this->data['Search']['product_on'] == 1) {
                $query['Product'] = array(
                    'fields' => $fieldsProduct,
                    'conditions' => array(
                        'OR' => array_merge(
                            $orProductName,
                            $orProductShortAbout,
                            $orProductLongAbout,
                            $orProductDet
                        ),
                        'Catalog.catalog_type_id' => '1',
                        "$producer_id IN (0, coalesce(Product.producer_id, 0))"
                    ),
                    'order' => 'Catalog.lft, Product.sort_order',
                    'limit' => $limitProduct,
                    'contain' => array(
                        'SmallImage',
                        'Catalog'
                    )
                );
            }

            if($this->data['Search']['article_on'] == 1) {
                $query['Article'] = array(
                    'fields' => $fieldsArticle,
                    'conditions' => array(
                        'OR' => array_merge(
                            $orArticleCaption,
                            $orArticleShortNote,
                            $orArticlePage
                        )
                    ),
                    'order' => 'Article.sort_order, Article.stamp DESC',
                    'limit' => $limitArticle,
                    'contain' => array(
                        'SmallImage'
                    )
                );
            }

          if ($this->data['Search']['news_on'] == 1) {
            $query['Cnew'] = array('fields' => $fieldsCnew,
                                             'limit' => $limitNews,
                                             'conditions' => array('OR' => array(array('OR' => $orNewsHeader), array('OR' => $orNewsBody))));
          }
          if ($this->data['Search']['project_on'] == 1) {
            $query['Project'] = array('fields' => $fieldsProject,
                                                     'limit' => $limitProject,
                                                     'conditions' => array('OR' => array(array('OR' => $orProjectName), array('OR' => $orProjectAbout))));
          }
//          if ($this->data['Search']['forum_on'] == 1) {
//            $query['Post'] = array('fields' => $fieldsPost,
//                                   'limit' => $limitForum,
//                                   'conditions' => array('OR' => array(array('OR' => $orPostName), array('OR' => $orPostText)))
//                                  );
//          }

          $this->paginate = $query;

            if($this->data['Search']['catalog_on'] == 1) {
                $result_catalogs = $this->paginate('Catalog');

                foreach($result_catalogs as &$rc) {
                    $rc['catalog_abouts'] = $this->_prepare_search_result($rc['Catalog'], $list);
                }
                $this->set('result_catalogs', $result_catalogs);
            }

            if($this->data['Search']['product_on'] == 1) {
                $result_products = $this->paginate('Product');

                foreach($result_products as &$rc) {
                    $rc['product_abouts'] = $this->_prepare_search_result($rc['Product'], $list);
                }
                $this->set('result_products', $result_products);
            }

            if($this->data['Search']['article_on'] == 1) {
                $result_articles = $this->paginate('Article');

                foreach($result_articles as &$rc) {
                    $rc['article_abouts'] = $this->_prepare_search_result($rc['Article'], $list);
                }
                $this->set('result_articles', $result_articles);
            }


          if ($this->data['Search']['news_on'] == 1) {
              $result_cnews = $this->paginate('Cnew');

              $i_news = 0;
              foreach($result_cnews as $rc) {
                  $kk = 0;
                  foreach($result_cnews[$i_news][0] as $ll) {
                     foreach($list as $l) {
                       if ($result_cnews[$i_news][0]['t'.$kk] <> '') {
                         $result_cnews[$i_news][0]['t'.$kk] = '.'.str_replace($l, '<strong>'.$l.'</strong>', $result_cnews[$i_news][0]['t'.$kk]).'.';
                       }
                     }
                     $kk++;
                  }
                $i_news++;
              };

              $this->set('result_cnews', $result_cnews);
          }

          if ($this->data['Search']['project_on'] == 1) {
              $result_projects = $this->paginate('Project');

              $i_projects = 0;
              foreach($result_projects as $rc) {
                  $kk = 0;
                  foreach($result_projects[$i_projects][0] as $ll) {
                     foreach($list as $l) {
                       if ($result_projects[$i_projects][0]['t'.$kk] <> '') {
                         $result_projects[$i_projects][0]['t'.$kk] = '.'.str_replace($l, '<strong>'.$l.'</strong>', $result_projects[$i_projects][0]['t'.$kk]).'.';
                       }
                     }
                     $kk++;
                  }
                $i_projects++;
              };

              $this->set('result_projects', $result_projects);
          }

//          if ($this->data['Search']['forum_on'] == 1) {
//              $result_posts = $this->paginate('Post');
//
//              $i_posts = 0;
//              foreach($result_posts as $rc) {
//                  $kk = 0;
//                  foreach($result_posts[$i_posts][0] as $ll) {
//                     foreach($list as $l) {
//                       if ($result_posts[$i_posts][0]['t'.$kk] <> '') {
//                         $result_posts[$i_posts][0]['t'.$kk] = '.'.str_replace($l, '<strong>'.$l.'</strong>', $result_posts[$i_posts][0]['t'.$kk]).'.';
//                       }
//                     }
//                     $kk++;
//                  }
//                $i_posts++;
//              };
//
//              $this->set('result_posts', $result_posts);
//          }

        }
    }

    function _prepare_search_result($result, $search_list) {
        $strs = array();
        $result = strip_tags($result);
        foreach($search_list as $l) {
            $pos = mb_stripos($result, $l, 0, 'UTF-8');
            if($pos===false) continue;
            if($pos<30) $pos = 0;
            else $pos = $pos-30;
            
            $str = mb_substr($result, $pos, 70, 'UTF-8');
            $str = preg_replace("#$l#isu", "<b>$l</b>", $str);
            
            $strs[] = $str;
        }
        if(empty($strs)) return $result;
        return implode("</br>", $strs);
    }
}
?>