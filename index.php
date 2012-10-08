<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KESSILER
 * Date: 16/09/12
 * Time: 15:34
 * To change this template use File | Settings | File Templates.
 */

error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);
require_once('autoload.php');
define("SESSION_NAME", "c21f969b5f03d33d43e04f8f136e7682");
define('CORE', dirname(__FILE__).'/modules/classes/');
define('TEMPLATE', 'default/');
define('TITLE_SITE', 'SICG - Sistema integrado de cadastro e gerenciamento');
/*
    Definições MySQL
*/
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '123');
define('BD', 'webpas');

ob_start();
session_name(SESSION_NAME);
session_start();
$application = new Application();
$application->run();