<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "rental_vehicle_type".
 *
 * @property int $id
 * @property string $rental_vehicle_type
 *
 * @property RentalVehicle[] $rentalVehicles
 */
class RentalVehicleType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rental_vehicle_type';
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
            [['rental_vehicle_type'], 'required'],
            [['rental_vehicle_type'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rental_vehicle_type' => 'Rental Vehicle Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentalVehicles()
    {
        return $this->hasMany(RentalVehicle::className(), ['type_id' => 'id']);
    }

   public static function getRentalVehicleTypeList()
   {
       $models = RentalVehicleType::find()->all();
       return ArrayHelper::map($models, 'id', 'rental_vehicle_type');
   }

}
