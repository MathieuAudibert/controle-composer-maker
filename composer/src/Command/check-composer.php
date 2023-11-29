<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use App\Service\CustomLogger; 

$translator = new Translator('fr_FR');
$translator->addLoader('yaml', new YamlFileLoader());

$translator->addResource('yaml', '/translations/trad.es.yaml', 'es');
$translator->addResource('yaml', '/translations/trad.ch.yaml', 'ch');
$translator->addResource('yaml', '/translations/trad.ps.yaml', 'ps');

$logger = new CustomLogger($logger, $translator);

$json = file_get_contents('composer.json');
$config = json_decode($json, true);

if (
    isset($config['name']) && $config['name'] !== '' &&
    isset($config['description']) && $config['description'] !== '' &&
    isset($config['require']) && !empty($config['require'])
) {
    $logger->logError('Composer.json is valid.');
    echo $translator->trans('Composer.json is valid.') . "\n";
} else {
    $logger->logError('Error in composer.json.');
    echo $translator->trans('Error in composer.json.') . "\n";
}
