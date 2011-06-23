<?php
class CHoleAclHelper
{
	private $acl;
	public function __construct()
	{
		require_once('CHolePhpGaclAdapter.php');
		$this->acl = new CHolePhpGaclAdapter();
	}
	
	//Used to be in Kutu_View_Helper
	public function isAllowedToView($itemGuid)
	{
		$aclMan = $this->acl;
		
        /*if (Yii::app()->user->isGuest) { 
			return $aclMan->getPermissionsOnContent('','everyone', $itemGuid);         
        }
		else {		
			$aReturn = $aclMan->getUserGroupIds(Yii::app()->user->name);
			//var_dump($itemGuid);die;
			return $aclMan->getPermissionsOnContent('',$aReturn[1], $itemGuid);
		}*/
		if (Yii::app()->user->isGuest) { 
			return $aclMan->getPermissionsOnContent('','everyone', $itemGuid);         
        }
		else
		{
			return $aclMan->checkAcl('action', 'read', 'user', Yii::app()->user->name, 'content', $itemGuid);
		}
	}
	
	public function isAllowed($itemGuid, $action, $section='content')
	{
        if (Yii::app()->user->isGuest) { 
            return false;
        }
		$aclMan = $this->acl;
		return $aclMan->isAllowed(Yii::app()->user->name, $itemGuid, $action, $section);
	}
}
?>