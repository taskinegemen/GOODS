<?php

/**
 * This is the model class for table "item_pictures".
 *
 * The followings are the available columns in table 'item_pictures':
 * @property integer $item_pictures_id
 * @property integer $item_id
 * @property string $picture
 * @property integer $is_it_main
 *
 * The followings are the available model relations:
 * @property Item $item
 */
class ItemPictures extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item_pictures';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_pictures_id, item_id, picture, is_it_main', 'required'),
			array('item_pictures_id, item_id, is_it_main', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('item_pictures_id, item_id, picture, is_it_main', 'safe', 'on'=>'search'),
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
			'item' => array(self::BELONGS_TO, 'Item', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'item_pictures_id' => 'Item Pictures',
			'item_id' => 'Item',
			'picture' => 'Picture',
			'is_it_main' => 'Is It Main',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('item_pictures_id',$this->item_pictures_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('is_it_main',$this->is_it_main);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ItemPictures the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
