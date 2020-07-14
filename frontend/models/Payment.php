<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property string $card_num
 * @property string $purpose
 * @property float $price
 * @property int $date
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_num', 'purpose', 'price', 'date'], 'required'],
            [['price'], 'number'],
            [['date', 'card_num'], 'integer'],
            [['card_num'], 'string', 'max' => 40],
            [['purpose'], 'string', 'max' => 360],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'card_num' => 'Card Num',
            'purpose' => 'Purpose',
            'price' => 'Price',
            'date' => 'Date',
        ];
    }
}
