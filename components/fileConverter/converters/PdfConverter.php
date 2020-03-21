<?php


namespace app\components\fileConverter\converters;


use app\components\fileConverter\ConvertedFileDto;
use app\components\fileConverter\FileConverter;
use kartik\mpdf\Pdf;

class PdfConverter implements IFileToTypeConverter
{
    public function run($filePath): ConvertedFileDto
    {
        $content = file_get_contents($filePath);

        $pdf = new Pdf([
            'mode'        => Pdf::MODE_CORE,
            'format'      => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_STRING,
            'content'     => $content,
            'methods'     => [
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        $convertedFile           = new ConvertedFileDto();
        $convertedFile->string   = $pdf->render();
        $convertedFile->filePath = $filePath;
        $convertedFile->type     = FileConverter::PDF;

        return $convertedFile;
    }
}