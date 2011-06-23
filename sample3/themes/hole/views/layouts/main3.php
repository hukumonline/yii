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
				<div style="padding-top:45px;"></div>
				<?php $this->widget('hole.components.LatestCatalog', array(
					'folderGuid' => 'lt481074ef14e7a',
					'limit' => 2, 'title'=>'Indonesian Legal News', 'showLongDescription'=>0
				)); ?>
				<?php $this->widget('hole.components.LatestCatalog', array(
					'folderGuid' => 'lt481074ef14e7a', 'offset'=>3,
					'limit' => 8, 'title'=>'More News', 'showLongDescription'=>-1
				)); ?>
			</div>
			<div class="fixed column" style="width:760px;">
				<div class="container" style="border-left:0px solid #999999;border-right:0px solid;padding-left:10px">
					<div class="unit">
						<img src="<?echo Yii::app()->theme->baseUrl;?>/images/bukuhol.gif" width="750px" height="80px">
						<div style="padding-top:5px"></div>
						<div class="container" style="background:#ffcc00;padding-left:0px;padding-right:10px;">
							<?php $this->widget('hole.components.MainMenu'); ?>
						</div>
						
					</div>
					<div class="unit on-2 columns" style="background:">
						<div class="fixed column" style="width:440px;background:">
							<div style="padding-top:10px"></div>
							<div class="container" style="padding-left:10px;padding-right:10px; border-right:0px solid #999999;background:">
								<!--img src="<?echo Yii::app()->theme->baseUrl;?>/images/maincontent.jpg" style="padding-top:10px"-->
								
								
								<?php $this->widget('hole.components.NewsSlider'); ?>
							</div>
							<div style="padding-top:10px"></div>
								<!--div style="text-align:center"><a href="#"><span id="prev">Prev</span></a> <a href="#"><span id="next">Next</span></a></div-->
								
								<div class="container" style="padding-left:10px;padding-right:10px;">
									<div class="container" style="border:1px solid #999999;background:#ffffcb;padding-left:10px;padding-right:10px;">
										<?php $this->widget('hole.components.LatestCatalog', array(
											'folderGuid' => 'lt47f05d1f9b110', 'offset'=>0,
											'limit' => 5, 'title'=>'Indonesian Legal Brief', 'showAltTitle'=>1,'showLongDescription'=>-1
										)); ?>
										<div style="padding-top:10px"></div>
										<?php $this->widget('hole.components.LatestCatalog', array(
											'folderGuid' => 'lt47f05c9c52db0', 'offset'=>0,
											'limit' => 3, 'title'=>'Indonesian Legal Digest', 'showAltTitle'=>1,'showLongDescription'=>0
										)); ?>
									</div>
								</div>
								
								
								
								<div class="unit">
									<?php echo $content;?>
								</div>
						</div>
						<div class="fixed column" style="width:310px">
							<div class="container" style="padding-left:10px;padding-right0px;border-left:0px solid #999999;">
								<?php foreach($this->rightPortlets as $w)
								        $this->widget($w['class'],$w['properties']); ?>
								
								<img src="<?echo Yii::app()->theme->baseUrl;?>/images/banner-right1.jpg" width="300px" >
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<div style="padding-top:10px"></div>
		
		<div class="unit horizontal-center layout on-2 columns">
			<div class="fixed column" style="width:690px;">
				<div class="container" style="padding:0 0px 0 0px;background:">
					<div class="unit on-2 columns">
						<div class="fixed column" style="width:250px;">
							<div class="container" style="padding:0 0px 0 0px;background:">
								<img src="<?echo Yii::app()->theme->baseUrl;?>/images/banner-icon-260.jpg" style="padding-right:0px">
							</div>
						</div>
						<div class="fixed column" style="width:440px;">
							<div class="container" style="padding:0 0px 0 20px;background:">
								<?php $this->widget('hole.components.LatestCatalogByKeyword', array(
									'folderGuid' => 'lt481074ef14e7a', 'offset'=>0,
									'limit' => 3, 'title'=>'@Hukumonline', 'showLongDescription'=>0
								)); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="unit">
					<div class="container" style="padding:15px 0px 0 0px;background:">
						<img src="<?echo Yii::app()->theme->baseUrl;?>/images/banner-icon.jpg" style="padding-right:10px">
						<img src="<?echo Yii::app()->theme->baseUrl;?>/images/banner-icon.jpg" style="padding-right:10px">
						<img src="<?echo Yii::app()->theme->baseUrl;?>/images/banner-icon.jpg" style="padding-right:10px">
						<img src="<?echo Yii::app()->theme->baseUrl;?>/images/banner-icon.jpg" style="padding-right:10px">
						<img src="<?echo Yii::app()->theme->baseUrl;?>/images/banner-icon.jpg" style="padding-right:0px">
					</div>
				</div>
			</div>
			<div class="fixed column" style="width:320px;">
				<div class="container" style="padding:0 0px 0 20px;background:">
					<script src="http://widgets.twimg.com/j/2/widget.js"></script>
					<script>
					new TWTR.Widget({
					  version: 2,
					  type: 'profile',
					  rpp: 5,
					  interval: 6000,
					  width: 250,
					  height: 300,
					  theme: {
					    shell: {
					      background: '#939699',
					      color: '#030303'
					    },
					    tweets: {
					      background: '#ffffff',
					      color: '#000000',
					      links: '#4aed05'
					    }
					  },
					  features: {
					    scrollbar: false,
					    loop: false,
					    live: false,
					    hashtags: true,
					    timestamp: true,
					    avatars: false,
					    behavior: 'all'
					  }
					}).render().setUser('hukumonline').start();
					</script>
				</div>
			</div>
		</div>
		
		<!-- div class="unit horizontal-center layout on-3 columns">
			<div class="fixed column" style="width:250px;">
				<div class="container" style="padding:0 0px 0 0px;background:green">
					Regulation No. 17/PMK.01/2008 with a view 
				</div>
			</div>
			<div class="fixed column" style="width:440px;">
				<div class="container" style="padding:0 0px 0 20px;background:">
					<?php $this->widget('hole.components.LatestCatalog', array(
						'folderGuid' => 'news', 'offset'=>5,
						'limit' => 3, 'title'=>'Blogs', 'showLongDescription'=>0
					)); ?>
				</div>
			</div>
			<div class="fixed column" style="width:320px;">
				<div class="container" style="padding:0 0px 0 20px;background:blue">
					The Directorate General of Intellectual Property Rights has prepared four draft Bills for Copyright, Patent, Trademark, and Industrial Design as each of the current laws are considered to be no longer suitable for the purposes that they were originally enacted.
				</div>
			</div>
		</div-->
		
		<div style="padding-top:10px"></div>
		<div class="unit">
			<div class="container" style="background:#3a3a3a;color:white;padding-top:15px;padding-bottom:5px;height:50px">
				<!-->FOOTER<-->
			</div>
		</div>
	</body>
</html>