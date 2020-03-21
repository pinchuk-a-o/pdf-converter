<?php

namespace app\commands;

use app\components\fileConverter\FileSearchHelper;
use app\services\SaveToPdfService;
use yii\console\Controller;
use yii\console\ExitCode;

class PdfConverterController extends Controller
{
    /**
     * @param string $path
     * @param string $extensions через запятую
     * @return int
     */
    public function actionIndex($path, $extensions = ''): int
    {
        $extensions = explode(',', $extensions);

        $fileSearchHelper = new FileSearchHelper();
        $foundFileDto     = $fileSearchHelper->run($path, $extensions);

        $service = new SaveToPdfService();
        $service->run($foundFileDto);

        return ExitCode::OK;
    }
}
