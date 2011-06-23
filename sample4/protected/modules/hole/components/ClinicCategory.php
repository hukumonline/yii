<?php
class ClinicCategory extends CWidget {
 
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
		print_r($sFolders);
		
		//$command=$db->createCommand("select * from KutuCatalog where guid in (select catalogGuid from KutuCatalogFolder where folderGuid='$folderGuid') order by createdDate desc limit $offset, $limit ");
		$query = "select KutuCatalog.* from KutuCatalog, KutuCatalogFolder where KutuCatalogFolder.folderGuid IN $sFolders 
				AND KutuCatalog.guid = KutuCatalogFolder.catalogGuid 
				order by KutuCatalog.publishedDate desc limit $offset, $limit";
		
		$command=$db->createCommand($query);
		
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		$this->_catalogFolder = $rows;
		
		/*
		echo '<pre>';
		print_r($rows);
		echo '</pre>';
		*/
	}
    public function run() {
		$this->render('latestclinicview', array('catalogs'=> $this->_catalogFolder));
    }	

}
?>