<?php

/**
 * This is the model class for table "{{form}}".
 *
 * The followings are the available columns in table '{{form}}':
 * @property integer $id_form
 * @property string $form_name
 * @property string $id_user
 * @property string $json_form
 * @property string $created_at
 * @property string $form_description
 * @property string $created_by
 */
class tb_form extends CActiveRecord
{
	public $id;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return tb_form the static model class
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
		return '{{form}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('form_name', 'required'),
			//array('created_by', 'length', 'max'=>1),
			array('form_description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_form, form_name, id_user, json_form, created_at, form_description, created_by', 'safe', 'on'=>'search'),
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
			'id_form' => 'Id Form',
			'form_name' => 'Form Name',
			'id_user' => 'Id User',
			'json_form' => 'Json Form',
			'created_at' => 'Created At',
			'last_updated_at' => 'last updated at',
			'form_description' => 'Form Description',
			'created_by' => 'Created By',
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

		$criteria->compare('"t"."id_form"',$this->id_form);
		$criteria->compare('lower("t"."form_name")',strtolower($this->form_name),true);
		$criteria->compare('lower("t"."id_user")',strtolower($this->id_user),true);
		$criteria->compare('lower("t"."json_form")',strtolower($this->json_form),true);
		$criteria->compare('lower("t"."created_at")',strtolower($this->created_at),true);
		$criteria->compare('lower("t"."last_updated_at")',strtolower($this->last_updated_at),true);
		$criteria->compare('lower("t"."form_description")',strtolower($this->form_description),true);
		$criteria->compare('lower("t"."created_by")',strtolower($this->created_by),true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search_by_id($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('"t"."id_form"',$this->id_form);
		$criteria->compare('lower("t"."form_name")',strtolower($this->form_name),true);
		$criteria->compare('lower("t"."id_user")',strtolower($id),true);
		$criteria->compare('lower("t"."json_form")',strtolower($this->json_form),true);
		$criteria->compare('lower("t"."created_at")',strtolower($this->created_at),true);
		$criteria->compare('lower("t"."last_updated_at")',strtolower($this->last_updated_at),true);
		$criteria->compare('lower("t"."form_description")',strtolower($this->form_description),true);
		$criteria->compare('lower("t"."created_by")',strtolower($this->created_by),true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
