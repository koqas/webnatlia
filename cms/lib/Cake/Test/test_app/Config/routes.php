<?php
/**
 * Routes file
 *
 * Routes for test app
 *
<<<<<<< HEAD
 * PHP 5
 *
=======
>>>>>>> 514c7aff6f8d3335089b89706e5a9e4fdf2f54c6
 * CakePHP : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP Project
 * @package       Cake.Test.TestApp.Config
 * @since         CakePHP v 2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

Router::parseExtensions('json');
Router::connect('/some_alias', array('controller' => 'tests_apps', 'action' => 'some_method'));
