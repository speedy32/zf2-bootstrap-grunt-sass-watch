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
 * credentials from accidentally being committed into version control.
 */
$rootPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
$dataPath = $rootPath . 'data' . DIRECTORY_SEPARATOR;

return array(
    'projects' => array(
        'uploadPath' => $dataPath . 'projects' . DIRECTORY_SEPARATOR,
        'printerPath' => $rootPath . 'bin' . DIRECTORY_SEPARATOR . 'libs',
        'javaPath' => 'java',
        'unzip' => '/usr/bin/unzip',
        'zip' => '/usr/bin/zip'
    ),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOPgSql\Driver',
                'params' => array(
                    'user' => 'postgres',
<<<<<<< HEAD
                    'password' => 'postgresql/.,',
=======
                    'password' => 'postgres/.,',
>>>>>>> 8b1b5a9ffe3075aea6e9c38419bd520d3f5cd3e5
                    'dbname' => 'zf2_template',
                    'host' => 'localhost',
                    'port' => '5432'
                )
            )
        )
    )
);
