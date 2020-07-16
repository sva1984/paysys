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
     * @param $fromDate
     * @param $tillDate
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function actionTransaction($fromDate, $tillDate)
    {
        /** @var PayService $payService */
        $payService = Yii::createObject(PayService::class);
        return $payService->transaction($fromDate, $tillDate);

    }
}
