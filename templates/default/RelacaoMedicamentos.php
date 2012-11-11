<?
$Error = new Error();
if (isset($_SESSION[SESSION_NAME])):
    $Clientes = new Clientes();
    $arrValue = $Clientes->getAllClientes();
    $Product     = new Produto();
    $arrMedicamento = $Product->getAllMedicamento();
?>
<div id="main">
    <header>
        <div id="logo">
            <div id="logo_text">
                <h1><a href="?">Lar da<span class="logo_colour"> Vovó</span></a></h1>

                <h2>Asilo Nossa Senhora da Piedade.</h2>
            </div>
        </div>
        <nav>
            <ul class="sf-menu" id="nav">
                <li><a href="?page=Home">Início</a>
                <li><a href="javascript: void(Group4);">Cadastros</a>
                    <ul>
                        <li><a href="?page=Usuarios">Usuários</a></li>
                        <li><a href="?page=Idosos">Idosos</a></li>
                        <li><a href="?page=Produtos">Produtos</a></li>
                        <li><a href="?page=Dietas">Dietas</a></li>
                    </ul>
                </li>
                <li><a href="javascript: void(Group4);">Estoque</a>
                    <ul>
                        <li><a href="?page=EntradaAtivos">Entrada de Ativos</a></li>
                        <li><a href="?page=SaidaAtivos">Saída de Ativos</a></li>
                    </ul>
                </li>
                <li><a href="javascript: void(Group4);">Relatórios</a>
                    <ul>
                        <li><a href="?page=RelacaoDietas">Relação de Dietas</a></li>
                        <li><a href="?page=RelacaoMedicamentos">Relação de Medicamentos</a>
                        <li><a href="javascript: void(Group4);">Relatórios de Estoque</a>
                            <ul>
                                <li><a href="?page=PosicaoEstoque">Posição de estoque</a></li>
                                <li><a href="?page=LogAtivos">Saída/Entrada Ativos</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="?page=Logout">Sair do Sistema</a>
            </ul>
        </nav>
    </header>
    <div id="site_content">
        <div id="content">
            <h1>Relação de Medicamentos</h1>
            <?
            if(empty($arrMedicamento)):
                $Error->setError('Não há medicamentos cadastrados para ser realizado a operação!');
                $Error->ShowError();
            elseif (empty($arrValue)):
                $Error->setError('Não há idosos cadastrados para ser realizado a operação!');
                $Error->ShowError();
            else:
                ?>
                <div class="form_settings">
                    <p>O relatório de relação de medicamentos permite imprimir qual os medicamentos que o idoso toma regurlamente.</p>
                    <hr>
                    <form id="relacMedicamento" method="post" action="" style="margin: 10px 0 0 0">
                        <p><span>Medicamentos(s)</span>
                            <select id="sele" name="sele" style="height: 22px;">
                                <? foreach($arrMedicamento as $value): ?>
                                <option value="<?=$value['CDPRODUTO'];?>"><?=$value['NMPRODUTO'];?></option>
                                <? endforeach;?>
                            </select>
                        </p>
                        <div id="table">
                            <table style="width: 600px">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th style="width: 50px">Sim/Não</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?
                                    if(!empty($arrValue)):
                                        foreach($arrValue as $value):
                                            ?>
                                        <tr>
                                            <th><?=$value['NMCLIENTE']?></th>
                                            <td style="text-align: center"><input class="checkbox" type="checkbox" name="relaccheck[]" value="<?=$value['CDCLIENTE']?>" /> </td>
                                        </tr>
                                            <?
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <input name="submitA" class="submit" type="submit"  value="Abrir relatório" style="margin: 5px 0 0 0; width: 200px" />
                        <input name="submitB" class="submit" type="submit"  value="Download do relatório" style="margin: 5px 0 0 0; width: 200px" />
                        <input name="submit" class="submit" type="hidden" />
                    </form>
                </div>
                <? endif; ?>
        </div>
        <?
        if(isset($_POST['submit'])) {
            $Rel = new Relatorios();
            $Rel->setNameRel("relacaomedicamento".date('Y-m-d-G-i-s').".pdf");
            if(isset($_POST['submitA'])) {
                if(isset($_POST['relaccheck'])) {
                    $Rel->RelacaoMedicamento(array('medicamento' => $_POST['sele'], 'relacoes' => $_POST['relaccheck']), 'I');
                }  else {
                    $Error->setError('Não há dados para ser gerado o relatório!');
                    $Error->ShowError();
                }
            } else {
                if(isset($_POST['submitB'])) {
                    if(isset($_POST['relaccheck'])) {
                        $Rel->RelacaoMedicamento(array('medicamento' => $_POST['sele'], 'relacoes' => $_POST['relaccheck']), 'D');
                    } else {
                        $Error->setError('Não há dados para ser gerado o relatório!');
                        $Error->ShowError();
                    }
                }
            }
        }
        ?>
    </div>
</div>
<? else:
    $Error->setError('É preciso estar logado para acessar a página!');
    $Error->ShowDie();
endif;
?>