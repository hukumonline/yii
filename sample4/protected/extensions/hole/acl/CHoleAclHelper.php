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
		
		if ($itemGuid=='clinic') {
			return true;
		}
		
		if (Yii::app()->user->isGuest) { 
			return $aclMan->getPermissionsOnContent('','everyone', $itemGuid);         
        }
		else
		{
			$aReturn = $aclMan->getUserGroupIds(Yii::app()->user->name);
			if (in_array($aReturn[0],array('master','super admin','dc admin','uploader','news ina','editor ina','marketing','klanten','holproject','dc editor','dc coordinator','admin ina','admin en','clinic ina','clinic en','clinic editor'))) 
				return true;
			else
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