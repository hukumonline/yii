<?php

class DefaultController extends Controller
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
	public function actionTestAjax()
	{
		echo 'test ajax';
	}
	public actionAddContent()
	{
		
	}
}