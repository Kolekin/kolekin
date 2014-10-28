<?php

/**
 * This is the model class for table "{{blog_banner}}".
 *
 * The followings are the available columns in table '{{blog_banner}}':
 * @property integer $id
 * @property string $gambar
 * @property string $keterangan
 * @property integer $status
 */
class Banner extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Banner the static model class
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
		return '{{blog_banner}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gambar', 'required'),
			array('status, posisi', 'numerical', 'integerOnly'=>true),
			array('keterangan,link', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gambar, link, keterangan, status, posisi', 'safe', 'on'=>'search'),
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

	public static function itemAlias($type,$code=NULL) {		
		$_items = array(
			'BannerStatus' => array(				
				0 => 'Draft',				
				1 => 'Tampil',				
			),						
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gambar' => 'Gambar',
			'keterangan' => 'Keterangan',
			'status' => 'Status',
			'posisi' => 'Posisi',
			'link'=> 'URL Tautan',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('gambar',$this->gambar,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('posisi',$this->posisi);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
