<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KESSILER
 * Date: 09/11/12
 * Time: 23:41
 * To change this template use File | Settings | File Templates.
 */
if (!class_exists('Relatorios')) {

    class Relatorios extends MySQL
    {
        private $_nameRel;

        public function setNameRel($nameRel)
        {
            $this->_nameRel = $nameRel;
        }

        public function getNameRel()
        {
            return $this->_nameRel;
        }

        public function PosicaoEstoque($type)
        {
            $pdf = new FPDF("P", "pt", "A4");
            $pdf->AddPage();

            $pdf->SetFont('arial', 'B', 13);
            $pdf->Cell(0, 5, utf8_decode("Relatório da posição de estoque"), 0, 1, 'C');
            $pdf->Cell(0, 5, "", "B", 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('arial', 'B', 11);
            $pdf->Cell(135, 20, 'Produto', 1, 0, "L");
            $pdf->Cell(135, 20, utf8_decode('Descrição'), 1, 0, "L");
            $pdf->Cell(135, 20, 'Quantidade', 1, 0, "L");
            $pdf->Cell(135, 20, 'Tipo', 1, 1, "L");
            $pdf->SetFont('arial', '', 10);
            $this->execute("SELECT * FROM PRODUTOS");
            while ($row = $this->fetch('array')) {
                $pdf->Cell(135, 20, utf8_decode($row['NMPRODUTO']), 1, 0, "L");
                $pdf->Cell(135, 20, utf8_decode($row['DSPRODUTO']), 1, 0, "L");
                $pdf->Cell(135, 20, number_format($row['QTDPROD'], 2, ',', ''), 1, 0, "L");
                $pdf->Cell(135, 20, self::getTypeProduct($row['TIPOPROD']), 1, 0, "L");
                $pdf->Ln();
            }
            $pdf->Output(self::getNameRel(), $type);
        }

        public function LogAtivos($type, $typeLog, $dtinicial, $dtfinal)
        {
            $pdf = new FPDF("P", "pt", "A4");
            $pdf->AddPage();
            $pdf->SetFont('arial', 'B', 13);
            $pdf->Cell(0, 5, utf8_decode("Relatório de saída e entrada de ativos"), 0, 1, 'C');
            $pdf->Cell(0, 5, "", "B", 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('arial', 'B', 11);
            $pdf->Cell(100, 20, 'Produto', 1, 0, "L");
            $pdf->Cell(100, 20, 'Quantidade', 1, 0, "L");
            $pdf->Cell(100, 20, utf8_decode('Tipo de operação'), 1, 0, "L");
            $pdf->Cell(100, 20, utf8_decode('Data da Operação'), 1, 0, "L");
            $pdf->Cell(100, 20, utf8_decode('Nome do usuário'), 1, 0, "L");
            $pdf->SetFont('arial', '', 10);
            $this->execute("SELECT L.*, P.NMPRODUTO, U.CDNOME FROM LOGOPERACAO L, PRODUTOS P, USUARIOS U
                            WHERE L.CDUSUARIO = U.CDUSUARIO
                              AND P.CDPRODUTO = L.CDPRODUTO
                              AND DTOPERACAO BETWEEN '%s' AND '%s'
                              AND ((IDOPERACAO = '%s') OR ('%s' = 'T'))", $dtinicial, $dtfinal, $typeLog, $typeLog);
            $pdf->Ln();
            while ($row = $this->fetch('array')) {
                $pdf->Cell(100, 20, utf8_decode($row['NMPRODUTO']), 1, 0, "L");
                $pdf->Cell(100, 20, number_format($row['QTDPROD'], 2, ',', ''), 1, 0, "L");
                $pdf->Cell(100, 20, utf8_decode(self::getTypeOper($row['IDOPERACAO'])), 1, 0, "L");
                $pdf->Cell(100, 20, date('d/m/Y', strtotime($row['DTOPERACAO'])), 1, 0, "L");
                $pdf->Cell(100, 20, $row['CDNOME'], 1, 0, "L");
                $pdf->Ln();
            }
            $pdf->Output(self::getNameRel(), $type);
        }

        public function RelacaoDietas($arrValues, $type)
        {
            $pdf = new FPDF("P", "pt", "A4");
            $pdf->AddPage();
            $pdf->SetFont('arial', 'B', 13);
            $pdf->Cell(0, 5, utf8_decode("Relacionamento de dietas x idosos"), 0, 1, 'C');
            $pdf->Cell(0, 5, "", "B", 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('arial', 'B', 11);
            $Dieta = new Dieta();
            $row = $Dieta->getDietaById($arrValues['dieta']);
            $pdf->Cell(300, 20, "Dieta - ".$row['NMDIETA'], 1, 0, "L");
            $pdf->Cell(100, 20, utf8_decode('Sim/Não'), 1, 0, "L");
            $pdf->SetFont('arial', '', 10);
            $pdf->Ln();
            $Cliente = new Clientes();
            foreach($arrValues['relacoes'] as $value) {
                $row = $Cliente->getIdodosById($value);
                $pdf->Cell(300, 20, utf8_decode($row['NMCLIENTE']), 1, 0, "L");
                $pdf->Cell(100, 20, 'Sim', 1, 0, "L");
                $pdf->Ln();
            }
            $pdf->Output(self::getNameRel(), $type);
        }

        public function RelacaoMedicamento($arrValues, $type)
        {
            $pdf = new FPDF("P", "pt", "A4");
            $pdf->AddPage();
            $pdf->SetFont('arial', 'B', 13);
            $pdf->Cell(0, 5, utf8_decode("Relacionamento de medicamento x idosos"), 0, 1, 'C');
            $pdf->Cell(0, 5, "", "B", 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('arial', 'B', 11);
            $Product = new Produto();
            $row = $Product->getProdutoById($arrValues['medicamento']);
            $pdf->Cell(300, 20, "Medicamento - ".$row['NMPRODUTO'], 1, 0, "L");
            $pdf->Cell(100, 20, utf8_decode('Sim/Não'), 1, 0, "L");
            $pdf->SetFont('arial', '', 10);
            $pdf->Ln();
            $Cliente = new Clientes();
            foreach($arrValues['relacoes'] as $value) {
                $row = $Cliente->getIdodosById($value);
                $pdf->Cell(300, 20, utf8_decode($row['NMCLIENTE']), 1, 0, "L");
                $pdf->Cell(100, 20, 'Sim', 1, 0, "L");
                $pdf->Ln();
            }
            $pdf->Output(self::getNameRel(), $type);
        }

        private function getTypeProduct($status)
        {
            switch ($status) {
                case 'M':
                    $status = "Medicamento";
                    break;
                case 'A':
                    $status = "Alimentar";
                    break;
                case 'O':
                    $status = "Outros";
                    break;
                default :
                    break;
            }
            return $status;
        }
        private function getTypeOper($oper)
        {
            switch ($oper) {
                case 'E':
                    $oper = "Entrada";
                    break;
                case 'S':
                    $oper = "Saída";
                    break;
                default :
                    break;
            }
            return $oper;
        }
    }
}
