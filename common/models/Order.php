<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id
 * @property int $service_id
 * @property int $numb_serial
 * @property int $box
 * @property int $code
 * @property int $degree_wear
 * @property string $defects
 * @property string $warning
 * @property string $date_receipt
 * @property string $date_issue
 * @property int $status
 * @property int $pay_type
 * @property int $pay_status
 * @property int $shipment
 * @property int $price
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'service_id', 'degree_wear', 'status', 'pay_type', 'pay_status', 'price'], 'required'],
            [['user_id', 'service_id', 'numb_serial', 'box', 'code', 'degree_wear', 'status', 'pay_type', 'pay_status', 'shipment', 'price'], 'integer'],
            [['defects', 'warning'], 'string'],
            [['date_receipt', 'date_issue'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'service_id' => 'Service ID',
            'numb_serial' => 'Numb Serial',
            'box' => 'Box',
            'code' => 'Code',
            'degree_wear' => 'Degree Wear',
            'defects' => 'Defects',
            'warning' => 'Warning',
            'date_receipt' => 'Date Receipt',
            'date_issue' => 'Date Issue',
            'status' => 'Status',
            'pay_type' => 'Pay Type',
            'pay_status' => 'Pay Status',
            'shipment' => 'Shipment',
            'price' => 'Price',
        ];
    }
}
