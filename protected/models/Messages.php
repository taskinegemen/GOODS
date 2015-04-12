<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $messages_id
 * @property integer $messages_communication_id
 * @property string $message
 * @property string $date
 * @property integer $from
 * @property integer $to
 * @property integer $read
 *
 * The followings are the available model relations:
 * @property User $to0
 * @property Conversation $messagesCommunication
 * @property User $from0
 */
class Messages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('messages_communication_id, message, date, from, to, read', 'required'),
			array('messages_communication_id, from, to, read', 'numerical', 'integerOnly'=>true),
			array('message', 'length', 'max'=>5000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('messages_id, messages_communication_id, message, date, from, to, read', 'safe', 'on'=>'search'),
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
			'to0' => array(self::BELONGS_TO, 'User', 'to'),
			'messagesCommunication' => array(self::BELONGS_TO, 'Conversation', 'messages_communication_id'),
			'from0' => array(self::BELONGS_TO, 'User', 'from'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'messages_id' => 'Messages',
			'messages_communication_id' => 'Messages Communication',
			'message' => 'Message',
			'date' => 'Date',
			'from' => 'From',
			'to' => 'To',
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

		$criteria->compare('messages_id',$this->messages_id);
		$criteria->compare('messages_communication_id',$this->messages_communication_id);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('from',$this->from);
		$criteria->compare('to',$this->to);
		$criteria->compare('read',$this->read);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Messages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
