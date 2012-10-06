<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KESSILER
 * Date: 30/09/12
 * Time: 20:06
 * To change this template use File | Settings | File Templates.
 */

if (!class_exists('Login')) {
    class Login extends MySQL
    {
        /**
         * @property mixed _fields
         */
        private $_fields = array('NMLOGIN', 'CDSENHA');

        public function __construct($login, $senha)
        {
            parent::__connect();
            $this->_fields['NMLOGIN'] = $login;
            $this->_fields['CDSENHA'] = md5($senha);
        }

        public function start()
        {
            return self::validate();
        }

        private function validate()
        {
            $_SESSION[SESSION_NAME] = array($this->_fields['NMLOGIN'], $this->_fields['CDSENHA']);
            session_write_close();
            header('Location: ?page=Home');
        }

    }
}

?>