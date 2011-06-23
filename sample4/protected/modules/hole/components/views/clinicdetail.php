<?php
	Yii::import('application.extensions.hole.cms.*'); 
	$catalogHelper = new HoleCmsHelper();
?>
<div class="boxDetailArticle">
	<h1><?php echo $catalog['attribute']['fixedTitle']; ?></h1>
	<div style="padding-top:5px"></div>
	<span class="date"><?= $catalogHelper->formatDateTimeFromMysql($catalog['catalog']['createdDate']);?>&nbsp;</span>&nbsp;
	<div style="padding-top:5px">
		<!-- AddThis Button BEGIN>
		<div class="addthis_toolbox addthis_default_style">
		<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4c23437801c0b05a" class="addthis_button_compact">Share</a>
		<span class="addthis_separator">|</span>
		<a class="addthis_button_facebook"></a>
		<a class="addthis_button_myspace"></a>
		<a class="addthis_button_google"></a>
		<a class="addthis_button_twitter"></a>
		</div>
		<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4c23437801c0b05a"></script>
		< AddThis Button END -->
		
		<!-- AddThis Button BEGIN -->
		<div class="addthis_toolbox addthis_default_style">
		<a class="addthis_button_facebook"></a>
		<a class="addthis_button_google"></a>
		<a class="addthis_button_twitter"></a>
		<a class="addthis_button_email"></a>
		<a class="addthis_button_favorites"></a>
		<!--a class="addthis_button_print"></a-->
		<span class="addthis_separator">|</span>
		<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4c23450239885f16" class="addthis_button_expanded">More</a>
		</div>
		<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4c23450239885f16"></script>
		<!-- AddThis Button END -->
		
		
	</div>
	<?php if($this->isAllowedToView()){?>
		<p><?php echo $catalog['attribute']['fixedQuestion']; ?></p>
		<p><strong>Answer:</strong></p>
		<div style="background:#ffffcb;padding:0 20px 0 20px"><?php echo $catalog['attribute']['fixedContent']; ?></div>
	
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
							<?php $tmpDetail = $this->getClinicDetails($row['itemGuid'])?>
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
		<p><?php echo $this->getSentence(3,$catalog['attribute']['fixedQuestion']);?>... 
			<br><br><div style="font-weight: bold;">You need to login or upgrade your membership.</div></p>
	<?php }?>
</div>
