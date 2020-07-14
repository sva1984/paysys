<?php

namespace frontend\service;


use Yii;

class ProductService
{
    private $session;

    public function register($price, $purposePay, $card=null){
        $this->session = Yii::$app->session;
        if (!$this->session->isActive) {
            $this->session->open();
        }
        $this->session->set('price', $price);
        $this->session->set('purpose', $purposePay);
        $this->session->set('card', $card);

        $this->session->close();
        return "http://payment.loc/card/form?sessionId=" . $this->session->id;
    }

}