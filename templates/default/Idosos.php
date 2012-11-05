<?
    $Error = new Error();
    if (isset($_SESSION[SESSION_NAME])):
        $Clientes = new Clientes();
        $arrValue = $Clientes->getAllClientes();
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
                <li><a href="?page=Home">Início</a></li>
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
                        <li><a href="?page=RelacaoMedicamentos">Relação de Medicamentos</a></li>
                    </ul>
                </li>
                <li><a href="?page=Logout">Sair do Sistema</a></li>
            </ul>
        </nav>
    </header>
	<div id="site_content">
        <div id="content">
				<h1>Idosos</h1>
			<?
                if(empty($arrValue)) {
                    $Error->setError('Não há idosos cadastrados!');
                    $Error->ShowError();
                }
            ?>
            <div id="table">
                <table>
                    <thead>
                    <tr>
                        <th>Dt. Nascimento</th>
                        <th>Nome completo</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?
                            if(!empty($arrValue)):
                                foreach($arrValue as $value):
                        ?>
                            <tr>
                                <td><?=date('d-m-Y', strtotime($value['DTNASCIMENTO']))?></td>
                                <td><?=$value['NMCLIENTE']?></td>
                                <th class="visualizar" id="visualizar"><a href="javascript: openPopUp();" style="text-decoration: none; color: #FFFFFF;">Visualizar</th>
                                <th class="update" id="AlterIdosos"><a href="?page=IdososAlter&id=<?=$value['CDCLIENTE']?>" style="text-decoration: none; color: #FFFFFF;">Alterar</a></th>
                                <th class="delete" id="ExclIdosos"><a href="?page=IdososExcl&id=<?=$value['CDCLIENTE']?>" style="text-decoration: none; color: #FFFFFF;">Excluir</a></th>
                            </tr>
                            <div id="dialog-form" title="Idosos" style="display: none;">
                                <div class="form_settings">
                                <form>
                                    <fieldset>
                                        <label for="name">Nome Completo</label>
                                        <input type="text" name="name" disabled="disabled" id="name" class="text ui-widget-content ui-corner-all" value="<?=$value['NMCLIENTE']?>"/>
                                        <label for="dtnaascimento">Data Nascimento</label>
                                        <input type="text" name="dtnaascimento" id="dtnaascimento" disabled="disabled" class="text ui-widget-content ui-corner-all" value="<?=date('d-m-Y', strtotime($value['DTNASCIMENTO']))?>" />
                                    </fieldset>
                                </form>
                                </div>
                            </div>
                        <?
                                endforeach;
                            endif;
                        ?>
                    <tr>
                        <th class="insert" id="InsIdosos"><a href="?page=IdososCad" style="text-decoration: none; color: #FFFFFF;">Incluir</a></th>
                    </tr>
                    </tbody>
                </table>
            </div>
		</div>
	</div>
</div>
<? else:
    $Error->setError('É preciso estar logado para acessar a página!');
    $Error->ShowDie();
endif;
?>