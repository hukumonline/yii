<?php

class RIUser extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'KutuUser':
	 * @var string $guid
	 * @var string $username
	 * @var string $password
	 * @var string $firstname
	 * @var string $lastname
	 * @var string $email
	 * @var string $openId
	 * @var string $bbPin
	 * @var string $clientId
	 * @var string $promotionId
	 * @var integer $educationId
	 * @var string $company
	 * @var string $mainAddress
	 * @var string $city
	 * @var string $state
	 * @var string $zip
	 * @var string $countryId
	 * @var string $phone
	 * @var string $fax
	 * @var string $jobId
	 * @var string $industryId
	 * @var string $companySizeId
	 * @var string $url
	 * @var string $createdDate
	 * @var string $createdBy
	 * @var string $modifiedDate
	 * @var string $modifiedBy
	 * @var integer $isActive
	 * @var string $isContact
	 * @var string $registrationDate
	 * @var string $activationDate
	 * @var string $activationCode
	 * @var string $expirationDate
	 * @var string $lastLoginDate
	 * @var string $lastLoginIp
	 * @var string $currentFund
	 */

	public function getDbConnection()
	{
		if(self::$db!==null)
			return self::$db;
		else
		{
			self::$db=Yii::app()->getComponent('identityDb');
			if(self::$db instanceof CDbConnection)
			{
				self::$db->setActive(true);
				return self::$db;
			}
			else
				throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
		}
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'KutuUser';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('educationId, isActive', 'numerical', 'integerOnly'=>true),
			array('guid, bbPin, clientId, phone, fax, jobId, industryId, activationCode, lastLoginIp', 'length', 'max'=>32),
			array('username, password, createdBy, modifiedBy', 'length', 'max'=>50),
			array('firstname', 'length', 'max'=>128),
			array('lastname, email, company, zip, url', 'length', 'max'=>100),
			array('openId', 'length', 'max'=>254),
			array('promotionId', 'length', 'max'=>20),
			array('mainAddress', 'length', 'max'=>200),
			array('city, state', 'length', 'max'=>255),
			array('countryId, currentFund', 'length', 'max'=>10),
			array('companySizeId', 'length', 'max'=>9),
			array('isContact', 'length', 'max'=>1),
			array('createdDate, modifiedDate, registrationDate, activationDate, expirationDate, lastLoginDate', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'guid' => 'Guid',
			'username' => 'Username',
			'password' => 'Password',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'email' => 'Email',
			'openId' => 'Open',
			'bbPin' => 'Bb Pin',
			'clientId' => 'Client',
			'promotionId' => 'Promotion',
			'educationId' => 'Education',
			'company' => 'Company',
			'mainAddress' => 'Main Address',
			'city' => 'City',
			'state' => 'State',
			'zip' => 'Zip',
			'countryId' => 'Country',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'jobId' => 'Job',
			'industryId' => 'Industry',
			'companySizeId' => 'Company Size',
			'url' => 'Url',
			'createdDate' => 'Created Date',
			'createdBy' => 'Created By',
			'modifiedDate' => 'Modified Date',
			'modifiedBy' => 'Modified By',
			'isActive' => 'Is Active',
			'isContact' => 'Is Contact',
			'registrationDate' => 'Registration Date',
			'activationDate' => 'Activation Date',
			'activationCode' => 'Activation Code',
			'expirationDate' => 'Expiration Date',
			'lastLoginDate' => 'Last Login Date',
			'lastLoginIp' => 'Last Login Ip',
			'currentFund' => 'Current Fund',
		);
	}
}