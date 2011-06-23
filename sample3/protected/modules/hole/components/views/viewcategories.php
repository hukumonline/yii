<div class="boxArticle">
<h1><?= $this->title;?></h1>
<div style="padding-top:5px"></div>

<h2><a href="<?echo Yii::app()->baseUrl;?>/pages/tag/<?=$this->folderGuid;?>"><?php echo 'All'?></a></h2>
<div style="padding-top:15px"></div>
<?php
	$db = Yii::app()->db;
	foreach($catalogs as $catalog)
	{
		
?>
		<h2><a href="<?echo Yii::app()->baseUrl;?>/pages/tag/<?=$catalog['guid'];?>"><?php echo $catalog['title'];?></a></h2>
		<div style="padding-top:15px"></div>
		
<?php
	}
?>



</div>