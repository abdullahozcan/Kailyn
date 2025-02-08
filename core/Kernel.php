<?php
/*
 * Project: BlogSistem
 * File: core/Kernel.php
 * Author: Abdullah ÖZCAN
 */

date_default_timezone_set("Europe/Istanbul");
require_once(__DIR__ . '/../vendor/autoload.php');

// config.php dosyasının doğru yolunu belirleyin
foreach (glob(__DIR__ . '/../config/*.php') as $configFile) {
    require_once($configFile);
}

require_once(dirname(__DIR__).'/route/api.php');

/*
 * @method Dotenv\Dotenv::createImmutable
 * @return $dotenv
 * @description Read ENV file and create immutable
 */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../');

/*
 * @method load
 * @return void
 * @description Run the dotenv
 */
$dotenv->load();

/*
 * @method run
 * @return void
 * @description Run the route
 */
$route->run();
