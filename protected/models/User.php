<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $picture
 *
 * The followings are the available model relations:
 * @property Conversation[] $conversations
 * @property Conversation[] $conversations1
 * @property Item[] $items
 * @property ItemsLiked[] $itemsLikeds
 * @property Messages[] $messages
 * @property Messages[] $messages1
 * @property ProfileFollows[] $profileFollows
 * @property ProfileFollows[] $profileFollows1
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, picture', 'required'),
			array('username, password, email', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, username, password, email, picture', 'safe', 'on'=>'search'),
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
			'conversations' => array(self::HAS_MANY, 'Conversation', 'start_to'),
			'conversations1' => array(self::HAS_MANY, 'Conversation', 'start_from'),
			'items' => array(self::HAS_MANY, 'Item', 'user_id'),
			'itemsLikeds' => array(self::HAS_MANY, 'ItemsLiked', 'user_id'),
			'messages' => array(self::HAS_MANY, 'Messages', 'to'),
			'messages1' => array(self::HAS_MANY, 'Messages', 'from'),
			'profileFollows' => array(self::HAS_MANY, 'ProfileFollows', 'liker'),
			'profileFollows1' => array(self::HAS_MANY, 'ProfileFollows', 'liked'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'picture' => 'Picture',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('picture',$this->picture,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
