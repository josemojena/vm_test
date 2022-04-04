<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__ . '/config'));

try {
    $loader->load('services.yaml');
    $application = $containerBuilder->get('application');
    $application->bootstrap();

} catch (Exception $e) {
    sprintf("Unable to load services: `%s`\n", $e->getMessage());
}


