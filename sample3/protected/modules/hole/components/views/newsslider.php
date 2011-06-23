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
});
</script>
<style type="text/css">
	#nav { width: 70px; margin: 0 0 0 0 ;z-index: 50;position: absolute; left: 365px;top:10px;}
	#nav li { width: 50px; float: left; margin: 0 0 5px 0; list-style: none }
	#nav a { width: 50px; padding: 3px; display: block; border: 0px solid red; }
	#nav li.activeSlide { background:#f3ca7b  ;border: 0px solid blue;width:55px;}
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
	
</style>

<div class="slideshow">
	<div class="ImgCaptMain" id="slide">
	     <a href="#"><img src="http://cloud.github.com/downloads/malsup/cycle/beach1.jpg" width="360" height="200" /></a>
		<br />
	     <div class="ImgCaptDescBox">
	         <div class="ImgCaptDescBg">
	               <div class="ImgCaptDesc">
	           			Licensing Services, Recommendations, and Product Certification - National Single Window
	               </div>
	         </div>
	    </div>
	</div>
	<div class="ImgCaptMain" id="slide">
	     <a href="#"><img src="http://cloud.github.com/downloads/malsup/cycle/beach2.jpg" width="360" height="200" /></a>
		<br />
	     <div class="ImgCaptDescBox">
	         <div class="ImgCaptDescBg">
	               <div class="ImgCaptDesc">
	           			Indah Kiat - A Bondholder's Nightmare
	               </div>
	         </div>
	    </div>
	</div>
	<div class="ImgCaptMain" id="slide">
	     <a href="#"><img src="http://cloud.github.com/downloads/malsup/cycle/beach3.jpg" width="360" height="200" /></a>
		<br />
	     <div class="ImgCaptDescBox">
	         <div class="ImgCaptDescBg">
	               <div class="ImgCaptDesc">
	           			Bill on Limited Liability Companies - A Fundamental Change
	               </div>
	         </div>
	    </div>
	</div>
	<ul id="nav1"></ul>
	<ul id="nav">

	        <li><a href="#"><img src="http://cloud.github.com/downloads/malsup/cycle/beach1.jpg" width="50" height="50" /></a></li>
	        <li><a href="#"><img src="http://cloud.github.com/downloads/malsup/cycle/beach2.jpg" width="50" height="50" /></a></li>
	        <li><a href="#"><img src="http://cloud.github.com/downloads/malsup/cycle/beach3.jpg" width="50" height="50" /></a></li>

	    </ul>
</div>