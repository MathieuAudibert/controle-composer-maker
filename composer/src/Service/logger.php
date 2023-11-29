<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CustomLogger
{
    private $logger;
    private $translator;

    public function __construct(LoggerInterface $logger, TranslatorInterface $translator)
    {
        $this->logger = $logger;
        $this->translator = $translator;
    }

    public function logError(string $message)
    {
        $translatedMessage = $this->translator->trans($message);
        $this->logger->error($translatedMessage);
    }
}
