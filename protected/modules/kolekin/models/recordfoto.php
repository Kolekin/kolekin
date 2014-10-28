<?php

/**
 * This is the model class for table "{{record_foto}}".
 *
 * The followings are the available columns in table '{{record_foto}}':
 * @property integer $id
 * @property integer $foto_record_id
 * @property string $foto
 */
class recordfoto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return recordfoto the static model class
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
		return '{{record_foto}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('foto_record_id', 'numerical', 'integerOnly'=>true),
			array('foto', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, foto_record_id, foto', 'safe', 'on'=>'search'),
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
			'idRecord' => array(self::BELONGS_TO, 'record', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'foto_record_id' => 'Foto Record',
			'foto' => 'Foto',
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
		$criteria->compare('"t"."foto_record_id"',$this->foto_record_id);
		$criteria->compare('lower("t"."foto")',strtolower($this->foto),true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
