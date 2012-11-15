<?php
if (!class_exists('Clientes'))
{

    class Clientes extends MySQL

    {
        protected $_NMcliente;
        protected $_DTnascimento;
        protected $_NMresponsavel;
        protected $_Parentesco;
		protected $_Convenios;
		protected $_IDbebe;
		protected $_iDfuma;
		protected $_NMvicios;
		protected $_Escolaridade;
		protected $_Profissao;
		protected $_Estado_civil;
		protected $_IDfilhos;
		protected $_QTfilhos;
		protected $_IDcliente;
        protected $_avaliacao;

        public function setAvaliacao($avaliacao)
        {
            $this->_avaliacao = $avaliacao;
            return $this;
        }

        public function getAvaliacao()
        {
            return $this->_avaliacao;
        }
	
		public function setId($id)
        {
            $this->_IDcliente = $id;
            return $this;
        }

        public function getId()
        {
            return $this->_IDcliente;
        }
		public function __construct()
        {
            $this->_Error = new Error();
        }
		public function insert()
        {
            $date = date('Y-m-d', strtotime($this->getNascimento()));
            if ($this->execute("INSERT INTO clientes(NMCLIENTE, DTNASCIMENTO, NMRESPONSAVEL,GRAUPARENTESCO,CONVENIOS,IDBEBE,IDFUMA,NMVICIOS,ESCOLARIDADE,PROFISSAO,ESTADOCIVIL,IDFILHOS,QTDFILHOS, AVALIACAOMEDICA)
                                    VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                 $this->getNome(),
                 $date,
				 $this->getResponsavel(),
				 $this->getParentesco(),
				 $this->getConvenio(),
				 $this->getBebe(),
				 $this->getFuma(),
				 $this->getVicio(),
				 $this->getEscolaridade(),
				 $this->getProfissao(),
				 $this->getCivil(),
				 $this->getFilhos(),
				 $this->getQTfilhos(),
                 $this->getAvaliacao())
				) {
					$this->_Error->setError('O cadastro foi realizado com sucesso!');
					$this->_Error->ShowSucess();
				  }
				  
        }
		public function setNome($nome)
        {
            $this->_NMcliente = $nome;
            return $this;
        }
		 public function getNome()
        {
            return $this->_NMcliente;
        }
		public function setNascimento($nascimento)
        {
            $this->_DTnascimento = $nascimento;
            return $this;
        }
		public function getNascimento()
        {
            return $this->_DTnascimento;
        }
		
		public function setResponsavel($responsavel)
        {
            $this->_NMresponsavel = $responsavel;
            return $this;
        }
		public function getResponsavel()
        {
            return $this->_NMresponsavel;
        }
		public function setParentesco($parentesco)
        {
            $this->_Parentesco = $parentesco;
            return $this;
        }
		public function getParentesco()
        {
            return $this->_Parentesco;
        }
		public function setConvenio($convenio)
        {
            $this->_Convenios = $convenio;
            return $this;
        }
		public function getConvenio()
        {
            return $this->_Convenios;
        }
		public function setBebe($bebe)
        {
            $this->_IDbebe = $bebe;
            return $this;
        }
		public function getBebe()
        {
            return $this->_IDbebe;
        }
		public function getStatusbebe($bebe)
		{
            if($bebe == true) {
                $bebe = "Sim";
            } else {
                $bebe = "Não";
            }
            return $bebe;
        }
		public function setFuma($fuma)
        {
            $this->_iDfuma = $fuma;
            return $this;
        }
		public function getFuma()
        {
            return $this->_iDfuma;
        }
		public function getStatusfuma($fuma)
		{
            if($fuma == true) {
                $fuma = "Sim";
            } else {
                $fuma = "Não";
            }
            return $fuma;
        }
		public function setVicio($vicio)
        {
            $this->_NMvicios = $vicio;
            return $this;
        }
		public function getVicio()
        {
            return $this->_NMvicios;
        }
		public function getStatusvicio($vicio)
		{
            if($vicio == true) {
                $vicio = "Sim";
            } else {
                $vicio = "Não";
            }
            return $vicio;
        }
		public function setEscolaridade($escolaridade)
        {
            $this->_Escolaridade = $escolaridade;
            return $this;
        }
		public function getEscolaridade()
        {
            return $this->_Escolaridade;
        }
		public function setProfissao($profissao)
        {
            $this->_Profissao = $profissao;
            return $this;
        }
		public function getProfissao()
        {
            return $this->_Profissao;
        }
		public function setCivil($civil)
        {
            $this->_Estado_civil = $civil;
            return $this;
        }
		public function getCivil()
        {
            return $this->_Estado_civil;
        }
		public function getStatuscivil($civil)
		{
            $civil = strtoupper($civil);
            if ($civil == 'C') {
                $civil = "Casado(a)";
            } else if ($civil == 'S') {
                $civil = "Solteiro(a)";
            } else if ($civil == 'D') {
                $civil = "Divorciado(a)";
            } else if ($civil == 'V') {
                $civil = "Viuvo(a)";
            }
            return $civil;
        
		}
		public function setFilhos($filhos)
        {
            $this->_IDfilhos = $filhos;
            return $this;
        }
		public function getFilhos()
        {
            return $this->_IDfilhos;
        }
		public function getStatusfilhos($filhos)
		{
            if($filhos == 'S') {
                $filhos = "Sim";
            } else {
                $filhos = "Não";
            }
            return $filhos;
        }
		public function setQTfilhos($qtfilhos)
        {
            $this->_QTfilhos = $qtfilhos;
            return $this;
        }
		public function getQTfilhos()
        {
            return $this->_QTfilhos;
        }
		
		
		public function update()
        {
            $date = date('Y-m-d', strtotime($this->getNascimento()));
            if ($this->execute("UPDATE clientes			
                                SET NMCLIENTE = '%s',
                                 DTNASCIMENTO = '%s',
                                 NMRESPONSAVEL = '%s',
								 GRAUPARENTESCO = '%s',
								 CONVENIOS = '%s',
								 IDBEBE = '%s',
								 IDFUMA = '%s',
								 NMVICIOS = '%s',
								 ESCOLARIDADE = '%s',
								 PROFISSAO = '%s',
								 ESTADOCIVIL = '%s',
								 IDFILHOS = '%s',
								 QTDFILHOS = '%s',
                                 AVALIACAOMEDICA = '%s'
                                WHERE CDCLIENTE = '%s'",
                 $this->getNome(),
                 $date,
				 $this->getResponsavel(),
				 $this->getParentesco(),
				 $this->getConvenio(),
				 $this->getBebe(),
				 $this->getFuma(),
				 $this->getVicio(),
				 $this->getEscolaridade(),
				 $this->getProfissao(),
				 $this->getCivil(),
				 $this->getFilhos(),
				 $this->getQTfilhos(),
                 $this->getAvaliacao(),
                 $this->getId())
            ) {
                $this->_Error->setError("Alteração realizada com sucesso!");
                $this->_Error->ShowSucess();
            }
        }

        public function delete($id){
            if($this->execute("DELETE FROM clientes WHERE CDCLIENTE = '%s'", $id)) {
               $this->_Error->setError('O cadastro foi excluído com sucesso!');
               $this->_Error->ShowSucess();
            }
        }

        public function getAllClientes() {
            $this->execute('SELECT CDCLIENTE, NMCLIENTE, DTNASCIMENTO, NMRESPONSAVEL,GRAUPARENTESCO,CONVENIOS,IDBEBE,IDFUMA,NMVICIOS,ESCOLARIDADE,PROFISSAO,ESTADOCIVIL,IDFILHOS,QTDFILHOS, AVALIACAOMEDICA FROM clientes ORDER BY NMCLIENTE');
            $array = array();
            while($row = $this->fetch()){
                $array[] = $row;
            }
            return $array;
        }

        public function getIdodosById($id) {
            $this->execute("SELECT NMCLIENTE, DTNASCIMENTO, NMRESPONSAVEL,GRAUPARENTESCO,CONVENIOS,IDBEBE,IDFUMA,NMVICIOS,ESCOLARIDADE,PROFISSAO,ESTADOCIVIL,IDFILHOS,QTDFILHOS, AVALIACAOMEDICA
                              FROM clientes
                             WHERE CDCLIENTE = '%s'
                            ORDER BY CDCLIENTE, NMCLIENTE", $id);
            return $this->fetch();
        }
	}	
}
?>
