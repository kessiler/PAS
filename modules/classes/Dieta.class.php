<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KESSILER
 * Date: 07/10/12
 * Time: 14:41
 * To change this template use File | Settings | File Templates.
 */

if (!class_exists('Dieta')) {

    class Dieta extends MySQL
    {
        protected $_nome;
        protected $_descricao;
        protected $_status;

        public function __construct()
        {
            $this->_Error = new Error();
        }

        public function insert()
        {
            if ($this->execute("INSERT INTO DIETA(NMDIETA, DSDIETA, IDATIVO)
                                    VALUES ('%s', '%s', '%s')",
                $this->getNome(),
                $this->getDescricao(),
                $this->getStatus())
            ) {
                $this->_Error->setError('O cadastro foi realizado com sucesso!');
                $this->_Error->ShowSucess();
            }

        }

        public function update()
        {
        }

        public function getAllDieta() {
            $this->execute('SELECT CDDIETA, NMDIETA, DSDIETA, IDATIVO FROM DIETA ORDER BY CDDIETA, NMDIETA');
            $array = array();
            while($row = $this->fetch()){
                $array[] = $row;
            }
            return $array;
        }

        public function setDescricao($descricao)
        {
            $this->_descricao = $descricao;
            return $this;
        }

        public function setNome($nome)
        {
            $this->_nome = $nome;
            return $this;
        }

        public function setStatus($status)
        {
            $this->_status = $status;
            return $this;
        }

        public function getDescricao()
        {
            return $this->_descricao;
        }

        public function getNome()
        {
            return $this->_nome;
        }

        public function getStatus()
        {
            return $this->_status;
        }
    }
}

