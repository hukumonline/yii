<?php
class CatalogPager extends CWidget {
 
    public $folderGuid = '';
	public $title = '';
	public $showAltTitle = 0;
	public $showLongDescription = 0;
 
	public function init()
	{
		if(empty($this->folderGuid))
			die('Folder Guid is EMPTY');
		
		if(empty($this->title))
		{
			switch($this->folderGuid)
			{
				case 'ild':
					$this->title = 'Indonesian Legal Digest';
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
					$query = "Select title From KutuFolder where guid='$folderGuid'";

					$command=$db->createCommand($query);
					$this->title = $command->queryScalar();
					break;
			}
			
			
		}
	}
    public function run() 
	{	
		$folderGuid = $this->folderGuid;
		
		Yii::import('application.extensions.hole.cms.*');
		$cmsHelper = new HoleCmsHelper();
		$aFolders = $cmsHelper->getStringRelatedFolders($folderGuid);
		
		$db = Yii::app()->db;
		
		$totalCountQuery = "Select count(*) count From KutuCatalog,KutuCatalogFolder 
    			where KutuCatalog.guid=KutuCatalogFolder.catalogGuid AND KutuCatalogFolder.folderGuid IN $aFolders";

		$command=$db->createCommand($totalCountQuery);
		$totalCount=$command->queryScalar();
		
		$pagerInfo = new CPagination($totalCount);
		$offset = $pagerInfo->offset;
		$limit = $pagerInfo->limit;
		
		$query = "select KutuCatalog.* from KutuCatalog, KutuCatalogFolder where KutuCatalogFolder.folderGuid IN $aFolders 
				AND KutuCatalog.guid = KutuCatalogFolder.catalogGuid 
				order by KutuCatalog.publishedDate desc limit $offset, $limit";
		
		
		$command=$db->createCommand($query);
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		
		
		$this->render('catalogpager', array('pages'=>$pagerInfo, 'catalogs'=>$rows));
		
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