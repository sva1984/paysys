<?php
namespace frontend\repository;

use yii\db\Query;

class PayRepository
{
    public function findAllFromTill(int $fromDate, int $tillDate)
    {
        $rows = (new Query())
            ->select('*')
            ->from('payment')
            ->where(['and', "date>$fromDate", "date<$tillDate"])
            ->all();
        return $rows;
    }

}