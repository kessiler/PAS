<? 
//if (isset($_SESSION[SESSION_NAME])): 

//require("../../modules/classes/Usuario.class.php");
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
            <h1>Cadastrar Usuário</h1>
            <?
            if (isset($_POST['cadastrarUsuario'])) :
                $Usuario->setNome($_POST['nome']);
				$Usuario->setLogin($_POST['login']);
				$Usuario->setSenha($_POST['senha']);
				$Usuario->setCpf($Usuario->mask($_POST['cpf'], false));
				$Usuario->setAtivo($_POST['tipo']);
				$Usuario->Cadastrar();
				
                unset($_POST['cadastrarUsuario']);
				
                ?>
                    <div class="back"><a onclick="history.go(-2);">Voltar</a></div>
                <?
            else:
                ?>
                <div class="form_settings" id="frmDieta">
                    <form id="dieta" method="post" action="">
                    <p><span>Nome </span><input class="validate[required] text-input" type="text" name="nome" value=""/></p>
                    <p><span>Login </span><input class="validate[required] text-input" type="text" style="width:200px;" name="login" value=""/></p>
                    <p><span>Senha</span><input class="validate[required] text-input " type="password" style="width:150px;" name="senha" value=""/></p>
                    <p><span>CPF </span><input class="validate[required] text-input" type="text" style="width:150px;" name="cpf" maxlength="14" value="" onkeypress="mask(this, event, '???.???.???-??')" /></p>

                    <p>
                           <span>Status </span>
                           <input type="radio" checked="checked" class="checkbox" name="tipo" value="S" />Ativo
                           <input type="radio" class="checkbox" name="tipo" value="N" style="margin: 0 0 0 50px"/>Inativo
                    </p>
                    
                   <hr>
                            <input class="submit" type="submit" style ="margin: 10px 0 0 0" name="cadastrarUsuario" value="Cadastrar"/>
                            <input class="submit" type="reset" style ="margin-left: 10px;" name="limpar" value="Limpar"/>
                            <input class="submit" type="button" onclick="history.go(-1);" value="Cancelar" style="margin: 0 0 0 10px;"/>
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