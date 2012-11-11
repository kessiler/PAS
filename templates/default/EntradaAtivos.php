<?
    $Error = new Error();
    if (isset($_SESSION[SESSION_NAME])):
        $Product = new Produto();
        $arrValue = $Product->getAllProduto();
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
            <h1>Entrada de Ativos</h1>
			<?
                if(empty($arrValue)) :	
                    $Error->setError('Não há produto cadastrado para ser realizado a operação!');
                    $Error->ShowError();
				elseif (isset($_POST['confirmentrada'])):
                $Product->setQtd($_POST['nome'])
				        ->setId($_POST['sele'])
						->updateEntradaFromQtd();
                unset($_POST['confirmentrada']);
            ?>
            <div class="back"><a href="?page=EntradaAtivos">Voltar</a></div>
            <? else:?>
            <div class="form_settings">
                <form id="EntradaAtivos" method="post" action="">
				     <p><span>Produto(s)</span>
                        <select id="sele" name="sele" style="height: 22px;">
						<? foreach($arrValue as $value): ?>
                            <option value="<?=$value['CDPRODUTO'];?>"><?=$value['NMPRODUTO'];?></option>
						<? endforeach;?>
                        </select>
                    </p>
                    <p><span>Quantidade de Entrada</span><input class="validate[required] text-input" type="text" name="nome" value=""/></p>
                    <input class="submit" type="submit" style="width: 120px; margin: 10px 0 0 190px;" name="confirmentrada" value="Confirmar entrada"/>
                </form>
            </div>
			<? endif; ?>
        </div>
    </div>
<? else:
    $Error->setError('É preciso estar logado para acessar a página!');
    $Error->ShowDie();
endif;
?>