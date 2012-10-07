<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KESSILER
 * Date: 07/10/12
 * Time: 14:41
 * To change this template use File | Settings | File Templates.
 */

if(!class_exists('Dieta')) {

    class Dieta extends MySQL
    {
        protected $_nome;
        protected $_descricao;
        protected $_status;

        public function __construct($nome, $descricao, $status){
            $this->_nome      = $nome;
            $this->_descricao = $descricao;
            $this->_status    = $status;
        }

        public function __cadastrar() {
            parent::connect();
        }

    }
}

