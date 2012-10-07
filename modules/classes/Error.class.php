<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KESSILER
 * Date: 30/09/12
 * Time: 20:04
 * To change this template use File | Settings | File Templates.
 */
if (!class_exists('Error')) {

    class  Error
    {
        protected $_data;
        public function __construct(){
            $this->_data = NULL;
        }

        public function setError($data) {
            $this->_data = $data;
        }
        public function ShowError()
        {
            echo '<div class="error">'.($this->_data).'</div>';
        }
        public function ShowSucess()
        {
            echo '<div class="success">'.($this->_data).'</div>';
        }

        public function ShowDie()
        {
            echo '<div class="error">'.($this->_data).'</div>';die;
        }

    }
}
?>
