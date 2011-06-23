<div class="boxDetailArticle">
	<h1><?php echo $catalog['attribute']['fixedTitle']; ?></h1>
	<div style="padding-top:5px"></div>
	<div class="date">February 12, 2010</div>
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
