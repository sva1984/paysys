<?php


namespace frontend\service;

use frontend\models\Payment;
use Yii;
use yii\web\ForbiddenHttpException;

class CardService
{
    /** @var Payment $payment */
    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * @param $sessionId
     * @param null $card
     * @return array
     * @throws ForbiddenHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function payByCard($sessionId, $card = null)
    {
        $session = Yii::$app->session;

        if (!isset($session['price']) || !isset($session['purpose'])) {
            throw new ForbiddenHttpException(
                'Ошибка. Отсутсвует цена или назначение платежа');
        }

        if (isset($session['created_at']) && (time() - $session['created_at']) > 1800) {
            $session->destroy();
            throw new ForbiddenHttpException(
                'Ошибка. Время жизни платёжной сессии истекло. Выберите товары снова.');
        }


        if ($session->id == $sessionId && $card == null) {
            $this->payment->price = $session->get('price');
            $this->payment->purpose = $session->get('purpose');
            $this->payment->date = $session->get('created_at');
            return ['Введите номер карты', $this->payment];
        }

        if ($session->id == $sessionId && $card != null) {
            $this->payment->price = $session->get('price');
            $this->payment->purpose = $session->get('purpose');
            $this->payment->date = $session->get('created_at');
            $this->payment->card_num = $card;
            if ($this->checkCard($card)) {
                $this->payment->save();
                $session->destroy();
                return ['Покупка оплачена', $this->payment];
            }

            return ['Ошибка оплаты. Проверьте номер карты', $this->payment];
        }
    }

    /**
     * @param $card
     * @return bool
     */
    public function checkCard($card)
    {
        $card = str_split($card);
        foreach ($card as $k => $val) {
            if ($k % 2 === 0) {
                $card[$k] = $card[$k] * 2;
                if ($card[$k] > 9) {
                    $card[$k] -= 9;
                }
            }
        }
        $sumCard = array_sum($card);
        return ($sumCard % 10 === 0);
    }
}