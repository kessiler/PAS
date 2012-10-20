<?
$Error = new Error();
if (isset($_SESSION[SESSION_NAME])):
    $Dieta = new Dieta();
    $row = $Dieta->getDietaById($_GET['id']);
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
            <h1>Alteração de Dietas</h1>
            <?
            if (isset($_POST['alterardieta'])) :
                $Dieta->setNome($_POST['nome'])
                    ->setDescricao($_POST['descricao'])
                    ->setStatus($_POST['sele'])
                    ->setId($_POST['Id'])
                    ->update();
                unset($_POST['alterardieta']);
                $row = $Dieta->getDietaById($_GET['id']);
            ?>
            <div class="back"><a href="?page=Dietas">Voltar</a></div>
            <?endif;?>
            <div class="form_settings" id="frmDieta">
                <form id="dieta" method="post" action="">
                    <p><span>Nome</span><input class="validate[required] text-input" type="text" name="nome" value="<?=$row['NMDIETA'];?>"/></p>
                    <p><span>Descrição</span><textarea class="validate[required] text-input" rows="5" cols="50" name="descricao"><?=$row['DSDIETA'];?></textarea></p>
                    <p><span>Status</span>
                        <select id="sele" name="sele">
                            <option value="S">Ativada</option>
                            <option value="N">Desativada</option>
                        </select>
                    </p>
                    <input name="Id" type="hidden" value="<?php echo $_GET['id'];?>"/>
                    <input class="submit" type="submit" name="alterardieta" style="margin: 0 0 0 100px;" value="Alterar"/>
                    <input class="submit" type="button" onclick="history.go(-1);" value="Cancelar" style="margin: 0 0 0 100px;"/>
                </form>
            </div>
        </div>
    </div>
<? else:
    $Error->setError('É preciso estar logado para acessar a página!');
    $Error->ShowDie();
endif;
?>