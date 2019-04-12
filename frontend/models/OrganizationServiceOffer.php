<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "organization_service_offer".
 *
 * @property int $id
 * @property int $organization_id
 * @property int $service_offer_id
 *
 * @property Organization $organization
 * @property ServiceOffer $serviceOffer
 */
class OrganizationServiceOffer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization_service_offer';
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
            [['organization_id', 'service_offer_id'], 'required'],
            [['organization_id', 'service_offer_id'], 'integer'],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
            [['service_offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceOffer::className(), 'targetAttribute' => ['service_offer_id' => 'id']],
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
            'service_offer_id' => 'Service Offer',
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
    public function getServiceOffer()
    {
        return $this->hasOne(ServiceOffer::className(), ['id' => 'service_offer_id']);
    }

//    public static function getOrganizationServiceOfferList()
//    {
//        $models = OrganizationServiceOffer::find()->all();
//        return ArrayHelper::map($models, 'id', 'organization_service_offer');
//    }

}
