<?php

class KutuCatalogFolder extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'KutuCatalogFolder':
	 * @var string $catalogGuid
	 * @var string $folderGuid
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
		return 'KutuCatalogFolder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('catalogGuid, folderGuid', 'length', 'max'=>50),
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
			'catalogs' => array(self::HAS_MANY, 'KutuCatalog', 'guid',
			            'condition'=>'comments.status='.Comment::STATUS_APPROVED,
			            'order'=>'comments.create_time DESC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'catalogGuid' => 'Catalog Guid',
			'folderGuid' => 'Folder Guid',
		);
	}
}