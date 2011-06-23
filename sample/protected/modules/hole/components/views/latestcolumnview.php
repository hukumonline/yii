<div class="boxArticle">
<?php if(!$this->showAltTitle) {?>
	<h1><?php $this->title;?></h1>
<?php } else {?>
	<div class="bigTitle"><?php $this->title;?></div>
<?php } ?>
	
<?php
	$db = Yii::app()->db;
	foreach($catalogs as $catalog)
	{
		$tmpGuid = $catalog['guid'];
		//$command=$db->createCommand("select t1.value title, t2.value subTitle, t3.value description, t4.value content from ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedTitle') as t1) LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedSubTitle') as t2) ON t1.catalogGuid=t2.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedDescription') as t3) ON t2.catalogGuid=t3.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedContent') as t4) ON t3.catalogGuid=t4.catalogGuid");
		//$row=$command->queryRow();
		Yii::import('application.extensions.hole.cms.*'); 
		$catalogManager = new HoleCatalogManager();
		$row = $catalogManager->getCatalogDetails($tmpGuid);
?>
		<h2><a href="<?php echo Yii::app()->baseUrl;?>/pages/<?php $tmpGuid;?>"><?php echo $row['fixedTitle'];?></a></h2>
		<div class="date">February 12, 2010</div>
		
		<?php if($this->showLongDescription) {?>
			<p><?php echo $this->the_nth_sentence(3,$row['fixedContent']);?></p>
		<?php } else {?>
			<p><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/face2.jpg" align="left" style="padding-right:5px"><?php echo $this->the_nth_sentence(1,$row['fixedContent']);?></p>
		<?php } ?>
		
		
<?php
	}
?>
</div>