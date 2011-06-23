<?php
Yii::import('application.extensions.mp.*'); 

class HoleCatalogManager extends MPCatalogManager
{
	public function __construct()
	{
		
	}
	public function init()
	{
		//Yii::import('application.extensions.langit.identity.riidentity.*');
		//$this->_userIdentity = new RIUserIdentity();
	}
	public function getCatalogInFolder($folderGuid, $offset=0, $limit=5)
	{
		$query = 
			"	SELECT DISTINCT KutuCatalog.*
				FROM KutuCatalog, KutuCatalogFolder, KutuFolder
				WHERE KutuCatalog.guid=KutuCatalogFolder.catalogGuid 
				AND KutuCatalogFolder.folderGuid=KutuFolder.guid
				AND ( KutuFolder.path LIKE '%$folderGuid%' OR KutuFolder.guid='$folderGuid') " . 
				" order by KutuCatalog.publishedDate desc limit $offset, $limit";
				
		$db = Yii::app()->db;
		$command=$db->createCommand($query);
		
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		
		return $rows;
	}
	public function getCatalogDetails($catalogGuid)
	{
		if(file_exists(MP_CATALOG_STORAGE_PATH.'/'.$catalogGuid.'.row'))
		{
			$fileContent = file_get_contents(MP_CATALOG_STORAGE_PATH.'/'.$catalogGuid.'.row');
			$return = unserialize($fileContent);
		}
		else
		{
			//die('no file');
			$db = Yii::app()->db;
			$tmpGuid = $catalogGuid;
			$command=$db->createCommand("select t1.value fixedTitle, t2.value fixedSubTitle, t3.value fixedDescription, t4.value fixedContent from ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedTitle') as t1) LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedSubTitle') as t2) ON t1.catalogGuid=t2.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedDescription') as t3) ON t2.catalogGuid=t3.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedContent') as t4) ON t3.catalogGuid=t4.catalogGuid");
			$dataReader=$command->query();
			$return=$dataReader->readAll();
			
			if(!isset($return[0]))
			{
				return array('fixedTitle'=>'No Title', 'fixedContent'=>'No Content');
			}
			$return = $return[0];
		}
		
		return $return;
	}
	public function getClinicDetails($catalogGuid)
	{
		if(file_exists(MP_CATALOG_STORAGE_PATH.'/'.$catalogGuid.'.row'))
		{
			$fileContent = file_get_contents(MP_CATALOG_STORAGE_PATH.'/'.$catalogGuid.'.row');
			$return = unserialize($fileContent);
		}
		else
		{
			//die('no file');
			$db = Yii::app()->db;
			$tmpGuid = $catalogGuid;
			$command=$db->createCommand("select t1.value fixedTitle, t2.value fixedQuestion, t3.value fixedSelect, t4.value fixedSelectNama, t5.value fixedContent from ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedTitle') as t1) LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedQuestion') as t2) ON t1.catalogGuid=t2.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedSelect') as t3) ON t2.catalogGuid=t3.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedSelectNama') as t4) ON t3.catalogGuid=t4.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedContent') as t5) ON t4.catalogGuid=t5.catalogGuid");
			$dataReader=$command->query();
			$return=$dataReader->readAll();
			
			if(!isset($return[0]))
			{
				return array('fixedTitle'=>'No Title', 'fixedQuestion'=>'No Content');
			}
			$return = $return[0];
		}
		
		return $return;
	}
	public function insertCatalog($aAttributes)
	{
		// let's use MongoDb.
		
		$mongoDb = Yii::app()->getComponent('mongoDb');
		$contentCollection = $mongodb->getCollection('content');
		$createdDate = new MongoDate(strtotime($catalog->createdDate));
		$doc = array( 
			"guid" => $catalog->guid,
			"shortTitle" => $catalog->shortTitle,
			"profileGuid" => $catalog->profileGuid,
			'createdDate' => $createdDate,
			'createdDateMySql' => $catalog->createdDate
		);
	}
	function getSentences($sentence_num = 1, $content) {
		if ($sentence_num == 0) {
			return false;
		}
		if ($sentence_num >= 1) {
			$sentence_num = $sentence_num-1;
		}
		//$content = strip_tags($content);
		//$content = apply_filters('the_content', $content);
		$content = strip_tags($content);
		$pos = strpos($content, '.');
		for($i=1; $i<=$sentence_num; $i++) {
			$pos = strpos($content, '.', $pos+1);
		}
		return substr($content,0,$pos+1) ;
	}
}

?>