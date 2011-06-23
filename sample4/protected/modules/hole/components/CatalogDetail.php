<?php
class CatalogDetail extends CWidget {
 
    public $guid = '';
	public $title = '';
	public $showAltTitle = 0;
	public $showLongDescription = 0;
	
	private $_catalog;
 
	public function init()
	{
		if(empty($this->guid))
			die('Catalog Guid is EMPTY');
	}
    public function run() 
	{	
		$db = Yii::app()->db;
		
		$query = "select KutuCatalog.* from KutuCatalog where guid='$this->guid'";
		
		//$query = "select KutuCatalog.* from KutuCatalog order by KutuCatalog.createdDate desc limit $offset, $limit";
		
		$command=$db->createCommand($query);
		//var_dump($command);die;
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		
		$rowCatalog = array();
		
		
		//die($rowCatalog['catalog']['profileGuid']);
		switch ($rows[0]['profileGuid']) {
			case 'clinic':
				if(count($rows)>0)
				{

					$rowCatalog['catalog'] = $rows[0];
					$rowCatalog['attribute'] = $this->getClinicDetails($this->guid);
				}

				$this->_catalog = $rowCatalog;

				Yii::app()->clientScript->registerMetaTag($rowCatalog['attribute']['fixedTitle'], 'title');
				Yii::app()->clientScript->registerMetaTag($this->getSentence(2,$rowCatalog['attribute']['fixedQuestion']), 'description');

				$this->owner->pageTitle = Yii::app()->name.' | '.$rowCatalog['attribute']['fixedTitle'];

				$aFiles = $this->getRelatedFiles();
				
				$this->render('clinicdetail', array('catalog'=>$rowCatalog, 'files'=>$aFiles));
				break;
			
			default:
				if(count($rows)>0)
				{

					$rowCatalog['catalog'] = $rows[0];
					$rowCatalog['attribute'] = $this->getCatalogDetails($this->guid);
				}

				$this->_catalog = $rowCatalog;

				Yii::app()->clientScript->registerMetaTag($rowCatalog['attribute']['fixedTitle'], 'title');
				Yii::app()->clientScript->registerMetaTag($this->getSentence(2,$rowCatalog['attribute']['fixedContent']), 'description');

				$this->owner->pageTitle = Yii::app()->name.' | '.$rowCatalog['attribute']['fixedTitle'];

				$aFiles = $this->getRelatedFiles();
				$this->render('catalogdetail', array('catalog'=>$rowCatalog, 'files'=>$aFiles));
				break;
		}
		
		
    }

	public function getCatalogDetails($catalogGuid)
	{
		//die('no file');
		/*$db = Yii::app()->db;
		$tmpGuid = $catalogGuid;
		$command=$db->createCommand("select t1.value fixedTitle, t2.value fixedSubTitle, t3.value fixedDescription, t4.value fixedContent from ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedTitle') as t1) LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedSubTitle') as t2) ON t1.catalogGuid=t2.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedDescription') as t3) ON t2.catalogGuid=t3.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedContent') as t4) ON t3.catalogGuid=t4.catalogGuid");
		$dataReader=$command->query();
		$return=$dataReader->readAll();
		$return = $return[0];*/

		Yii::import('application.extensions.hole.cms.*'); 
		$catalogManager = new HoleCatalogManager();
		$row = $catalogManager->getCatalogDetails($catalogGuid);
		
		return $row;
	}
	public function getClinicDetails($catalogGuid)
	{
		Yii::import('application.extensions.hole.cms.*'); 
		$catalogManager = new HoleCatalogManager();
		$row = $catalogManager->getClinicDetails($catalogGuid);
		
		return $row;
	}
	public function isAllowedToView()
	{
		Yii::import('application.extensions.hole.acl.*');
		$aclHelper = new CHoleAclHelper();
		
		if(!empty($this->_catalog))
		{
			if(!empty($this->_catalog['catalog']['profileGuid']))
			{
				/*switch ($this->_catalog['catalog']['profileGuid'])
				{
					case 'ilb':
					case 'ild':
						return $aclHelper->isAllowedToView($this->_catalog['catalog']['profileGuid']);
					default:
						//return true;
				}*/
				return $aclHelper->isAllowedToView($this->_catalog['catalog']['profileGuid']);
			}
		}
		
		return false;
		
	}
	function getSentence($sentence_num = 1, $content) {
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
	function getRelatedFiles()
	{
		$db = Yii::app()->db;
		
		$query = "select KutuRelatedItem.* from KutuRelatedItem where relatedGuid='$this->guid' AND relateAs='RELATED_FILE'";
		
		//$query = "select KutuCatalog.* from KutuCatalog order by KutuCatalog.createdDate desc limit $offset, $limit";
		
		$command=$db->createCommand($query);
		//var_dump($command);die;
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		
		return $rows;
	}

}
?>