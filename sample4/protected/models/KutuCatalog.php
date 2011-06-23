<?php

class KutuCatalog extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'KutuCatalog':
	 * @var string $guid
	 * @var string $shortTitle
	 * @var string $profileGuid
	 * @var string $publishedDate
	 * @var string $expiredDate
	 * @var string $createdBy
	 * @var string $modifiedBy
	 * @var string $createdDate
	 * @var string $modifiedDate
	 * @var string $deletedDate
	 * @var integer $status
	 * @var string $price
	 * @var string $currency
	 * @var integer $isIndexed
	 * @var string $lastIndexedDate
	 * @var integer $numDownloads
	 * @var integer $numViews
	 */

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
		return 'KutuCatalog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, isIndexed, numDownloads, numViews', 'numerical', 'integerOnly'=>true),
			array('guid, profileGuid', 'length', 'max'=>50),
			array('shortTitle', 'length', 'max'=>1000),
			array('createdBy, modifiedBy', 'length', 'max'=>255),
			array('price', 'length', 'max'=>10),
			array('currency', 'length', 'max'=>9),
			array('publishedDate, expiredDate, createdDate, modifiedDate, deletedDate, lastIndexedDate', 'safe'),
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
			'shortTitle' => 'Short Title',
			'profileGuid' => 'Profile Guid',
			'publishedDate' => 'Published Date',
			'expiredDate' => 'Expired Date',
			'createdBy' => 'Created By',
			'modifiedBy' => 'Modified By',
			'createdDate' => 'Created Date',
			'modifiedDate' => 'Modified Date',
			'deletedDate' => 'Deleted Date',
			'status' => 'Status',
			'price' => 'Price',
			'currency' => 'Currency',
			'isIndexed' => 'Is Indexed',
			'lastIndexedDate' => 'Last Indexed Date',
			'numDownloads' => 'Num Downloads',
			'numViews' => 'Num Views',
		);
	}
}