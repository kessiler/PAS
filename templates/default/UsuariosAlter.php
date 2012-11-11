<?
$Error = new Error();
    if (isset($_SESSION[SESSION_NAME])):
        $Usuario = new Usuario();
        $row = $Usuario->BuscarUsuario($_GET['id']);
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
            <h1>Alteração de Usuario</h1>
            <?
            if (isset($_POST['AlterarUsuario'])) :
                $Usuario->setLogin($_POST['login']);
                $Usuario->setNome($_POST['nome']);
                $Usuario->setSenha($_POST['senha']);
                $Usuario->setCpf($Usuario->mask($_POST['cpf'], false));
                $Usuario->setAtivo($_POST['tipo']);
                $Usuario->setId($_GET['id']);

                $Usuario->Alterar();

                unset($_POST['AlterarUsuario']);
                $row = $Usuario->BuscarUsuario($_GET['id']);

                ?>
                <div class="back"><a href="?page=Usuarios">Voltar</a></div>
                <? endif;?>
            <div class="form_settings">
                <form id="frmUsuarios" method="post" action="">
                    <p><span>Nome </span><input class="validate[required] text-input" type="text" name="nome"
                                                value="<?=$row['CDNOME'];?>"/></p>

                    <p><span>Login </span><input class="validate[required] text-input" type="text" style="width:200px;"
                                                 name="login" value="<?=$row['NMLOGIN'];?>"</p>

                    <p><span>Senha</span><input class="validate[required] text-input " type="password"
                                                style="width:150px;" name="senha" value="<?=$row['CDSENHA'];?>"</p>

                    <p><span>CPF </span><input class="validate[required] text-input" type="text" style="width:150px;"
                                               name="cpf" value="<?=$Usuario->mask($row['CDCPF'], true);?>" onkeypress="mask(this, event, '???.???.???-??');" /></p>

                    <p>

                        <span>Status </span><span class="p1"> <input type="radio" checked="checked" class="checkbox"
                                                                     <?($row['IDATIVO'] == 'N') ? print 'checked="checked"' : "";?> name="tipo" value="S"/>Ativo </span>
                        <input type="radio" class="checkbox" name="tipo" <?($row['IDATIVO'] == 'N') ? print 'checked="checked"' : "";?> value="N"/>Inativo

                    </p>
                    <hr>
                    <br />
                    <input class="submit" type="submit" style=" margin-left: 0px;" name="AlterarUsuario"
                           value="Alterar"/>
                    <input class="submit" type="button" onclick="history.go(-1);" value="Cancelar" style="margin: 0 0 0 50px;"/>

                </form>
            </div>
        </div>
    </div>
<? else:
    $Error->setError('É preciso estar logado para acessar a página!');
    $Error->ShowDie();
endif;
?>