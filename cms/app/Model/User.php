<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class User extends AppModel
{
	
	public $name = "User";
	public $belongsTo = array(
		'Supervisor' => array(
			'className' => 'Supervisor',
			'foreignKey' => 'supervisor_id'
		)
	);
	
	public function beforeSave($options = array())
	{
		if (!$this->id) {
		    $passwordHasher = new SimplePasswordHasher();
		    $this->data[$this->name]['password'] 	= $passwordHasher->hash(
			strtolower($this->data[$this->name]['password'])
		    );
			$this->data[$this->name]['username']	=	strtolower($this->data[$this->name]['username']);
		} else {
			if(isset($this->data[$this->name]['new_password']) && $this->data[$this->name]['new_password'] != "") {
				$passwordHasher = new SimplePasswordHasher();
			    $this->data[$this->name]['password'] 	= $passwordHasher->hash(
				strtolower($this->data[$this->name]['new_password'])
			    );
				$this->data[$this->name]['username']	=	strtolower($this->data[$this->name]['username']);
			}
		}
		return true;
	}
	
	public function beforeValidate($options = array())
	{
		return true;
	}
	
	function BindDefault($reset	=	true)
	{
		$this->bindModel(array(
			"hasOne"	=>	array(
				"Image"	=>	array(
					"className"		=>	"Content",
					"foreignKey"	=>	"model_id",
					"conditions"	=>	array(
						"Image.model"	=>	$this->name,
						"Image.type"	=>	"original"
					)
				),
				"Schedule"	=>	array(
					"className"		=>	"Schedule",
					"foreignKey"	=>	"user_id",
					"conditions"	=>	array(
						"Schedule.date"		=>	date("Y-m-d"),
						"Schedule.status"	=>	1
					)
				),
				"PunchedLog"	=>	array(
					"className"		=>	"PunchedLog",
					"foreignKey"	=>	"user_id",
					"conditions"	=>	array(
						"DATE_FORMAT(PunchedLog.punched_in,'%Y-%m-%d')"	=>	date("Y-m-d")
					)
				)
			)
		),$reset);
	}
	
	function BindImage($reset	=	true)
	{
		$this->bindModel(array(
			"hasOne"	=>	array(
				"Image"	=>	array(
					"className"		=>	"Content",
					"foreignKey"	=>	"model_id",
					"conditions"	=>	array(
						"Image.model"	=>	$this->name,
						"Image.type"	=>	"original"
					)
				)
			)
		),$reset);
	}
	
	function BindImageBig($reset	=	true)
	{
		$this->bindModel(array(
			"hasOne"	=>	array(
				"Big"	=>	array(
					"className"		=>	"Content",
					"foreignKey"	=>	"model_id",
					"conditions"	=>	array(
						"Big.model"	=>	$this->name,
						"Big.type"	=>	"big"
					)
				)
			)
		),$reset);
	}
	
	function BindImageSmall($reset	=	true)
	{
		$this->bindModel(array(
			"hasOne"	=>	array(
				"Small"	=>	array(
					"className"		=>	"Content",
					"foreignKey"	=>	"model_id",
					"conditions"	=>	array(
						"Small.model"	=>	$this->name,
						"Small.type"	=>	"small"
					)
				)
			)
		),$reset);
	}
	
	function VirtualFieldActivated()
	{
		$this->virtualFields = array(
			'SStatus'		=> 'IF(('.$this->name.'.status=\'1\'),\'Active\',\'Hide\')',
		);
	}
	
	function ValidateAdd()
	{
		App::uses('CakeNumber', 'Utility');
		$this->validate 	= array(
			'name' => array(
				'maxLength' => array(
					'rule'		=> array('maxLength', 50),
					'message'	=> "Your fullname is too long, please insert less than or equals 50 character."
				),
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert your fullname"
				)
			)
		);
	}
	
	function ValidateEdit()
	{
		App::uses('CakeNumber', 'Utility');
		$this->validate 	= array(
			'name' => array(
				'maxLength' => array(
					'rule'		=> array('maxLength', 50),
					'message'	=> "Your fullname is too long, please insert less than or equals 50 character."
				),
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert your fullname"
				)
			)
		);
	}
	
	function ValidateLogin()
	{
		$this->validate 	= array(
			'username' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => 'Please insert your username.'	
				)
			),
			'password' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => 'Please insert your password.'	
				),
				'CheckPassword' => array(
					'rule' 		=> "CheckPassword",
					'message' 	=> 'Username or password is wrong!.'	
				),
				'UserType' => array(
					'rule' => "UserType",
					'message' => 'Sorry, this apps is for promoters only.'	
				)
			)
		);
	}
	
	function IsAdmin($fields = array())
	{
		foreach($fields as $k=>$v)
		{
			$find	=	$this->find("first",array(
							"conditions"	=>	array(
								"LOWER({$this->name}.username)"		=> 	strtolower($v),
								"{$this->name}.user_level"			=> 	array("1","2"),
								"{$this->name}.status = '1'"
							)
						));
			if(!empty($find))
			{
				return true;
			}
		}
		return false;
	}
	
	function UserType($fields = array())
	{
		foreach($fields as $k=>$v)
		{
			$username	=	strtolower($this->data[$this->name]['username']);
			$passwordHasher = new SimplePasswordHasher();
			$password 	= $passwordHasher->hash(
				strtolower($this->data[$this->name]['password'])
			);
			
			$data		=	$this->find('first',array(
								'conditions'	=>	array(
									"LOWER({$this->name}.username)"	=>	strtolower($username),
									"{$this->name}.password"			=>	$password
								),
								"order"	=>	array("{$this->name}.id ASC")
							));
			if(!empty($data) && $data[$this->name]["type"] == "2")
			{
				return true;
			}
		}
		return false;
	}
	
	function CheckPassword()
	{
		$username	=	strtolower($this->data[$this->name]['username']);
		$passwordHasher = new SimplePasswordHasher();
		$password 	= $passwordHasher->hash(
			strtolower($this->data[$this->name]['password'])
		);
		
		$data		=	$this->find('first',array(
							'conditions'	=>	array(
								"LOWER({$this->name}.username)"	=>	strtolower($username),
								"{$this->name}.password"			=>	$password
							),
							"order"	=>	array("{$this->name}.id ASC")
						));
		if(!empty($data)) return true;
		return false;
	}
	
	function IsExists($fields = array())
	{
		foreach($fields as $key=>$value)
		{
			$data	=	$this->findById($value);
			if(!empty($data)) return true;
		}
		return false;
	}
	
	function IsEmailExists($fields = array())
	{
		foreach($fields as $key=>$value)
		{
			$data	=	$this->findByEmail($value);
			if(!empty($data)) return false;
		}
		return true;
	}
	
	function IsUsernameExists($fields = array())
	{
		foreach($fields as $key=>$value)
		{
			$data	=	$this->findByUsername($value);
			if(!empty($data)) return false;
		}
		return true;
	}
	
	function size( $field=array(), $aloowedsize) 
    {
		foreach( $field as $key => $value ){
            $size = intval($value['size']);
            if($size > $aloowedsize) {
                return FALSE;
            } else {
                continue;
            }
        }
        return TRUE;
    }
	
	
	function notEmptyImage($fields = array())
	{
		foreach($fields as $key=>$value)
		{
			if(empty($value['name']))
			{
				return false;
			}
		}
		
		return true;
	}
	
	function validateName($file=array(),$ext=array())
	{
		$err	=	array();
		$i=0;
		
		foreach($file as $file)
		{
			$i++;
			
			if(!empty($file['name']))
			{
				if(!Validation::extension($file['name'], $ext))
				{
					return false;
				}
			}
		}
		return true;
	}
	
	function imagewidth($field=array(), $allowwidth=0)
	{
		foreach( $field as $key => $value ){
			if(!empty($value['name']))
			{
				$imgInfo	= getimagesize($value['tmp_name']);
				$width		= $imgInfo[0];
				
				if($width < $allowwidth)
				{
					return false;
				}
			}
        }
        return TRUE;
	}
	
	function imageheight($field=array(), $allowheight=0)
	{
		
		foreach( $field as $key => $value ){
			if(!empty($value['name']))
			{
				$imgInfo	= getimagesize($value['tmp_name']);
				$height		= $imgInfo[1];
				
				if($height < $allowheight)
				{
					return false;
				}
			}
        }
        return TRUE;
	}
}
?>