<?php

namespace frontend\controllers;

use frontend\models\Payment;
use frontend\service\PaymentsService;
use Yii;

class PaymentController extends RestController
{
    /** @var Payment */
	public $modelClass = Payment::class;

    /**
     * @param $sessionId
     * @param null $card
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
	public function actionCard($sessionId, $card=null){
	    $paymentService = Yii::createObject(PaymentsService::class);
	    return $paymentService->payByCard($sessionId, $card);



//        $this->modelClass->price = $session->get('price');
//        $this->modelClass->purpose = $session->get('purpose');
//        $card = "1111222233334444";
//        $cardService = new PaymentsService();
//
//        if($cardService->checkCard($card)){
//            $this->modelClassl->card_num = $card;
//            $this->modelClass->date = 1324567;
//            $this->modelClass->save();
//            return "Операция оплаты прошла успешно";
//        }
//        return "Ошибка. Проверьте номер карты";
	}
}
