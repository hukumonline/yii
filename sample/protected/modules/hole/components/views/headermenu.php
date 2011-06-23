<div class="unit">
	<div class="container" style="background:#000">
		<div class="unit horizontal-center layout on-2 columns">
			<div class="column">
				&nbsp;
			</div>
			<div class="column">
				<div class="container" style="text-align:right;padding-top:5px">
					<?php if(Yii::app()->user->isGuest) {?>
						<div class="headerMenu" style="text-align:right">
							<a href="http://en2.hukumonline.com/app/servers/identity/account/signup">register</a> &nbsp;|&nbsp; <a href="http://id.hukumonline.tld/kumon/app/services/session/synclogin.php?returnTo=aHR0cDovL2h1a3Vtb25saW5lLnRsZC95aWkvc2FtcGxl">login</a>
							&nbsp;|&nbsp; <a href="http://en1.hukumonline.com/">help</a> &nbsp;|&nbsp; <a href="http://en1.hukumonline.com/">advanced search</a>
						</div>
					<?php } else { ?>
						<div class="headerMenu" style="text-align:right">
							<span style="color:#fff;">Hello, <?php echo Yii::app()->user->name;?></span> &nbsp;|&nbsp; <a href="http://id.hukumonline.tld/kumon/app/servers/identity/account/logout/returnTo/aHR0cDovL2h1a3Vtb25saW5lLnRsZC95aWkvc2FtcGxl">logout</a>
							&nbsp;|&nbsp; <a href="http://en1.hukumonline.com/">help</a> &nbsp;|&nbsp; <a href="http://en1.hukumonline.com/">advanced search</a>
						</div>
					<?php }?>
				</div>
			</div>
			
		</div>
	</div>
	<div class="container" style="background:#000000;padding-top:15px;padding-bottom:10px;">
		<div class="unit horizontal-center layout on-2 columns">
			<div class="column">
				<div class="headerMenu">
					<a href="http://www.hukumonline.com">hukumonline.com</a> &nbsp;|&nbsp; <a href="http://en1.hukumonline.com">en.hukumonline.com</a>
					&nbsp;|&nbsp; <a href="http://www.hukumpedia.com/">hukumpedia.com</a> 
				</div>
			</div>
			<div class="column">
				<div class="container" style="text-align:right;">
					<span style="color:#fff">Search &nbsp;  </span>
					<form id="searchForm" method="POST" action="http://en2.hukumonline.com/app/dms/browser/search" style="display:inline;"> 
						<input type="text" id="searchQuery" name="searchQuery" size="100" style="width:250px"> 
						<input type="hidden" name="profile" value="">
						<input type="submit" value="Go">
					</form>
				</div>
			</div>
			
		</div>
	</div>
</div>