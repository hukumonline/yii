<?php
class ClinicController extends Controller
{
	public $mainPortlets = array();
	public $rightPortlets = array();
	public function actionIndex()
	{
		$this->layout='clinic';
		//var_dump(Yii::app()->cache);
		//die;
		
		// $this->portlets = array (
		// 				'hole.components.LatestCatalog'=>array('folderGuid' => 'fb7', 'offset'=>0, 'limit' => 2, 'title'=>'Columns1', 'showImage'=>1),
		// 				'hole.components.LatestCatalog'=>array('folderGuid' => 'fb7', 'offset'=>0, 'limit' => 2, 'title'=>'Columns2', 'showImage'=>1),
		// 				'hole.components.LatestCatalog'=>array('folderGuid' => 'fb7', 'offset'=>0, 'limit' => 2, 'title'=>'Columns3', 'showImage'=>1),
		// 			);
		
		$this->rightPortlets[0]['class'] = 'hole.components.LatestCatalog';
		$this->rightPortlets[0]['properties'] = array('folderGuid' => 'lt47b42de36c8d3', 'offset'=>0, 'limit' => 2, 'title'=>'Columns', 'showImage'=>1);
		$this->rightPortlets[1]['class'] = 'hole.components.LatestCatalog';
		$this->rightPortlets[1]['properties'] = array('folderGuid' => 'lt482be440ad745', 'offset'=>10, 'limit' => 2, 'title'=>'Clinic');	
		
		$this->mainPortlets[0]['class'] = 'hole.components.LatestCatalog';
		$this->mainPortlets[0]['properties'] = array('folderGuid' => 'fb17', 'offset'=>0, 'limit' => 3, 'title'=>'Indonesian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Legal Brief', 'showAltTitle'=>1);
		$this->mainPortlets[1]['class'] = 'hole.components.LatestCatalog';
		$this->mainPortlets[1]['properties'] = array('folderGuid' => 'fb17', 'offset'=>3,'limit' => 3, 'title'=>'Indonesian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Legal Digest', 'showAltTitle'=>1);	
		
		$this->render('index');
		//echo "test";
	}
}