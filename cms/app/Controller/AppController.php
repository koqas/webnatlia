<?php

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

		if($this->Auth->loggedIn())

		{

			$this->profile	=	$this->CheckProfile();

		}

		

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