<?php
		use Doctrine\ORM\Tools\Setup;
		use Doctrine\ORM\EntityManager;

		require_once "vendor/autoload.php";

		$pathyml = array("./app/doctrine");
//		$pathEnt= array("./yml/my");
		$isDevMode = true;

		$dbParams = array(
		'driver'   => 'pdo_mysql',
		'user'     => 'root',
		'password' => '',
		'dbname'   => 'ed',
		);

//		$config = Setup::createAnnotationMetadataConfiguration($pathEnt, $isDevMode);
		$config = Setup::createYAMLMetadataConfiguration($pathyml, $isDevMode);
		$em = EntityManager::create($dbParams, $config);
