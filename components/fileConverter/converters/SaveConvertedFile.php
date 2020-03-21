<?php


namespace app\components\fileConverter\converters;


use app\components\fileConverter\ConvertedFileDto;

class SaveConvertedFile
{
    /**
     * @param ConvertedFileDto $convertedFileDto
     */
    public function execute(ConvertedFileDto $convertedFileDto): void
    {
        file_put_contents($convertedFileDto->filePath . '.' . $convertedFileDto->type, $convertedFileDto->string);
    }
}