<?
    $Error = new Error();
    if (isset($_SESSION[SESSION_NAME])):
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
                        <li><a href="?page=User">Usuários</a></li>
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
                    </ul>
                </li>
                <li><a href="?page=Logout">Sair do Sistema</a>
            </ul>
        </nav>
    </header>
    <div id="site_content">
        <div id="content">
            <h1>Cadastro de Dietas</h1>
            <div class="form_settings">
                <form id="dieta" method="post" action="">
                    <p><span>Nome</span><input class="validate[required] text-input" type="text" name="nome" value=""/></p>
                    <p><span>Descrição</span><textarea class="textarea" rows="5" cols="50" name="descricao"></textarea></p>
                    <p><span>Status</span>
                        <select id="sele">
                            <option value="S">Ativada</option>
                            <option value="N">Desativada</option>
                        </select>
                    </p>
                    <input class="submit" type="submit" name="cadastrardieta" value="Cadastrar"/>
                </form>
                <?
                    if (isset($_POST['cadastrardieta'])) {
                        $Dieta = new Dieta();
                        $Dieta->setNome($_POST['nome'])
                              ->setDescricao($_POST['descricao'])
                              ->setStatus($_POST['sele'])
                              ->insert();
                    }
                ?>
            </div>
        </div>
    </div>
<? else:
    $Error->setError('É preciso estar logado para acessar a página!');
    $Error->ShowDie();
endif;
?>