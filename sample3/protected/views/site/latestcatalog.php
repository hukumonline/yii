<?php
	$db = Yii::app()->db;
	foreach($catalogs as $catalog)
	{
		$tmpGuid = $catalog['guid'];
		$command=$db->createCommand("select t1.value title, t2.value subTitle, t3.value description, t4.value content from ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedTitle') as t1) LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedSubTitle') as t2) ON t1.catalogGuid=t2.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedDescription') as t3) ON t2.catalogGuid=t3.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedContent') as t4) ON t3.catalogGuid=t4.catalogGuid");
		$row=$command->queryRow();
		echo $row['title'];
		echo "<br>";
	}
?>