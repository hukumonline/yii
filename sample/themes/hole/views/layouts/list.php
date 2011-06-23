<?php
	Yii::app()->clientScript->registerCoreScript('jquery');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Hukumonline English</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->theme->baseUrl;?>/css/elastic.css" />
		<script src="<?php echo Yii::app()->theme->baseUrl;?>/css/elastic.js" type="text/javascript" language="javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->theme->baseUrl;?>/css/typography.css" />
		
		<link href="<?php echo Yii::app()->baseUrl;?>/js/lightbox/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
		<script src="<?php echo Yii::app()->baseUrl;?>/js/lightbox/facebox/facebox.js" type="text/javascript"></script>
		
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->theme->baseUrl;?>/css/superfish/css/superfish.css" /> 
		<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/css/superfish/js/superfish.js"></script> 
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
			<div class="fixed column" style="width:300px;">
				<div class="container" style="padding-left:10px;padding-right:10px;border-right:0px solid #e2e2e2">
					<div style="padding-top:5px;"></div>
					<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/logo.gif">
					<br>&nbsp;<br>
					<?php $this->widget('hole.components.LatestCatalog', array(
						'folderGuid' => 'lt4810069ce5b5b',
						'limit' => 3, 'title'=>'Indonesian Legal News', 'showLongDescription'=>0
					)); ?>
					<?php $this->widget('hole.components.LatestCatalog', array(
						'folderGuid' => 'lt4810069ce5b5b', 'offset'=>3,
						'limit' => 5, 'title'=>'More News', 'showLongDescription'=>0
					)); ?>
				</div>
			</div>
			<div class="fixed column" style="width:700px;">
				<div class="container" style="border-left:1px solid #999999;border-right:0px solid">
					<div class="unit">
						<div class="container" style="background:#ffcc00;padding-left:45px;padding-right:10px;">
							<?php $this->widget('hole.components.MainMenu'); ?>
						</div>
					</div>
					<div class="unit">
						<div class="container" style="background:#cc9900;padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px">
							<form id="searchForm" method="POST" action="http://en2.hukumonline.com/app/dms/browser/search">
								Search 
								<input type="text" id="searchQuery" name="searchQuery" size="35"> 
								<input type="hidden" name="profile" value="">
								<input type="submit" value="Go">
							</form>
						</div>
					</div>
					<div class="unit" style="">
						<!--<div class="boxListArticle">
							<h1>Indonesian Legal Brief</h1>
							
							<div class="boxItem">
								<div class="date">FEBRUARY 12, 2010</div>
								<h2>Obama to Offer Health Bill to Ease Impasse as Bipartisan Meeting Approaches</h2>
								<p>Komisi Pengawas Persaingan Usaha (KPPU) agaknya geram dengan kondisi pengadaan barang dan jasa yang terus diselimuti persekongkolan.</p>
							</div>
							<div class="boxItem" style="background:#f4f4f4;">
								<div class="date">FEBRUARY 12, 2010</div>
								<h2>Obama to Offer Health Bill to Ease Impasse as Bipartisan Meeting Approaches</h2>
								<p>Komisi Pengawas Persaingan Usaha (KPPU) agaknya geram dengan kondisi pengadaan barang dan jasa yang terus diselimuti persekongkolan.</p>
							</div>
							<div class="boxItem">
								<div class="date">FEBRUARY 12, 2010</div>
								<h2>Obama to Offer Health Bill to Ease Impasse as Bipartisan Meeting Approaches</h2>
								<p>Komisi Pengawas Persaingan Usaha (KPPU) agaknya geram dengan kondisi pengadaan barang dan jasa yang terus diselimuti persekongkolan.</p>
							</div>
							<div class="boxItem" style="background:#f4f4f4;">
								<div class="date">FEBRUARY 12, 2010</div>
								<h2>Obama to Offer Health Bill to Ease Impasse as Bipartisan Meeting Approaches</h2>
								<p>Komisi Pengawas Persaingan Usaha (KPPU) agaknya geram dengan kondisi pengadaan barang dan jasa yang terus diselimuti persekongkolan.</p>
							</div>
							<div class="boxItem">
								<div class="date">FEBRUARY 12, 2010</div>
								<h2>Obama to Offer Health Bill to Ease Impasse as Bipartisan Meeting Approaches</h2>
								<p>Komisi Pengawas Persaingan Usaha (KPPU) agaknya geram dengan kondisi pengadaan barang dan jasa yang terus diselimuti persekongkolan.</p>
							</div>
							<div class="boxItem" style="background:#f4f4f4;">
								<div class="date">FEBRUARY 12, 2010</div>
								<h2>Obama to Offer Health Bill to Ease Impasse as Bipartisan Meeting Approaches</h2>
								<p>Komisi Pengawas Persaingan Usaha (KPPU) agaknya geram dengan kondisi pengadaan barang dan jasa yang terus diselimuti persekongkolan.</p>
							</div>
							<div class="boxItem">
								<div class="date">FEBRUARY 12, 2010</div>
								<h2>Obama to Offer Health Bill to Ease Impasse as Bipartisan Meeting Approaches</h2>
							</div>
							<div class="boxItem" style="background:#f4f4f4;">
								<div class="date">FEBRUARY 12, 2010</div>
								<h2>Obama to Offer Health Bill to Ease Impasse as Bipartisan Meeting Approaches</h2>
							</div>
						</div> -->
						<?php echo $content;?>
					</div>
				</div>
			</div>
		</div>
		<div style="padding-top:10px"></div>
		<div class="unit">
			<div class="container" style="background:#3a3a3a;color:white;padding-top:15px;padding-bottom:5px;height:50px">
				Footer
			</div>
		</div>
	</body>
</html>
