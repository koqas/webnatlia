<?php
App::uses('AppHelper', 'View/Helper');

class AimfoxHelper extends AppHelper {

  public $helpers = array('Html');

  public function printImageByImageId($image_id, $options = array()) {
      //set default value of image.
    $default['imageType'] = '';
    $default['fileName']  = '';
    $default['path'] 	  = Configure::read('ImageContentPath');
    $default['host']	  =	Configure::read('ImageContentHost');
    $default['class']	  = "big";
    $default['style']	  = "wow";
    $default['alt']		  = "coda aimfox image";

    $arrayKeys = array_keys($default);

    foreach($arrayKeys as $key) {
      if(!isset($options[$key])) $options[$key] = $default[$key];
    }
    
    if($options['imageType'] != "") {
	    $options['imageType'] = $options['imageType']."_";
    }

    $dataImage =  $this->Html->image($options['host'].$options['path'].$image_id."/".$options['imageType'].$options['fileName'], array('alt' => $options['alt'], 'style' => $options['style'], 'class' => $options['class']));
	
	if($options['fileName'] != "") {
		return $dataImage;	
	} else {
		return "";
	}
	
    

  }
}
