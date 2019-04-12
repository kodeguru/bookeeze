<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;


/**
 * This is the model class for table "organization".
 *
 * @property int $id
 * @property int $parent_id
 * @property int $type_id
 * @property string $name
 * @property string $description
 * @property string $logo
 * @property string $picture
 * @property string $record_status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Contact[] $contacts
 * @property GenericProduct[] $genericProducts
 * @property HotelRoom[] $hotelRooms
 * @property Organization $parent
 * @property Organization[] $organizations
 * @property OrganizationType $type
 * @property RentalVehicle[] $rentalVehicles
 * @property RestaurantMenu[] $restaurantMenus
 * @property Tour[] $tours
 * @property UserProfile[] $userProfiles
 */
class Organization extends \yii\db\ActiveRecord
{
    public $file_1;
    public $file_2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization';
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
            [['parent_id', 'type_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['type_id', 'name', 'description',], 'required'],
            [['description', 'record_status'], 'string'],
            [['file_1', 'file_2'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 1],
            [['name', 'logo', 'picture'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent Organization',
            'type_id' => 'Business Type',
            'name' => 'Name',
            'description' => 'Description',
            'logo' => 'Logo',
            'picture' => 'Picture',
            'file_1' => 'Logo',
            'file_2' => 'Picture',
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
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['organization_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenericProducts()
    {
        return $this->hasMany(GenericProduct::className(), ['organization_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelRooms()
    {
        return $this->hasMany(HotelRoom::className(), ['organization_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Organization::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizations()
    {
        return $this->hasMany(Organization::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(OrganizationType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentalVehicles()
    {
        return $this->hasMany(RentalVehicle::className(), ['organization_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurantMenus()
    {
        return $this->hasMany(RestaurantMenu::className(), ['organization_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTours()
    {
        return $this->hasMany(Tour::className(), ['organization_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['organization_id' => 'id']);
    }

//    public static function getOrganizationList()
//    {
//        $models = Organization::find()->all();
//        return ArrayHelper::map($models, 'id', 'organization');
//    }

    public function upload($file) {

        $base_name = uniqid('biz_');
        $filename = 'frontend/web/img/organization/' . $base_name . '.' . $file->extension;
        $file_path = '/frontend/web/img/organization/' . $base_name . '.' . $file->extension;

        $truth = $file->saveAs($filename);
        // unlink($filename);

        return $file_path;
    }

}
