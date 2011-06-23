<script type="text/javascript"> 

	jQuery(document).ready(function($) {
	  $('.my-list').easyListSplitter({ colNumber: 1 });
	//alert($('.my-list'));
	})

</script>
<style type="text/css">
	  
		
	.boxArticle ul,.boxArticle ol{list-style-type:none;background:url(images/dotted.gif) 0 0 repeat-x;width:200px;float:left;margin:0 10px 30px 0}
		.boxArticle li{width:200px;float:left;padding:0;list-style-type:none;}
		.boxArticle li a{padding:8px 20px 8px 0;width:180px;float:left;text-decoration:none;color:#294f88;}
		.boxArticle li a:hover{text-decoration:underline}
  </style>

<div class="boxArticle">
<?php if(!$this->showAltTitle) {?>
	<h1><?= $this->title;?></h1>
<?php } else {?>
	<div class="bigTitle"><?= $this->title;?></div>
<?php } ?>
<div style="padding-top:5px"></div>
<ul class="my-list">
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
		<li><h2><a href="<?echo Yii::app()->baseUrl;?>/pages/<?=$tmpGuid;?>"><?php echo $row['fixedTitle'];?></a></h2></li>
		
<?php
	}
?>
</ul>


</div>
