<?php

/**
 * This is the model class for table "conversation".
 *
 * The followings are the available columns in table 'conversation':
 * @property integer $communication_id
 * @property integer $start_from
 * @property integer $start_to
 * @property string $date
 *
 * The followings are the available model relations:
 * @property User $startTo
 * @property User $startFrom
 * @property Messages[] $messages
 */
class Conversation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'conversation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_from, start_to, date', 'required'),
			array('start_from, start_to', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('communication_id, start_from, start_to, date', 'safe', 'on'=>'search'),
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
			'startTo' => array(self::BELONGS_TO, 'User', 'start_to'),
			'startFrom' => array(self::BELONGS_TO, 'User', 'start_from'),
			'messages' => array(self::HAS_MANY, 'Messages', 'messages_communication_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'communication_id' => 'Communication',
			'start_from' => 'Start From',
			'start_to' => 'Start To',
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

		$criteria->compare('communication_id',$this->communication_id);
		$criteria->compare('start_from',$this->start_from);
		$criteria->compare('start_to',$this->start_to);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Conversation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
