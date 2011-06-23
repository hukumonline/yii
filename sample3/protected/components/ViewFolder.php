<?php
class ViewFolder extends CWidget 
{
 
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
		//$viewPath = $this->controller->viewPath."/latestcatalog.php";
		//die($viewPath);
        //$this->render('latestcatalog', array('catalogs'=> $this->_catalogFolder));
		//$this->renderFile($viewPath, array('catalogs'=> $this->_catalogFolder, 'title'=>$this->title));
		$folderGuid = 'root';
    	
    	$parentGuid = $folderGuid;
        
        
        $columns = 3;
        
        $rowsetFolder = $this->fetchChildren($parentGuid);
		
		$num_rows = count($rowsetFolder);
		$rows = ceil($num_rows / $columns);
		
		if($num_rows < 3)
			$columns = $num_rows;
		if($num_rows==0)
		{
			//echo 'No folder(s) found';
		}
		
		$kucrut = 0;
		$data = array();
		foreach ($rowsetFolder as $rowFolder)
		//for($kucrut=0;$kucrut<$num_rows;$kucrut++)
		{
			//$rowFolder = $rowsetFolder[$kucrut];
			
			$data[$kucrut][0] = $rowFolder['title'];
			
			$data[$kucrut][1] = $rowFolder['description']; 
			$data[$kucrut][2] = $rowFolder['guid']; 
			
			$data[$kucrut][3] = ''; 
			$kucrut++;
			
		}
		
		// $this->view->rows = $rows;
		// 		$this->view->columns = $columns;
		// 		$this->view->data = $data;
		// 		$this->view->numberOfFolders = $num_rows;
		// 		$this->view->node = $parentGuid;
		
		$this->render('viewfolder', array('rows'=>$rows,'columns'=>$columns,'data'=>$data,'numberOfFolders'=>$num_rows,'node'=>$parentGuid));
    }

	public function fetchChildren($parentGuid)
    {
		$db = Yii::app()->db;
		
    	if($parentGuid == 'root')
    	{
			$query = "select * from KutuFolder where parentGuid=guid order by title ASC";
			$command=$db->createCommand($query);
			$dataReader=$command->query();
			$rows=$dataReader->readAll();
			
    		return $rows;
    	}
    	else 
    	{
			$query = "select * from KutuFolder where parentGuid='$parentGuid' AND NOT parentGuid=guid order by title ASC";
			$command=$db->createCommand($query);
			$dataReader=$command->query();
			$rows=$dataReader->readAll();
			
    		return $rows;
			//return $this->fetchAll("parentGuid = '$parentGuid' AND NOT parentGuid=guid",'title ASC');
    	}
    }
	function viewFolderKu($node)
	{
		
	}
 
}
?>