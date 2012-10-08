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
        protected $_fields = array('NMLOGIN', 'CDSENHA');

        public function __construct($login, $senha)
        {
            parent::connect();
            $this->_fields['NMLOGIN'] = $login;
            $this->_fields['CDSENHA'] = $senha;
            $this->_Error = new Error();
        }

        public function start()
        {
            return self::validate();
        }

        private function validate()
        {
            $this->execute("SELECT COUNT(1) as QTD FROM USUARIOS WHERE NMLOGIN = '%s' AND CDSENHA = MD5('%s')", $this->_fields['NMLOGIN'], $this->_fields['CDSENHA']);
            $row = $this->fetch();
            if(((int)$row['QTD']) > 0 ){
                $_SESSION[SESSION_NAME] = array('USER' => $this->_fields['NMLOGIN'], 'SENHA' => $this->_fields['CDSENHA']);
                session_write_close();
                header('Location: ?page=Home');
            } else {
                $this->_Error->setError('Usuário ou senha inválido! Tente novamente.');
                $this->_Error->ShowError();
            }

        }

    }
}

?>