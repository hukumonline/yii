<?php
class MPCatalogManager extends CApplicationComponent
{
	public $aConfig = array();
	
	public $model;
	
	public function __construct()
	{
		$mongoDb = Yii::app()->getComponent('mongoDb');
		$this->model = $mongoDb->getCollection('Content');
	}
	
	public function init()
	{
		
	}
	public function updateCatalog($doc)
	{
		//$doc = $this->_validateUserData($aData);
		
		if(empty($doc['_id']))
			$doc['_id'] = (string)(new MongoId());
		
		try {
		    //$this->userModel->insert($doc, true);
			$this->model->update(array("_id" => $doc['_id']), $doc, array("upsert" => true));
		}
		catch(MongoCursorException $e) {
		    return false;
		}
		
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
			$return = $return[0];
		}
		
		return $return;
	}
	public function insertCatalog($doc)
	{
		// let's use MongoDb.
		
		//always set new _id
		$doc['_id'] = (string)(new MongoId());
		
		//must have profileId
		if(empty($doc['profileId']))
		{
			throw new CException('Field: profileId cannot be EMPTY.');
		}
		
		//must have folders
		if(empty($doc['folders']))
		{
			throw new CException('Field: folders cannot be EMPTY.');
		}
		
		// folders must be array -> $doc['folders'] = array('a','b','c')
		if(!is_array($doc['folders']))
			throw new CException('Field: folders must be array.');
		
		// must have title
		if(empty($doc['title']))
		{
			throw new CException('Field: title cannot be EMPTY.');
		}
		
		// generate shortTitle
		$doc['shortTitle'] = $this->_generateShortTitle($doc['title']);
		
		//set default values
		
		//[TODO] createdBy and modifiedBy should be filled with username yang login
		$doc['createdBy'] = "admin";
		$doc['modifiedBy'] = "admin";
		
		//change all dates to mongoDbDate
		$now = date('Y-m-d');
		$doc['dateCreated'] = new MongoDate();
		$doc['dateModified'] = $doc['dateCreated'];
		
		$doc['datePublished'] = new MongoDate(strtotime($doc['datePublished']));
		
		
		try {
		    //$this->userModel->insert($doc, true);
			$this->model->update(array("_id" => $doc['_id']), $doc, array("upsert" => true));
		}
		catch(MongoCursorException $e) {
		    return false;
		}
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
	private function _generateShortTitle($title)
	{
		
		$count = $this->model->count(array('title'=>$title));
		
		//remove space to -
		$title = strtolower($title);
		$title = str_replace(array(',','"',"'"),'',$title);
		$title = str_replace(array(' '),'-',$title);
		
		if($count>0)
			$title .= '-'.$count;
		return $title;
	}
}
?>