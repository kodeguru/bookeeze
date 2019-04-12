<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product_item".
 *
 * @property int $id
 * @property int $product_id
 * @property string $reference
 * @property string $unit_cost
 * @property int $product_item_status_id
 * @property string $start_date
 * @property string $end_date
 * @property string $description
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property InvoiceItem[] $invoiceItems
 * @property InvoiceItem[] $invoiceItems0
 * @property OrderItem[] $orderItems
 * @property Product $product
 * @property ProductItemStatus $productItemStatus
 */
class ProductItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_item';
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
            [['product_id', 'unit_cost', ], 'required'],
            [['product_id', 'product_item_status_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['unit_cost'], 'number'],
            [['start_date', 'end_date'], 'safe'],
            [['description'], 'string'],
            [['reference'], 'string', 'max' => 64],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['product_item_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductItemStatus::className(), 'targetAttribute' => ['product_item_status_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'reference' => 'Reference',
            'unit_cost' => 'Unit Cost',
            'product_item_status_id' => 'Product Item Status ID',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'description' => 'Description',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceItems()
    {
        return $this->hasMany(InvoiceItem::className(), ['product_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceItems0()
    {
        return $this->hasMany(InvoiceItem::className(), ['product_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['product_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductItemStatus()
    {
        return $this->hasOne(ProductItemStatus::className(), ['id' => 'product_item_status_id']);
    }

//    public static function getProductItemList()
//    {
//        $models = ProductItem::find()->all();
//        return ArrayHelper::map($models, 'id', 'product_item');
//    }

}
