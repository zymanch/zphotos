<?php

/**
 * This is the model class for table "image".
 *
 * The followings are the available columns in table 'image':
 * @property string $id
 * @property string $album_id
 * @property string $name
 * @property string $filename
 * @property string $orientation
 * @property integer $width
 * @property integer $height
 * @property integer $margin_left
 * @property integer $margin_right
 * @property integer $margin_top
 * @property integer $margin_bottom
 * @property string $progress
 * @property string $status
 * @property string $changed
 * @property Album $album
 */
class CImage extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(
                'album_id, name, filename, width, height, margin_left, margin_right, margin_top, margin_bottom',
                'required',
                'on' => 'insert'
            ),
            array(
                'margin_left, margin_right, margin_top, margin_bottom',
                'numerical',
                'integerOnly'=>true,
            ),
			array(
                'album_id, width, height',
                'numerical',
                'integerOnly'=>true,
                'on' => 'insert'
            ),
			array(
                'orientation',
                'length',
                'max'=>10,
                'on' => 'insert'
            ),
			array(
                'name',
                'length',
                'max'=>64
            ),
			array(
                'filename',
                'length',
                'max'=>128,
                'on' => 'insert'
            ),
			array(
                'progress',
                'length',
                'max'=>9,
                'on' => 'insert'
            ),
			array(
                'status',
                'length',
                'max'=>7,
                'on' => 'insert'
            ),
			array('id, album_id, name, filename, width, height, margin_left, margin_right, margin_top, margin_bottom, progress, status, changed', 'safe', 'on'=>'search'),
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
            'album' => array(self::BELONGS_TO,'Album','album_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'album_id' => 'Album',
			'name' => 'Имя',
			'filename' => 'Имя файла',
			'width' => 'Ширина',
			'height' => 'Высота',
			'margin_left' => 'Отступ слева',
			'margin_right' => 'Отступ справа',
			'margin_top' => 'Отступ сверху',
			'margin_bottom' => 'Отступ снизу',
			'progress' => 'Состояние',
			'status' => 'Status',
			'changed' => 'Последнее изменения',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('album_id',$this->album_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('width',$this->width);
		$criteria->compare('height',$this->height);
		$criteria->compare('margin_left',$this->margin_left);
		$criteria->compare('margin_right',$this->margin_right);
		$criteria->compare('margin_top',$this->margin_top);
		$criteria->compare('margin_bottom',$this->margin_bottom);
		$criteria->compare('progress',$this->progress,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}