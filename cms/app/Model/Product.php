<?php
class Product extends AppModel
{
	
	public $name = "Product";
	public $belongsTo = array(
		'ProductCategory' => array(
			'className' => 'ProductCategory', 
			'foreignKey' => 'product_category_id'
		)
	);

	var $hasOne = array(
		'Image' => array(
			'className' => 'Content',
			'foreignKey' => 'model_id',
			'conditions' => array(
				'Image.model' => "Product"
			)
		)
	);
	
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

	function createWithAttachments($data) {
		if(!empty($data['Image'])) {
			$image = $data['Image'];
			$image['model'] = $this->name;

			// Unset the foreign_key if the user tries to specify it
			if (isset($image['foreign_key'])) {
				unset($image['foreign_key']);
			}

		}

	    $data['Image'] = $image;
	
	    // Try to save the data using Model::saveAll()
	    $this->create();
	
	    if ($this->saveAll($data)) {
	        return true;
	    }
	
	    // Throw an exception for the controller
	    throw new Exception(__("This post could not be saved. Please try again"));

	}
	
	function BindDefault($reset	=	true)
	{
		
	}
	
	public function BindImageContent($reset	=	true)
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
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please enter State Name"
				)
			),
		);
	}
	
	function ValidateEdit()
	{
		App::uses('CakeNumber', 'Utility');
		$this->validate 	= array(
			"id"	=>	array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => 'Sorry we cannot find your ID.'	
				),
				'IsExists' => array(
					'rule' => "IsExists",
					'message' => 'Sorry we cannot find your details data.'	
				)
			),
			'name' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert Venue name"
				)
			),
			'zone_id' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => 'Please enter Zone'
				)
			),
			'lat' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => 'Please pick a point in the map'
				)
			),
			'lng' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => 'Please pick a point in the map'
				)
			),
		);
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