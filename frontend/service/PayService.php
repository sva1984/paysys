<?php

namespace frontend\service;

use frontend\repository\PayRepository;
use Yii;

class PayService
{
    public function transaction($fromDate, $tillDate){
        $fromDate = $this->transformToUnixDate($fromDate);
        $tillDate = $this->transformToUnixDate($tillDate);

        /** @var PayRepository $payRepository */
        $payRepository = Yii::createObject(PayRepository::class);
        $rows = $payRepository->findAllFromTill($fromDate, $tillDate);
        foreach ($rows as $key => $val){
            $rows[$key]['date'] = date('H:m d-m-Y ', $val['date']);
        }
        return $rows;
    }

    private function transformToUnixDate($date){
        return strtotime($date);
    }

}