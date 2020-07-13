<?php

namespace frontend\controllers;

use frontend\models\Product;
use frontend\service\PayService;
use Yii;

class ProductController extends RestController
{
    /** @var Product */
	public $modelClass = Product::class;

	/** @var PayService */
	public $registerPay;

    /**
     * @param $price
     * @param $purposePay
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
	public function actionPay($price, $purposePay){
        $this->registerPay = Yii::createObject('frontend\service\PayService');
        return $this->registerPay->register($price, $purposePay);

	}
}
