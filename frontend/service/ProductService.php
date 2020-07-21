<?php

namespace frontend\service;


use Yii;
use yii\helpers\Url;

class ProductService
{

    public function register(float $price, string $purposePay)
    {
        $session = Yii::$app->session;

        if (!$session->isActive) {
            $session->open();
        }

        $session->set('price', $price);
        $session->set('purpose', $purposePay);
        $session->set('created_at', time());
        $session->close();

        return Url::to(["payments/card/form?sessionId=" . $session->id], true);
    }
}