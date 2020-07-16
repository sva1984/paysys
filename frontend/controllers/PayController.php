<?php

namespace frontend\controllers;

use frontend\models\Payment;
use frontend\service\PayService;
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
	public function actionTransaction($fromDate, $tillDate){
	    /** @var PayService $payService */
	    $payService = Yii::createObject(PayService::class);
	    return $payService->transaction($fromDate, $tillDate);

	}
}
