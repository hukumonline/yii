<?
	Yii::app()->clientScript->registerCoreScript('jquery');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="google-site-verification" content="MUDP2J4JyyfKSWJsjfuglidOXiHOU_vn5VLXY7S-G8w" />
		<link rel="stylesheet" type="text/css" media="all" href="<?echo Yii::app()->theme->baseUrl;?>/css/elastic.css" />
		<script src="<?echo Yii::app()->theme->baseUrl;?>/css/elastic.js" type="text/javascript" language="javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="<?echo Yii::app()->theme->baseUrl;?>/css/typography3.css" />
		
		<link href="<?echo Yii::app()->baseUrl;?>/js/lightbox/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
		<script src="<?echo Yii::app()->baseUrl;?>/js/lightbox/facebox/facebox.js" type="text/javascript"></script>
		
		<link rel="stylesheet" type="text/css" media="screen" href="<?echo Yii::app()->theme->baseUrl;?>/css/superfish/css/superfish.css" /> 
		<script type="text/javascript" src="<?echo Yii::app()->theme->baseUrl;?>/css/superfish/js/superfish.js"></script> 
		<script type="text/javascript"> 

		    $(document).ready(function(){ 
		        $("ul.sf-menu").superfish(); 
		    }); 
			
			jQuery(document).ready(function($) {
			  $('a[rel*=facebox]').facebox()
			})

		</script>
		
	</head>
	<body>
		<?php include(Yii::app()->theme->basePath.'/views/layouts/analytics.php');?>
		<?php $this->widget('hole.components.HeaderMenu'); ?>
		<div style="padding-top:5px"></div>
		<?php include(Yii::app()->theme->basePath.'/views/layouts/subheader.php');?>
		
		<div class="unit horizontal-center layout on-2 columns">
			<div class="fixed column" style="width:260px;">
				<div class="container" style="padding:0 5px 0 5px">
					<div style="padding-top:0px"></div>
					<?php $this->widget('hole.components.ViewCategories', array(
						'folderGuid' => $_GET['guid'],
						'title'=>'Categories'
					)); ?>
				</div>
			</div>
			<div class="fixed column" style="width:740px;">
				<div class="container" style="padding:0 5px 0 5px">
					<div style="padding-top:5px"></div>
					<div class="container" style="margin:0 0px 0 0px;background:;border-left:1px solid #999999;">
						<?php echo $content;?>
					</div>
				</div>
			</div>
		</div>
		
		<div style="padding-top:10px"></div>
		<?php include(Yii::app()->theme->basePath.'/views/layouts/footer.php');?>
	</body>
</html>
