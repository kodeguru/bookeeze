<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "refund".
 *
 * @property int $id
 * @property int $payment_id
 * @property int $customer_id
 * @property string $refund_amount
 * @property int $refund_method_id
 * @property int $notes
 * @property string $record_status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Payment $payment
 * @property Customer $customer
 * @property PaymentMethod $refundMethod
 */
class Refund extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'refund';
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
            [['payment_id', 'customer_id', 'created_at'], 'required'],
            [['payment_id', 'customer_id', 'refund_method_id', 'notes', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['refund_amount'], 'number'],
            [['record_status'], 'string'],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payment::className(), 'targetAttribute' => ['payment_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['refund_method_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethod::className(), 'targetAttribute' => ['refund_method_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_id' => 'Payment ID',
            'customer_id' => 'Customer ID',
            'refund_amount' => 'Refund Amount',
            'refund_method_id' => 'Refund Method ID',
            'notes' => 'Notes',
            'record_status' => 'Record Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Payment::className(), ['id' => 'payment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefundMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'refund_method_id']);
    }

//    public static function getRefundList()
//    {
//        $models = Refund::find()->all();
//        return ArrayHelper::map($models, 'id', 'refund');
//    }

}
