<?php

/**
 * This is the model class for table "items_liked".
 *
 * The followings are the available columns in table 'items_liked':
 * @property integer $items_liked_id
 * @property integer $user_id
 * @property integer $item_id
 * @property string $date
 * @property integer $read
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Item $item
 */
class ItemsLiked extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'items_liked';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, item_id, date, read', 'required'),
			array('user_id, item_id, read', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('items_liked_id, user_id, item_id, date, read', 'safe', 'on'=>'search'),
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
			'item' => array(self::BELONGS_TO, 'Item', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'items_liked_id' => 'Items Liked',
			'user_id' => 'User',
			'item_id' => 'Item',
			'date' => 'Date',
			'read' => 'Read',
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

		$criteria->compare('items_liked_id',$this->items_liked_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('read',$this->read);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ItemsLiked the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
