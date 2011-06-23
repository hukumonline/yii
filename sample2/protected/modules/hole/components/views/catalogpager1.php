<div class="boxListArticle">
<?php if(!$this->showAltTitle) {?>
	<h1><?= $this->title;?> 1</h1>
<?php } else {?>
	<div class="bigTitle"><?= $this->title;?></div>
<?php } ?>
	<?php
		// $db = Yii::app()->db;
		//  		$i = 0;
		// 		$sGuid = '';
		// 		$totalCatalog = count($catalogs);
		// 		foreach($catalogs as $catalog)
		// 		{
		// 			$i++;
		// 			$tmpGuid = $catalog['guid'];
		// 			if($i == $totalCatalog)
		// 				$sGuid .= "'$tmpGuid'";
		// 			else 
		// 				$sGuid .= "'$tmpGuid',"; 
		// 		}
		// 		//echo $sGuid;
		// 		$catalogs = KutuCatalogTest::model()->findAllBySql("select KutuCatalogTest.* from KutuCatalogTest where guid IN ($sGuid)");

		$i = 0;
		foreach($catalogs as $catalog)
		{
			$i++;
			$tmpGuid = $catalog['guid'];
			//$command=$db->createCommand("select t1.value title, t2.value subTitle, t3.value description, t4.value content from ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedTitle') as t1) LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedSubTitle') as t2) ON t1.catalogGuid=t2.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedDescription') as t3) ON t2.catalogGuid=t3.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedContent') as t4) ON t3.catalogGuid=t4.catalogGuid");
			$attribute = KutuCatalogTest::model()->findByPk($tmpGuid);
			
			//$row=unserialize($catalog->content);
			$row=unserialize($attribute->content);
	?>
		<?php if ($i%2==0) {?>
			<div class="boxItem" style="background:#f4f4f4;">
		<?php } else { ?>
			<div class="boxItem">
		<?php }?>
			<div class="date">February 12, 2010, <a href="<?echo Yii::app()->baseUrl;?>/hole/default/info" rel="facebox"><img src="<?echo Yii::app()->theme->baseUrl;?>/images/quickview_icon.gif"> Quick View</a></div>
			<h2><a href="dms"><?php echo $row['fixedTitle'];?></a></h2>
			
		
			<?php if($this->showLongDescription) {?>
				<p><?php echo $this->the_nth_sentence(3,$row['fixedContent']);?></p>
			<?php } else {?>
				<p><?php echo $this->the_nth_sentence(1,$row['fixedContent']);?></p>
			<?php } ?>
		
		</div>
	<?php
		}
	?>
	
</div>
<div style="padding-top:10px;padding-left:10px">
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
</div>