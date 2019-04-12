<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $parent_id
 * @property int $generic_product_id
 * @property int $rental_vehicle_id
 * @property int $hotel_room_id
 * @property int $tour_id
 * @property int $restaurant_menu_id
 * @property string $name
 * @property string $description
 * @property string $unit_cost
 * @property int $quantity
 * @property int $total_sold
 * @property int $total_reserved
 * @property int $total_remaining
 * @property string $start_date
 * @property string $end_date
 * @property string $product_status
 * @property string $record_status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property RentalVehicle $rentalVehicle
 * @property HotelRoom $hotelRoom
 * @property Tour $tour
 * @property RestaurantMenu $restaurantMenu
 * @property GenericProduct $genericProduct
 * @property Product $parent
 * @property Product[] $products
 * @property ProductItem[] $productItems
 */
class Product extends \yii\db\ActiveRecord
{
    public $check_in_out_date;
    public $location_id;
    public $room_type_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
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
            [['parent_id', 'generic_product_id', 'rental_vehicle_id', 'hotel_room_id', 'tour_id', 'restaurant_menu_id', 'quantity', 'total_sold', 'total_reserved', 'total_remaining', 'created_at', 'updated_at', 'created_by', 'updated_by', 'location_id', 'room_type_id'], 'integer'],
            [['name', 'description', 'unit_cost'], 'required'],
            [['description', 'product_status', 'record_status'], 'string'],
            [['unit_cost'], 'number'],
            [['start_date', 'end_date', 'check_in_out_date'], 'safe'],
            [['name'], 'string', 'max' => 250],
            [['rental_vehicle_id'], 'exist', 'skipOnError' => true, 'targetClass' => RentalVehicle::className(), 'targetAttribute' => ['rental_vehicle_id' => 'id']],
            [['hotel_room_id'], 'exist', 'skipOnError' => true, 'targetClass' => HotelRoom::className(), 'targetAttribute' => ['hotel_room_id' => 'id']],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tour::className(), 'targetAttribute' => ['tour_id' => 'id']],
            [['restaurant_menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => RestaurantMenu::className(), 'targetAttribute' => ['restaurant_menu_id' => 'id']],
            [['generic_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => GenericProduct::className(), 'targetAttribute' => ['generic_product_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'generic_product_id' => 'Generic Product ID',
            'rental_vehicle_id' => 'Rental Vehicle ID',
            'hotel_room_id' => 'Hotel Room ID',
            'tour_id' => 'Tour ID',
            'location_id' => 'Destination',
            'room_type_id' => 'Room Type',
            'restaurant_menu_id' => 'Restaurant Menu ID',
            'name' => 'Name',
            'description' => 'Description',
            'unit_cost' => 'Unit Cost',
            'quantity' => 'Quantity',
            'total_sold' => 'Total Sold',
            'total_reserved' => 'Total Reserved',
            'total_remaining' => 'Total Remaining',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'check_in_out_date' => 'Check-in and Check-out Date',
            'product_status' => 'Product Status',
            'record_status' => 'Record Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentalVehicle()
    {
        return $this->hasOne(RentalVehicle::className(), ['id' => 'rental_vehicle_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelRoom()
    {
        return $this->hasOne(HotelRoom::className(), ['id' => 'hotel_room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurantMenu()
    {
        return $this->hasOne(RestaurantMenu::className(), ['id' => 'restaurant_menu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenericProduct()
    {
        return $this->hasOne(GenericProduct::className(), ['id' => 'generic_product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Product::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductItems()
    {
        return $this->hasMany(ProductItem::className(), ['product_id' => 'id']);
    }

    public static function setProductStatus($product_item_id, $product_status)
    {
       $product_id = ProductItem::find()
          ->where(['id' => $product_item_id])
          ->select(['product_id'])
          ->one();

       $product = Product::find(['id' => $product_id])->one();
       $product->product_status = $product_status;
       $product->save();
    }

//    public static function getProductList()
//    {
//        $models = Product::find()->all();
//        return ArrayHelper::map($models, 'id', 'product');
//    }

}
