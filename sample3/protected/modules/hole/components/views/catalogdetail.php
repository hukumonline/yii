<div class="boxDetailArticle">
	<h1><?php echo $catalog['attribute']['fixedTitle']; ?></h1>
	<div style="padding-top:5px"></div>
	<span class="date">February 12, 2010</span>&nbsp;
	<div style="padding-top:5px">
		<!-- AddThis Button BEGIN -->
		<a class="addthis_button" href="http://addthis.com/bookmark.php?v=250&amp;username=xa-4be575c25f52d844"><img src="http://s7.addthis.com/static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0"/></a>
		<!-- AddThis Button END -->
		
		<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4be57092018a90f9"></script>
		<!-- AddThis Button END -->
	</div>
	<?php if($this->isAllowedToView()){?>
		<p><?php echo $catalog['attribute']['fixedContent']; ?></p>
	
		<?php
			if (count($files) > 0) { ?>
			<table>
			<tr>
				<td><div class="inside"><b>Download Document(s)</b></div></td>
			</tr>
			<tr>
				<td>
					<div class="inside">
						<?php foreach ($files as $row) : ?>
							<?php $tmpDetail = $this->getCatalogDetails($row['itemGuid'])?>
							<div style="padding-top:5px"></div>
							<a href="http://en2.hukumonline.com/app/dms/default/browser/download-file/guid/<?php echo $row['itemGuid'];?>/parent/<?php echo $row['relatedGuid'];?>"><?php echo $tmpDetail['fixedTitle']; ?></a>
							<div style="padding-top:5px"></div>
						<?php endforeach; ?>
					</div>
				</td>
			</tr>
			</table>
		<?php } ?>
	<?php } else {?>
		<p><?php echo $this->getSentence(3,$catalog['attribute']['fixedContent']);?>... 
			<br><br><div style="font-weight: bold;">You need to login or upgrade your membership.</div></p>
	<?php }?>
</div>
