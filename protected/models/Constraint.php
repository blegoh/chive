<?php

class Constraint extends CActiveRecord
{

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
		return 'TABLE_CONSTRAINTS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('CONSTRAINT_CATALOG','length','max'=>512),
			array('CONSTRAINT_SCHEMA','length','max'=>64),
			array('CONSTRAINT_NAME','length','max'=>64),
			array('TABLE_SCHEMA','length','max'=>64),
			array('TABLE_NAME','length','max'=>64),
			array('CONSTRAINT_TYPE','length','max'=>64),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'table' => array(self::BELONGS_TO, 'Table', 'TABLE_NAME'),
			'keys' => array(self::HAS_MANY, 'Key', 'CONSTRAINT_SCHEMA, CONSTRAINT_NAME, TABLE_SCHEMA, TABLE_NAME'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
		);
	}

	public function primaryKey()
	{
		return array(
			'CONSTRAINT_SCHEMA',
			'CONSTRAINT_NAME',
			'TABLE_SCHEMA',
			'TABLE_NAME',
			'CONSTRAINT_TYPE',
		);
	}
}