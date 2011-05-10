<?php

/**
 * My Application bootstrap file.
 */
error_reporting(E_ALL);

use Nette\Diagnostics\Debugger;
use Nette\Environment;
use Nette\Application\Routers\Route;


// Load Nette Framework
// this allows load Nette Framework classes automatically so that
// you don't have to litter your code with 'require' statements
require LIBS_DIR . '/Nette/loader.php';

Debugger::$strictMode = TRUE;
Debugger::enable();


// Load configuration from config.neon file
Environment::loadConfig();

$config = new \Doctrine\ORM\Configuration(); // (2)

// Proxy Configuration (3)
$config->setProxyDir(__DIR__.'/lib/MyProject/Proxies');
$config->setProxyNamespace('MyProject\Proxies');
$config->setAutoGenerateProxyClasses(!Environment::isProduction());

// Mapping Configuration (4)
$driverImpl = new \Doctrine\ORM\Mapping\Driver\YamlDriver(dirname(__FILE__) . '/doctrine/schema');
$config->setMetadataDriverImpl($driverImpl);

// Caching Configuration (5)
if (!Environment::isProduction()) {
    $cache = new \Doctrine\Common\Cache\ArrayCache();
} else {
    $cache = new \Doctrine\Common\Cache\ApcCache();
}
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

// database configuration parameters (6)
$conn = array(
    'driver'	=> 'pdo_mysql',
    'user'	=> 'root',
    'password'	=> '',
    'host'	=> 'localhost',
    'dbname'	=> 'dobrapojistka',
    'data_fixtures_path' => dirname(__FILE__) . '/doctrine/data/fixtures',
    'models_path'        => dirname(__FILE__) . '/models',
    'migrations_path'    => dirname(__FILE__) . '/doctrine/migrations',
    'sql_path'           => dirname(__FILE__) . '/doctrine/data/sql',
    'yaml_schema_path'   => dirname(__FILE__) . '/doctrine/schema'
);

// obtaining the entity manager (7)
$evm = new Doctrine\Common\EventManager();
$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config, $evm);

// Configure application
$application = Environment::getApplication();
$application->errorPresenter = 'Error';
//$application->catchExceptions = TRUE;

Environment::getContext()->addService('doctrine', $entityManager);

// Setup router
$application->onStartup[] = function() use ($application) {
	$router = $application->getRouter();

	$router[] = new Route('index.php', 'Homepage:default', Route::ONE_WAY);

	$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');
};

// Run the application!
$application->run();
