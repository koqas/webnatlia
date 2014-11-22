<?php
/**
 * A class to contain test cases and run them with shared fixtures
 *
<<<<<<< HEAD
 * PHP 5
 *
=======
>>>>>>> 514c7aff6f8d3335089b89706e5a9e4fdf2f54c6
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.TestSuite
 * @since         CakePHP(tm) v 2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Folder', 'Utility');

/**
 * A class to contain test cases and run them with shared fixtures
 *
 * @package       Cake.TestSuite
 */
class CakeTestSuite extends PHPUnit_Framework_TestSuite {

/**
 * Adds all the files in a directory to the test suite. Does not recurse through directories.
 *
 * @param string $directory The directory to add tests from.
 * @return void
 */
	public function addTestDirectory($directory = '.') {
		$Folder = new Folder($directory);
		list(, $files) = $Folder->read(true, true, true);

		foreach ($files as $file) {
			if (substr($file, -4) === '.php') {
				$this->addTestFile($file);
			}
		}
	}

/**
 * Recursively adds all the files in a directory to the test suite.
 *
 * @param string $directory The directory subtree to add tests from.
 * @return void
 */
	public function addTestDirectoryRecursive($directory = '.') {
		$Folder = new Folder($directory);
		$files = $Folder->tree(null, true, 'files');

		foreach ($files as $file) {
			if (substr($file, -4) === '.php') {
				$this->addTestFile($file);
			}
		}
	}

}