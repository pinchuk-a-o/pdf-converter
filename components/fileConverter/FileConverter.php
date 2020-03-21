<?php


namespace app\components\fileConverter;


use app\components\fileConverter\converters\IFileToTypeConverter;
use app\exceptions\FileNotFoundException;

/**
 * Конвертирует файл в указанный фрмат
 * Class Converter
 * @package app\components\fileConverter
 */
class FileConverter
{
    public const PDF = 'Pdf';

    /**
     * @param $filePath
     * @param $toType
     * @return ConvertedFileDto
     * @throws FileNotFoundException
     */
    public function execute($filePath, $toType): ConvertedFileDto
    {
        if (!file_exists($filePath)) {
            throw new FileNotFoundException('FileNotFoundException: ' . $filePath);
        }

        $class = 'app\components\fileConverter\converters\\' . $toType . 'Converter';

        /** @var IFileToTypeConverter $converter */
        $converter = new $class;

        return $converter->run($filePath);
    }
}