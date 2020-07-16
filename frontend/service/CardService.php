<?php


namespace frontend\service;

use frontend\models\Payment;
use Yii;
use yii\web\ForbiddenHttpException;

class CardService
{
    private $card;

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
        /** @var Payment $payment */
        $payment = Yii::createObject(Payment::class);

        if (!isset($session['price']) || !isset($session['purpose'])) {
            throw new ForbiddenHttpException(
                'Ошибка. Отсутсвует цена или назначение платежа');
        }

        if (isset($session['created_at']) && (time() - $session['created_at']) > 1800) {
            $session->destroy();
            throw new ForbiddenHttpException(
                'Ошибка. Время жизни платёжной сессии истекло. Выберите товары снова.');
        }


        if ($session->id == $sessionId && $card === null) {
            $payment->price = $session->get('price');
            $payment->purpose = $session->get('purpose');
            $payment->date = $session->get('created_at');
            return ['Введите номер карты', $payment];
        }

        if ($session->id == $sessionId && $card != null) {
            $payment->card_num = $card;
            if ($this->checkCard($card)) {
                $payment->save();
                $session->destroy();
                return ['Покупка оплачена', $payment];
            }

            return ['Ошибка оплаты. Проверьте номер карты', $payment];
        }
    }

    /**
     * @param $card
     * @return bool
     */
    public function checkCard($card)
    {
        $this->card = str_split($card);
        foreach ($this->card as $k => $val) {
            if ($k % 2 === 0) {
                $this->card[$k] = $this->card[$k] * 2;
                if ($this->card[$k] > 9) {
                    $this->card[$k] -= 9;
                }
            }
        }
        $sumCard = array_sum($this->card);
        return ($sumCard % 10 === 0);
    }
}