<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- Framework CSS -->
		<link rel="stylesheet" href="<?echo Yii::app()->theme->baseUrl;?>/styles/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="<?echo Yii::app()->theme->baseUrl;?>/styles/print.css" type="text/css" media="print">

	  <!--[if IE]><link rel="stylesheet" href="<?echo Yii::app()->theme->baseUrl;?>/styles/ie.css" type="text/css" media="screen, projection"><![endif]-->

		<!-- Import fancy-type plugin for the sample page. -->
		<link rel="stylesheet" href="<?echo Yii::app()->theme->baseUrl;?>/styles/site.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="<?echo Yii::app()->theme->baseUrl;?>/styles/superfish.css" type="text/css" media="screen, projection">

	<script type="text/javascript" src="<?echo Yii::app()->baseUrl;?>/js/swfobject.js"></script>	

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body style="background:#fff;">
	<?php //var_dump(Yii::app()->theme->getLayoutFile());die();?>

<?=$this->renderFile(Yii::app()->theme->viewPath."/layouts/header.phtml")?>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->
</body>
</html>