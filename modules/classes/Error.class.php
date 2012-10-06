<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KESSILER
 * Date: 30/09/12
 * Time: 20:04
 * To change this template use File | Settings | File Templates.
 */
if (!class_exists('Error')) {

    class Error
    {
        public function error($data)
        {
            echo '<div id="erro">'.($data).'</div>';
        }
        public function sucess($data)
        {
            echo '<div id="sucess">'.($data).'</div>';
        }

    }
}
?>
