<?php

declare(strict_types=1);

namespace App\Handlers;

class FormHandler implements HandlerInterface
{
    private const FILE_DIR = __DIR__ . '/../../files/';
    private array $file;
    private string $delimeter;

    public function __construct(array $file, string $delimeter)
    {
        $this->delimeter = $delimeter;
        $this->file = $file;
    }

    public function handle(): string
    {
        $filename = $this->uploadFile();
        $content = trim(file_get_contents($filename));
        $splitedContent = preg_split('/' . $this->delimeter . '/', $content, -1, PREG_SPLIT_NO_EMPTY);

        $response = [];

        foreach ($splitedContent as $line) {
            $response[$line] = strlen($line);
        }

        return json_encode($response, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES, 512);
    }

    private function uploadFile(): string
    {
        if (!is_dir(self::FILE_DIR)) {
            mkdir(self::FILE_DIR);
        }

        $filename = self::FILE_DIR . md5(microtime()) . $this->file['name'];

        move_uploaded_file($this->file['tmp_name'], $filename);

        return $filename;
    }

}