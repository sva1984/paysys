<?php
/**
 * Created by PhpStorm.
 * User: asv
 * Date: 10.07.2020
 * Time: 16:31
 */

namespace frontend\service;


use frontend\models\Payment;
use Yii;

class PaymentsService
{
    private $card;

    public function payByCard($sessionId, $card=null){
        $session = Yii::$app->session;
        /** @var Payment $payment */
        $payment = Yii::createObject(Payment::class);

        if ($session->id ==$sessionId && $card === null) {
            $payment->price = $session->get('price');
            $payment->purpose = $session->get('purpose');
            return['Введите номер карты', $payment];
        }

        if ($session->id ==$sessionId && $card != null){
            $payment->price = $session->get('price');
            $payment->purpose = $session->get('purpose');
            $payment->card_num = $card;
            $payment->date = time();
            if($this->checkCard($card)){
                $payment->save();
                return ['Покупка оплачена', $payment];
            }

            return ['Ошибка оплаты. Проверьте номер карты', $payment];
        }


    }
    /**
     * @param $this->card
     * @return bool
     */
    public function checkCard($card) {
        $this->card = str_split($card);
        foreach ($this->card as $k => $val){
            if ($k%2 === 0){
                $this->card[$k] = $this->card[$k] * 2;
                if ($this->card[$k] > 9){
                    $this->card[$k] -= 9;
                }
            }
        }
        $sumCard = array_sum($this->card);
        return ($sumCard%10 === 0);
    }
}