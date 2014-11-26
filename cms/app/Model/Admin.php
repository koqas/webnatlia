<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class Admin extends AppModel
{
	public function beforeSave($options = array())
	{
		if (!$this->id) {
		    $passwordHasher = new SimplePasswordHasher();
		    $this->data[$this->name]['password'] 	= $passwordHasher->hash(
			strtolower($this->data[$this->name]['password'])
		    );
				$this->data[$this->name]['username']	=	strtolower($this->data[$this->name]['username']);
		}
		return true;
	}
	
	
	public function BindImageContent($reset	=	true)
	{
		$this->bindModel(array(
			"hasOne"	=>	array(
				"Big"	=>	array(
					"className"	=>	"Content",
					"foreignKey"	=>	"model_id",
					"conditions"	=>	array(
						"Big.model"	=>	$this->name,
						"Big.type"	=>	"big"
					)
				)
			)
		),$reset);
	}
	
	
	public function ValidateAdmin()
	{
		$this->validate	=	array(
			'username' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert your username"
				)
			),
			'password' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert your password"
				)
			)
		);
	}
}
?>