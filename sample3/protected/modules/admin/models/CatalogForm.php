<?php
class CatalogForm extends CFormModel
{
	public $_id;
	public $shortTitle;
	public $profileId;
	public $datePublished;
	public $dateExpired;
	public $createdBy;
	public $modifiedBy;
	public $dateCreated;
	public $dateModified;
	public $dateDeleted;
	public $status;
	public $folderId;

	
	private $_profile;
	private $_collection;
	private $_row;
	
	public function __set($name,$value)
	{
		$this->{$name} = $value;
		try
		{
			parent::__set($name,$value);
		}
		catch (Exception $e)
		{
		
		}
	}
	public function __construct($profile, $scenario='')
	{
		$this->_profile = $profile;
		parent::__construct($scenario);
	}
	public function init()
	{
		
		$mongoDb = Yii::app()->getComponent('mongoDb');
		$this->_collection = $mongoDb->getCollection('ContentProfile');
		
		$this->_row = $this->_collection->findOne(array('name'=>$this->_profile));
		
		foreach($this->_row['attributes'] as $attribute)
		{
			//echo $attribute['name'];
			$this->{$attribute['name']} = '';
		}
		
	}
	
	function getCatalogAttributes()
	{
		return $this->_row['attributes'];
	}
	
	public function rules()
    {
		$aRules = array();
		
		array_push($aRules, array('_id', 'safe'));
		array_push($aRules, array('profileId', 'required'));
		array_push($aRules, array('folderId', 'required'));
		array_push($aRules, array('shortTitle', 'unsafe'));

		foreach($this->_row['attributes'] as $attribute)
		{
			switch ($attribute['name'])
			{
				case 'title':
					array_push($aRules, array($attribute['name'], 'required'));
					break;
				default:
					array_push($aRules, array($attribute['name'], 'safe'));
					break;
			}
			
		}
		//var_dump($aRules);
		
        /*return array(
			
			array('tags', 'safe'),
            array('title', 'required'),
            array('shortTitle', 'boolean'),
            array('password', 'safe'),
        );*/
		return $aRules;
    }
	public function attributeLabels1()
	{
		return array(
			'title'=>'Title',
		);
	}
}
?>