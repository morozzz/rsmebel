<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'page', 'action' => 'main'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
        Router::connect('/admin/*', array('controller' => 'catalogs', 'action' => 'admin_index'));
        Router::connect('/manager/*', array('controller' => 'customs', 'action' => 'adm_custom'));
        Router::connect('/sitemap.xml', array('controller' => 'setting', 'action' => 'sitemap_xml'));
        Router::connect('/catalog.yml', array('controller' => 'setting', 'action' => 'catalog_yml'));
        
        Router::connect('/new/*', array('controller' => 'cnews', 'action' => 'view'));
        Router::connect('/news', array('controller' => 'cnews', 'action' => 'index'));
        Router::connect('/about/*', array('controller' => 'company_infos', 'action' => 'index'));
?>