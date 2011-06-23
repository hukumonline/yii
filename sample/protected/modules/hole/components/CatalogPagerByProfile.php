<?php
class CatalogPagerByProfile extends CWidget {
 
    public $profileGuid = '';
	public $title = '';
	public $showAltTitle = 0;
	public $showLongDescription = 0;
 
	public function init()
	{
		if(empty($this->profileGuid))
			die('Profile Guid is EMPTY');
		
		if(empty($this->title))
		{
			$db = Yii::app()->db;
			$profileGuid = $this->profileGuid;
			$query = "Select title From KutuProfile where guid='$profileGuid'";

			$command=$db->createCommand($query);
			$this->title = $command->queryScalar();
		}
	}
    public function run() 
	{	
		$db = Yii::app()->db;
		$profileGuid = $this->profileGuid;
		$totalCountQuery = "Select count(*) count From KutuCatalog 
    			where KutuCatalog.profileGuid='$profileGuid'";

		$command=$db->createCommand($totalCountQuery);
		$totalCount=$command->queryScalar();
		
		
		
		$pagerInfo = new CPagination($totalCount);
		//echo $pagerInfo->currentPage ;
		//echo '<br>'.$pagerInfo->offset;
		//var_dump($pagerInfo);die;
		$offset = $pagerInfo->offset;
		$limit = $pagerInfo->limit;
		
		$query = "select KutuCatalog.* from KutuCatalog where KutuCatalog.profileGuid='$profileGuid' 
				order by KutuCatalog.createdDate desc limit $offset, $limit";
		
		//$query = "select KutuCatalog.* from KutuCatalog order by KutuCatalog.createdDate desc limit $offset, $limit";
		
		$command=$db->createCommand($query);
		//var_dump($command);die;
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