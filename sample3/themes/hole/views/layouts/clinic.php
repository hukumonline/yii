<?
	Yii::app()->clientScript->registerCoreScript('jquery');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" media="all" href="<?echo Yii::app()->theme->baseUrl;?>/css/elastic.css" />
		<script src="<?echo Yii::app()->theme->baseUrl;?>/css/elastic.js" type="text/javascript" language="javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="<?echo Yii::app()->theme->baseUrl;?>/css/typography3.css" />
		
		<link href="<?echo Yii::app()->baseUrl;?>/js/lightbox/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
		<script src="<?echo Yii::app()->baseUrl;?>/js/lightbox/facebox/facebox.js" type="text/javascript"></script>
		<script src="<?echo Yii::app()->baseUrl;?>/js/jquery.easyListSplitter.js" type="text/javascript"></script>
		
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
		<?php $this->widget('hole.components.HeaderMenu'); ?>
		<div style="padding-top:10px"></div>
		<div class="unit horizontal-center layout on-2 columns">
			<div class="fixed column" style="width:250px;">
				<div class="container" style="padding:0 0px 0 0px;background:green">
					<img src="<?echo Yii::app()->theme->baseUrl;?>/images/logo.gif" width="250px"> 
				</div>
			</div>
			<div class="fixed column" style="width:760px;">
				<div class="container" style="background:;margin-left:10px;padding-right:0px;">
					<img src="<?echo Yii::app()->theme->baseUrl;?>/images/bukuhol.gif" width="750px" height="80px">
				</div>
				<div style="padding-top:5px"></div>
				<div class="container" style="background:#ffcc00;margin-left:10px;padding-right:10px;">
					<?php $this->widget('hole.components.MainMenu'); ?>
				</div>
			</div>
		</div>
		
		<div style="padding-top:5px"></div>
		<div class="unit horizontal-center layout on-2 columns">
			<div class="fixed column" style="width:250px;">
				<div class="container" style="padding:0 0px 0 0px;background:">
					<div style="padding-top:0px;"></div>
					<?php $this->widget('hole.components.ClinicCategory', array(
						'folderGuid' => 'lt482c0163330e1', 'offset'=>0,
						'limit' => 100, 'title'=>'Clinic Categories', 'showLongDescription'=>-1
					)); ?>
					<div style="clear:both;"></div>
					<?php $this->widget('hole.components.LatestCatalog', array(
						'folderGuid' => 'news', 'offset'=>3,
						'limit' => 8, 'title'=>'Clinic Partner', 'showLongDescription'=>-1
					)); ?>
					
				</div>
			</div>
			<div class="fixed column" style="width:760px;">
				<div class="container" style="margin:0 0px 0 20px;background:;border-left:0px solid #999999;">
					<?php echo $content;?>
					
				</div>
			</div>
		</div>
		
		<div style="padding-top:10px"></div>
		<div class="unit">
			<div class="container" style="background:#3a3a3a;color:white;padding-top:15px;padding-bottom:5px;height:50px">
				<!-- Footer -->
			</div>
		</div>
	</body>
</html>
