<?php 
// src/Service/CustomLogger.php

namespace App\Service;

use Psr\Log\LoggerInterface;

class CustomLogger
{
    private $logger;
    private $translationDirectory;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->translationDirectory = __DIR__ . '/../../translations'; // Chemin vers les fichiers de traduction
    }

    public function logInfo($lang)
    {
        $logMessage = $this->getTranslatedMessage('log_info', $lang);
        $this->logger->info($logMessage);
    }

    public function logError($lang)
    {
        $logMessage = $this->getTranslatedMessage('log_error', $lang);
        $this->logger->error($logMessage);
    }

    private function getTranslatedMessage($key, $lang)
    {
        $translationsFile = "{$this->translationDirectory}/messages.{$lang}.yaml";

        if (!file_exists($translationsFile)) {
            return "Language file for '{$lang}' not found!";
        }

        $translations = yaml_parse_file($translationsFile);

        return $translations[$key] ?? "Translation for '{$key}' not found!";
    }
}