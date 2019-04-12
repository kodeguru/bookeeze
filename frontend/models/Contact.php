<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property int $organization_id
 * @property int $type_id
 * @property string $telephone
 * @property string $mobilephone
 * @property string $website
 * @property string $email_address
 * @property string $postal_address
 * @property string $physical_address
 * @property string $map_address
 * @property int $country_id
 *
 * @property Organization $organization
 * @property ContactType $type
 * @property Country $country
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
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
            [['organization_id', 'type_id', 'country_id'], 'integer'],
            [['postal_address'], 'required'],
            [['telephone', 'mobilephone'], 'string', 'max' => 20],
            [['website', 'email_address', 'physical_address'], 'string', 'max' => 255],
            [['postal_address'], 'string', 'max' => 250],
            [['map_address'], 'string', 'max' => 500],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContactType::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
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
            'type_id' => 'Type ID',
            'telephone' => 'Telephone',
            'mobilephone' => 'Mobile',
            'website' => 'Website',
            'email_address' => 'Email Address',
            'postal_address' => 'Postal Address',
            'physical_address' => 'Physical Address',
            'map_address' => 'Map Location',
            'country_id' => 'Country ID',
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
    public function getType()
    {
        return $this->hasOne(ContactType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

//    public static function getContactList()
//    {
//        $models = Contact::find()->all();
//        return ArrayHelper::map($models, 'id', 'contact');
//    }

}
