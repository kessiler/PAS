<?
$Error = new Error();
if (isset($_SESSION[SESSION_NAME])): ?>
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
            <h1>Saída/Entrada de Ativos</h1>
            <p>O relatório Saída/Entrada de Ativos permite identificar quais foram as movimentações realizadas no estoque.</p>
            <hr>
            <div class="form_settings">
                <form id="logativos" method="post" action="">
                    <p><span>Operação:</span><input class="checkbox" type="radio" name="oper" checked="checked" value="E">Entrada
                        <input class="checkbox" style="margin: 0 0 0 30px" type="radio"  name="oper" value="S">Saída
                        <input class="checkbox" style="margin: 0 0 0 30px" type="radio"  name="oper" value="T">Todos</p>
                    <p><span>Data Inicial:</span><input class="validate[required] text-input"
                                                                                   style="width: 100px;" id="dtinicial" type="text" name="dtinicial"
                                                                                   value="" onfocus="datePicker('#dtinicial');" onkeypress="mask(this, event,  '??/??/????');"/></p>
                    <p><span>Data Final:</span><input class="validate[required] text-input"
                                                                                   style="width: 100px;" id="dtfinal" type="text" name="dtfinal"
                                                                                   value="" onfocus="datePicker('#dtfinal');" onkeypress="mask(this, event,  '??/??/????');"/></p>
                    <input name="submitA" class="submit" type="submit"  value="Abrir relatório" style="margin: 10px 0 0 0; width: 240px" />
                    <input name="submitB" class="submit" type="submit"  value="Download do relatório" style="margin: 10px 0 0 0; width: 240px" />
                    <input name="submit" class="submit" type="hidden" />
                </form>
            </div>
        </div>
        <?
        if(isset($_POST['submit'])) {
            $Rel = new Relatorios();
            $Rel->setNameRel("logativos".date('Y-m-d-G-i-s').".pdf");
            if(isset($_POST['submitA'])) {
                $Rel->LogAtivos('I', $_POST['oper'], date('Y-m-d', strtotime($_POST['dtinicial'])), date('Y-m-d', strtotime($_POST['dtfinal'])));
            } else {
                if(isset($_POST['submitB'])) {
                    $Rel->LogAtivos('D', $_POST['oper'], date('Y-m-d', strtotime($_POST['dtinicial'])), date('Y-m-d', strtotime($_POST['dtfinal'])));
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