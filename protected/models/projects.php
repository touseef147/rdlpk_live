<?php

/**
 * This is the model class for table "iknanow_users".
 *
 * The followings are the available columns in table 'iknanow_users':
 * @property integer $user_id
 * @property string $company
 * @property string $phone
 * @property string $name
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $status
 * @property integer $login_status
 * @property string $create_date
 * @property string $modify_date
 */
class projects extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'projects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_name', 'required'),
			//array('login_status', 'numerical', 'integerOnly'=>true),
			//array('username', 'length', 'max'=>255),
			//array('email', 'length', 'max'=>100),
			//array('username', 'length', 'max'=>150),
			//array('password', 'length', 'max'=>50),
			//array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('project_name, teaser, project_details', 'safe', 'on'=>'search'),
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
			'project_name' => 'Project Name',
			'teaser' => 'teaser',
			'project_details' => 'Project Details',
			
			'create_date' => 'Create Date',
			'modify_date' => 'Modify Date',
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

		$criteria->compare('projects_name',$this->projects_name);
		$criteria->compare('teaser',$this->teaser,true);
		$criteria->compare('projects_details',$this->projects_details,true);
		//$criteria->compare('name',$this->name,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modify_date',$this->modify_date,true);

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
