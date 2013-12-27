<?php
/**
 * Local Configuration Override
 *
 * This configuration override file is for overriding environment-specific and
 * security-sensitive configuration information. Copy this file without the
 * .dist extension at the end and populate values as needed.
 *
 * @NOTE: This file is ignored from Git by default with the .gitignore included
 * in ZendSkeletonApplication. This is a good practice, as it prevents sensitive
 * credentials from accidentally being comitted into version control.
 */

$dbConnection = array(
    'driver'         => 'Pdo',
    'pdodriver'      => 'mysql',
    'username' => '',
    'password' => '',
    'characterset' => 'UTF8',
    'driver_options' => array(
        //PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
    ),
    'host' => 'localhost',
);
// config.autoload/local.php:
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => '',
                    'password' => '',
                    'dbname' => '',
                ),
            ),
        ),
    ),
    'di' => array (
        'instance' => array(
            'Zend\Db\Adapter\Adapter' => array(
                'parameters' => array(
                    'driver' => array(
                        'dbname' => 'sandbox',
                    ) + $dbConnection,
                    //'profiler' => 'Zend\Db\Adapter\Profiler\Profiler',
                ),
            ),
        ),
    ),
);


