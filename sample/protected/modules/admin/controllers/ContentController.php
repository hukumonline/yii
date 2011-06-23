<?php

class ContentController extends Controller
{
	public function actionIndex()
	{
		//set different layout other than default MAIN layout
		//Yii::app()->layout = "main2";
		
		//var_dump(Yii::app()->clientScript->scriptMap);
		/*Yii::app()->user->logout();
		//Yii::import('application.extensions.langit.web.auth.core.*');
		$username = 'himawan';
		$password = 'test';
		//$identity=new RIUserIdentity($username,$password);
		$identity = Yii::app()->getComponent('identity');
		$auth = $identity->getAuthAdapter();
		$auth->username = $username;
		$auth->password = $password;
		if($auth->authenticate())
		    Yii::app()->user->login($auth);
		//else
		  //  echo $identity->errorMessage;*/
		
		if(Yii::app()->user->isGuest)
			Yii::app()->user->loginRequired();
		
		$this->render('index');
	}
	public function actionAdd1()
	{
		$model = new CatalogForm('article');
		if(isset($_POST['CatalogForm']))
		{
			$model->attributes=$_POST['CatalogForm'];
			//var_dump($model);
		}
		
		$form = new CForm($this->_buildForm(), $model);
		
		if($form->submitted('save') && $form->validate())
		{
			$model->attributes['folders'] = array('r','001');
			
			//insert Catalog
			Yii::import('application.extensions.mp.*');
			$manager = new MPCatalogManager();
			
			$manager->insertCatalog($model->attributes);
			
			//model->attributes['folders'] should be change to array
			//model->attributes['tags'] should be change to array
			
			var_dump($model->attributes);
			
			die('sukses');
 		}
		else
		{	
			$this->render('addcontent', array('form'=>$form));
		}
	}
	public function actionAdd()
	{
		$profileId = $_GET['profile'];
		$folderId = $_GET['folder'];
		
		$model = new CatalogForm($profileId);
		$model->datePublished = date('Y-m-d');
		$model->profileId = $profileId;
		$model->folderId = $folderId;
		
		$this->performAjaxValidation($model);
		
		if(isset($_POST['CatalogForm']))
		{
			var_dump($_POST['CatalogForm']);
			//die('go');
			$model->attributes=$_POST['CatalogForm'];
			
			if($model->validate())
			{
				//$this->redirect(Yii::app()->user->returnUrl);
				//die($model->title);
				
				$doc = $_POST['CatalogForm'];
				
				//lets's prepare the data for mongoDb
				if(!empty($doc['tags']))
				{
					$doc['tags'] = str_replace(',', ';', $doc['tags']);
					$doc['tags'] = explode(';', $doc['tags']);
				}
				$doc['folders'] = array($doc['folderId']);
				unset($doc['folderId']);
				
				Yii::import('application.extensions.mp.*');
				$manager = new MPCatalogManager();

				$manager->insertCatalog($doc);
			}
			
			//var_dump($model);
		}
		$this->render('addcontent', array('model'=>$model));
	}
	protected function performAjaxValidation($model)
	{
	    if(isset($_POST['ajax']) && $_POST['ajax']==='catalog-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	}
	public function actionUpdate()
	{
		$model = $this->_loadModel('4ba441778ead0e8f3e000000');
		$form = new CForm($this->_buildForm(), $model);
		
		if($form->submitted('save') && $form->validate())
		{
			$model->attributes=$_POST['CatalogForm'];

			//insert Catalog
			Yii::import('application.extensions.mp.*');
			$manager = new MPCatalogManager();

			$manager->updateCatalog($model->attributes);

			//model->attributes['folders'] should be change to array
			//model->attributes['tags'] should be change to array

			//var_dump($model->attributes);

			die('sukses');
 		}
		else
		{
			$this->render('update', array('form'=>$form));
		}
	}
	
	private function _buildForm()
	{
		$mongoDb = Yii::app()->getComponent('mongoDb');
		$collection = $mongoDb->getCollection('ContentProfile');
		
		$row = $collection->findOne(array('name'=>'article'));
		
		$sortedAttributes = $this->order_array_num($row['attributes'], 'viewOrder', 'ASC');
		
		$elements = array();
		
		$elements['_id'] = array('type'=>'text','maxlength'=>32);
		$elements['shortTitle'] = array('type'=>'text','maxlength'=>32);
		$elements['profileId'] = array('type'=>'text','maxlength'=>32);
		
		foreach($sortedAttributes as $attribute)
		{
			switch ($attribute['name'])
			{
				case 'title':
					$elements[$attribute['name']] = array('type'=>'text','maxlength'=>32);
					break;
				default:
					$elements[$attribute['name']] = array('type'=>'text','maxlength'=>32);
					break;
			}
		}
		
		$config = array(
		    'title'=>'Please provide your login credential',

		    'elements'=>$elements,

		    'buttons'=>array(
		        'save'=>array(
		            'type'=>'submit',
		            'label'=>'Save',
		        ),
		    ),
		);
		return $config;
	}
	
	private function _loadModel($contentId)
	{
		$model = new CatalogForm('article');
		
		$collection = Yii::app()->getComponent('mongoDb')->getCollection('Content');
		
		$row = $collection->findOne(array('_id'=>$contentId));
		
		foreach($row as $key=>$value)
		{
			$model->{$key} = $value;
		}
		
		//var_dump($row);
		
		return $model;
	}
	
	public function actionAddProfile()
	{
		$doc = array();
		$doc['_id'] = '4ba3b0388ead0e983e000000';
		if(empty($doc['_id']))
			$doc['_id'] = (string)(new MongoId());
		
		$doc['name'] = 'article';
		$doc['description'] = 'Article';
		$doc['attributes'] = array(array('name'=>'title', 'description'=>'Title', 'defaultValues'=>'', 'viewOrder'=>0, 'type'=>'text'), 
									array('name'=>'subTitle', 'description'=>'Sub Title', 'defaultValues'=>'', 'viewOrder'=>1, 'type'=>'text'),
									array('name'=>'description', 'description'=>'Description', 'defaultValues'=>'', 'viewOrder'=>2, 'type'=>'textarea'),
									array('name'=>'content', 'description'=>'Content', 'defaultValues'=>'', 'viewOrder'=>3, 'type'=>'editor'),
									array('name'=>'tags', 'description'=>'Tags', 'defaultValues'=>'', 'viewOrder'=>4, 'type'=>'tag'),
									array('name'=>'author', 'description'=>'Author', 'defaultValues'=>'', 'viewOrder'=>5, 'type'=>'text'),
								);
							
		$mongoDb = Yii::app()->getComponent('mongoDb');
		$coll = $mongoDb->getCollection('ContentProfile');
		
		$coll->update(array("_id" => $doc['_id']), $doc, array("upsert" => true));
	}
	function order_array_num ($array, $key, $order = "ASC") 
    { 
        $tmp = array(); 
        foreach($array as $akey => $array2) 
        { 
            $tmp[$akey] = $array2[$key]; 
        } 

        if($order == "DESC") 
        {arsort($tmp , SORT_NUMERIC );} 
        else 
        {asort($tmp , SORT_NUMERIC );} 

        $tmp2 = array();        
        foreach($tmp as $key => $value) 
        { 
            $tmp2[$key] = $array[$key]; 
        }        

        return $tmp2; 
    }
	function actionTestLogin()
	{
		$model=new LoginForm;
		    if(isset($_POST['LoginForm']))
		    {
		        // collects user input data
		        $model->attributes=$_POST['LoginForm'];
		        // validates user input and redirect to previous page if validated
		        if($model->validate())
		            $this->redirect(Yii::app()->user->returnUrl);
		    }
		    // displays the login form
		    $this->render('testlogin',array('model'=>$model));
	}
}