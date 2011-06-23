<?php
class LatestCatalog extends CWidget {
 
    public $folderGuid = '';
    public $offset = 0;
	public $limit = 5;
	public $title = '';
	public $showAltTitle = 0;
	public $showLongDescription = 0;
	public $showImage = 0;
	
	private $_catalogFolder = "";
 
	public function init()
	{
		$db = Yii::app()->db;
		$folderGuid = $this->folderGuid;
		$offset = $this->offset;
		$limit = $this->limit;
		
		Yii::import('application.extensions.hole.cms.*');
		$cmsHelper = new HoleCmsHelper();
		$sFolders = $cmsHelper->getStringRelatedFolders($folderGuid);
		
		
		//$command=$db->createCommand("select * from KutuCatalog where guid in (select catalogGuid from KutuCatalogFolder where folderGuid='$folderGuid') order by createdDate desc limit $offset, $limit ");
		$query = "select KutuCatalog.* from KutuCatalog, KutuCatalogFolder where KutuCatalogFolder.folderGuid IN $sFolders 
				AND KutuCatalog.guid = KutuCatalogFolder.catalogGuid 
				order by KutuCatalog.publishedDate desc limit $offset, $limit";
		
		$command=$db->createCommand($query);
		
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		$this->_catalogFolder = $rows;
	}
    public function run() {
		//$viewPath = $this->controller->viewPath."/latestcatalog.php";
		//die($viewPath);
		if(!$this->showImage)
        	$this->render('latestcatalogview', array('catalogs'=> $this->_catalogFolder));
		else
			$this->render('latestcolumnview', array('catalogs'=> $this->_catalogFolder));
		//$this->renderFile($viewPath, array('catalogs'=> $this->_catalogFolder, 'title'=>$this->title));
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