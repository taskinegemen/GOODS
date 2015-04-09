<?php

/**
 * This is the model class for table "profile_follows".
 *
 * The followings are the available columns in table 'profile_follows':
 * @property integer $profile_follows_id
 * @property integer $liker
 * @property integer $liked
 * @property string $date
 *
 * The followings are the available model relations:
 * @property User $liker0
 * @property User $liked0
 */
class ProfileFollows extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'profile_follows';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('liker, liked, date', 'required'),
			array('liker, liked', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('profile_follows_id, liker, liked, date', 'safe', 'on'=>'search'),
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
			'liker0' => array(self::BELONGS_TO, 'User', 'liker'),
			'liked0' => array(self::BELONGS_TO, 'User', 'liked'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'profile_follows_id' => 'Profile Follows',
			'liker' => 'Liker',
			'liked' => 'Liked',
			'date' => 'Date',
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

		$criteria->compare('profile_follows_id',$this->profile_follows_id);
		$criteria->compare('liker',$this->liker);
		$criteria->compare('liked',$this->liked);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProfileFollows the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
