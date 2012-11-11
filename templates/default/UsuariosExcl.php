<?
$Error = new Error();
if (isset($_SESSION[SESSION_NAME])):
    $Usuario = new Usuario();
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
            <h1>Confirma exclusão do Usuário?</h1>
            <?
            if (isset($_POST['sim'])) :
                $Usuario->delete($_POST['Id']);
                unset($_POST);
                ?>
                <div class="back"><a onclick="history.go(-2);">Voltar</a></div>
                <? elseif (isset($_POST['nao'])):
                    echo "<script>history.go(-2);</script>";
             else:
                ?>
                <div class="form_settings" id="frmDieta">
                    <form id="dieta" method="post" action="">
                        <input name="Id" type="hidden" value="<?php echo $_GET['id'];?>"/>
                        <input class="submit" type="submit" name="sim" style="margin: 0 0 0 0px;"
                               value="Sim"/>
                        <input class="submit" type="submit" name="nao" value="Não" style="margin: 0 0 0 40px;"/>
                    </form>
                </div>
                <? endif;?>
        </div>
    </div>
<? else:
    $Error->setError('É preciso estar logado para acessar a página!');
    $Error->ShowDie();
endif;
?>