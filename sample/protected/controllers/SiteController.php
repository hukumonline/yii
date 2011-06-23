<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndexORI()
	{
		$criteria=new CDbCriteria(array(
		        'condition'=>"profileGuid='article'",
		        'order'=>'createdDate DESC',
				'limit'=>5,
		        //'with'=>'commentCount',
		    ));
		
		/*$models = KutuCatalogTest::model()->findAll($criteria);
		foreach($models as $row)
			echo $row->title."<br>";
		$tmpData = new CDataProvider();
		$tmpData->data = $models;*/
		
		// $dataProvider=new CActiveDataProvider('KutuCatalogTest', array(
		// 	        'pagination'=>array(
		// 	            //'pageSize'=>Yii::app()->params['postsPerPage'],
		// 				'pageSize'=>2,
		// 	        ),
		// 	        'criteria'=>$criteria,
		// 	    ));
		$dataProvider=new CActiveDataProvider('KutuCatalogTest', array(
							'criteria'=>$criteria,
							'pagination'=> false,
							));
						
		$criteria=new CDbCriteria(array(
	        'condition'=>"profileGuid='article'",
	        'order'=>'createdDate DESC',
			'offset'=>6,
			'limit'=>5,
	        //'with'=>'commentCount',
	    ));
		$dataProvider2=new CActiveDataProvider('KutuCatalogTest', array(
							'criteria'=>$criteria,
							'pagination'=> false,
							));
		
		
		
		
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index', array(
		        		'dataProvider'=>$dataProvider,
						'dataProvider2'=>$dataProvider2
					)
				);
	}
	
	public function actionIndex()
	{
		//$this->forward('hole/default');
		//$this->layout = "main2";
		//Yii::app()->user->loginRequired();
		
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		//$this->layout = "main2";
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->renderPartial('error', $error);
	    }
	}
	public function actionMongodb()
	{
		//$catalog = KutuCatalog::model()->findByPk(4);
		//echo $catalog->shortTitle;
		//$this->_insertIntoMongoDb();
		//$this->_mongoTestInsertFolder();
		
		// Connect to localhost on the default port.
		$con = new Mongo();

		// Get a handle on the myCollection collection,
		// which is in the 'test' database.
		//$myCollection = $con->test->content;
		
		$mongodb = Yii::app()->getComponent('mongoDb');
		$myCollection = $mongodb->getCollection('content');

		// Find everything in our collection:
		$results = $myCollection->find(array('profileGuid'=>'article'))->sort(array('createdDate'=>1));
		//$results = $myCollection->find(array('folders'=>'15'))->sort(array('createdDate'=>1));
		//$results = $myCollection->find();
		$results->limit(10)->skip(370);

		// Loop through all results
		foreach ($results as $document) {

		  // Attributes of a document come back in an array.
		//var_dump($document);
		  $test = $document['fixedTitle'];
			//if(isset($document['fixedContent']))
				//echo $document['fixedContent'];

		  // Technically, _id is a MongoId object. It can 
		  // be automatically converted to a string, though.
		  $id = $document['_id'];

		  // Print out the values.
		  //printf("Test Value: %d, ID Value: %s\n <br>", $test, $id);
		echo $test.'<br>';

		  // You can also extract the timestamp that this 
		  // object was created, since timestamp is encoded in 
		  // the id:
		  //$createdOn = $id->getTimestamp();
		  //$prettyDate = date('r', $createdOn);

		  //printf("Created on %s.\n", $prettyDate);
		}
		
		$results = $myCollection->find(array('folders'=>'15'))->sort(array('createdDate'=>1));
		//$results = $myCollection->find();
		$results->limit(10)->skip(52);

		// Loop through all results
		foreach ($results as $document) {

		  $test = $document['fixedTitle'];
			
		  $id = $document['_id'];

		echo $test.'<br>';

		}
		$results = $myCollection->find(array('folders'=>'12'))->sort(array('createdDate'=>1));
		//$results = $myCollection->find();
		$results->limit(10)->skip(2);

		// Loop through all results
		foreach ($results as $document) {

		  $test = $document['fixedTitle'];
			
		  $id = $document['_id'];

		echo $test.'<br>';

		}
		echo "<br>&nbsp;<br>";
		
		//$myCollection = $con->test->content;
		$user = $con->test->myCollection->findOne(array("name"=>"himawan"));
		$idku = $user["_id"];
		//$tmpUser = $user->current();
		//$aUserId = array();
		//var_dump($user);
		
		//$post = $con->test->testPost->findOne(array("user"=>array('$in'=>array(array('$ref'=>'myCollection','$id'=>$idku)))));
		//$post = $con->test->testPost->findOne();
		
		$jsCode1 = 
			"function() {
				return db.myCollection.find();
			} ";
		
		$jsCode1 = 
			"
				print( tojson(db.myCollection.find()) );
			 ";
		$jsCode = 
			"
				function () {
						var a = db.myCollection.findOne({'name':'himawan'});
						//print(tojson(a));
						//var z = a[0];
						//return a._id;
						
						var b = db.testPost.findOne();
						//return b.user.\$id;
						
						try{
							return this.user.\$id == a._id;	
							//return true;
						}
						catch(err) {
							return false;
						}
					} 
				//return test();
					
			";
		
		$jsCode1 = 
			"
				function test () {
						var a = db.myCollection.find();
						return false;
					} 
				return test();

			";
		
		/*$mongoCode = new MongoCode($jsCode);
		
		$response = $con->test->execute($mongoCode);
		//$tmp = $response['retval'];
		var_dump($response);
		
		$posts = $con->test->testPost->find(array('$where'=>$mongoCode));
		foreach($posts as $post)
			var_dump($post);*/
		$mongodb = Yii::app()->getComponent('mongoDb');
		$myCollection = $mongodb->getCollection('test');
		
		$this->render('mongodb');
	}
	private function _insertIntoMongoDb()
	{
		//$catalogs = KutuCatalog::model()->findAll();
		//echo count($catalogs);
		$db = Yii::app()->db;
		$command=$db->createCommand("select guid from KutuCatalog");
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		$totalCatalog = count($rows);
		
		//insert into mongodb
		$con = new Mongo();

		
		
		
		for($i=0;$i<$totalCatalog;$i++)
		{
			$catalog = KutuCatalog::model()->findByPk($rows[$i]['guid']);
			echo "($i)".$catalog->shortTitle."<br>";
			
			// Get a handle on the myCollection collection,
			// which is in the 'test' database.
			$contentCollection = $con->test->content;
			$createdDate = new MongoDate(strtotime($catalog->createdDate));
			$doc = array( 
				"guid" => $catalog->guid,
				"shortTitle" => $catalog->shortTitle,
				"profileGuid" => $catalog->profileGuid,
				'createdDate' => $createdDate,
				'createdDateMySql' => $catalog->createdDate
			);
			
			
			
			$command=$db->createCommand("select * from KutuCatalogAttribute where catalogGuid='$catalog->guid'");
			$dataReader=$command->query();
			$rowsAttribute=$dataReader->readAll();
			foreach($rowsAttribute as $attribute)
			{
				//var_dump($attribute['attributeGuid']);die;
				$attributeGuid = $attribute['attributeGuid'];
				$doc[$attributeGuid] = $attribute['value'];
			}
			
			try
			{
				$contentCollection->insert($doc);
			}
			catch(Exception $e)
			{
				echo $e->getMessage().'<br>';
			}
			
			//die;
		}
	}
	
	private function _mongoTestInsertFolder()
	{
		$con = new Mongo();

		$content = $con->test->content;
		$results = $content->find();
		$iCatalog = 0;
		foreach($results as $doc)
		{
			echo $iCatalog++ . ") ". $doc['guid'] ."<br>";
			
			
			$catalogGuid = $doc['guid'];
			//$catalogGuid = "1000";
			$db = Yii::app()->db;
			$command=$db->createCommand("select * from KutuCatalogFolder where catalogGuid='$catalogGuid'");
			$dataReader=$command->query();
			$rows=$dataReader->readAll();
			$total = count($rows);
			
			$aFolder = array();
			for($i=0;$i<$total;$i++)
			{
				$aFolder[$i] = $rows[$i]['folderGuid'];
			}
			//var_dump($aFolder);
			
			$filter = array('guid' => $catalogGuid);
			$new_document = array(
			 	'$set' => array('folders' =>  $aFolder)			 
			);
			/*$new_document_pull = array(
			 '$pullAll' => array('folders' => array('mac','cikunir','langit'))
			);*/
			
			$options['multiple'] = true;
			
			$content->update($filter,$new_document, $options);
			
			
			//die();
			
		}
		
		
		
		$db = Yii::app()->db;
		$command=$db->createCommand("select guid from KutuCatalog");
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		$totalCatalog = count($rows);
		
		
		
		/*$con = new Mongo();

		$myCollection = $con->test->myCollection;
		$results = $myCollection->findOne();*/
		
		//var_dump($results);
		
		// $doc = array('test'=>1);
		// 		for($i=0;$i<5;$i++)
		// 		{
		// 			$myCollection->insert(array('test'=>1));
		// 		}
		
		// $filter = array('test' => 1);
		// 		$new_document = array(
		// 		 //'$inc' => array('sessions' => 1),
		// 		 '$set' => array(
		// 		   'folders' =>  array('mac','cikunir','langit'),
		// 		 ),
		// 		 //'$unset' => array('address.1' => 1),
		// 		);
		// 		$options['multiple'] = true;
		// 		
		// 		$myCollection->update(
		// 		 $filter,
		// 		 $new_document, $options);
		
		
		/*$filter = array('folders' => 'cikunir');
		$new_document_pull = array(
		 //'$inc' => array('sessions' => 1),
		 '$pull' => array('folders' => 'macku'),
		//'$push' => array('folders'=> 'macku3'),
		 //'$unset' => array('address.1' => 1),
		);
		
		$new_document_push = array(
		 '$push' => array('folders'=> 'macku2'),
		);
		
		$options['multiple'] = true;
		
		$myCollection->update($filter,$new_document_pull, $options);
		$myCollection->update($filter,$new_document_push, $options);
		
		$cursor = $myCollection->find($filter);
		foreach ($cursor as $user) {
		  var_dump($user);
		}*/
		
	}
	
	public function actionMysql()
	{
		$db = Yii::app()->db;
		$query = "select guid from KutuCatalog where profileGuid='article' order by createdDate DESC limit 360, 10";
		$query2 = "select guid from KutuCatalog, KutuCatalogFolder where KutuCatalog.guid=KutuCatalogFolder.catalogGuid AND KutuCatalogFolder.folderGuid='15' order by createdDate DESC limit 62, 10";
		$command=$db->createCommand($query);
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		
		//var_dump($rows);
		
		foreach($rows as $catalog)
		{
			//$i++;
			$tmpGuid = $catalog['guid'];
			//$command=$db->createCommand("select t1.value title, t2.value subTitle, t3.value description, t4.value content from ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedTitle') as t1) LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedSubTitle') as t2) ON t1.catalogGuid=t2.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedDescription') as t3) ON t2.catalogGuid=t3.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedContent') as t4) ON t3.catalogGuid=t4.catalogGuid");
			//$row=$command->queryRow();
			//file_put_contents(Yii::app()->basePath . '/data/'.$tmpGuid.'.row', serialize($row));
			Yii::import('application.extensions.mp.cms.*'); 
			$catalogManager = new MPCatalogManager();
			$row = $catalogManager->getCatalogDetails($tmpGuid);
			
			echo $row['fixedTitle'].'<br>';
		}
		
		$query = "select guid from KutuCatalog, KutuCatalogFolder where KutuCatalog.guid=KutuCatalogFolder.catalogGuid AND KutuCatalogFolder.folderGuid='15' order by createdDate DESC limit 52, 10";
		$command=$db->createCommand($query);
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		
		//var_dump($rows);
		
		foreach($rows as $catalog)
		{
			//$i++;
			$tmpGuid = $catalog['guid'];
			//$command=$db->createCommand("select t1.value title, t2.value subTitle, t3.value description, t4.value content from ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedTitle') as t1) LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedSubTitle') as t2) ON t1.catalogGuid=t2.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedDescription') as t3) ON t2.catalogGuid=t3.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedContent') as t4) ON t3.catalogGuid=t4.catalogGuid");
			//$row=$command->queryRow();
			//file_put_contents(Yii::app()->basePath . '/data/'.$tmpGuid.'.row', serialize($row));
			Yii::import('application.extensions.mp.cms.*'); 
			$catalogManager = new MPCatalogManager();
			$row = $catalogManager->getCatalogDetails($tmpGuid);
			
			echo $row['fixedTitle'].'<br>';
		}
		
		$query = "select guid from KutuCatalog, KutuCatalogFolder where KutuCatalog.guid=KutuCatalogFolder.catalogGuid AND KutuCatalogFolder.folderGuid='12' order by createdDate DESC limit 2, 10";
		$command=$db->createCommand($query);
		$dataReader=$command->query();
		$rows=$dataReader->readAll();
		
		//var_dump($rows);
		
		foreach($rows as $catalog)
		{
			//$i++;
			$tmpGuid = $catalog['guid'];
			//$command=$db->createCommand("select t1.value title, t2.value subTitle, t3.value description, t4.value content from ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedTitle') as t1) LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedSubTitle') as t2) ON t1.catalogGuid=t2.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedDescription') as t3) ON t2.catalogGuid=t3.catalogGuid LEFT JOIN ((select * from KutuCatalogAttribute where catalogGuid='$tmpGuid' and attributeGuid='fixedContent') as t4) ON t3.catalogGuid=t4.catalogGuid");
			//$row=$command->queryRow();
			//file_put_contents(Yii::app()->basePath . '/data/'.$tmpGuid.'.row', serialize($row));
			Yii::import('application.extensions.mp.cms.*'); 
			$catalogManager = new MPCatalogManager();
			$row = $catalogManager->getCatalogDetails($tmpGuid);
			
			echo $row['fixedTitle'].'<br>';
		}
		
		$this->render('mongodb');
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionTestinsertuser()
	{
		Yii::import('application.extensions.mp.MPUserManager');
		$userManager = new MPUserManager();
		$aData = array('username'=>'arwen','guid'=>'001','password'=>'uhui','_id'=>'arwen','addresses'=>array(array('city'=>'jakarta'),array('city'=>'semarang')));
		
		//$userManager->insertUser($aData);
		$userManager->updateUser($aData);
		
	}
	
	public function actionPhpgacl()
	{
		Yii::import('application.extensions.hole.acl.*');
		$acl = new CHolePhpGaclAdapter();
		var_dump($acl->getUserGroupIds('pelanggan'));
		
		var_dump($acl->getPermissionsOnContent('','everyone', 'ild'));
		
		$aclHelper = new CHoleAclHelper();
		var_dump($aclHelper->isAllowedToView('ild'));
		if($aclHelper->isAllowedToView('ild'))
			echo 'test';
		else
			echo "mboh";
			
		echo $_SERVER['REQUEST_URI'];
		
		echo iconv('UTF-8', 'ASCII//TRANSLIT', "kampret");
	}
}