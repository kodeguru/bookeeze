<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "pos".
 *
 * @property int $id
 * @property int $organization_id
 * @property string $session_id
 * @property string $start_date
 * @property string $end_date
 * @property string $opening_balance
 * @property string $closing_balance
 * @property string $total_orders
 * @property string $total_invoices
 * @property string $total_payments
 * @property string $total_refunds
 * @property string $record_status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property Invoice[] $invoices
 * @property Order[] $orders
 */
class Pos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pos';
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
            [['organization_id', 'session_id', 'start_date', ], 'required'],
            [['organization_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['opening_balance', 'closing_balance', 'total_orders', 'total_invoices', 'total_payments', 'total_refunds'], 'number'],
            [['record_status'], 'string'],
            [['session_id'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'organization_id' => 'Organization ID',
            'session_id' => 'Session ID',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'opening_balance' => 'Opening Balance',
            'closing_balance' => 'Closing Balance',
            'total_orders' => 'Total Orders',
            'total_invoices' => 'Total Invoices',
            'total_payments' => 'Total Payments',
            'total_refunds' => 'Total Refunds',
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
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['pos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['pos_id' => 'id']);
    }

//    public static function getPosList()
//    {
//        $models = Pos::find()->all();
//        return ArrayHelper::map($models, 'id', 'pos');
//    }

}
