<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "vehicle_model".
 *
 * @property int $id
 * @property int $make_id
 * @property string $model
 *
 * @property RentalVehicle[] $rentalVehicles
 * @property VehicleMake $make
 */
class VehicleModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle_model';
    }

    // public function behaviors()
    // {
    //     return [
    //         [
    //             'class' => BlameableBehavior::className(),
    //             'createdByAttribute' => 'created_by',
    //             'updatedByAttribute' => 'updated_by',
    //         ],
    //         [
    //             'class' => TimestampBehavior::className(),
    //             'attributes' => [
    //                 ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
    //                 ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
    //             ],
    //         ],
    //     ];
    // }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['make_id', 'model'], 'required'],
            [['make_id'], 'integer'],
            [['model'], 'string', 'max' => 20],
            [['make_id'], 'exist', 'skipOnError' => true, 'targetClass' => VehicleMake::className(), 'targetAttribute' => ['make_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'make_id' => 'Make ID',
            'model' => 'Model',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentalVehicles()
    {
        return $this->hasMany(RentalVehicle::className(), ['model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMake()
    {
        return $this->hasOne(VehicleMake::className(), ['id' => 'make_id']);
    }

   public static function getVehicleModelList()
   {
       $models = VehicleModel::find()->all();
       return ArrayHelper::map($models, 'id', 'model');
   }

}
