<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property string $price
 * @property string $order_date
 * @property string $description
 * @property string $delivery_date
 * @property integer $arrived_in
 * @property string $paid_with
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * Relationship with Shipments
     */
    public function getShipments()
    {
        return $this->hasMany(Shipment::className(), ['order_id' => 'id']);
    }

    /**
     * Relationship with PaymentMethod
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'paid_with']);
    }

    /**
     * TimestampBehavior & BlameableBehavior to update created_* and updated_* fields
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'order_date'], 'required'],
            [['order_date', 'delivery_date'], 'safe'],
            [['price'], 'string', 'max' => 6],
            [['description'], 'string', 'max' => 48],
            [['paid_with'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price' => 'Price',
            'order_date' => 'Order Date',
            'description' => 'Description',
            'delivery_date' => 'Delivery Date',
            'arrived_in' => 'Arrived In',
            'paid_with' => 'Paid With',
            'created_by' => 'Created by',
            'created_at' => 'Created at',
            'updated_by' => 'Updated by',
            'updated_at' => 'Updated at',
        ];
    }
}