<?php
if (!class_exists('Usuario')) {
    class Usuario extends MySQL
    {

        private $id;
        private $login;
        private $senha;
        private $nome;
        private $cpf;
        private $ativo;

        public function getId()
        {
            return $this->id;
        }

        public function setId($value)
        {
            $this->id = $value;
        }

        public function getLogin()
        {
            return $this->login;
        }

        public function setLogin($value)
        {
            $this->login = $value;
        }

        public function getSenha()
        {
            return $this->senha;
        }

        public function setSenha($value)
        {
            $this->senha = $value;
        }

        public function getNome()
        {
            return $this->nome;
        }

        public function setNome($value)
        {
            $this->nome = $value;
        }

        public function getCpf()
        {
            return $this->cpf;
        }

        public function setCpf($value)
        {
            $this->cpf = $value;
        }

        public function getAtivo()
        {
            return $this->ativo;
        }

        public function setAtivo($value)
        {
            $this->ativo = $value;
        }

        public function __construct()
        {
            $this->_Error = new Error();
        }

        public function Cadastrar()
        {


            if ($this->execute("INSERT INTO USUARIOS(NMLOGIN,CDSENHA,CDNOME,CDCPF,IDATIVO)
                                    VALUES ('%s', '%s', '%s', '%s', '%s')",
                $this->getLogin(),
                md5($this->getSenha()),
                $this->getNome(),
                $this->getCpf(),
                $this->getAtivo())
            ) {
                $this->_Error->setError('O cadastro foi realizado com sucesso!');
                $this->_Error->ShowSucess();
            }

        }

        public function BuscarUsuario($id)
        {
            $this->execute("SELECT NMLOGIN, CDSENHA, CDNOME, CDCPF,IDATIVO
                              FROM USUARIOS
                             WHERE CDUSUARIO = '%s'
                            ORDER BY CDUSUARIO, CDNOME", $id);
            return $this->fetch();
        }


        public function Alterar()
        {
            if ($this->execute("UPDATE USUARIOS
                                SET NMLOGIN = '%s',
                                 CDSENHA = '%s',
                                 CDNOME = '%s',
								 CDCPF = '%s',
								 IDATIVO = '%s'
                                WHERE CDUSUARIO = '%s'",

                $this->getLogin(),
                $this->getSenha(),
                $this->getNome(),
                $this->getCpf(),
                $this->getAtivo(),
                $this->getId())
            ) {
                $this->_Error->setError('Alteração realizada com sucesso!');
                $this->_Error->ShowSucess();
            }
        }

        public function delete($id)
        {
            if ($this->execute("DELETE FROM USUARIOS WHERE CDUSUARIO = '%s'", $id)) {
                $this->_Error->setError('Usuário excluído com sucesso!');
                $this->_Error->ShowSucess();
            }
        }

        public function getStatusColor($status)
        {
            if ($status == 'S') {
                $status = "<b><font color='#008000'>Ativo</font></b>";
            } else {
                $status = "</b><font color='#FF0000'>Inativo</font></b>";
            }
            return $status;
        }

        public function ListarUsuario()
        {
            $this->execute('SELECT CDUSUARIO,NMLOGIN,CDSENHA,CDNOME,CDCPF,IDATIVO  FROM USUARIOS ORDER BY CDUSUARIO, CDNOME');
            $array = array();
            while ($row = $this->fetch()) {
                $array[] = $row;
            }
            return $array;


        }
        function mask($campo, $formatado = true){
            $campo = preg_replace("[' '-./ t]", '', $campo);
            $tamanho = (strlen($campo) -2);
            if ($tamanho != 9 && $tamanho != 12){
                return $campo;
            }
            if ($formatado){
                $mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##';
                $indice = -1;
                for ($i=0; $i < strlen($mascara); $i++) {
                    if ($mascara[$i]=='#') $mascara[$i] = $campo[++$indice];
                }
                $retorno = $mascara;
            }else{
                $retorno = $campo;
            }
            return $retorno;

        }
    }
}
?>