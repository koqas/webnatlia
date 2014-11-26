<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?php echo $title_for_layout; ?></title>

<link href="<?php echo $this->webroot; ?>css/style.css" rel="stylesheet">
<link href="<?php echo $this->webroot; ?>css/style-responsive.css" rel="stylesheet">
<script src="<?php echo $this->webroot; ?>js/jquery-1.10.2.min.js"></script>
<script src="<?php echo $this->webroot; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $this->webroot; ?>js/modernizr.min.js"></script>

<?php

//FAVICON
echo $this->Html->meta('icon',$this->webroot."img/favicon.png",array("type"=>"png"));

//************ CSS NEEDED ****************//
echo $this->Html->css("main");
//************ CSS NEEDED ****************//

//************ JS NEEDED ******************/
echo $this->Html->script(array(
	"jquery",
	"jquery-ui.min",
	"aby_custom"
));
//************ JS NEEDED ******************/

?>
</head>

<body>
<!-- HEADER -->
<?php
	echo $this->fetch('header');
?>
<!-- HEADER -->

<!-- CONTENT -->

<?php echo $this->fetch('content'); ?>
<!-- CONTENT -->


<?php echo $this->element('sql_dump'); ?>

</body>
</html>