<?php


namespace app\components\fileConverter;


class FoundFilesDto
{
    /**
     * @var array $pathsList пути к файлам
     */
    public $pathsList;

    /**
     * @var array $files файлы и ссылки на pathList [['pathId' => 2, 'fileName'=> 'index.php'], ...]
     */
    public $files;
}