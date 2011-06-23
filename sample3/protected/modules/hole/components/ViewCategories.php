<?php
class ViewCategories extends CWidget {

	public $folderGuid = '';
	public $title = '';
	private $_categoryRows;
	
	public function init()
	{
		$db = Yii::app()->db;
		$folderGuid = $this->folderGuid;
		
		
		
		//$command=$db->createCommand("select * from KutuCatalog where guid in (select catalogGuid from KutuCatalogFolder where folderGuid='$folderGuid') order by createdDate desc limit $offset, $limit ");
		$query = "select * from KutuFolder where parentGuid='$folderGuid' AND guid !='$folderGuid' ";
		
		$command=$db->createCommand($query);
		
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		
		if(count($rows)==0 && $folderGuid!='lt47b42de36c8d3')
		{
			$query = "select * from KutuFolder where guid ='$folderGuid' ";

			$command=$db->createCommand($query);

			$dataReader=$command->query();
			$rows=$dataReader->readAll();
			//var_dump($rows);die;
			
			$this->folderGuid = $folderGuid = $rows[0]['parentGuid'];
			
			$query = "select * from KutuFolder where parentGuid='$folderGuid' AND guid !='$folderGuid' ";

			$command=$db->createCommand($query);

			$dataReader=$command->query();
			$rows=$dataReader->readAll();
		}
		
		$this->_categoryRows = $rows;
	}
    public function run() 
	{
		$this->render('viewcategories', array('catalogs'=> $this->_categoryRows));
    }
	
}