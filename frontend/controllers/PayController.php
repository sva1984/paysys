<?php

namespace frontend\controllers;

use frontend\models\Payment;
use frontend\service\CardService;
use Yii;

class PayController extends RestController
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
//	    $paymentService = Yii::createObject(PaymentService::class);
//	    return $paymentService->payByCard($sessionId, $card);
	}
}
