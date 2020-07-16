<?php

namespace frontend\service;

use frontend\repository\PayRepository;
use Yii;
use yii\web\ForbiddenHttpException;

class PayService
{
    public function transaction($fromDate, $tillDate)
    {
        $fromDate = $this->transformToUnixDate($fromDate);
        $tillDate = $this->transformToUnixDate($tillDate);

        /** @var PayRepository $payRepository */
        $payRepository = Yii::createObject(PayRepository::class);
        $rows = $payRepository->findAllFromTill($fromDate, $tillDate);
        foreach ($rows as $key => $val) {
            $rows[$key]['date'] = date('H:m d-m-Y ', $val['date']);
        }
        return $rows;
    }

    /**
     * @param $date
     * @return false|int
     * @throws ForbiddenHttpException
     */
    private function transformToUnixDate($date)
    {
        $unixDate = strtotime($date);
        if ($unixDate == null) {
            throw new ForbiddenHttpException(
                "Ошибка. Формат даты $date - не верен");
        }
        return $unixDate;
    }

}