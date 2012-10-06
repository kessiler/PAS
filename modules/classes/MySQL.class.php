<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KESSILER
 * Date: 16/09/12
 * Time: 16:25
 * To change this template use File | Settings | File Templates.
 */
if (!class_exists('MySQL')) {

    class MySQL
    {
        private $_dbh;
        private $_data;

        public function __construct(){}

        public function __connect() {
            if (!isset($this->_dbh)) {
                if ($this->_dbh = mysql_connect(HOST, USER, PASS)) {
                    mysql_select_db(BD, $this->_dbh);
                }
            }
            return $this;
        }

        public function execute($data)
        {
            $this->data = mysql_query($data) or die(mysql_error());
            return $this->_data;
        }

        public function fetch($fp = 'assoc')
        {
            $fp = 'mysql_fetch_' . $fp;
            return $fp($this->_data);
        }

        public function rows()
        {
            return mysql_num_rows($this->_data);
        }
    }
}
