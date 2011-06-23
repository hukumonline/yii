<?php
	Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/menu/potato/jquery.ui.potato.menu.css');

	Yii::app()->clientScript->registerCoreScript('jquery');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/menu/potato/jquery.ui.potato.menu.js');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title><? echo ($this->pageTitle)?($this->pageTitle):"Admin Title";?></title>

  <!-- Framework CSS -->
	<link rel="stylesheet" href="<?echo Yii::app()->theme->baseUrl;?>/styles/blueprint/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="<?echo Yii::app()->theme->baseUrl;?>/styles/blueprint/print.css" type="text/css" media="print">
  <!--[if IE]><link rel="stylesheet" href="<?echo Yii::app()->theme->baseUrl;?>/styles/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

	
	<!-- Import fancy-type plugin for the sample page. -->
	<link rel="stylesheet" href="<?echo Yii::app()->theme->baseUrl;?>/styles/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
	
	<link rel="stylesheet" href="<?echo Yii::app()->theme->baseUrl;?>/styles/fb-admin.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="<?echo Yii::app()->theme->baseUrl;?>/styles/superfish2.css" type="text/css" media="screen, projection">
	
	<!--[if IE]><script type="text/javascript" src="<?echo Yii::app()->request->baseUrl;?>/js/excanvas.js"></script><![endif]-->
	
	<script type="text/javascript" src="<?echo Yii::app()->request->baseUrl;?>/lib/jquery/jquery.roundcorners.2.js"></script>
	<script type="text/javascript" src="<?echo Yii::app()->request->baseUrl;?>/lib/jquery/splitter.js"></script>
	<script type="text/javascript" src="<?echo Yii::app()->request->baseUrl;?>/lib/jquery/jquery.cookie.js"></script>
	<script type="text/javascript" src="<?echo Yii::app()->request->baseUrl;?>/lib/jquery/jquery.flickrmenu.js"></script>
	<script type="text/javascript" src="<?echo Yii::app()->request->baseUrl;?>/lib/jquery/jquery.validate.js"></script>
	<script type="text/javascript" src="<?echo Yii::app()->request->baseUrl;?>/lib/jquery/superfish.js"></script>
	<script type="text/javascript" src="<?echo Yii::app()->request->baseUrl;?>/lib/jquery/jquery.popupwindow.js"></script>
	
	<!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/jquery-ui.min.js"></script-->
	
	<script type="text/javascript">
	$(document).ready(function(){
		$('#menu1').ptMenu();
	});
	</script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			
			$('#message_box').hide();
			//scroll the message box to the top offset of browser's scrool bar
			$(window).scroll(function()
			{
		  		$('#message_box').animate({top:$(window).scrollTop()+"px" },{queue: false, duration: 100});  
			});
		    //when the close button at right corner of the message box is clicked 
			$('#close_message').click(function()
			{
		  		//the messagebox gets scrool down with top property and gets hidden with zero opacity 
				$('#message_box').animate({ top:"+=15px",opacity:0 }, "slow");
			});
		});
	</script>

</head>

<body>
	<div id="message_box">Loading...</div>
	<div style="background:#3B5998;height:35px">
		<div class="container">
			<div class="span-24 last" id="">
					<div style="padding-top:7px"></div>
					<div class="span-3" style="font-size:14px; font-weight:bold;color:white;margin-bottom:0px">
					  &nbsp;&nbsp;backDESK
					</div>
					<div class="span-13">
						<!--
						<div id="headerNavigation1">
						<a href="<?echo Yii::app()->request->baseUrl;?>/admin/user/browse">User</a>
						<a href="<?echo Yii::app()->request->baseUrl;?>/admin/dms/explore">Dms</a>
						<a href="<?echo Yii::app()->request->baseUrl;?>/admin/acl">Access Control</a>
						<a href="<?echo Yii::app()->request->baseUrl;?>/admin/store">Store</a>
						<a href="<?echo Yii::app()->request->baseUrl;?>/admin/dms/search">Search</a>
						<a href="<?echo Yii::app()->request->baseUrl;?>/admin/indexing">Indexing</a>
						</div>
						-->
						<ul id="menu1"> 
							<li><a href="<?echo Yii::app()->request->baseUrl;?>/admin">Dashboard</a></li>
							<li><a href="<?echo Yii::app()->request->baseUrl;?>/admin/user">User</a>
								<ul> 
									<li><a href="#">Access Control</a></li> 
								</ul>
							</li>
							<li><a href="#">Dms</a></li>
						<li><a href="#">Store</a></li>
						<li><a href="#">Search</a></li>
						<li> 
							<a href="#">Indexing</a>
							<ul>
								<li><a href="#">Menu3a</a></li>
								<li><a href="#">Menu3b</a>
									<ul> 
											<li><a href="#">Menu5a</a></li> 
											<li> 
												<a href="#">Menu5b</a> 
												<ul> 
													<li><a href="#">Menu5b-i</a></li> 
													<li><a href="#">Menu5b-ii</a></li> 
												</ul> 
											</li> 
											<li><a href="#">Menu5c</a></li> 
										</ul>	
								</li>
							</ul>
						</li>
						<li><a href="#">Others</a></li>
						</ul>
					</div>
					<div class="span-8 last">
						<div style="padding-top:3px"></div>
						<div id="headerNavigation">
					  	<a href="<?echo Yii::app()->request->baseUrl;?>/admin/user/browse"><span style="font-weight:normal;"><?php //echo $this->username;?></span></a>
						<a href="<?echo Yii::app()->request->baseUrl;?>/admin/dms/browse">My Account</a>
						<a href="<?echo Yii::app()->request->baseUrl;?>/identity/logout">Logout</a>
						</div>
					</div>
			</div>
		</div>
	</div>
	<div class="container">
		<?php echo $content; ?>	
	</div>
</body>
</html>