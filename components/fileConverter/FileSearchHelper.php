<?php


namespace app\components\fileConverter;

/**
 * Рекурсивный поиск
 * Class FileSearchHelper
 * @package app\components\fileConverter
 */
class FileSearchHelper
{
    public function run(string $path, $extensions = []): FoundFilesDto
    {
        $extensions = array_map('trim', $extensions);

        $foundFilesDto = new FoundFilesDto();

        $foundFilesDto->pathsList[] = $path;

        for ($pathId = 0; ; ++$pathId) {
            $path = $foundFilesDto->pathsList[$pathId] ?? null;

            if ($path === null) {
                break;
            }

            $pathData = scandir($path);

            foreach ($pathData as $file) {
                if ($file === '.' || $file === '..') {
                    continue;
                }

                $filePath = $path . '/' . $file;

                if (is_file($filePath)) {
                    $ext = pathinfo($file, PATHINFO_EXTENSION);

                    if (empty($extensions) || in_array($ext, $extensions, true)) {
                        $foundFilesDto->files[] = ['fileName' => $file, 'pathId' => $pathId];
                    }
                } else {
                    $foundFilesDto->pathsList[] = $path . '/' . $file;
                }
            }
        }

        return $foundFilesDto;
    }
}