<?php

namespace frontend\service;


use Yii;

class PayService
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

        $url =  "http://paysys/payment/card?sessionId=" . $this->session->id;
        $this->session->close();
        return $url;
    }

}