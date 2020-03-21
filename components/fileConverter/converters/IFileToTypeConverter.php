<?php


namespace app\components\fileConverter\converters;


use app\components\fileConverter\ConvertedFileDto;

interface IFileToTypeConverter
{
    public function run($filePath): ConvertedFileDto;
}