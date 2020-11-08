<?
define('BASE', '');
define('APP', dirname(__DIR__) . '/app');
define('TEMPLATE', '\\\\' . $_SERVER['HTTP_HOST'] . '/' . BASE . '/public/template/');

session_start();

require_once(APP . '/components/Autoload.php');

$router = new Router();
$router->run();