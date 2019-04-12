<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "vehicle_make".
 *
 * @property int $id
 * @property string $make
 *
 * @property RentalVehicle[] $rentalVehicles
 * @property VehicleModel[] $vehicleModels
 */
class VehicleMake extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle_make';
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
            [['make'], 'required'],
            [['make'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'make' => 'Make',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentalVehicles()
    {
        return $this->hasMany(RentalVehicle::className(), ['make_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicleModels()
    {
        return $this->hasMany(VehicleModel::className(), ['make_id' => 'id']);
    }

   public static function getVehicleMakeList()
   {
       $models = VehicleMake::find()->all();
       return ArrayHelper::map($models, 'id', 'make');
   }

}
