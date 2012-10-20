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

        public function connect() {
            if (!isset($this->_dbh)) {
                if ($this->_dbh = @mysql_connect(HOST, USER, PASS)) {
                    $this->_dbh = @mysql_select_db(BD, $this->_dbh);
                } else {
                    $Error = new Error();
                    $Error->setError('Não foi possível efetuar a conexão com o MySQL.');
                    $Error->ShowError();
                }
            }
            return $this;
        }

        public function execute()
        {
            $args = func_get_args();
            $sql = array_shift($args);

            for ($i=0;$i<count($args);$i++) {
                $args[$i] = urldecode($args[$i]);
                $args[$i] = addslashes($args[$i]);
            }
            $sql = vsprintf($sql, $args);
            self::connect();
            $this->_data = mysql_query($sql) or die(mysql_error());
            return true;
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
