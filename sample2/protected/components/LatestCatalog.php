<?php
class LatestCatalog extends CWidget {
 
    public $folderGuid = '';
    public $offset = 0;
	public $limit = 5;
	public $title = '';
	
	private $_catalogFolder = "";
 
	public function init()
	{
		$db = Yii::app()->db;
		$folderGuid = $this->folderGuid;
		$offset = $this->offset;
		$limit = $this->limit;
		$command=$db->createCommand("select * from KutuCatalog where guid in (select catalogGuid from KutuCatalogFolder where folderGuid='$folderGuid') order by createdDate desc limit $offset, $limit ");
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		$this->_catalogFolder = $rows;
	}
    public function run() {
		$viewPath = $this->controller->viewPath."/latestcatalog.php";
		//die($viewPath);
        //$this->render('latestcatalog', array('catalogs'=> $this->_catalogFolder));
		$this->renderFile($viewPath, array('catalogs'=> $this->_catalogFolder, 'title'=>$this->title));
    }
 
}
?>