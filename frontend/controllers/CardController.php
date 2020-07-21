<?php

namespace frontend\controllers;

use frontend\models\Payment;
use frontend\service\CardService;
use Yii;

class CardController extends \yii\web\Controller
{
    /** @var CardService $cardService */
    public $cardService;

    /** @var Payment $payment */
    public $payment;

    public function __construct(
        $id,
        $module,
        CardService $cardService,
        Payment $payment,
        array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->cardService = $cardService;
        $this->payment = $payment;
    }

    /**
     * @param $sessionId
     * @return string
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\ForbiddenHttpException
     */
    public function actionForm(string $sessionId)
    {
        if (Yii::$app->request->post()) {
            $card = Yii::$app->request->post()['Payment']['card_num'];
        }

        return $this->render('form', [
            'model' => $this->payment,
            'payment' => $this->cardService->payByCard($sessionId, $card),
        ]);
    }
}
