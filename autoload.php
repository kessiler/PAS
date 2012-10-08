<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KESSILER
 * Date: 16/09/12
 * Time: 15:44
 * To change this template use File | Settings | File Templates.
 */

function __autoload($file)
{
    $path = CORE . $file . '.class.php';
    if (file_exists($path)){
        return require_once($path);
    }
}

?>