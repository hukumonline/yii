<?php

class HoleModule extends CWebModule
{
	public $theme = '';
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'hole.models.*',
			'hole.components.*',
		));
		
		//set template for this module
		Yii::app()->setTheme($this->theme);
		//var_dump(Yii::app()->theme->viewPath);die;
		$this->layoutPath = Yii::app()->theme->viewPath.'/layouts';
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
