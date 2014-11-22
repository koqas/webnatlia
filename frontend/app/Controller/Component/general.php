<?php
class GeneralComponent extends Object 
{
	//AMAZON CREDENTIAL
	var $bucketName		= "code2ibiza-stuff";
	var $awsAccessKey 	= "AKIAIUAQPZPXSHB4MEDA";
	var $awsSecretKey 	= "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";
	var $awsHost		= "https://s3-ap-southeast-1.amazonaws.com/code2ibiza-stuff/";
	
	function CropSentence ($strText, $intLength, $strTrail) 
	{
		$wsCount = 0;
		$intTempSize = 0;
		$intTotalLen = 0;
		$intLength = $intLength - strlen($strTrail);
		$strTemp = "";
	
		if (strlen($strText) > $intLength) {
			$arrTemp = explode(" ", $strText);
			foreach ($arrTemp as $x) {
				if (strlen($strTemp) <= $intLength) $strTemp .= " " . $x;
			}
			$CropSentence = $strTemp . $strTrail;
		} else {
			$CropSentence = $strText;
		}
	
		return $CropSentence;
	}
	
	function UploadToCloud($file_source,$model_id,$model_name,$type,$mime_type, $file_ext = null)
	{
		//App::import('Vendor', "S3");
		App::import('Vendor','S3' ,array('file'=>'S3.php'));
		
		$s3			=	new S3($this->awsAccessKey, $this->awsSecretKey, true, "s3-ap-southeast-1.amazonaws.com");
		$input		=	$s3->inputFile($file_source, false);
		$ext		=	pathinfo($file_source,PATHINFO_EXTENSION);
		
		if($file_ext != null) {
			$obj		=	$s3->putObject($input,$this->bucketName, "contents/".$model_name."/".$model_id."/".$model_id."_".$type.".".$file_ext,S3::ACL_PUBLIC_READ,array(),array("Content-Type"=>$mime_type));
		} else {
			$obj		=	$s3->putObject($input,$this->bucketName, "contents/".$model_name."/".$model_id."/".$model_id."_".$type.".".$ext,S3::ACL_PUBLIC_READ,array(),array("Content-Type"=>$mime_type));
		}
		return $obj;
	}
	
	function getFromCloud($uri)
	{
		App::import('Vendor','S3' ,array('file'=>'S3.php'));
		$s3			=	new S3($this->awsAccessKey, $this->awsSecretKey, true, "s3-ap-southeast-1.amazonaws.com");
		if(($info = $s3->getObject($this->bucketName, $uri)) !== false) {
			$path_tmp = APP."tmp/cache/picture/";
			
			/*if(!is_dir($path_tmp)) {
				mkdir(APP."tmp/cache/picture", 0777);
			}
			$handle = fopen($path_tmp."kossa.jpg", "w+");
			if (fwrite($handle, $info->body) === FALSE) {
		        echo "Cannot write to file (kossa.jpg)";
		        exit;
		    } else {
			    echo "success";
		    }*/
		}
	}
	
	function GenerateQrCode($path,$model_id,$model_name="Venue",$link)
	{
		/*$path_content	=	$path.'contents/';
			if(!is_dir($path_content))mkdir($path_content,0777);
			
		$path_model		=	$path_content. $model_name . "/";
			if(!is_dir($path_model)) mkdir($path_model,0777);
			
		$path_model_id	=	$path_model . $model_id . "/";
			if(!is_dir($path_model_id))
				mkdir($path_model_id,0777);*/
		
		$path_tmp			=	ROOT.'/app/tmp/upload/';
			if(!is_dir($path_tmp)) mkdir($path_tmp,0777);
			
		$source				=	"https://chart.googleapis.com/chart?cht=qr&chs=400x400&chl=".urlencode($link);
		$tmp_file_name		=	md5(time());
		$destination		=	$path_tmp .$tmp_file_name.".png";
		$download			=	$this->GetImageFromUrl($destination, $source);
		if($download)
		{
			//UPLOAD TO CLOUD
			App::import('Vendor','S3' ,array('file'=>'S3.php'));
			$s3					=	new S3($this->awsAccessKey, $this->awsSecretKey, true, "s3-ap-southeast-1.amazonaws.com");
			$input				=	$s3->inputFile($destination, false);
			$obj				=	$s3->putObject($input,$this->bucketName, "contents/".$model_name."/".$model_id."/".$model_id."_qrcode.png",S3::ACL_PUBLIC_READ,array(),array("Content-Type"=>"image/png"));
			
			@unlink($destination);
			return true;
		}
		return false;
	}
	
	function ResizeImageContent($path,$source,$host,$model_id,$model_name,$type,$mime_type,$width,$height,$resizeType = 'cropResize')
	{
		$ext								=	pathinfo($source,PATHINFO_EXTENSION);
		$Content							=	ClassRegistry::Init("Content");
		
		$data								=	$Content->find("first",array(
													"conditions"	=>	array(
														"Content.model_id"		=>	$model_id,
														"Content.model"			=>	$model_name,
														"LOWER(Content.type)"	=>	strtolower($type),
													)
												));
												
		if(!empty($data))
		$Contents["Content"]["id"]			=	$data["Content"]["id"];					
		$Contents["Content"]["model"]		=	$model_name;
		$Contents["Content"]["model_id"]	=	$model_id;
		$Contents["Content"]["host"]		=	$host;
		$Contents["Content"]["mime_type"]	=	$mime_type;
		$Contents["Content"]["cloud"]		=	"0";
		 	
		
		$path_content	=	$path.'contents/';
			if(!is_dir($path_content))mkdir($path_content,0777);
			
		$path_model		=	$path_content. $model_name . "/";
			if(!is_dir($path_model)) mkdir($path_model,0777);
			
		$path_model_id	=	$path_model . $model_id . "/";
			if(!is_dir($path_model_id))
				mkdir($path_model_id,0777);
			
		//RESIZE
		App::import('Vendor','upload' ,array('file'=>'class.upload.php'));
		$path_content						=	$path_model_id.$model_id.'_'.$type.".".$ext;
		@unlink($path_content);
		$img 								=	new upload($source);
		$img->file_new_name_body   			=	$model_id.'_'.$type;
		if($resizeType == 'cropResize') {
			$img->image_resize          		=	true;
			$img->image_ratio_crop      		=	true;
			$img->image_y               		=	$height;
			$img->image_x               		=	$width;	
		} else if($resizeType == 'resizeMaxWidth') {
			$img->image_resize          		=	true;
			$img->image_ratio_y        			= 	true;
			$img->image_x               		=	$width;
		}
		
		$img->process($path_model_id);
		
		
		$Contents["Content"]["type"]		=	$type;
		$Contents["Content"]["url"]			=	"contents/{$model_name}/{$model_id}/{$model_id}_{$type}.{$ext}";
		$Contents["Content"]["path"]		=	$path_content;
		
		if ($img->processed)
		{
			$Content->create();
			$Content->save($Contents);
			return true;
		}
		return false;
	}
	
	//function ResizeImageContent($path,$source,$host,$model_id,$model_name,$type,$mime_type,$width,$height,$resizeType = 'cropResize')
	function ResizeImageContentCloud($source, $destination_path, $model_id, $model_name, $type = "original", $mime_type, $width, $height, $resizeType = 'cropResize') 
	{
		
		$ext								=	pathinfo($source,PATHINFO_EXTENSION);
		$Content							=	ClassRegistry::Init("Content");
		
		$data								=	$Content->find("first",array(
													"conditions"	=>	array(
														"Content.model_id"		=>	$model_id,
														"Content.model"			=>	$model_name,
														"LOWER(Content.type)"	=>	strtolower($type),
													)
												));
												
		if(!empty($data))
		$Contents["Content"]["id"]			=	$data["Content"]["id"];					
		$Contents["Content"]["model"]		=	$model_name;
		$Contents["Content"]["model_id"]	=	$model_id;
		$Contents["Content"]["host"]		=	$this->awsHost;
		$Contents["Content"]["mime_type"]	=	$mime_type;
		$Contents["Content"]["cloud"]		=	"1";
		
		App::import('Vendor','upload' ,array('file'=>'class.upload.php'));
		$img 								=	new upload($source);
		$img->file_new_name_body   			=	$model_id."_".$type;
		
		if($resizeType == 'cropResize') {
			$img->image_resize          		=	true;
			$img->image_ratio_crop      		=	true;
			$img->image_y               		=	$height;
			$img->image_x               		=	$width;	
		} else if($resizeType == 'resizeMaxWidth') {
			$img->image_resize          		=	true;
			$img->image_ratio_y        			= 	true;
			$img->image_x               		=	$width;
		}
		
		$img->process($destination_path);
		
		$Contents["Content"]["type"]		=	$type;
		$Contents["Content"]["url"]			=	"contents/{$model_name}/{$model_id}/{$model_id}_{$type}.{$ext}";
		$Contents["Content"]["path"]		=	"contents/{$model_name}/{$model_id}/{$model_id}_{$type}.{$ext}";
		
		if ($img->processed) {
			
			$file_source = $destination_path.$model_id."_".$type.".".$ext;
			
			if($this->UploadToCloud($file_source,$model_id,$model_name,$type,$mime_type, $ext)) 
			{
				unlink($file_source);
				$Content->create();
				$Content->save($Contents);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	function PostCurl($url,$post,$header)
	{
		//TRY TO SEND PARAMETER
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$out = curl_exec($ch);
		curl_close($ch);
		return $out;
	}
	
	function copy_directory( $source, $destination ) {
		if ( is_dir( $source ) ) {
			@mkdir( $destination );
			$directory = dir( $source );
			while ( FALSE !== ( $readdirectory = $directory->read() ) ) {
				if ( $readdirectory == '.' || $readdirectory == '..' ) {
					continue;
				}
				$PathDir = $source . '/' . $readdirectory; 
				if ( is_dir( $PathDir ) ) {
					$this->copy_directory( $PathDir, $destination . '/' . $readdirectory );
					continue;
				}
				copy( $PathDir, $destination . '/' . $readdirectory );
			}
	 
			$directory->close();
		}else {
			copy( $source, $destination );
		}
	}

	
	function RmDir($filepath){
		
		if (is_dir($filepath) && !is_link($filepath))
		{
			if ($dh = opendir($filepath))
			{
				while (($sf = readdir($dh)) !== false)
				{
					if ($sf == '.' || $sf == '..')
					{
						continue;
					}
					$filepath = (substr($filepath, -1) != "/")? $filepath."/":$filepath;
					if (!$this->RmDir($filepath.$sf))
					{
						echo ($filepath.$sf.' could not be deleted.');
					}
				}
				closedir($dh);
			}
			return rmdir($filepath);
		}
		return unlink($filepath);
	} 
	
	function getContent($destination, $source){
		$filename 	= $destination;
		$handle 	= fopen("$source", "rb");
		if($handle)
		{
	  		$somecontent = stream_get_contents($handle);
	  		fclose($handle);
	  		$handle = fopen($filename, 'wb');
	 
	  		if($handle)
			{
				if (fwrite($handle, $somecontent) === FALSE) 
				{
		   			$confirm = false;
		   			exit;
				}
				$confirm = true;
				fclose($handle);
	  		}
			else
			{
		 		$confirm = false;
		 		exit;
	  		}
		}
		return $confirm;
	}
	
	function GetImageFromUrl($destination, $source)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 0);
		curl_setopt($ch,CURLOPT_URL,$source);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result	=	curl_exec($ch);
		curl_close($ch);
		$handle = fopen($destination, 'wb');
		if($handle)
		{
			if (fwrite($handle, $result) === FALSE) 
			{
				return false;
			}
			fclose($handle);
			return true;
		}
		else
		{
			return false;
		}		 
	}
	
	function getArrayFirstIndex($arr)
	{
		foreach ($arr as $key => $value)
		return $value;
	}
	
	 
	function json_encode($a=false)
	{
		if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
		
		if (is_null($a)) return 'null';
		if ($a === false) return 'false';
		if ($a === true) return 'true';
		if (is_scalar($a))
		{
		  if (is_float($a))
		  {
			// Always use "." for floats.
			return floatval(str_replace(",", ".", strval($a)));
		  }
		
		  if (is_string($a))
		  {
			static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
			return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
		  }
		  else
			return $a;
		}
		$isList = true;
		for ($i = 0, reset($a); $i < count($a); $i++, next($a))
		{
		  if (key($a) !== $i)
		  {
			$isList = false;
			break;
		  }
		}
		$result = array();
		if ($isList)
		{
		  foreach ($a as $v) $result[] = $this->json_encode($v);
		  return '[' . join(',', $result) . ']';
		}
		else
		{
		  foreach ($a as $k => $v) $result[] = $this->json_encode($k).':'.$this->json_encode($v);
		  return '{' . join(',', $result) . '}';
		}
	}
	
	function checkExtContent($type,$code,$prefix="")
	{
		$dest	=	Configure::read('PATH_CONTENT')."images/".$type."/".$code."/";
		$prefix	=	empty($prefix) ? $code : $code.$prefix;
		
		if(!is_dir($dest))
		{
			return false;
		}
		else
		{
			if ($dh = opendir($dest))
			{
				while (($sf = readdir($dh)) !== false)
				{
					if ($sf == '.' || $sf == '..')
					{
						continue;
					}
					$sep	=	explode(".",$sf);
					if($sep[0]==$prefix)
					{
						return $sep[1] ;
					}
				}
				closedir($dh);
			}
			else
			{
				return false;
			}	
		}
	}
	
	function wordwrapText($text)
	{
		$split	=	explode(" ",$text);
		foreach($split as $split)
		{
			if(strlen($split) > 20 && strpos($split, 'http://') === false && strpos($word, 'www.') === false)
			{
				$arr = implode(" ",str_split($split, 20));
			}
			else
			{
				$arr = $split;
			}
			$out[]	=	$arr;
		}
		return implode(" ",$out);
	}
	
	function crop( $s, $srt, $len = NULL, $decode=true, $strict=false, $suffix = NULL )
	{
		if ( is_null($len) ){ $len = strlen( $s ); }
		
		$f = 'static $strlen=0; 
				if ( $strlen >= ' . $len . ' ) { return "><"; } 
				$html_str = html_entity_decode( $a[1] );
				$subsrt   = max(0, ('.$srt.'-$strlen));
				$sublen = ' . ( empty($strict)? '(' . $len . '-$strlen)' : 'max(@strpos( $html_str, "' . ($strict===2?'.':' ') . '", (' . $len . ' - $strlen + $subsrt - 1 )), ' . $len . ' - $strlen)' ) . ';
				$new_str = substr( $html_str, $subsrt,$sublen); 
				$new_str = wordwrap($new_str, 200, "<br>", 1);
				$strlen += $new_str_len = strlen( $new_str );
				$suffix = ' . (!empty( $suffix ) ? '($new_str_len===$sublen?"'.$suffix.'":"")' : '""' ) . ';
				
				return ">" . htmlentities($new_str, ENT_QUOTES, "UTF-8") . "$suffix<";';
		
		if($decode==false)
		{
			$gen = preg_replace( array( "#<[^/][^>]+>(?R)*</[^>]+>#", "#(<(b|h)r\s?/?>){2,}$#is"), "", trim( rtrim( ltrim( preg_replace_callback( "#>([^<]+)<#", create_function(
				'$a',
			  $f
			), ">$s<"  ), ">"), "<" ) ) );
		}
		else
		{
			$gen = html_entity_decode(preg_replace( array( "#<[^/][^>]+>(?R)*</[^>]+>#", "#(<(b|h)r\s?/?>){2,}$#is"), "", trim( rtrim( ltrim( preg_replace_callback( "#>([^<]+)<#", create_function(
				'$a',
			  $f
			), ">$s<"  ), ">"), "<" ) ) ));
			
		}
			
		$split	=	explode(" ",$gen);
		
		foreach($split as $split)
		{
			if(strlen($split) > 20 && strpos($split, 'http://') === false && strpos($split, 'www.') === false)
			{
				$arr = implode(" ",str_split($split, 20));
				
			}
			else
			{
				$arr = $split;
			}
			$out[]	=	$arr;
		}
		
		return implode(" ",$out);
		//return $gen;
	}
	
	function seoUrl($string)
	{
		//Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
		$string = strtolower($string);
		//Strip any unwanted characters
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		//Clean multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		return $string;
	}
	
	function my_encrypt($string, $key="aby") {
		$result = '';
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
	
		return base64_encode($result);
	}
	
	function my_decrypt($string, $key="aby") {
		$result = '';
		$string = base64_decode($string);
	
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result; 
	}
	
	function UpdateLatestUpdate($model,$model_id,$type,$message="New Update!",$jsondata="{}")
	{
		$LatestUpdate							=	ClassRegistry::Init("LatestUpdate");
		$data["LatestUpdate"]["id"]				=	$model;
		$data["LatestUpdate"]["model_id"]		=	$model_id;
		$data["LatestUpdate"]["message"]		=	$message;
		$data["LatestUpdate"]["change_type"]	=	$type;
		$data["LatestUpdate"]["data"]			=	$jsondata;
		$save									=	false;
		
		if(!empty($model_id))
		{
			$save								=	$LatestUpdate->save($data);

			//REMOVE CACHE
			if (($fSetting = Cache::read('setting')) === false)
			{
				$Setting						=	ClassRegistry::Init("Setting");
				$fSetting						=	$Setting->find('first');
				Cache::write('setting', $setting);
			}
			
			$tmp_loc							=	$fSetting["Setting"]["path_cms"] . DS ."app/tmp/cache/".$model;
			@unlink($tmp_loc);
		}
		return $save;
	}
	
	function SendNotif($id,$modified,$model_id,$message,$change_type,$data="{}")
	{
		$User								=	ClassRegistry::Init("User");
		$status								=	false;
		$code								=	"03";
		$fUser								=	$User->find("all",array(
													"group"	=>	array(
														"User.device_id"
													),
													"conditions"	=>	array(
														"User.device_id IS NOT NULL AND User.device_id != ''"
													)
												));
		
		if(!empty($fUser))
		{
			$reg_ids	=	array();
			foreach($fUser as $fUser)
			{
				$reg_ids[]	=	$fUser["User"]["device_id"];
			}
			$url = 'https://android.googleapis.com/gcm/send';
			$fields =	array(
				'registration_ids' => $reg_ids,
				'data' => array(
					"id"			=>	$id,
					"modified"		=>	$modified,
					"model_id"		=>	$model_id,
					"change_type"	=>	$change_type,
					"message"		=>	$message,
					"data"			=>	$data
				),
			);
	 
			$headers = array(
				'Authorization: key=' . "AIzaSyAIkeOTUyp9ipjV74y4BliEmsnkfXWi8DM",
				'Content-Type: application/json'
			);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
			$result = curl_exec($ch);
			
			if ($result === FALSE) {
				die('Curl failed: ' . curl_error($ch));
			}
			curl_close($ch);
			//print_r($result);
		}
	}
	
	function SendNotifToUser($id,$modified,$model_id,$message,$change_type,$user_id,$data="{}")
	{
		$User								=	ClassRegistry::Init("User");
		$fUser								=	$User->findById($user_id);
					
		if(!empty($fUser["User"]["device_id"]))
		{
			$url = 'https://android.googleapis.com/gcm/send';
			$fields =	array(
				'registration_ids'	=>	array($fUser["User"]["device_id"]),
				'data' => array(
					"id"			=>	$id,
					"modified"		=>	$modified,
					"model_id"		=>	$model_id,
					"change_type"	=>	$change_type,
					"message"		=>	$message,
					"data"			=>	$data
				),
			);
		
			$headers = array(
				'Authorization: key=' . "AIzaSyAIkeOTUyp9ipjV74y4BliEmsnkfXWi8DM",
				'Content-Type: application/json'
			);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
			$result = curl_exec($ch);
			
			if ($result === FALSE) {
				die('Curl failed: ' . curl_error($ch));
			}
			curl_close($ch);
		}
	}
	
	
	function ShareFacebook($user_id,$photo_title,$path,$fb_id,$fb_app_id,$fb_app_secret,$fb_access_token,$fb_album_id,$share_type="pict")
	{
		if(!empty($fb_id))
		{
			//LOAD MODEL CRON SHARE
			$SHARE		=	ClassRegistry::Init("CronShare");
			$arr['CronShare']['vendor']			=	"facebook";
			$arr['CronShare']['user_id']		=	$user_id;
			$arr['CronShare']['share_type']		=	$share_type;
			$arr['CronShare']['text']			=	$photo_title;
			$arr['CronShare']['image_path']		=	$path;
			$arr['CronShare']['album_title']	=	"AQUARIUS";
			$arr['CronShare']['album_desc']		=	"AQUARIUS";
			$arr['CronShare']['fb_id']			=	$fb_id;
			$arr['CronShare']['fb_app_id']		=	$fb_app_id;
			$arr['CronShare']['fb_app_secret']	=	$fb_app_secret;
			$arr['CronShare']['fb_access_token']=	$fb_access_token;
			$arr['CronShare']['fb_album_id']	=	$fb_album_id;
			$SHARE->create();
			$save								=	$SHARE->save($arr);
			return $save;
		}
		return false;
	}
}
?>