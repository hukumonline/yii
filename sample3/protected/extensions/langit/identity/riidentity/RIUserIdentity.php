<?php
Yii::import('application.extensions.langit.identity.riidentity.kutu.*');
class RIUserIdentity extends CUserIdentity
{
    private $_id;
	
	public function __construct($username='', $password='')
	{
		parent::__construct($username, $password);
	}
	
    public function authenticate()
    {
        $record=RIUser::model()->findByAttributes(array('username'=>$this->username));
		$obj = new Kutu_Crypt_Password();
        if($record===null)
		{
            $this->errorCode=self::ERROR_USERNAME_INVALID;
			$this->errorMessage = 'Username Invalid';
		}
        //else if($record->password!==md5($this->password))
		else if(!$obj->matchPassword($this->password, $record->password))
		{
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
			$this->errorMessage = 'Password Invalid';
		}
        else
        {
            $this->_id=$record->guid;
            $this->setState('username', $record->username);
			$this->setState('lastname', $record->lastname);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }
}
?>