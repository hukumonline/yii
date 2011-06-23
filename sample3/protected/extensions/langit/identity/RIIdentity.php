<?php
class RIIdentity extends CApplicationComponent
{
	private $_userIdentity;
	//public $userIdentity;
	public $loginUrl;
	public $logoutUrl;
	
	public function init()
	{
		Yii::import('application.extensions.langit.identity.riidentity.*');
		$this->_userIdentity = new RIUserIdentity();
	}
	public function getAuthAdapter()
	{
		return $this->_userIdentity;
	}
}
?>