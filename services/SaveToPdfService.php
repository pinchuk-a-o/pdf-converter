<?php


namespace app\services;


use app\components\fileConverter\converters\SaveConvertedFile;
use app\components\fileConverter\FileConverter;
use app\components\fileConverter\FoundFilesDto;

/**
 * Переводит полученные файлы в pdf и сохраняет в каталоге оригинала
 * Class SaveToPdfService
 * @package app\services
 */
class SaveToPdfService
{
    public function run(FoundFilesDto $foundFilesDto): void
    {
        $converter = new FileConverter();
        foreach ($foundFilesDto->files as $file) {
            $path     = $foundFilesDto->pathsList[$file['pathId']];
            $fileName = $file['fileName'];

            $filePath = $path . '/' . $fileName;
            $convertedFileDto  = $converter->execute($filePath, FileConverter::PDF);

            $saver = new SaveConvertedFile();
            $saver->execute($convertedFileDto);
        }
    }
}