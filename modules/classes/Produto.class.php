<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KESSILER
 * Date: 07/10/12
 * Time: 14:41
 * To change this template use File | Settings | File Templates.
 */

if (!class_exists('Produto')) {

    class Produto extends MySQL
    {
        protected $_nome;
        protected $_descricao;
        protected $_tipoprod;
        protected $_id;
        protected $_qtd;

        public function setQtd($qtd)
        {
            $this->_qtd = $qtd;
            return $this;
        }

        public function getQtd()
        {
            return $this->_qtd;
        }

        public function setId($id)
        {
            $this->_id = $id;
            return $this;
        }

        public function getId()
        {
            return $this->_id;
        }

        public function __construct()
        {
            $this->_Error = new Error();
        }

        public function insert()
        {
            if ($this->execute("INSERT INTO PRODUTOS(NMPRODUTO, DSPRODUTO, TIPOPROD)
                                    VALUES ('%s', '%s', '%s')",
                $this->getNome(),
                $this->getDescricao(),
                $this->getTipoProd())
            ) {
                $this->_Error->setError('O cadastro foi realizado com sucesso!');
                $this->_Error->ShowSucess();
            }

        }

        public function update()
        {
            if ($this->execute("UPDATE PRODUTOS
                                SET NMPRODUTO = '%s',
                                 DSPRODUTO = '%s',
                                 TIPOPROD = '%s'
                                WHERE  CDPRODUTO = '%s'",
                $this->getNome(),
                $this->getDescricao(),
                $this->getTipoProd(), $this->getId())
            ) {
                $this->_Error->setError('O produto foi alterado com sucesso!');
                $this->_Error->ShowSucess();
            }
        }

        public function delete($id){
            if($this->execute("DELETE FROM PRODUTOS WHERE CDPRODUTO = '%s'", $id)) {
               $this->_Error->setError('O produto foi excluída com sucesso!');
               $this->_Error->ShowSucess();
            }
        }

        public function updateEntradaFromQtd() {
            if ($this->execute("UPDATE PRODUTOS
                                SET QTDPROD = QTDPROD + %f
                                WHERE  CDPRODUTO = '%s'",
                $this->getQtd(),
                $this->getId())
            ) {
                $this->execute("INSERT INTO LOGOPERACAO(DTOPERACAO, IDOPERACAO, CDUSUARIO, QTDPROD, CDPRODUTO)
                                                  VALUES (now(), 'E', '%s', %f, '%s')",
                    $_SESSION[SESSION_NAME]['IDUSER'], $this->getQtd(), $this->getId());
                $rowProduct = $this->getProdutoById($this->getId());
                $formatNumber = number_format($rowProduct['QTDPROD'], 2, ',', '');
                $this->_Error->setError("Entrada realizada com sucesso!<br /> A nova quantidade em estoque do produto {$rowProduct['NMPRODUTO']} é {$formatNumber}.");
                $this->_Error->ShowSucess();
            }
        }

        public function updateSaidaFromQtd() {
            $rowProduct = $this->getProdutoById($this->getId());
            $formatNumber = number_format($rowProduct['QTDPROD'], 2, ',', '');
            if(((float)$rowProduct['QTDPROD'] - (float)$this->getQtd()) < 0.0) {
                $qtd = number_format($this->getQtd(), 2, ',', '');
                $this->_Error->setError("Operação bloqueada!<br /> A quantidade {$qtd} a ser retirada deixará o estoque negativo.<br /> A quantidade disponível do produto {$rowProduct['NMPRODUTO']} é {$formatNumber}. ");
                $this->_Error->ShowError();
            } else {
                if ($this->execute("UPDATE PRODUTOS
                                  SET QTDPROD = QTDPROD - %f
                                WHERE  CDPRODUTO = '%s'",
                    $this->getQtd(),
                    $this->getId())
                ) {
                    $rowProduct['QTDPROD'] -= $this->getQtd();
                    $formatNumber = number_format($rowProduct['QTDPROD'], 2, ',', '');
                    $this->execute("INSERT INTO LOGOPERACAO(DTOPERACAO, IDOPERACAO, CDUSUARIO, QTDPROD, CDPRODUTO)
                                                  VALUES (now(), 'S', '%s', %f, '%s')",
                        $_SESSION[SESSION_NAME]['IDUSER'], $this->getQtd(), $this->getId());
                    $this->_Error->setError("Saída realizada com sucesso!<br /> A quantidade restante em estoque do produto {$rowProduct['NMPRODUTO']} é {$formatNumber}. ");
                    $this->_Error->ShowError();
                }
            }
        }

        public function getAllProduto() {
            $this->execute('SELECT CDPRODUTO, NMPRODUTO, DSPRODUTO, TIPOPROD FROM PRODUTOS ORDER BY CDPRODUTO, NMPRODUTO');
            $array = array();
            while($row = $this->fetch()){
                $array[] = $row;
            }
            return $array;
        }

        public function getAllMedicamento() {
            $this->execute("SELECT CDPRODUTO, NMPRODUTO, DSPRODUTO, TIPOPROD FROM PRODUTOS WHERE TIPOPROD = 'M' ORDER BY CDPRODUTO, NMPRODUTO");
            $array = array();
            while($row = $this->fetch()){
                $array[] = $row;
            }
            return $array;
        }

        public function getProdutoById($id) {
            $this->execute("SELECT CDPRODUTO, NMPRODUTO, DSPRODUTO, TIPOPROD, QTDPROD
                              FROM PRODUTOS
                             WHERE CDPRODUTO = '%s'
                            ORDER BY CDPRODUTO, NMPRODUTO", $id);
            return $this->fetch();
        }

        public function getStatusColor($status) {
            switch($status) {
                case 'M': $status = "<b><font color='#000000'>Medicamento</font></b>";break;
                case 'A': $status = "<b><font color='#2E8B57'>Alimentar</font></b>";break;
                case 'O': $status = "<b><font color='#FF0000'>Outros</font></b>";break;
                default : break;
            }
            return $status;
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

        public function setTipoProd($status)
        {
            $this->_tipoprod = $status;
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

        public function getTipoProd()
        {
            return $this->_tipoprod;
        }
    }

}
?>
