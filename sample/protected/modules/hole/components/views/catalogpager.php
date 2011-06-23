<div class="boxListArticle">
<?php if(!$this->showAltTitle) {?>
	<h1><?php  $this->title;?></h1>
<?php } else {?>
	<div class="bigTitle"><?php  $this->title;?></div>
<?php } ?>
	<?php
		$db = Yii::app()->db;
		$i = 0;
		foreach($catalogs as $catalog)
		{
			$i++;
			$tmpGuid = $catalog['guid'];
			//$command=$db->createCommand("select t1.value title, t2.value subTitle, t3.value description, t4.value content from ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedTitle') as t1) LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedSubTitle') as t2) ON t1.catalogGuid=t2.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedDescription') as t3) ON t2.catalogGuid=t3.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedContent') as t4) ON t3.catalogGuid=t4.catalogGuid");
			//$row=$command->queryRow();
			//file_put_contents(Yii::app()->basePath . '/data/'.$tmpGuid.'.row', serialize($row));
			Yii::import('application.extensions.hole.cms.*'); 
			$catalogManager = new HoleCatalogManager();
			$row = $catalogManager->getCatalogDetails($tmpGuid);
			//$fileContent = file_get_contents(KUTU_CATALOG_STORAGE_PATH.'/'.$tmpGuid.'.row'); 
			//$row = unserialize($fileContent);
	?>
		<?php if ($i%2==0) {?>
			<div class="boxItem" style="background:#f4f4f4;">
		<?php } else { ?>
			<div class="boxItem">
		<?php }?>
			<div class="date"><?php echo $catalog['publishedDate'];?>, &nbsp;<a href="<?echo Yii::app()->baseUrl;?>/hole/default/info/guid/<?php $tmpGuid;?>" rel="facebox"><img src="<?echo Yii::app()->theme->baseUrl;?>/images/quickview_icon.gif"> Quick View</a></div>
			<h2><a href="<?php echo Yii::app()->baseUrl;?>/pages/<?php $tmpGuid?>"><?php echo $row['fixedTitle'];?></a></h2>
			<?php //echo Yii::app()->basePath;?>
		
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