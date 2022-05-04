<?php
date_default_timezone_set("Europe/Istanbul");

$config = [];

$config['URL'] = 'http://makalesistemi:8888/';

define('PROJE_ADI', "Makale Sistemi");
define('CHARSET', 'UTF-8');
define('PANEL', $config['URL'] . 'yonetim/');
define('VERSION','1');

define('DB_HOST','makalesistemi');
define('DB_PORT','8889');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','makalesistemi');
