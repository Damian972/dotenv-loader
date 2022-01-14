<?php

namespace Damian972\DotenvLoader;

class Dotenv
{
    protected string $envFilePath;

    public function __construct(string $folderPath, string $fileName = '.env')
    {
        $this->envFilePath = "{$folderPath}/{$fileName}";
        if (!is_readable($this->envFilePath)) {
            throw new \Exception('File not found or not readable');
        }
    }

    public function load(): void
    {
        $lines = file($this->envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (str_contains($line, '#')) {
                continue;
            }

            [$variableName, $variableValue] = explode('=', trim($line), 2);
            if (null === $variableValue) {
                continue;
            }

            if (!isset($_SERVER[$variableName]) && !isset($_ENV[$variableName])) {
                putenv("{$variableName}={$variableValue}");
                $_SERVER[$variableName] = $variableValue;
                $_ENV[$variableName] = $variableValue;
            }
        }
    }
}
