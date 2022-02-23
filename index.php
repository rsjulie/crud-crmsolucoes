<?php 
require_once 'lib/Database/Connection.php';
require_once 'App/Core/Core.php';
require_once 'App/Controller/HomeController.php';
require_once 'App/Controller/ErrorController.php';
require_once 'App/Model/Lista.php';
require_once 'vendor/autoload.php';

$template = file_get_contents('App/Template/structure.php');

ob_start();
    $core = new Core;
    $core->start($_GET);
    $output = ob_get_contents();
ob_end_clean();

$dynamicArea = str_replace('{{area}}', $output, $template);

echo $dynamicArea;