<?php
/**
 *
<<<<<<< HEAD
 * PHP 5
=======
>>>>>>> 514c7aff6f8d3335089b89706e5a9e4fdf2f54c6
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */
?>
<!DOCTYPE html>
<html>
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo $page_title; ?></title>

<<<<<<< HEAD
<?php if (Configure::read('debug') == 0) { ?>
<meta http-equiv="Refresh" content="<?php echo $pause; ?>;url=<?php echo $url; ?>"/>
<?php } ?>
=======
<?php if (Configure::read('debug') == 0): ?>
<meta http-equiv="Refresh" content="<?php echo $pause; ?>;url=<?php echo $url; ?>"/>
<?php endif ?>
>>>>>>> 514c7aff6f8d3335089b89706e5a9e4fdf2f54c6
<style><!--
P { text-align:center; font:bold 1.1em sans-serif }
A { color:#444; text-decoration:none }
A:HOVER { text-decoration: underline; color:#44E }
--></style>
</head>
<body>
<p><a href="<?php echo $url; ?>"><?php echo $message; ?></a></p>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 514c7aff6f8d3335089b89706e5a9e4fdf2f54c6
