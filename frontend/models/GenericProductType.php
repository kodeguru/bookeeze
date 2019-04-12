<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "generic_product_type".
 *
 * @property int $id
 * @property string $generic_product_type
 *
 * @property GenericProduct[] $genericProducts
 */
class GenericProductType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'generic_product_type';
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
            [['generic_product_type'], 'required'],
            [['generic_product_type'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'generic_product_type' => 'Generic Product Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenericProducts()
    {
        return $this->hasMany(GenericProduct::className(), ['type_id' => 'id']);
    }

   public static function getGenericProductTypeList()
   {
       $models = GenericProductType::find()->all();
       return ArrayHelper::map($models, 'id', 'generic_product_type');
   }

}
