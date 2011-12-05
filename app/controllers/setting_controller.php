<?php

class SettingController extends AppController {
    var $name = 'Setting';
    
    var $uses = array(
        'Article',
        'Catalog',
        'Cnew',
        'CompanyInfo',
        'DesignInfo',
        'Product',
        'Project'
    );

    var $cacheAction = array('sitemap_xml' => '1 day');

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth2->allow('sitemap_xml');
        $this->Auth2->allow('catalog_yml');
    }
    
    function sitemap_xml() {
        $this->layout = 'xml';
        
        $urls = array(
            array(
                'loc' => '/',
                'priority' => 1.0
            )
        );
        
        //о компании
        $company_infos = $this->CompanyInfo->find('all', array(
            'contain' => array(),
            'order' => 'CompanyInfo.sort_order'
        ));
        foreach($company_infos as $num => $company_info) {
            if($num>0) $this->_add_sitemap_xml_url ($urls,
                    '/company_infos/index/'.$company_info['CompanyInfo']['id'], 0.2);
            else $this->_add_sitemap_xml_url ($urls, '/company_infos/index', 0.2);
        }
        
        //новости
        $this->_add_sitemap_xml_url($urls, '/cnews/index', 0.6);
        $cnews = $this->Cnew->find('all', array(
            'contain' => array()
        ));
        foreach($cnews as $cnew) {
            $this->_add_sitemap_xml_url($urls, '/cnews/view_new/'.$cnew['Cnew']['id'], 0.5);
        }
        
        //статьи
        $this->_add_sitemap_xml_url($urls, '/articles/index', 0.7);
        $articles = $this->Article->find('all', array(
            'contain' => array(
                'ArticlePage'
            )
        ));
        foreach($articles as $article) {
            $i = 1;
            foreach($article['ArticlePage'] as $article_page) {
                $this->_add_sitemap_xml_url($urls,
                        "/article_pagex/index/{$article['Article']['id']}/{$i}", 0.6);
                $i++;
            }
        }
        
        //дизайн
        $design_infos = $this->DesignInfo->find('all', array(
            'contain' => array(),
            'order' => 'DesignInfo.sort_order'
        ));
        foreach($design_infos as $num => $design_info) {
            if($num>0) $this->_add_sitemap_xml_url ($urls, '/design_infos/index/'.$design_info['DesignInfo']['id'], 0.6);
            else $this->_add_sitemap_xml_url ($urls, '/design_infos/index', 0.6);
        }
        $this->_add_sitemap_xml_url($urls, '/design_order_dets/add', 0.3);
        
        //портфолио
        $this->_add_sitemap_xml_url($urls, '/projects/index', 0.7);
        $projects = $this->Project->find('all', array(
            'contain' => array(
                'ProjectSlide'
            )
        ));
        foreach($projects as $project) {
            $this->_add_sitemap_xml_url($urls, '/projects/show/'.$project['Project']['id'], 0.7);
            foreach($project['ProjectSlide'] as $project_slide) {
                $this->_add_sitemap_xml_url($urls, '/project_slides/index/'.$project_slide['id'], 0.7);
            }
        }
        
        //спецпредложения
        $this->_add_sitemap_xml_url($urls, '/specials/index', 0.8);
        
        //каталоги и товары
        $this->_add_sitemap_xml_url($urls, '/catalogs/index', 0.9);
        $catalogs = $this->Catalog->find('all', array(
            'conditions' => array(
                'catalog_type_id' => 1
            ),
            'contain' => array(
                'Product'
            )
        ));
        foreach($catalogs as $catalog) {
            $this->_add_sitemap_xml_url($urls, '/catalogs/index/'.$catalog['Catalog']['id'], 0.9);
            foreach($catalog['Product'] as $product) {
                $this->_add_sitemap_xml_url($urls, '/products/index/'.$product['id'], '1.0');
            }
        }
        
        $this->set('urls', $urls);
    }
    
    function _add_sitemap_xml_url(&$urls, $loc, $priority) {
        $urls[] = array(
            'loc' => $loc,
            'priority' => $priority
        );
    }
    
    function catalog_yml() {
//        Configure::write('debug', '2');
        $this->layout = 'yml';
        
        $catalogs = $this->Catalog->find('all', array(
            'conditions' => array(
                'Catalog.catalog_type_id' => 1
            ),
            'contain' => array()
        ));
        $this->set('catalogs', $catalogs);
        
        $products = $this->Product->find('all', array(
            'conditions' => array(
                'Product.catalog_id' => Set::combine($catalogs, '{n}.Catalog.id', '{n}.Catalog.id')
            ),
            'contain' => array(
                'Producer',
                'ProductDet' => array(
                    'Producer',
                    'SmallImage'
                ),
                'SmallImage'
            )
        ));
        $this->set('products', $products);
    }
}

?>
