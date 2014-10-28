<?php

/**
 * This is the model class for table "{{record}}".
 *
 * The followings are the available columns in table '{{record}}':
 * @property integer $id
 * @property integer $record_user_id
 * @property integer $record_form_id
 * @property string $record_json_data
 * @property string $latitude
 * @property string $longitude
 * @property string $create_at
 * @property string $last_update
 */
class record extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return record the static model class
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
		return '{{record}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('record_user_id, record_form_id', 'numerical', 'integerOnly'=>true),
			array('record_json_data, latitude, longitude, create_at, last_update', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, record_user_id, record_form_id, record_json_data, latitude, longitude, create_at, last_update', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'record_user_id' => 'Record User',
			'record_form_id' => 'Record Form',
			'record_json_data' => 'Record Json Data',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'create_at' => 'Create At',
			'last_update' => 'Last Update',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('"t"."id"',$this->id);
		$criteria->compare('"t"."record_user_id"',$this->record_user_id);
		$criteria->compare('"t"."record_form_id"',$this->record_form_id);
		$criteria->compare('lower("t"."record_json_data")',strtolower($this->record_json_data),true);
		$criteria->compare('lower("t"."latitude")',strtolower($this->latitude),true);
		$criteria->compare('lower("t"."longitude")',strtolower($this->longitude),true);
		$criteria->compare('lower("t"."create_at")',strtolower($this->create_at),true);
		$criteria->compare('lower("t"."last_update")',strtolower($this->last_update),true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search_by_id($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('"t"."id"',$this->id);
		$criteria->compare('"t"."record_user_id"',$this->record_user_id);
		$criteria->compare('"t"."record_form_id"',$id);
		$criteria->compare('lower("t"."record_json_data")',strtolower($this->record_json_data),true);
		$criteria->compare('lower("t"."latitude")',strtolower($this->latitude),true);
		$criteria->compare('lower("t"."longitude")',strtolower($this->longitude),true);
		$criteria->compare('lower("t"."create_at")',strtolower($this->create_at),true);
		$criteria->compare('lower("t"."last_update")',strtolower($this->last_update),true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
