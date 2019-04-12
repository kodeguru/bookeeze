<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int $invoice_id
 * @property string $session_id
 * @property int $customer_id
 * @property string $due
 * @property string $tendered
 * @property string $change
 * @property int $payment_method_id
 * @property string $payment_status
 * @property int $notes
 * @property string $record_status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Invoice $invoice
 * @property Customer $customer
 * @property PaymentMethod $paymentMethod
 * @property Refund[] $refunds
 * @property Shipping[] $shippings
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
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
            [['invoice_id', 'session_id', ], 'required'],
            [['invoice_id', 'customer_id', 'payment_method_id', 'notes', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['due', 'tendered', 'change'], 'number'],
            [['payment_status', 'record_status'], 'string'],
            [['session_id'], 'string', 'max' => 40],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['payment_method_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethod::className(), 'targetAttribute' => ['payment_method_id' => 'id']],
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
            'session_id' => 'Session ID',
            'customer_id' => 'Customer ID',
            'due' => 'Due Amount',
            'tendered' => 'Paid Amount',
            'change' => 'Change',
            'payment_method_id' => 'Payment Method ID',
            'payment_status' => 'Payment Status',
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
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
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
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'payment_method_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefunds()
    {
        return $this->hasMany(Refund::className(), ['payment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippings()
    {
        return $this->hasMany(Shipping::className(), ['payment_id' => 'id']);
    }

//    public static function getPaymentList()
//    {
//        $models = Payment::find()->all();
//        return ArrayHelper::map($models, 'id', 'payment');
//    }

}
