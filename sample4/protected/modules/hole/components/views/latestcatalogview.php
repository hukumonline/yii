<div class="boxArticle">
<?php if($this->showTitle) {?>
	<?php if(!$this->showAltTitle) {?>
		<h1><a href="/pages/tag/<?php echo $this->folderGuid;?>"><?= $this->title;?></a></h1>
	<?php } else {?>
		<div class="bigTitle"><a href="/pages/tag/<?php echo $this->folderGuid;?>"><?= $this->title;?></a></div>
	<?php } ?>
	<div style="padding-top:5px"></div>
<?php }?>
<?php
	$db = Yii::app()->db;
	Yii::import('application.extensions.hole.cms.*'); 
	$catalogManager = new HoleCatalogManager();
	$catalogHelper = new HoleCmsHelper();
	
	foreach($catalogs as $catalog)
	{
		$tmpGuid = $catalog['guid'];
		//$command=$db->createCommand("select t1.value title, t2.value subTitle, t3.value description, t4.value content from ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedTitle') as t1) LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedSubTitle') as t2) ON t1.catalogGuid=t2.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedDescription') as t3) ON t2.catalogGuid=t3.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedContent') as t4) ON t3.catalogGuid=t4.catalogGuid");
		//$row=$command->queryRow();
		$row = $catalogManager->getCatalogDetails($tmpGuid);
?>
		<h2><a href="<?echo Yii::app()->baseUrl;?>/pages/<?=$tmpGuid;?>"><?php echo $row['fixedTitle'];?></a></h2>
		<!--h3><?php //echo $row['fixedSubTitle'];?></h3-->
		<div class="date"><?= $catalogHelper->formatDateTimeFromMysql($catalog['publishedDate']);?>&nbsp; <a href="<?echo Yii::app()->baseUrl;?>/hole/default/info/guid/<?=$tmpGuid;?>" rel="facebox"><img src="<?echo Yii::app()->theme->baseUrl;?>/images/quickview_icon.gif"> Quick View</a></div>
		
		<?php if($this->showLongDescription!=-1) {?>
			<?php $rowDesc = (strlen($row['fixedDescription']) < 10) ? $row['fixedContent'] : $row['fixedDescription'] ;?>
			<?php if($this->showLongDescription) {?>
				<p><?php echo $this->the_nth_sentence(5,$rowDesc);?></p>
			<?php } else {?>
				<p><?php echo $this->the_nth_sentence(1,$rowDesc);?></p>
			<?php } ?>
		<?php }?>
		<div style="padding-top:5px"></div>
		
<?php
	}
?>
</div>