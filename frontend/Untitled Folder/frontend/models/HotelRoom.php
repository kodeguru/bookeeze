<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "hotel_room".
 *
 * @property int $id
 * @property int $organization_id
 * @property int $room_type_id
 * @property string $name
 * @property string $description
 * @property string $picture
 * @property string $cost
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Organization $organization
 * @property HotelRoomType $roomType
 * @property ProductHeader[] $productHeaders
 */
class HotelRoom extends \yii\db\ActiveRecord
{
    public $file_1;
    public $location_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotel_room';
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
            [['organization_id', 'room_type_id', 'name', 'description'], 'required'],
            [['organization_id', 'room_type_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'location_id'], 'integer'],
            [['description'], 'string'],
            [['cost'], 'number'],
            [['name'], 'string', 'max' => 250],
            [['picture'], 'string', 'max' => 255],
            [['file_1'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 1],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
            [['room_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => HotelRoomType::className(), 'targetAttribute' => ['room_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'organization_id' => 'Organization',
            'room_type_id' => 'Room Type',
            'name' => 'Name',
            'description' => 'Description',
            'location_id' => 'Destination',
            'file_1' => 'Picture',
            'picture' => 'Picture',
            'cost' => 'Cost',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomType()
    {
        return $this->hasOne(HotelRoomType::className(), ['id' => 'room_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHeaders()
    {
        return $this->hasMany(ProductHeader::className(), ['hotel_room_id' => 'id']);
    }

//    public static function getHotelRoomList()
//    {
//        $models = HotelRoom::find()->all();
//        return ArrayHelper::map($models, 'id', 'hotel_room');
//    }

    public function upload($file) {
        $base_name = uniqid('hotel_');
        $filename = 'frontend/web/img/hotel/' . $base_name . '.' . $file->extension;
        $file_path = '/frontend/web/img/hotel/' . $base_name . '.' . $file->extension;

        $truth = $file->saveAs($filename);
        // unlink($filename);

        return $file_path;
    }

    public static function getAvailableHotelRoomList($daterange)
    {
          $dates = explode(" - ", $daterange);
          $startdate = $dates[0];
          $enddate = $dates[1];

          $sql = "

              select hotel_room.*
              from hotel_room hotel_room
                left join product
                  on hotel_room.id = product.hotel_room_id
                    and product_status not in ('prospecting')
                    and (start_date between :start_date and :end_date
                      or end_date between :start_date and :end_date
                      or start_date between :start_date and :end_date)
              where start_date is null

              ";

          $room = Product::findBySql($sql,
              [
                  ':start_date' => $startdate,
                  ':end_date' => $enddate,
              ])->asArray()->all();

          return $room;

    }

}
