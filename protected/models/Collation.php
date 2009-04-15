<?php

class Collation extends CActiveRecord
{
	const DEFAULT_CHARACTER_SET = 'utf8';
	const DEFAULT_COLLATION = 'utf8_general_ci';

	public $collationGroup;

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
		return 'COLLATIONS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('COLLATION_NAME','length','max'=>64),
			array('CHARACTER_SET_NAME','length','max'=>64),
			array('IS_DEFAULT','length','max'=>3),
			array('IS_COMPILED','length','max'=>3),
			array('ID, SORTLEN', 'numerical'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'schema' => array(self::HAS_MANY, 'Schema', 'DEFAULT_COLLATION_NAME'),
			'characterSet' => array(self::BELONGS_TO, 'CharacterSet', 'CHARACTER_SET_NAME'),
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

	/*
	 * @return string primary key column
	 */
	public function primaryKey()
	{
		return 'COLLATION_NAME';
	}

	public static function getDefinition($collation)
	{
		$data = explode('_', $collation);
		$text = Yii::t('collation', $data[0]) . ', ' . Yii::t('collation', $data[1]);
		if(count($data) == 3)
		{
			$text .= ' (' . Yii::t('collation', $data[2]) . ')';
		}
		return $text;
	}

	public static function getCharacterSet($collation)
	{
		$data = explode('_', $collation);
		return $data[0];
	}

}