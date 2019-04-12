<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "shipping".
 *
 * @property int $id
 * @property int $invoice_id
 * @property int $payment_id
 * @property string $shipping_address
 * @property string $notes
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Invoice $invoice
 * @property Payment $payment
 */
class Shipping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping';
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
            [['invoice_id', 'created_at', 'created_by'], 'required'],
            [['invoice_id', 'payment_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['notes'], 'string'],
            [['shipping_address'], 'string', 'max' => 500],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payment::className(), 'targetAttribute' => ['payment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Invoice ID',
            'payment_id' => 'Payment ID',
            'shipping_address' => 'Shipping Address',
            'notes' => 'Notes',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Payment::className(), ['id' => 'payment_id']);
    }

//    public static function getShippingList()
//    {
//        $models = Shipping::find()->all();
//        return ArrayHelper::map($models, 'id', 'shipping');
//    }

}
