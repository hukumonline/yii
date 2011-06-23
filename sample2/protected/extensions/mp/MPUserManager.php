<?php
class MPUserManager
{
	public $userModel;
	public function __construct()
	{
		$mongoDb = Yii::app()->getComponent('mongoDb');
		$this->userModel = $mongoDb->getCollection('user');
	}
	
	private function _validateUserData($aData)
	{
		$doc = $aData;
		
		if(empty($doc['_id']))
			$doc['_id'] = (string)(new MongoId());
		
		/*foreach($doc as $key=>$value)
		{
			if(empty($doc[$key]))
				throw new CException('Field: '.$key.' cannot be EMPTY.');
		}*/
		
		/*if(empty($aData['username']))
			throw new CException('Field: username cannot be EMPTY.');
		else
			$doc['username'] = $aData['username'];
		
		if(isset($aData['password']) && !empty($aData['password']))
			$doc['password'] = $aData['password'];
			//throw new CException('Field: password cannot be EMPTY.');
		//else
			//$doc['password'] = $aData['password'];*/
			
		/*if(isset($aData['username']))
			$doc['username'] = $aData['username'];
		
		if(isset($aData['password']))
			$doc['password'] = $aData['password'];
		
		if(isset($aData['firstname']))
			$doc['firstname'] = $aData['firstname'];
			
		if(isset($aData['lastname']))
			$doc['lastname'] = $aData['lastname'];
			
		if(isset($aData['email']))
			$doc['email'] = $aData['email'];
			
		if(isset($aData['openId']))
			$doc['openId'] = $aData['openId'];
		
		
		//$doc['password'] = sha1($doc['password']);*/
		
		return $doc;
	}
	private function getField($fieldName, $aData)
	{
		//var_dump($aData);die;
		if(empty($aData[$fieldName]))
			throw new CException('Field: '.$fieldName.' cannot be EMPTY.');
		
		return $aData[$fieldName];
	}
	private function isExistUsername($username)
	{
		$user = $this->userModel->findOne(array('username'=>$username));
		if(!empty($user))
			return true;
		else
			return false;
	}
	public function updateUser($doc)
	{
		//$doc = $this->_validateUserData($aData);
		
		try {
		    //$this->userModel->insert($doc, true);
			$this->userModel->update(array("_id" => $doc['_id']), $doc, array("upsert" => true));
		}
		catch(MongoCursorException $e) {
		    return false;
		}
		
	}
	/**
	   * Instantiate an object conforming to Mongo_Document conventions.
	   * The document is not loaded until load() is called.
	   *
	   * @param   array  aData should be in form of array('username'=>'','password'=>'','addresses'=>array(array('address'=>'','type'=>'[office|home|others]','zip'=>'')))
	   * @param   mixed   optional _id of document to operate on or criteria for loading (if you expect it exists)
	   * @return  Mongo_Document
	   */
	public function subscribeUser($aData)
	{
		if(empty($aData['_id']))
			$aData['_id'] = (string)(new MongoId());
		if(empty($aData['username']))
			throw new CException('Field: username cannot be EMPTY.');
		if(empty($aData['password']))
			throw new CException('Field: password cannot be EMPTY.');
		else
		{
			$aData['password'] = sha1($aData['password']);
		}
		
		if($this->isExistUsername($aData['username']))
			throw new CException('Username is already used');
			
		if($this->updateUser($aData))
		{
			//continue doing things, like send confirmation email
			
			return true;
		}
		else
		{
			throw new CException('Can not add user!');
		}
	}
	public function editProfile($aData)
	{
		if(empty($doc['_id']))
			throw new CException('Must supply _id');
		if(isset($aData['username']))
			throw new CException('Can not set username here');
		if(isset($aData['password']))
			throw new CException('Can not set password here');
			
		$this->updateUser($aData);
	}
	public function changePassword($id, $newPassword)
	{
		$newPassword = sha1($newPassword);
		$doc = array('password'=>$newPassword);
		
		try {
		    //$this->userModel->insert($doc, true);
			$this->userModel->update(array("_id" => $id, $doc, array("upsert" => true)));
		}
		catch(MongoCursorException $e) {
		    return false;
		}
	}
	public function addAddress($aData)
	{
		$addresses = array("addresses"=>array("address"=>$aData['address'], "type"=>$aData['type'], ));
	}
}
?>