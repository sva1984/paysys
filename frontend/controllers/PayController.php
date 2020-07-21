<?php

namespace frontend\controllers;

use frontend\models\Payment;
use frontend\service\PayService;

class PayController extends RestController
{
    /** @var Payment */
    public $modelClass = Payment::class;

    /** @var PayService $payService */
    public $payService;

    public function __construct(
        $id,
        $module,
        PayService $payService,
        array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->payService = $payService;
    }

    /**
     * @param $from
     * @param $till
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function actionTransaction(string $from, string $till)
    {
        return $this->payService->transaction($from, $till);
    }
}
