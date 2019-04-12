<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "invoice_status".
 *
 * @property int $id
 * @property string $invoice_status
 *
 * @property Invoice[] $invoices
 */
class InvoiceStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_status';
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
            [['invoice_status'], 'required'],
            [['invoice_status'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_status' => 'Invoice Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['invoice_status_id' => 'id']);
    }

//    public static function getInvoiceStatusList()
//    {
//        $models = InvoiceStatus::find()->all();
//        return ArrayHelper::map($models, 'id', 'invoice_status');
//    }

}
