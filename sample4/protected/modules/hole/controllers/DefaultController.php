<?php

class DefaultController extends Controller
{
	public $mainPortlets = array();
	public $rightPortlets = array();
	public function actionIndex()
	{
		$this->layout='main3';
		//var_dump(Yii::app()->cache);
		//die;
		
		// $this->portlets = array (
		// 				'hole.components.LatestCatalog'=>array('folderGuid' => 'fb7', 'offset'=>0, 'limit' => 2, 'title'=>'Columns1', 'showImage'=>1),
		// 				'hole.components.LatestCatalog'=>array('folderGuid' => 'fb7', 'offset'=>0, 'limit' => 2, 'title'=>'Columns2', 'showImage'=>1),
		// 				'hole.components.LatestCatalog'=>array('folderGuid' => 'fb7', 'offset'=>0, 'limit' => 2, 'title'=>'Columns3', 'showImage'=>1),
		// 			);
		
		
		$this->rightPortlets[1]['class'] = 'hole.components.LatestCatalog';
		$this->rightPortlets[1]['properties'] = array('folderGuid' => 'lt47b42de36c8d3', 'offset'=>0, 'limit' => 2, 'title'=>'Opinion', 'showImage'=>1);
		$this->rightPortlets[0]['class'] = 'hole.components.LatestCatalog';
		$this->rightPortlets[0]['properties'] = array('folderGuid' => 'lt482be440ad745', 'offset'=>0, 'limit' => 2, 'title'=>'Clinic');
		
		$this->mainPortlets[0]['class'] = 'hole.components.LatestCatalog';
		$this->mainPortlets[0]['properties'] = array('folderGuid' => 'fb17', 'offset'=>0, 'limit' => 3, 'title'=>'Indonesian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Legal Brief', 'showAltTitle'=>1);
		$this->mainPortlets[1]['class'] = 'hole.components.LatestCatalog';
		$this->mainPortlets[1]['properties'] = array('folderGuid' => 'fb17', 'offset'=>3,'limit' => 3, 'title'=>'Indonesian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Legal Digest', 'showAltTitle'=>1);	
		
		$this->render('index');
	}
	public function actionIndex3()
	{
		$this->layout='main3';
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
		$this->rightPortlets[1]['properties'] = array('folderGuid' => 'lt481005fa41f52', 'offset'=>10, 'limit' => 3, 'title'=>'Clinic');	
		
		$this->mainPortlets[0]['class'] = 'hole.components.LatestCatalog';
		$this->mainPortlets[0]['properties'] = array('folderGuid' => 'fb17', 'offset'=>0, 'limit' => 3, 'title'=>'Indonesian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Legal Brief', 'showAltTitle'=>1);
		$this->mainPortlets[1]['class'] = 'hole.components.LatestCatalog';
		$this->mainPortlets[1]['properties'] = array('folderGuid' => 'fb17', 'offset'=>3,'limit' => 3, 'title'=>'Indonesian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Legal Digest', 'showAltTitle'=>1);	
		
		$this->render('index');
	}
	public function actionIndex4()
	{
		$this->layout='main4';
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
		$this->rightPortlets[1]['properties'] = array('folderGuid' => 'lt481005fa41f52', 'offset'=>10, 'limit' => 3, 'title'=>'Clinic');	
		
		$this->mainPortlets[0]['class'] = 'hole.components.LatestCatalog';
		$this->mainPortlets[0]['properties'] = array('folderGuid' => 'fb17', 'offset'=>0, 'limit' => 3, 'title'=>'Indonesian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Legal Brief', 'showAltTitle'=>1);
		$this->mainPortlets[1]['class'] = 'hole.components.LatestCatalog';
		$this->mainPortlets[1]['properties'] = array('folderGuid' => 'fb17', 'offset'=>3,'limit' => 3, 'title'=>'Indonesian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Legal Digest', 'showAltTitle'=>1);	
		
		$this->render('index');
	}
	public function actionIndex5()
	{
		$this->layout='main5';
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
		$this->rightPortlets[1]['properties'] = array('folderGuid' => 'lt481005fa41f52', 'offset'=>10, 'limit' => 3, 'title'=>'Clinic');	
		
		$this->mainPortlets[0]['class'] = 'hole.components.LatestCatalog';
		$this->mainPortlets[0]['properties'] = array('folderGuid' => 'fb17', 'offset'=>0, 'limit' => 3, 'title'=>'Indonesian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Legal Brief', 'showAltTitle'=>1);
		$this->mainPortlets[1]['class'] = 'hole.components.LatestCatalog';
		$this->mainPortlets[1]['properties'] = array('folderGuid' => 'fb17', 'offset'=>3,'limit' => 3, 'title'=>'Indonesian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Legal Digest', 'showAltTitle'=>1);	
		
		$this->render('index');
	}
	public function actionIndex6()
	{
		$this->layout='main6';
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
		$this->rightPortlets[1]['properties'] = array('folderGuid' => 'lt481005fa41f52', 'offset'=>0, 'limit' => 3, 'title'=>'Clinic');	
		
		$this->mainPortlets[0]['class'] = 'hole.components.LatestCatalog';
		$this->mainPortlets[0]['properties'] = array('folderGuid' => 'fb17', 'offset'=>0, 'limit' => 3, 'title'=>'Indonesian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Legal Brief', 'showAltTitle'=>1);
		$this->mainPortlets[1]['class'] = 'hole.components.LatestCatalog';
		$this->mainPortlets[1]['properties'] = array('folderGuid' => 'fb17', 'offset'=>3,'limit' => 3, 'title'=>'Indonesian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Legal Digest', 'showAltTitle'=>1);	
		
		$this->render('index');
	}
	public function actionList()
	{
		$this->layout='list3';
		
		if(isset($_GET['guid']))
			$guid = $_GET['guid'];
		else
			$guid = '';
		
		$this->render('list', array('guid'=>$guid));
		
	}
	public function actionDetails()
	{
		Yii::import('application.extensions.hole.cms.*');
		$cmsHelper = new HoleCmsHelper();
		
		switch ($cmsHelper->getCatalogProfile($_GET['guid'])) {
			case 'clinic':
				$this->layout='clinic';
				$this->render('details', array('guid'=>$_GET['guid']));
				break;
			
			default:
				$this->layout='detail3';
				$this->render('details', array('guid'=>$_GET['guid']));
				break;
		}
		
		
	}
	
	public function actionInfo()
	{
		if(isset($_GET['guid']))
			$guid = $_GET['guid'];
		
		Yii::import('application.extensions.hole.cms.*');
		$manager = new HoleCatalogManager();
		$row = $manager->getCatalogDetails($guid);
		
		if($this->_isAllowedToView($guid))
		{
			echo '<div class="boxDetailArticle" style="width:700px">';
				echo $row['fixedContent'];
			echo '</div>';
		}
		else
		{
			$db = Yii::app()->db;

			$query = "Select title From KutuCatalog, KutuProfile where KutuCatalog.guid='$guid' AND KutuCatalog.profileGuid=KutuProfile.guid";

			$command=$db->createCommand($query);
			$profile=$command->queryScalar();
			
			echo "Please Login or Upgrade Your Membership to access ". $profile.'.';
		}
		
		
		//$this->renderPartial('info');
	}
	public function actionStatic()
	{
		# code...
		$pageId = (isset($_GET['id'])) ? $_GET['id'] : '' ;
		
		$this->layout='detail3';
		switch ($pageId) {
			case 'contact':
				$this->render('contactstatic');
				break;
			case 'about':
				$this->render('staticabout');
				break;
			default:
				$this->render('static'.$pageId);
				break;
		}
		
		echo $pageId;
		//die;
	}
	
	public function actionFeed()
	{
		require_once 'Zend/Loader/Autoloader.php';
	    spl_autoload_unregister(array('YiiBase','autoload')); 
	    spl_autoload_register(array('Zend_Loader_Autoloader','autoload')); 
	    spl_autoload_register(array('YiiBase','autoload'));
	
		Yii::import('application.extensions.hole.cms.*');
		$cmsHelper = new HoleCmsHelper();
		
		//$folderGuid = ($_GET['id']): $_GET['id'] ? 'ilb';
		$folderGuid = $_GET['id'];
		$sFolders = $cmsHelper->getStringRelatedFolders($folderGuid);
		$offset = 0;
		$limit = 10;
		
		$db = Yii::app()->db;
		//$command=$db->createCommand("select * from KutuCatalog where guid in (select catalogGuid from KutuCatalogFolder where folderGuid='$folderGuid') order by createdDate desc limit $offset, $limit ");
		$query = "select KutuCatalog.* from KutuCatalog, KutuCatalogFolder where KutuCatalogFolder.folderGuid IN $sFolders 
				AND KutuCatalog.guid = KutuCatalogFolder.catalogGuid 
				order by KutuCatalog.publishedDate desc limit $offset, $limit";
		
		$command=$db->createCommand($query);
		
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		
		$catalogManager = new HoleCatalogManager();
		
		foreach($rows as $row)
		{
			$rowDetail = $catalogManager->getCatalogDetails($row['guid']);
			//echo $rowDetail['fixedTitle'].'<br>';
			
			$entries[]=array(
			            'title'=> $rowDetail['fixedTitle'],
			            'link'=>CHtml::encode($this->createAbsoluteUrl('default/details',array('guid'=>$row['guid']))),
			            'description'=>$this->_getSentences(2,$rowDetail['fixedContent']),
			            'lastUpdate'=>strtotime($row['publishedDate']),
			        );
		}
		//var_dump($entries);
		$feed=Zend_Feed::importArray(array(
		        'title'   => 'Hukumonline English RSS Feed',
		        'link'    => $this->createUrl(''),
		        'charset' => 'UTF-8',
		        'entries' => $entries,      
		    ), 'rss');
	    $feed->send();
		
		//echo 'test';
	}
	
	public function actionMoveCatalogAttribute()
	{
		echo 'test';
		
		$db = Yii::app()->db;
		
		$queryAllCatalog = 'select guid from KutuCatalog';
		$command=$db->createCommand($queryAllCatalog);
		//var_dump($command);die;
		$dataReader = $command->query();
		$rowSource = $dataReader->readAll();
		//var_dump($rowSource); die;
		
		$i = 0;
		foreach($rowSource as $source)
		{
			
			$catalogGuid = $source['guid'];
			
			$query = "select * from KutuCatalogAttribute where catalogGuid='$catalogGuid'";
			$command=$db->createCommand($query);
			//var_dump($command);die;
			$dataReader=$command->query();
			$rows=$dataReader->readAll();
		
		
			$aRowFinal = array();
			foreach($rows as $attribute)
			{
				$aRowFinal[$attribute['attributeGuid']] = $attribute['value'];
			}
			
			echo $i++ . '<br>';
			//var_dump($aRowFinal['fixedTitle']);
			
			$catalog = KutuCatalogTest::model()->findByPk($catalogGuid);
			//var_dump($catalog);
			$catalog->content = serialize($aRowFinal);
			$catalog->save();
			
		}
	}
	public function actionExportCatalogAttributeToFile()
	{
		echo 'test';
		
		$db = Yii::app()->db;
		
		$queryAllCatalog = 'select guid from KutuCatalog';
		$command=$db->createCommand($queryAllCatalog);
		//var_dump($command);die;
		$dataReader = $command->query();
		$rowSource = $dataReader->readAll();
		//var_dump($rowSource); die;
		
		$i = 0;
		foreach($rowSource as $source)
		{
			
			$catalogGuid = $source['guid'];
			
			$query = "select * from KutuCatalogAttribute where catalogGuid='$catalogGuid'";
			$command=$db->createCommand($query);
			//var_dump($command);die;
			$dataReader=$command->query();
			$rows=$dataReader->readAll();
		
		
			$aRowFinal = array();
			foreach($rows as $attribute)
			{
				$aRowFinal[$attribute['attributeGuid']] = $attribute['value'];
			}
			
			echo $i++ . '<br>';
			//var_dump($aRowFinal['fixedTitle']);
			
			$serializedRow = serialize($aRowFinal);
			file_put_contents(Yii::app()->basePath . '/data/row/'.$catalogGuid.'.row', $serializedRow);
			// if($i == 3)
			// 				die('ihii'); 
			
		}
	}
	private function _isAllowedToView($catalogGuid)
	{
		Yii::import('application.extensions.hole.acl.*');
		$aclHelper = new CHoleAclHelper();
		
		$db = Yii::app()->db;
		$query = "select profileGuid from KutuCatalog where guid='$catalogGuid'";
		
		$command=$db->createCommand($query);
		//var_dump($command);die;
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		
		if(count($rows)>0)
		{
			/*switch ($rows[0]['profileGuid'])
			{
				case 'ilb':
				case 'ild':
					return $aclHelper->isAllowedToView($rows[0]['profileGuid']);
				default:
					return true;
			}*/
			return $aclHelper->isAllowedToView($rows[0]['profileGuid']);
			
		}
		
		return false;
		
	}
	
	public function filters1()
	{
	    return array(
	        array(
	            'COutputCache',
	            'duration'=>100,
	            'varyByParam'=>array('id'),
	        ),
	    );
	}
	private function _getSentences($sentence_num = 1, $content) {
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
	
	public function actionLogin()
	{
		//session_id("");
//		setcookie ("PHPSESSID", "", time() - 3600,"/");
//		session_start();
//		session_unset();
//		session_destroy();
//		$_SESSION = array();
		
		//header("Location: http://en2.hukumonline.com/app/services/session/synclogin.php?returnTo=aHR0cDovL2VuLmh1a3Vtb25saW5lLmNvbQ==");
		//returnTo = "http://mygoogleconnect.tld/yii/sample4/"
//		header("Location: http://hukumonline.b1/app/services/session/synclogin.php?returnTo=aHR0cDovL215Z29vZ2xlY29ubmVjdC50bGQveWlpL3NhbXBsZTQv");
		Yii::import('application.extensions.hole.auth.*');
		$sso = new CAuthRemote();
		
		$user = $sso->getInfo();
		if ($user) $this->redirect(Yii::app()->user->returnUrl);
		
		$this->layout='login';
		
		$db = Yii::app()->pg;
		$query = "SELECT * FROM KutuCatalog WHERE shortTitle='halaman-depan-login' AND status=99";
		$command = $db->createCommand($query);
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		
		
		$this->render('login', array('rows' => $rows, 'sso' => $sso));
	}
	public function actionLogout()
	{
		Yii::import('application.extensions.hole.auth.*');
		$sso = new CAuthRemote();
		$sso->logout();
		$this->redirect(Yii::app()->user->returnUrl);
	}
}