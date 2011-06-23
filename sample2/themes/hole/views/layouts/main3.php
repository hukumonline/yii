<?
	Yii::app()->clientScript->registerCoreScript('jquery');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Hukumonline English</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" media="all" href="<?echo Yii::app()->theme->baseUrl;?>/css/elastic.css" />
		<script src="<?echo Yii::app()->theme->baseUrl;?>/css/elastic.js" type="text/javascript" language="javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="<?echo Yii::app()->theme->baseUrl;?>/css/typography3.css" />
		
		<link href="<?echo Yii::app()->baseUrl;?>/js/lightbox/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
		<script src="<?echo Yii::app()->baseUrl;?>/js/lightbox/facebox/facebox.js" type="text/javascript"></script>
		<script src="<?echo Yii::app()->baseUrl;?>/js/slider/jquery.cycle/jquery.cycle.all.min.js" type="text/javascript"></script>
		
		<link rel="stylesheet" type="text/css" media="screen" href="<?echo Yii::app()->theme->baseUrl;?>/css/superfish/css/superfish.css" /> 
		<script type="text/javascript" src="<?echo Yii::app()->theme->baseUrl;?>/css/superfish/js/superfish.js"></script> 
		<script type="text/javascript"> 

		    $(document).ready(function(){ 
		        $("ul.sf-menu").superfish(); 
		    }); 
			
			jQuery(document).ready(function($) {
			  $('a[rel*=facebox]').facebox()
			})
			
			$(document).ready(function() {
			    $('.slideshow').cycle({
					fx: 'uncover', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
					prev:    '#prev',
					next:    '#next'
				});
			});
			

		</script>
		
	</head>
	<body>
		<?php $this->widget('hole.components.HeaderMenu'); ?>
		<!--<div class="unit">
			<div class="container" style="background:#3a3a3a;color:white;height:86px;border-top:1px solid #666666">
				<div class="unit horizontal-center layout on-2 columns">
					<div class="fixed column" style="width:260px;">
						<div class="container" style="padding-left:10px;padding-right:10px">
							<img src="logo.gif">
						</div>
					</div>
					<div class="fixed column" style="width:740px;">
					</div>
				</div>
			</div>
		</div> -->
		<div style="padding-top:10px"></div>
		<div class="unit horizontal-center layout on-2 columns">
			<div class="fixed column" style="width:250px;">
				<img src="<?echo Yii::app()->theme->baseUrl;?>/images/logo.gif" width="250px">
				<div style="padding-top:5px;"></div>
				<?php $this->widget('hole.components.LatestCatalog', array(
					'folderGuid' => 'news',
					'limit' => 1, 'title'=>'Indonesian Legal News', 'showLongDescription'=>1
				)); ?>
				<?php $this->widget('hole.components.LatestCatalog', array(
					'folderGuid' => 'news', 'offset'=>3,
					'limit' => 10, 'title'=>'More News', 'showLongDescription'=>-1
				)); ?>
			</div>
			<div class="fixed column" style="width:760px;">
				<div class="container" style="border-left:0px solid #999999;border-right:0px solid;padding-left:10px">
					<div class="unit">
						<div class="container" style="background:#ffcc00;padding-left:0px;padding-right:10px;">
							<?php $this->widget('hole.components.MainMenu'); ?>
						</div>
					</div>
					<div class="unit on-2 columns" style="background:">
						<div class="fixed column" style="width:440px;background:">
							<div style="padding-top:10px"></div>
							<div class="container" style="padding-left:10px;padding-right:10px; border-right:0px solid #999999;background:">
								<!--img src="<?echo Yii::app()->theme->baseUrl;?>/images/maincontent.jpg" style="padding-top:10px"-->
								<div class="slideshow">
									<div class="ImgCaptMain">
									     <a href="#"><img src="http://cloud.github.com/downloads/malsup/cycle/beach1.jpg" width="420" height="200" /></a>
										<br />
									     <div class="ImgCaptDescBox">
									         <div class="ImgCaptDescBg">
									               <div class="ImgCaptDesc">
									           			Licensing Services, Recommendations, and Product Certification - National Single Window
									               </div>
									         </div>
									    </div>
									</div>
									<div class="ImgCaptMain">
									     <a href="#"><img src="http://cloud.github.com/downloads/malsup/cycle/beach2.jpg" width="420" height="200" /></a>
										<br />
									     <div class="ImgCaptDescBox">
									         <div class="ImgCaptDescBg">
									               <div class="ImgCaptDesc">
									           			Indah Kiat - A Bondholder's Nightmare
									               </div>
									         </div>
									    </div>
									</div>
									<div class="ImgCaptMain">
									     <a href="#"><img src="http://cloud.github.com/downloads/malsup/cycle/beach4.jpg" width="420" height="200" /></a>
										<br />
									     <div class="ImgCaptDescBox">
									         <div class="ImgCaptDescBg">
									               <div class="ImgCaptDesc">
									           			Bill on Limited Liability Companies - A Fundamental Change
									               </div>
									         </div>
									    </div>
									</div>
								</div>
							</div>
							<div style="padding-top:10px"></div>
								<!--div style="text-align:center"><a href="#"><span id="prev">Prev</span></a> <a href="#"><span id="next">Next</span></a></div-->
								
								<div class="container" style="padding-left:10px;padding-right:10px;">
									<div class="container" style="border:1px solid #999999;background:#ffffcb;padding-left:10px;padding-right:10px;">
										<?php $this->widget('hole.components.LatestCatalog', array(
											'folderGuid' => 'ilb', 'offset'=>0,
											'limit' => 5, 'title'=>'Indonesian Legal Brief', 'showAltTitle'=>1,'showLongDescription'=>-1
										)); ?>
										<div style="padding-top:10px"></div>
										<?php $this->widget('hole.components.LatestCatalog', array(
											'folderGuid' => 'ild', 'offset'=>0,
											'limit' => 3, 'title'=>'Indonesian Legal Digest', 'showAltTitle'=>1,'showLongDescription'=>0
										)); ?>
									</div>
								</div>
								<div class="container" style="padding-left:10px;padding-right:10px;">
									<?php $this->widget('hole.components.LatestCatalog', array(
										'folderGuid' => 'news', 'offset'=>5,
										'limit' => 3, 'title'=>'Blogs', 'showLongDescription'=>0
									)); ?>
								</div>
								
								<!--div class="container" style="padding-left:10px;padding-right:10px; border:0px solid #999999;background:">	
									<div class="unit on-2 columns" style="background:#ffffcb;border:1px solid #999999;">
										<div class="fixed column" style="width:209px">
											<div class="container" style="padding-right:0px;">
												<?php $this->widget('hole.components.LatestCatalog', array(
													'folderGuid' => 'ilb', 'offset'=>0,
													'limit' => 3, 'title'=>'Indonesian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Legal Brief', 'showAltTitle'=>1,
												)); ?>
											</div>
										</div>
										<div class="fixed column" style="width:209px">
											<div class="container" style="padding-left:0px;">
												<?php $this->widget('hole.components.LatestCatalog', array(
													'folderGuid' => 'ild', 'offset'=>3,
													'limit' => 3, 'title'=>'Indonesian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Legal Digest', 'showAltTitle'=>1,
												)); ?>
											</div>
										</div>
									</div>
									<br>
								</div-->
								
								<div class="unit">
									<?php echo $content;?>
								</div>
						</div>
						<div class="fixed column" style="width:310px">
							<div class="container" style="padding-left:10px;padding-right0px;border-left:0px solid #999999;">
								<?php foreach($this->rightPortlets as $w)
								        $this->widget($w['class'],$w['properties']); ?>
								
								<div class="boxArticle">
									<h1>Hukumonline.com</h1>
									<h2>Bill on Shipping - Passes the DPR</h2>
									<h2>Revision of the Intellectual Property Laws - Trademarks</h2>
									<h2>Why Indonesia Deserves A Better President</h2>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<div style="padding-top:10px"></div>
		<div class="unit">
			<div class="container" style="background:#3a3a3a;color:white;padding-top:15px;padding-bottom:5px;height:50px">
				<!-->FOOTER<-->
			</div>
		</div>
	</body>
</html>