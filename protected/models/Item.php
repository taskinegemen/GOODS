<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property integer $item_id
 * @property double $latitude
 * @property double $longtitude
 * @property string $title
 * @property string $description
 * @property double $price
 * @property integer $category_id
 * @property integer $trade
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Category $category
 * @property ItemPictures[] $itemPictures
 * @property ItemsLiked[] $itemsLikeds
 */
class Item extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('latitude, longtitude, title, description, price, category_id, trade, user_id', 'required'),
			array('category_id, trade, user_id', 'numerical', 'integerOnly'=>true),
			array('latitude, longtitude, price', 'numerical'),
			array('title', 'length', 'max'=>500),
			array('description', 'length', 'max'=>5000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('item_id, latitude, longtitude, title, description, price, category_id, trade, user_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'itemPictures' => array(self::HAS_MANY, 'ItemPictures', 'item_id'),
			'itemsLikeds' => array(self::HAS_MANY, 'ItemsLiked', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'item_id' => 'Item',
			'latitude' => 'Latitude',
			'longtitude' => 'Longtitude',
			'title' => 'Title',
			'description' => 'Description',
			'price' => 'Price',
			'category_id' => 'Category',
			'trade' => 'Trade',
			'user_id' => 'User',
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

		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longtitude',$this->longtitude);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('trade',$this->trade);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Item the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
