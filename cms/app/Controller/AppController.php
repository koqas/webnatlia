<?php
<<<<<<< HEAD
App::uses('Controller', 'Controller');
class AppController extends Controller
{
	var $settings;
	public $helpers		=	array("Form","Js","Session");
	public $components	=	array(
		"Auth"	=>	array(
			"logoutRedirect"	=>	array(
				"controller"	=> "Home",
				"action" 		=> "Index"
			),
			"loginAction" => array(
				"controller"	=> "Account",
				"action" 		=> "Login"
			),
			"authenticate"		=>	array(
    			"Form"		=>	array(
					"userModel" => "Admin",
					"fields" 	=> array(
						"username"	=>	"username"
					),
					"scope"		=>	array(
						"Admin.status"	=>	1
					)
				)
			)
		),
		"Session",
		"Cookie"
	);
	
	public function beforeFilter()
	{
		$this->layout	=	"main";
		
		//GET SETTINGS
		$this->loadModel("Setting");
		$settings		=	$this->Setting->find("first");
		$this->settings	=	$settings["Setting"];
		$this->set("settings",$this->settings);
		/*
		if($this->Auth->loggedIn())
		{
			$this->profile	=	$this->CheckProfile();
		}*/
		
		$this->set('profile',$this->profile);
		$this->set('lft_menu_category_id',"1");
	}
	
	function CheckProfile()
	{
	
		$this->loadModel('Admin');
		
		$find	=	$this->Admin->find('first',array(
						'conditions'	=>	array(
							'Admin.id'		=>	$this->Auth->user("id")
						)
					));
		return $find;
	}
}
=======
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public function beforeFilter()
	{
		$this->layout	=	'main';
	}
}
>>>>>>> 514c7aff6f8d3335089b89706e5a9e4fdf2f54c6
