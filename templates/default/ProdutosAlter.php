<? 
$Error = new Error();
if (isset($_SESSION[SESSION_NAME])): 
	$Produto = new Produto();
    $row = $Produto->getProdutoById($_GET['id']);
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
            <h1>Alteração de Produto</h1>
            <?
				if (isset($_POST['alterarproduto'])) :
                $Produto->setNome($_POST['nome'])
                    ->setDescricao($_POST['descricao'])
                    ->setTipoProd($_POST['sele'])
                    ->setId($_POST['Id'])
                    ->update();
                unset($_POST['alterarproduto']);
                $row = $Produto->getProdutoById($_GET['id']);
            ?>
            <div class="back"><a href="?page=Produtos">Voltar</a></div>
            <?endif;?>
            <div class="form_settings" id="frmProduto">
                <form id="produto" method="post" action="">
                    <p><span>Nome</span><input class="validate[required] text-input" type="text" name="nome" value="<?=$row['NMPRODUTO'];?>"/></p>
                    <p><span>Descrição</span><textarea class="validate[required] text-input" rows="5" cols="50" name="descricao"><?=$row['DSPRODUTO'];?></textarea></p>
                     <p><span>Tipo</span>
                            <select id="sele" name="sele">
                                <option <?($row['TIPOPROD'] == 'M') ? print 'selected="selected"' : "";?> value="M">Medicamento</option>
                                <option <?($row['TIPOPROD'] == 'A') ? print 'selected="selected"' : "";?> value="A">Alimentar</option>
								<option <?($row['TIPOPROD'] == 'O') ? print 'selected="selected"' : "";?> value="O">Outros</option>
                            </select>
                        </p>
                    <input name="Id" type="hidden" value="<?php echo $_GET['id'];?>"/>
                    <input class="submit" type="submit" name="alterarproduto" style="margin: 10px 0 0 100px;" value="Alterar"/>
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