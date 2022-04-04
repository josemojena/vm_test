<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$containerBuilder = new ContainerBuilder();
//$containerBuilder->register('event_dispatcher', EventDispatcher::class);

$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__ . '/config'));

try {
    $loader->load('services.yaml');

    //$dispatcher = $containerBuilder->get('event_dispatcher')->addListener('order.confirmed', array());
    $application = $containerBuilder->get('application');
    $application->bootstrap();

} catch (Exception $e) {
    sprintf("Unable to load services: `%s`\n", $e->getMessage());
}


