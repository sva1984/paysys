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

        $url =  "http://paysys/card/form?sessionId=" . $this->session->id;
        $urlRest =  "http://paysys/pay/card?sessionId=" . $this->session->id;
        $this->session->close();
        return ['Form' => $url, 'Rest' => $urlRest];
    }

}