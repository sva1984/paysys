<?php

namespace frontend\controllers;

use frontend\models\Payment;
use frontend\service\PaymentService;
use Yii;

class PaymentController extends RestController
{
    /** @var Payment */
	public $modelClass = Payment::class;

    /**
     * @param $sessionId
     * @param null $card
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
	public function actionCard($sessionId, $card=null){
	    $paymentService = Yii::createObject(PaymentService::class);
	    return $paymentService->payByCard($sessionId, $card);
	}
}
