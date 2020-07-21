<?php

namespace frontend\controllers;

use frontend\models\Product;
use frontend\service\ProductService;
use Yii;

class ProductController extends RestController
{
    /** @var Product */
    public $modelClass = Product::class;

    /** @var ProductService */
    public $registerPay;


    public function __construct(
        $id,
        $module,
        ProductService $registerPay,
        array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->registerPay = $registerPay;
    }

    /**
     * @param $price
     * @param $purposePay
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    public function actionPay($price, $purposePay)
    {
        return $this->registerPay->register($price, $purposePay);
    }
}
