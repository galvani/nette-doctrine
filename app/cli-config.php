<?php
//require_once __DIR__ . '/../libs/Doctrine/Doctrine/Common/ClassLoader.php';

$config = new \Doctrine\ORM\Configuration();
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Proxies');
$driverImpl = new \Doctrine\ORM\Mapping\Driver\YamlDriver(dirname(__FILE__) . '/doctrine/schema');
$config->setMetadataDriverImpl($driverImpl);

$connectionOptions = array(
    'driver'	=> 'pdo_mysql',
    'user'	=> 'root',
    'password'	=> '',
    'host'	=> 'localhost',
    'dbname'	=> 'nettebox',
);


$em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));