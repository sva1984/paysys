<?php

namespace frontend\controllers;

use frontend\models\Payment;
use frontend\service\PaymentService;
use Yii;

class CardController extends \yii\web\Controller
{
    public function actionForm($sessionId)
    {
        /** @var PaymentService $paymentService */
        $paymentService = new PaymentService();
        $model = Yii::createObject(Payment::class);
        if (Yii::$app->request->post()) {
            $card = Yii::$app->request->post()['Payment']['card_num'];
        }
            return $this->render('form', [
                'model' => $model,
                'payment' => $paymentService->payByCard($sessionId, $card),
            ]);
    }



}
