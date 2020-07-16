<?php

namespace frontend\controllers;

use frontend\models\Payment;
use frontend\service\CardService;
use Yii;

class CardController extends \yii\web\Controller
{
    /**
     * @param $sessionId
     * @return string
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\ForbiddenHttpException
     */
    public function actionForm($sessionId)
    {
        /** @var CardService $cardService */
        $cardService = Yii::createObject(CardService::class);
        $model = Yii::createObject(Payment::class);
        if (Yii::$app->request->post()) {
            $card = Yii::$app->request->post()['Payment']['card_num'];
        }
            return $this->render('form', [
                'model' => $model,
                'payment' => $cardService->payByCard($sessionId, $card),
            ]);
    }
}
