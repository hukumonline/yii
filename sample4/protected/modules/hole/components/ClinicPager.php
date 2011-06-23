<?php
class ClinicPager extends CWidget {
 
    public $folderGuid = '';
	public $title = '';
	public $showAltTitle = 0;
	public $showLongDescription = 0;
	
	private $_countQuery;
	private $_catalogQuery;
	private $_pagerInfo;
 
	public function init()
	{
		$db = Yii::app()->db;
		
		if(empty($this->folderGuid))
		{
			$this->folderGuid='lt482be440ad745';
			$folderGuid = $this->folderGuid;
			$this->_countQuery = 
				"	SELECT count(DISTINCT KutuCatalog.guid) as count
					FROM KutuCatalog, KutuCatalogFolder, KutuFolder
					WHERE KutuCatalog.guid=KutuCatalogFolder.catalogGuid 
					AND KutuCatalogFolder.folderGuid=KutuFolder.guid
					AND ( KutuFolder.path LIKE '%$folderGuid%' OR KutuFolder.guid='$folderGuid') ";
				
			$totalCountQuery = $this->_countQuery;

			$command=$db->createCommand($totalCountQuery);
			$totalCount=$command->queryScalar();
			//die $totalCount;

			$pagerInfo = new CPagination($totalCount);
			$offset = $pagerInfo->offset;
			$limit = $pagerInfo->limit;
			$this->_pagerInfo = $pagerInfo;
					
			$this->_catalogQuery = 
				"	SELECT DISTINCT KutuCatalog.*
					FROM KutuCatalog, KutuCatalogFolder, KutuFolder
					WHERE KutuCatalog.guid=KutuCatalogFolder.catalogGuid 
					AND KutuCatalogFolder.folderGuid=KutuFolder.guid
					AND ( KutuFolder.path LIKE '%$folderGuid%' OR KutuFolder.guid='$folderGuid') " . 
					" order by KutuCatalog.createdDate desc limit $offset, $limit";
		}
		else
		{
			$folderGuid = $this->folderGuid;
			$this->_countQuery = 
				"	SELECT count(DISTINCT KutuCatalogAttribute.catalogGuid) as count
					FROM KutuCatalogAttribute 
					WHERE KutuCatalogAttribute.value like '%$folderGuid%'";
				
			$totalCountQuery = $this->_countQuery;

			$command=$db->createCommand($totalCountQuery);
			$totalCount=$command->queryScalar();
			//die ($totalCount);

			$pagerInfo = new CPagination($totalCount);
			$offset = $pagerInfo->offset;
			$limit = $pagerInfo->limit;
			$this->_pagerInfo = $pagerInfo;
					
			$this->_catalogQuery = 
				"	SELECT DISTINCT KutuCatalog.*
					FROM KutuCatalog, KutuCatalogAttribute 
					WHERE KutuCatalog.guid=KutuCatalogAttribute.catalogGuid 
					AND KutuCatalogAttribute.value = '$folderGuid' " . 
					" order by KutuCatalog.createdDate desc limit $offset, $limit";
		}
		
		if(empty($this->title))
		{
			switch($this->folderGuid)
			{
				case 'lt482be440ad745':
					$this->title = 'Clinic';
					break;
				case 'ilb':
					$this->title = 'Indonesian Legal Brief';
					break;
				case 'news':
					$this->title = 'Indonesian Legal News';
					break;
				case 'article':
				case 'column':
				case 'columns':
					$this->title = 'Columns';
					break;
				default:
					$db = Yii::app()->db;
					$folderGuid = $this->folderGuid;
					$query = "Select value From KutuCatalogAttribute where KutuCatalogAttribute.attributeGuid='fixedTitle' and KutuCatalogAttribute.catalogGuid='$folderGuid'";

					$command=$db->createCommand($query);
					$this->title = $command->queryScalar();
					break;
			}
			
			
		}
	}
    public function run() 
	{	
		$folderGuid = $this->folderGuid;
		
		/*Yii::import('application.extensions.hole.cms.*');
		$cmsHelper = new HoleCmsHelper();
		$aFolders = $cmsHelper->getStringRelatedFolders($folderGuid);*/
		
		$db = Yii::app()->db;
		
				
		$query = $this->_catalogQuery;
		
		
		$command=$db->createCommand($query);
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		//var_dump($rows);die;
		
		
		$this->render('clinicpager', array('pages'=>$this->_pagerInfo, 'catalogs'=>$rows));
		
    }

	public function getNumberOfWords($sSentences, $iNumberOfWords)
	{
		$sReturn = strip_tags($sSentences);
		
		$arr = preg_split("/[\s]+/", $sReturn,$iNumberOfWords+1);
		$arr = array_slice($arr,0,$iNumberOfWords);
		return join(' ',$arr);
	
	}
 	public function firstSentence($content) {

	    $content = (strip_tags($content));
	    $pos = strpos($content, '.');

	    if($pos === false) {
			$pos = strpos($content, '?');
			return substr($content, 0, $pos+1);
	        //return $content;
	    }
	    else {
	        return substr($content, 0, $pos+1);
	    }

	}
	function trim_text_in_sentences($intLength, $strText) {
		$strText = strip_tags($strText);
	    $intLastPeriodPos = strpos(strrev(substr($strText, 0, $intLength)), '.');
	    if ($intLastPeriodPos === false) {
	        $strReturn = substr($strText, 0, $intLength);
	    } else {
	        $strReturn = substr($strText, 0, ($intLength - $intLastPeriodPos));
	    }
	    return $strReturn;
	}
	
	function the_nth_sentence($sentence_num = 1, $content) {
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