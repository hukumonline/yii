<?php

class UserController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionTestAjax()
	{
		echo 'test ajax';
	}
}