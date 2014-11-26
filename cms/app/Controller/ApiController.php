<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class ApiController extends AppController
{
	public $uses	=	NULL;
	public $settings;
	public $components = array('Auth');
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow();	
		$this->autoRender = false;
		define("ERR_00","Success");
		define("ERR_01","Wrong username or password");
		define("ERR_02","Data not found");
		define("ERR_03","Validate Failed");
		define("ERR_04","Parameter Not Completed!");
		define("ERR_05","Failed send verification code!");
		
		$token		=	(isset($_REQUEST['token'])) ? $_REQUEST['token'] : "";
		
		if($token !== "461fd77b-1f04-4cf9-a045-49fb07435913")
		{
			echo json_encode(array("status"=>false,"message"=>"Invalid Token","data"=>NULL,"code"=>"01"));	
			exit;
		}
		
		//SETTING
		$this->loadModel('Setting');
		$settings			=	$this->Setting->find('first');
		$this->settings		=	$settings["Setting"];
	}
	
	public function Login()
	{
		$status									=	false;
		$message								=	ERR_04;
		$code									=	"04";
		$request["User"]["username"]			=	empty($_REQUEST["username"]) ? "" : $_REQUEST["username"];
		$request["User"]["password"]			=	empty($_REQUEST["password"]) ? "" : $_REQUEST["password"];
		
		$this->loadModel('User');
		$this->User->set($request);
		$this->User->BindDefault(false);
		$this->User->Schedule->BindShift(false);
		$this->User->ValidateLogin();
		$error								=	$this->User->InvalidFields();
		
		if(empty($error))
		{
			$status		=	true;
			$message	=	ERR_00;
			$code		=	"00";
			
			$passwordHasher = new SimplePasswordHasher();
            $password = $passwordHasher->hash(
                strtolower(trim($request["User"]["password"]))
            );
			
			$data		=	$this->User->find("first",array(
								"conditions"	=>	array(
									"User.username"		=>	$request["User"]["username"],
									"User.password"		=>	$password,
									"User.status"		=>	1
								),
								"recursive"				=>	2
							));
			
		}
		else
		{
			$status		=	false;
			foreach($error as $k => $v)
			{
				$message	=	$v[0];
				break;
			}
			$code		=	"03";
			$data		=	false;
		}
		
		$out			=	array("status"=>$status,"message"=>$message,"data"=>$data,"code"=>$code);
		$json			=	json_encode($out);
		echo $json;
		if(isset($_GET["debug"]) && $_GET["debug"]=="1")
		{
			pr($out);
			//$this->render("sql");
		}
	}
	
	function CheckPunched()
	{
		$status		=	false;
		$message	=	ERR_03;
		$data		=	null;
		$code		=	"03";
		$user_id	=	(!empty($_REQUEST['user_id'])) ? $_REQUEST['user_id'] : "";
		$this->loadModel("PunchedLog");
		$fPunched	=	$this->PunchedLog->find("first",array(
							"conditions"	=>	array(
								"PunchedLog.user_id"								=>	$user_id,
								"DATE_FORMAT(PunchedLog.punched_in,'%Y-%m-%d')"		=>	date("Y-m-d")
							)
						));
						
		if(empty($fPunched))
		{
			$status		=	false;
			$message	=	"Data is empty";
			$data		=	NULL;
			$code		=	"03";
		}
		else
		{
			$status		=	true;
			$message	=	ERR_00;
			$code		=	"00";
			$data		=	$fPunched;
		}
		
		$out	=	array("status"=>$status,"message"=>$message,"data"=>$data,"code"=>$code);
		echo json_encode($out);
		
		if(isset($_GET['debug']) && $_GET['debug'] == "1")
		{
			pr($fPunched);
			$this->render('sql');
		}
		$this->autoRender	=	false;
						
	}
	
	function GetSchedule()
	{
		$status		=	false;
		$message	=	ERR_03;
		$data		=	null;
		$code		=	"03";
		
		$user_id	=	(!empty($_REQUEST['user_id'])) ? $_REQUEST['user_id'] : "";
		
		//LOAD MODEL
		$this->loadModel('Schedule');
		$this->Schedule->BindDefault(false);
		$this->Schedule->User->BindImage(false);
		$fSchedule	=	$this->Schedule->find("first",array(
								"order"			=>	array("Shift.start_time ASC"),
								"conditions"	=>	array(
									"Schedule.user_id"	=>	$user_id,
									"Schedule.date"		=>	date("Y-m-d"),
									"Schedule.status"	=>	1
								),
								"recursive"				=>	2
							));
							
		if(empty($fSchedule))
		{
			$status		=	false;
			$message	=	"Data is empty";
			$data		=	NULL;
			$code		=	"03";
		}
		else
		{
			$status		=	true;
			$message	=	ERR_00;
			$code		=	"00";
			$data		=	$fSchedule;
		}
		
		$out	=	array("status"=>$status,"message"=>$message,"data"=>$data,"code"=>$code);
		echo json_encode($out);
		if(isset($_GET['debug']) && $_GET['debug'] == "1")
		{
			pr($data);
			//$this->render('sql');
		}
		$this->autoRender	=	false;
	}
	
	function VenueDetail()
	{
		$status		=	false;
		$message	=	ERR_03;
		$data		=	null;
		$code		=	"03";
		
		$venue_id	=	(!empty($_REQUEST['venue_id'])) ? $_REQUEST['venue_id'] : "";
		
		//LOAD MODEL
		$this->loadModel('Venue');
		$this->Venue->BindImage();
		$fVenue	=	$this->Venue->find("first",array(
								"order"			=>	array("Venue.id ASC"),
								"conditions"	=>	array(
									"Venue.id"		=>	$venue_id,
									"Venue.status"	=>	1
								)
							));
							
		if(empty($fVenue))
		{
			$status		=	false;
			$message	=	"Data is empty";
			$data		=	NULL;
			$code		=	"03";
		}
		else
		{
			$status		=	true;
			$message	=	ERR_00;
			$code		=	"00";
			$data		=	$fVenue;
		}
		
		$out	=	array("status"=>$status,"message"=>$message,"data"=>$data,"code"=>$code);
		echo json_encode($out);
		if(isset($_GET['debug']) && $_GET['debug'] == "1")
		{
			pr($data);
			//$this->render('sql');
		}
		$this->autoRender	=	false;
	}
	
	public function PunchedIn()
	{
		$status									=	false;
		$message								=	ERR_04;
		$code									=	"04";
		$request["PunchedLog"]["user_id"]		=	empty($_REQUEST["user_id"]) ? "" : $_REQUEST["user_id"];
		$request["PunchedLog"]["punched_in"]	=	date("Y-m-d H:i:s");
		$this->loadModel('PunchedLog');
		$this->PunchedLog->set($request);
		$this->PunchedLog->ValidatePunchedIn();
		$error									=	$this->PunchedLog->InvalidFields();
		
		if(empty($error))
		{
			$status		=	true;
			$message	=	ERR_00;
			$code		=	"00";
			$this->PunchedLog->create();
			$save		=	$this->PunchedLog->save($request);
			$id			=	$this->PunchedLog->id;
			$data		=	$this->PunchedLog->find("first",array(
								"conditions"	=>	array(
									"PunchedLog.id"	=>	$id
								)
							));
		}
		else
		{
			$status		=	false;
			foreach($error as $k => $v)
			{
				$message	=	$v[0];
				break;
			}
			$code		=	"03";
			$data		=	false;
		}
		
		$out			=	array("status"=>$status,"message"=>$message,"data"=>$data,"code"=>$code);
		$json			=	json_encode($out);
		echo $json;
		if(isset($_GET["debug"]) && $_GET["debug"]=="1")
		{
			pr($out);
			$this->render("sql");
		}
	}
	
	public function PunchedOut()
	{
		$status									=	false;
		$message								=	ERR_04;
		$code									=	"04";
		$request["PunchedLog"]["user_id"]		=	empty($_REQUEST["user_id"]) ? "" : $_REQUEST["user_id"];
		$request["PunchedLog"]["punched_out"]	=	date("Y-m-d H:i:s");
		
		$this->loadModel('PunchedLog');
		$this->PunchedLog->set($request);
		$this->PunchedLog->ValidatePunchedOut();
		$error								=	$this->PunchedLog->InvalidFields();
		
		if(empty($error))
		{
			$status		=	true;
			$message	=	ERR_00;
			$code		=	"00";
			$update		=	$this->PunchedLog->updateAll(
				array(
					"punched_out"	=>	"'".$request["PunchedLog"]["punched_out"]."'"	
				),
				array(
					"DATE_FORMAT(PunchedLog.punched_in,'%Y-%m-%d')"	=>	date("Y-m-d"),
					"PunchedLog.user_id"							=>	$request["PunchedLog"]["user_id"]
				)
			);
			
			$data		=	$this->PunchedLog->find("first",array(
								"conditions"	=>	array(
									"DATE_FORMAT(PunchedLog.punched_in,'%Y-%m-%d')"	=>	date("Y-m-d"),
									"PunchedLog.user_id"							=>	$request["PunchedLog"]["user_id"]
								)
							));
		}
		else
		{
			$status		=	false;
			foreach($error as $k => $v)
			{
				$message	=	$v[0];
				break;
			}
			$code		=	"03";
			$data		=	false;
		}
		
		$out			=	array("status"=>$status,"message"=>$message,"data"=>$data,"code"=>$code);
		$json			=	json_encode($out);
		echo $json;
		if(isset($_GET["debug"]) && $_GET["debug"]=="1")
		{
			pr($out);
			$this->render("sql");
		}
	}
	
	function GetScheduleVenue()
	{
		$status		=	false;
		$message	=	ERR_03;
		$data		=	null;
		$code		=	"03";
		$user_id	=	(!empty($_REQUEST['user_id'])) ? $_REQUEST['user_id'] : "";
		
		//LOAD MODEL
		$this->loadModel('Schedule');
		$this->Schedule->BindScheduleVenue(false);
		$this->Schedule->ScheduleVenue->BindVenue(false);
		$fSchedule	=	$this->Schedule->find("first",array(
								"conditions"	=>	array(
									"Schedule.user_id"	=>	$user_id,
									"Schedule.date"		=>	date("Y-m-d"),
									"Schedule.status"	=>	1
								),
								"recursive"				=>	3
							));
							
		if(empty($fSchedule))
		{
			$status		=	false;
			$message	=	"Data is empty";
			$data		=	NULL;
			$code		=	"03";
		}
		else
		{
			$status		=	true;
			$message	=	ERR_00;
			$code		=	"00";
			$data		=	$fSchedule;
		}
		
		$out	=	array("status"=>$status,"message"=>$message,"data"=>$data,"code"=>$code);
		echo json_encode($out);
		if(isset($_GET['debug']) && $_GET['debug'] == "1")
		{
			pr($data);
			$this->render('sql');
		}
		$this->autoRender	=	false;
	}
	
	
	function GetNextScheduleVenue()
	{
		$status		=	false;
		$message	=	ERR_03;
		$data		=	null;
		$code		=	"03";
		$user_id	=	(!empty($_REQUEST['user_id'])) ? $_REQUEST['user_id'] : "";
		
		//LOAD MODEL
		$this->loadModel('Schedule');
		$this->Schedule->BindScheduleVenue(false);
		$this->Schedule->ScheduleVenue->BindVenue(false);
		$fSchedule	=	$this->Schedule->find("first",array(
								"conditions"	=>	array(
									"Schedule.user_id"	=>	$user_id,
									"Schedule.date > "	=>	date("Y-m-d"),
									"Schedule.status"	=>	1
								),
								"recursive"				=>	3
							));
							
		if(empty($fSchedule))
		{
			$status		=	false;
			$message	=	"Data is empty";
			$data		=	NULL;
			$code		=	"03";
		}
		else
		{
			$status		=	true;
			$message	=	ERR_00;
			$code		=	"00";
			$data		=	$fSchedule;
		}
		
		$out	=	array("status"=>$status,"message"=>$message,"data"=>$data,"code"=>$code);
		echo json_encode($out);
		if(isset($_GET['debug']) && $_GET['debug'] == "1")
		{
			pr($data);
			$this->render('sql');
		}
		$this->autoRender	=	false;
	}
	
	function GetScheduleVenueBrand()
	{
		$status				=	false;
		$message			=	ERR_03;
		$data				=	null;
		$code				=	"03";
		$schedule_venue_id	=	(!empty($_REQUEST['schedule_venue_id'])) ? $_REQUEST['schedule_venue_id'] : "";

		//LOAD MODEL
		$this->loadModel("ScheduleVenueBrand");
		$this->ScheduleVenueBrand->BindBrand(false);
		$fSchedule	=	$this->ScheduleVenueBrand->find("all",array(
								"conditions"	=>	array(
									"ScheduleVenueBrand.schedule_venue_id"	=>	$schedule_venue_id,
									"ScheduleVenueBrand.status"				=>	1,
								),
								"recursive"					=>	2,
								'order' => array('Brand.name ASC')
							));
							
		if(empty($fSchedule))
		{
			$status		=	false;
			$message	=	"Data is empty";
			$data		=	NULL;
			$code		=	"03";
		}
		else
		{
			$status		=	true;
			$message	=	ERR_00;
			$code		=	"00";
			$data		=	$fSchedule;
		}
		
		$out	=	array("status"=>$status,"message"=>$message,"data"=>$data,"code"=>$code);
		echo json_encode($out);
		if(isset($_GET['debug']) && $_GET['debug'] == "1")
		{
			pr($data);
			$this->render('sql');
		}
		$this->autoRender	=	false;
	}
	
	public function Checkin()
	{
		$status										=	false;
		$message									=	ERR_04;
		$code										=	"04";
		$request["ScheduleVenue"]["id"]				=	empty($_REQUEST["schedule_venue_id"]) ? "" : $_REQUEST["schedule_venue_id"];
		$request["ScheduleVenue"]["checkin"]		=	date("Y-m-d H:i:s");
		$request["ScheduleVenue"]["user_id"]		=	empty($_REQUEST["user_id"]) ? "" : $_REQUEST["user_id"];
		
		$request["ScheduleVenue"]["brand_id"]		=	$_REQUEST["brand_id"];
		$request["ScheduleVenue"]["brand_value"]	=	$_REQUEST["brand_value"];
		$request["ScheduleVenue"]["brand_name"]		=	$_REQUEST["brand_name"];
		
		$this->loadModel('ScheduleVenue');
		$this->loadModel('ScheduleVenueBrand');
		
		$this->ScheduleVenue->set($request);
		$this->ScheduleVenue->ValidateCheckin();
		$error								=	$this->ScheduleVenue->InvalidFields();
		
		if(empty($error))
		{
			foreach($request["ScheduleVenue"]["brand_id"] as $k => $id)
			{
				$request["ScheduleVenue"]["brand_value"][$k]	=	trim($request["ScheduleVenue"]["brand_value"][$k]);
				if(strlen($request["ScheduleVenue"]["brand_value"][$k]) == 0)
				{
					$error[]		=	"Please insert your stock in for ".$request["ScheduleVenue"]["brand_name"][$k]."!";
				}
			}
			
			if(empty($error))
			{
				$status		=	true;
				$message	=	ERR_00;
				$code		=	"00";
				
				$this->ScheduleVenue->create();
				$save		=	$this->ScheduleVenue->save($request);
				
				//UPDATE SCHEDULE VENUE BRAND
				foreach($request["ScheduleVenue"]["brand_id"] as $k => $id)
				{
					$this->ScheduleVenueBrand->updateAll(
						array(
							"stock_in"						=>	"'".$request["ScheduleVenue"]["brand_value"][$k]."'"
						),
						array(
							"ScheduleVenueBrand.brand_id"			=>	$id,
							"ScheduleVenueBrand.schedule_venue_id"	=>	$request["ScheduleVenue"]["id"],
						)
					);
				}
				
			}
			else
			{
				$status		=	false;
				$message	=	reset($error);
				$code		=	"03";
			}
		}
		else
		{
			$status		=	false;
			foreach($error as $k => $v)
			{
				$message	=	$v[0];
				break;
			}
			$code		=	"03";
			$data		=	false;
		}
		
		$out			=	array("status"=>$status,"message"=>$message,"data"=>false,"code"=>$code);
		$json			=	json_encode($out);
		echo $json;
		if(isset($_GET["debug"]) && $_GET["debug"]=="1")
		{
			pr($out);
			$this->render("sql");
		}
	}
	
	public function Checkout()
	{
		$status											=	false;
		$message										=	ERR_04;
		$code											=	"04";
		$request["ScheduleVenue"]["id"]					=	empty($_REQUEST["schedule_venue_id"]) ? "" : $_REQUEST["schedule_venue_id"];
		$request["ScheduleVenue"]["checkout"]			=	date("Y-m-d H:i:s");
		$request["ScheduleVenue"]["user_id"]			=	empty($_REQUEST["user_id"]) ? "" : $_REQUEST["user_id"];
		$request["ScheduleVenue"]["brand_id"]			=	$_REQUEST["brand_id"];
		$request["ScheduleVenue"]["brand_value"]		=	$_REQUEST["brand_value"];
		$request["ScheduleVenue"]["stock_in"]			=	$_REQUEST["stock_in"];
		$request["ScheduleVenue"]["brand_name"]			=	$_REQUEST["brand_name"];
		$request["ScheduleVenue"]["customer_approach"]	=	trim($_REQUEST["customer_approach"]);
		
		
		foreach($request["ScheduleVenue"]["brand_id"] as $k => $id)
		{
			$request["ScheduleVenue"]["brand_value"][$k]	=	trim($request["ScheduleVenue"]["brand_value"][$k]);
			if(strlen($request["ScheduleVenue"]["brand_value"][$k]) == 0)
			{
				$error[]		=	"Please insert your stock out for ".$request["ScheduleVenue"]["brand_name"][$k]."!";
			}
			else
			{
				if(intval($request["ScheduleVenue"]["brand_value"][$k]) > intval($request["ScheduleVenue"]["stock_in"][$k]))
				{
					$error[]		=	"Stock Out cannot greather than Stock In ( ".$request["ScheduleVenue"]["brand_name"][$k]." )";
				}
			}
		}
		
		if(empty($error))
		{	
			$this->loadModel('ScheduleVenue');
			$this->loadModel('ScheduleVenueBrand');
			$this->ScheduleVenue->set($request);
			$this->ScheduleVenue->ValidateCheckout();
			$error								=	$this->ScheduleVenue->InvalidFields();
		
			if(empty($error))
			{
				$status		=	true;
				$message	=	ERR_00;
				$code		=	"00";
				
				$this->ScheduleVenue->create();
				$save		=	$this->ScheduleVenue->save($request);
				
				//UPDATE SCHEDULE VENUE BRAND
				foreach($request["ScheduleVenue"]["brand_id"] as $k => $id)
				{
					$this->ScheduleVenueBrand->updateAll(
						array(
							"stock_out"								=>	"'".$request["ScheduleVenue"]["brand_value"][$k]."'"
						),
						array(
							"ScheduleVenueBrand.brand_id"			=>	$id,
							"ScheduleVenueBrand.schedule_venue_id"	=>	$request["ScheduleVenue"]["id"],
						)
					);
				}
			}
			else
			{
				$status		=	false;
				foreach($error as $k => $v)
				{
					$message	=	$v[0];
					break;
				}
				$code		=	"03";
				$data		=	false;
			}
		}
		else
		{
			$status		=	false;
			$message	=	reset($error);
			$code		=	"03";
		}
		
		$out			=	array("status"=>$status,"message"=>$message,"data"=>false,"code"=>$code);
		$json			=	json_encode($out);
		echo $json;
		if(isset($_GET["debug"]) && $_GET["debug"]=="1")
		{
			pr($out);
			$this->render("sql");
		}
	}
}
