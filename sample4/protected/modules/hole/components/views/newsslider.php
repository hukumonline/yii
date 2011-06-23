<script type="text/javascript" src="<?php echo Yii::app()->baseUrl;?>/js/jloader.js"></script>
<script>
$(document).ready(function() {
    $('.slideshow').cycle({
		fx: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
		prev:    '#prev',
		next:    '#next',
		slideExpr: '#slide',
		pager:  '#nav', 
		    pagerAnchorBuilder: function(idx, slide) { 
		        // return selector string for existing anchor 
		        return '#nav li:eq(' + idx + ') a';
				//return '<a href="#">&nbsp;</a>';
		}
	});
	var loader= new Loader("#newsSlide", {userCallback:showContent, showProgress:true, showProgressText:true, textSize:15});

	loader.Start();
});
function showContent()
{
	//alert('hi');
	//$(".slideshow").show();
	$(".slideshow").css('visibility','visible');
}

</script>
<style type="text/css">
	#nav { width: 70px; margin: 0 0 0 0 ;z-index: 50;position: relative; left: 365px;top:10px;}
	#nav li { width: 50px; float: left; margin: 0 0 5px 0; list-style: none;}
	#nav a { width: 50px; padding: 3px; display: block; border: 0px solid red; }
	#nav li.activeSlide { background:#f3ca7b  ;border: 0px solid blue;width:55px;
	#nav a:focus { outline: none; }
	#nav img { border: none; display: block }
	
	#nav1 { 
		z-index: 50; 
		position: absolute; 
		bottom: 20px;
		left: 20px;
		font-size:8px;
	}
	#nav1 a { margin: 0 5px; padding: 3px 6px; border: 1px solid #ccc; background: #336666; text-decoration: none }
	#nav1 a.activeSlide { background: #f3ca7b }
	#nav1 a:focus { outline: none; }
	
	
	.slideshow .first{ display:block; }
	#slide { display:none; }
	
</style>

<div class="slideshow" id="newsSlide" style="visibility:hidden;">
	<?php
		foreach($catalogs as $catalog)
		{
	?>
			<div class="ImgCaptMain first" id="slide">
			     <a href="/pages/<?= $catalog['catalog']['guid']?>"><img src="<?php echo Yii::app()->baseUrl.$catalog['image'];?>" width="360" height="200"/></a>
				<br />
			     <div class="ImgCaptDescBox">
			         <div class="ImgCaptDescBg">
			               <div class="ImgCaptDesc">
			           			<a href="/pages/<?= $catalog['catalog']['guid']?>"><?php echo $catalog['details']['fixedTitle'];?></a>
			               </div>
			         </div>
			    </div>
			</div>
	
	<?php } ?>
	
	<ul id="nav1"></ul>
	<ul id="nav">
		<?php
			foreach($catalogs as $catalog)
			{
		?>
				<li><a href="#"><img src="<?php echo $catalog['image'];?>" width="50" height="50" /></a></li>
		
		<?php } ?>
	        
	
	
	

	</ul>
</div>