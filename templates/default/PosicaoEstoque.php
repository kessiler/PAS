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
            <h1>Posição de Estoque</h1>
            <p>O Relatório de Posição de Estoque permite identificar a posição do estoque atual.</p>
            <hr>
            <div class="form_settings">
                <form method="post" action="">
                    <input name="submitA" class="submit" type="submit"  value="Abrir relatório" style="margin: -6px 0 0 0; width: 240px" />
                    <input name="submitB" class="submit" type="submit"  value="Download do relatório" style="margin: -6px 0 0 0; width: 240px" />
                    <input name="submit" class="submit" type="hidden" />
                </form>
            </div>
        </div>
        <?
            if(isset($_POST['submit'])) {
                $Rel = new Relatorios();
                $Rel->setNameRel("posicao".date('Y-m-d-G-i-s').".pdf");
                if(isset($_POST['submitA'])) {
                    $Rel->PosicaoEstoque('I');
                } else {
                    if(isset($_POST['submitB'])) {
                        $Rel->PosicaoEstoque('D');
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