<?php
class Background extends AppModel
{
	function BindDefault($reset	=	true)
	{
		
	}
	
	public function BindImageContent($reset	=	true)
	{
		$this->bindModel(array(
			"hasOne"	=>	array(
				"Detail"	=>	array(
					"className"		=>	"Content",
					"foreignKey"	=>	"model_id",
					"conditions"	=>	array(
						"Detail.model"	=>	$this->name,
						"Detail.type"	=>	"sound-detail"
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
					'message' => "Please insert background name"
				)
			),
			'file' => array(
				'notEmptyImage' => array(
					'rule' 			=>	"notEmptyImage",
					'message'		=>	'Please upload bumper\'s sound.'
				),
				'extension' => array(
					'rule' => array('validateName', array('mp3')),
					'message' => 'Only (*.mp3) are allowed.'	
				),
				'size' => array(
					'rule' => array('size',5242880),
					'message' => 'Your image size is too big, please upload less than '.CakeNumber::toReadableSize(5242880).'.'
				)
			)
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
					'message' => "Please insert background name"
				)
			),
			'file' => array(
				'extension' => array(
					'rule' => array('validateName', array('mp3')),
					'message' => 'Only (*.mp3) are allowed.',
					"allowEmpty"	=>	true
				),
				'size' => array(
					'rule' => array('size',5242880),
					'message' => 'Your image size is too big, please upload less than '.CakeNumber::toReadableSize(5242880).'.',
					"allowEmpty"	=>	true
				)
			)
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