<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "rental_vehicle".
 *
 * @property int $id
 * @property int $organization_id
 * @property string $registration_number
 * @property int $type_id
 * @property int $make_id
 * @property int $model_id
 * @property int $color_id
 * @property string $chassis
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
 * @property RentalVehicleType $type
 * @property VehicleMake $make
 * @property VehicleModel $model
 * @property Color $color
 */
class RentalVehicle extends \yii\db\ActiveRecord
{
    public $file_1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rental_vehicle';
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
            [['organization_id', 'type_id', 'description', ], 'required'],
            [['organization_id', 'type_id', 'make_id', 'model_id', 'color_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['cost'], 'number'],
            [['registration_number'], 'string', 'max' => 16],
            [['chassis'], 'string', 'max' => 40],
            [['name'], 'string', 'max' => 250],
            [['picture'], 'string', 'max' => 255],
            [['file_1'], 'file', 'skipOnEmpty' => true, 'extensions' => 'gif, png, jpg, jpeg', 'maxFiles' => 1],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RentalVehicleType::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['make_id'], 'exist', 'skipOnError' => true, 'targetClass' => VehicleMake::className(), 'targetAttribute' => ['make_id' => 'id']],
            [['model_id'], 'exist', 'skipOnError' => true, 'targetClass' => VehicleModel::className(), 'targetAttribute' => ['model_id' => 'id']],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Color::className(), 'targetAttribute' => ['color_id' => 'id']],
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
            'registration_number' => 'Registration Number',
            'type_id' => 'Type',
            'make_id' => 'Make',
            'model_id' => 'Model',
            'color_id' => 'Color',
            'chassis' => 'Chassis',
            'name' => 'Name',
            'description' => 'Description',
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
        return $this->hasMany(ProductHeader::className(), ['rental_vehicle_id' => 'id']);
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
        return $this->hasOne(RentalVehicleType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMake()
    {
        return $this->hasOne(VehicleMake::className(), ['id' => 'make_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(VehicleModel::className(), ['id' => 'model_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Color::className(), ['id' => 'color_id']);
    }

//    public static function getRentalVehicleList()
//    {
//        $models = RentalVehicle::find()->all();
//        return ArrayHelper::map($models, 'id', 'rental_vehicle');
//    }

      public function upload($file) {

          $height = 500;
          $width = 300;

          $base_name = uniqid('vehicle_');
          $filename = 'frontend/web/img/vehicle/event_image_' . $base_name . '.' . $file->extension;
          $file_path = '/frontend/web/img/vehicle/thumbnail_' . $base_name . '.' . $file->extension;
          $thumbnail = 'frontend/web/img/vehicle/thumbnail_' . $base_name . '.' . $file->extension;

          $file->saveAs($filename);

          Image::thumbnail($filename, $height, $width)
                  ->resize(new Box($height, $width))
                  ->save($thumbnail, ['quality' => 60]);
          unlink($filename);

          return $file_path;
      }
}
