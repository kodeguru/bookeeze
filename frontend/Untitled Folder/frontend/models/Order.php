<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $session_id
 * @property int $customer_id
 * @property string $order_total
 * @property int $order_status_id
 * @property int $pos_id
 * @property int $notes
 * @property string $record_status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Customer $customer
 * @property OrderStatus $orderStatus
 * @property Pos $pos
 * @property OrderItem[] $orderItems
 * @property Payment[] $payments
 */
class Order extends \yii\db\ActiveRecord
{
    CONST OPEN_ORDER = 1;
    CONST PAID_ORDER = 2;
    CONST PAID_REFUND = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
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
            [['customer_id', 'order_status_id', 'pos_id', 'notes', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['order_total'], 'number'],
            [['record_status'], 'string'],
            [['session_id'], 'string', 'max' => 40],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['order_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::className(), 'targetAttribute' => ['order_status_id' => 'id']],
            [['pos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pos::className(), 'targetAttribute' => ['pos_id' => 'id']],
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
            'customer_id' => 'Customer',
            'order_total' => 'Cart Total',
            'order_status_id' => 'Status',
            'pos_id' => 'Pos ID',
            'notes' => 'Notes',
            'record_status' => 'Record Status',
            'created_at' => 'Date',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
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
    public function getOrderStatus()
    {
        return $this->hasOne(OrderStatus::className(), ['id' => 'order_status_id']);
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
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderTotal()
    {
        $order_total = $this->hasMany(OrderItem::className(), ['order_id' => 'id'])->sum('total');
        return $order_total !== null ? $order_total : 0.00;
    }

//    public static function getOrderList()
//    {
//        $models = Order::find()->all();
//        return ArrayHelper::map($models, 'id', 'order');
//    }

}
