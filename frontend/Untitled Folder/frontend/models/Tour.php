<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "tour".
 *
 * @property int $id
 * @property int $organization_id
 * @property int $type_id
 * @property string $name
 * @property string $description
 * @property string $picture
 * @property string $cost
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property ProductHeader[] $productHeaders
 * @property Organization $organization
 * @property TourType $type
 */
class Tour extends \yii\db\ActiveRecord
{
    public $file_1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour';
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organization_id', 'type_id', 'name', 'description',], 'required'],
            [['organization_id', 'type_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['cost'], 'number'],
            [['file_1'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 1],
            [['name'], 'string', 'max' => 250],
            [['picture'], 'string', 'max' => 255],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TourType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'organization_id' => 'Organization',
            'type_id' => 'Type',
            'name' => 'Name',
            'description' => 'Description',
            'file_1' => 'Picture',
            'picture' => 'Picture',
            'cost' => 'Cost',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHeaders()
    {
        return $this->hasMany(ProductHeader::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TourType::className(), ['id' => 'type_id']);
    }

//    public static function getTourList()
//    {
//        $models = Tour::find()->all();
//        return ArrayHelper::map($models, 'id', 'tour');
//    }

    public function upload($file) {

        $base_name = uniqid('tour_');
        $filename = 'frontend/web/img/tour/' . $base_name . '.' . $file->extension;
        $file_path = '/frontend/web/img/tour/' . $base_name . '.' . $file->extension;

        $truth = $file->saveAs($filename);
        // unlink($filename);

        return $file_path;
    }

}
