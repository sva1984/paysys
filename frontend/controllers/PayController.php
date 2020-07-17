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
    /**
     * @OA\Info(
     *   title="My first API",
     *   version="1.0.0",
     *   @OA\Contact(
     *     email="support@example.com"
     *   )
     * )
     */
    public function actionTransaction($fromDate, $tillDate)
    {
        /** @var PayService $payService */
        $payService = Yii::createObject(PayService::class);
        return $payService->transaction($fromDate, $tillDate);

    }
}
