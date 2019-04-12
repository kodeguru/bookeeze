<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "generic_product".
 *
 * @property int $id
 * @property int $organization_id
 * @property int $type_id
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
 * @property GenericProductType $type
 * @property ProductHeader[] $productHeaders
 */
class GenericProduct extends \yii\db\ActiveRecord
{
    public $file_1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'generic_product';
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
            [['organization_id', 'type_id', 'name', 'description', ], 'required'],
            [['organization_id', 'type_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['cost'], 'number'],
            [['name'], 'string', 'max' => 250],
            [['picture'], 'string', 'max' => 255],
            [['file_1'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 1],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => GenericProductType::className(), 'targetAttribute' => ['type_id' => 'id']],
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
            'type_id' => 'Type',
            'name' => 'Name',
            'description' => 'Description',
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
    public function getType()
    {
        return $this->hasOne(GenericProductType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductHeaders()
    {
        return $this->hasMany(ProductHeader::className(), ['generic_product_id' => 'id']);
    }

//    public static function getGenericProductList()
//    {
//        $models = GenericProduct::find()->all();
//        return ArrayHelper::map($models, 'id', 'generic_product');
//    }

    public function upload($file)
    {
        $height = 500;
        $width = 300;

        $base_name = uniqid('generic_')  . '.' . $file->extension;
        $filename = 'frontend/web/img/generic/' . $base_name;
        $file_path = '/frontend/web/img/generic/' . $base_name;
        $thumbnail = 'frontend/web/img/generic/' . $base_name;

        $file->saveAs($filename);

        Image::thumbnail($filename, $height, $width)
                ->resize(new Box($height, $width))
                ->save($thumbnail, ['quality' => 60]);
        // unlink($filename);

        return $file_path;
    }

}
