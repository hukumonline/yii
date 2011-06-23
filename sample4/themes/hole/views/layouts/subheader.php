<?
	$sReturn = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$sReturn = base64_encode($sReturn);
	$ini_array = parse_ini_file(Yii::getPathOfAlias('webroot')."/protected/config/site.ini",TRUE);
	$loginUrl = $ini_array['general']['identity_login_hukum'];
	$logoutUrl = $ini_array['general']['identity_logout'];
	$signUp = $ini_array['general']['identity_signup'];
?>
<div class="unit horizontal-center layout on-2 columns">
	<div class="fixed column" style="width:260px;">
		<div class="container" style="padding:0 5px 0 5px">
			<a href="/"><img src="<?echo Yii::app()->theme->baseUrl;?>/images/logo.gif" width="250px"></a>
			<div style="padding-top:22px;padding-right:5px">
			<?php if(Yii::app()->user->isGuest) {?>
				<div class="headerMenuLogin" style="text-align:right">
					<a href="<?=$signUp;?>">register</a> &nbsp;|&nbsp; <a href="<?=$loginUrl.'?returnTo='.$sReturn;?>">login</a>

				</div>
			<?} else { ?>
				<div class="headerMenuLogin" style="text-align:right">
					<span style="color:#000;">Hello, <?php echo Yii::app()->user->name;?></span> &nbsp;|&nbsp; <a href="<?=$logoutUrl.'/'.$sReturn;?>">logout</a>

				</div>
			<?php }?>
			</div>
		</div>
	</div>
	<div class="fixed column" style="width:740px;">
		<div class="container" style="padding:0 5px 0 5px">
			<!--/* OpenX Javascript Tag v2.8.5 */-->

			<!--/*
			  * The backup image section of this tag has been generated for use on a
			  * non-SSL page. If this tag is to be placed on an SSL page, change the
			  *   'http://openx.hukumonline.com/www/delivery/...'
			  * to
			  *   'https://openx.hukumonline.com/www/delivery/...'
			  *
			  * This noscript section of this tag only shows image banners. There
			  * is no width or height in these banners, so if you want these tags to
			  * allocate space for the ad before it shows, you will need to add this
			  * information to the <img> tag.
			  *
			  * If you do not want to deal with the intricities of the noscript
			  * section, delete the tag (from <noscript>... to </noscript>). On
			  * average, the noscript tag is called from less than 1% of internet
			  * users.
			  */-->

			<script type='text/javascript'><!--//<![CDATA[
			   var m3_u = (location.protocol=='https:'?'https://openx.hukumonline.com/www/delivery/ajs.php':'http://openx.hukumonline.com/www/delivery/ajs.php');
			   var m3_r = Math.floor(Math.random()*99999999999);
			   if (!document.MAX_used) document.MAX_used = ',';
			   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
			   document.write ("?zoneid=1");
			   document.write ('&amp;cb=' + m3_r);
			   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
			   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
			   document.write ("&amp;loc=" + escape(window.location));
			   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
			   if (document.context) document.write ("&context=" + escape(document.context));
			   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
			   document.write ("'><\/scr"+"ipt>");
			//]]>--></script><noscript><a href='http://openx.hukumonline.com/www/delivery/ck.php?n=aea8e799&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://openx.hukumonline.com/www/delivery/avw.php?zoneid=1&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=aea8e799' border='0' alt='' /></a></noscript>
			
			<div style="padding-top:5px"></div>
			<div class="container" style="background:#ffcc00;padding-left:0px;padding-right:0px;">
				<?php $this->widget('hole.components.MainMenu'); ?>
			</div>
		</div>
	</div>
</div>