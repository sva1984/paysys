<?php
/**
 * Created by PhpStorm.
 * User: asv
 * Date: 16.07.2020
 * Time: 15:48
 */

namespace console\controllers;


use OpenApi\Annotations\OpenApi;
use yii\console\Controller;
use Yii;
use yii\console\ExitCode;
use yii\helpers\Console;
use function OpenApi\scan;

class DefaultController extends Controller
{
    public function actionSwagger()
    {
        $openApi = scan('frontend\controllers');
        $file = Yii::getAlias('frontend\web\documentation\swagger.yaml');

        $handle = fopen($file, 'wb');
        fwrite($handle, $openApi->toYaml());
        fclose($handle);

        echo $this->ansiFormat("Created \n", Console::FG_BLUE);

        return ExitCode::OK;
    }
}
