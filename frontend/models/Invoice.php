<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id
 * @property string $session_id
 * @property int $order_id
 * @property int $customer_id
 * @property string $invoice_total
 * @property int $invoice_status_id
 * @property int $pos_id
 * @property int $notes
 * @property string $record_status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Customer $customer
 * @property InvoiceStatus $invoiceStatus
 * @property Pos $pos
 * @property Order $order
 * @property InvoiceItem[] $invoiceItems
 * @property Shipping[] $shippings
 */
class Invoice extends \yii\db\ActiveRecord
{
    CONST OPEN_INVOICE = 1;
    CONST PAID_INVOICE = 2;
    CONST REFUNDED_INVOICE = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
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
            [['order_id', 'customer_id', 'invoice_status_id', 'pos_id', 'notes', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['invoice_total'], 'number'],
            [['record_status'], 'string'],
            [['session_id'], 'string', 'max' => 40],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['invoice_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvoiceStatus::className(), 'targetAttribute' => ['invoice_status_id' => 'id']],
            [['pos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pos::className(), 'targetAttribute' => ['pos_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session_id' => 'Session ID',
            'order_id' => 'Order ID',
            'customer_id' => 'Customer ID',
            'invoice_total' => 'Invoice Total',
            'invoice_status_id' => 'Invoice Status ID',
            'pos_id' => 'Pos ID',
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
		   public function getOrder()
		   {
		       return $this->hasOne(Order::className(), ['id' => 'order_id']);
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
    public function getInvoiceStatus()
    {
        return $this->hasOne(InvoiceStatus::className(), ['id' => 'invoice_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPos()
    {
        return $this->hasOne(Pos::className(), ['id' => 'pos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceItems()
    {
        return $this->hasMany(InvoiceItem::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippings()
    {
        return $this->hasMany(Shipping::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceTotal()
    {
        $invoice_total = $this->hasMany(InvoiceItem::className(), ['invoice_id' => 'id'])->sum('total');
        return $invoice_total !== null ? $invoice_total : 0.00;
    }

//    public static function getInvoiceList()
//    {
//        $models = Invoice::find()->all();
//        return ArrayHelper::map($models, 'id', 'invoice');
//    }

}
