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
                        <li><a href="?page=RelacaoMedicamentos">Relação de Medicamentos</a></li>
                        <li><a href="javascript: void(Group4);">Relatórios de Estoque</a>
                            <ul>
                                <li><a href="?page=PosicaoEstoque">Posição de estoque</a></li>
                                <li><a href="?page=LogAtivos">Saída/Entrada Ativos</a></li>
                            </ul>
                        </li>
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
                        <th>Id</th>
                        <th>Nome completo</th>
                        <th>Dt. Nascimento</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?
                            if(!empty($arrValue)):
                                foreach($arrValue as $value):
                        ?>
                            <tr>
                                <th><?=$value['CDCLIENTE']?></th>
                                <td><?=$value['NMCLIENTE']?></td>
                                <td><?=date('d/m/Y', strtotime($value['DTNASCIMENTO']))?></td>
                                <th class="visualizar" id="visualizar"><a href="javascript: openPopUp();" style="text-decoration: none; color: #FFFFFF;">Visualizar</th>
                                <th class="update" id="AlterIdosos"><a href="?page=IdososAlter&id=<?=$value['CDCLIENTE']?>" style="text-decoration: none; color: #FFFFFF;">Alterar</a></th>
                                <th class="delete" id="ExclIdosos"><a href="?page=IdososExcl&id=<?=$value['CDCLIENTE']?>" style="text-decoration: none; color: #FFFFFF;">Excluir</a></th>
                            </tr>
                            <div id="dialog-form" title="Idosos" style="display: none;">
                                <div class="form_settings">
                                    <form>
                                    <p><span style="width: 130px">Nome Completo:</span><input class="validate[required] text-input" disabled="disabled"
                                                                                              style="width: 350px;"
                                                                                              type="text" name="nome" value="<?=$value['NMCLIENTE'];?>"/></p>

                                    <p><span style="width: 130px">Data de Nascimento:</span><input class="validate[required] text-input" disabled="disabled"
                                                                                                   style="width: 100px;" id="dtnascimento" type="text" name="nascimento"
                                                                                                   value="<?=date('d/m/Y', strtotime($value['DTNASCIMENTO']));?>" onfocus="datePicker('#dtnascimento');" onkeypress="mask(this, event,  '??/??/????');"/></p>

                                    <p><span style="width: 130px">Nome do Responsável:</span><input disabled="disabled"
                                            style="width: 350px;" type="text" name="responsavel"
                                            value="<?=$value['NMRESPONSAVEL']?>"/></p>

                                    <p><span style="width: 130px">Grau de Parentesco: </span><input disabled="disabled"
                                            style="width: 150px;" type="text" name="parentesco"
                                            value="<?=$value['GRAUPARENTESCO']?>"/></p>

                                    <p><span style="width: 130px">Convênio médico:</span> <input disabled="disabled"
                                            style="width: 200px;"
                                            type="text" name="convenio" value="<?=$value['CONVENIOS']?>"/></p>

                                    <p><span style="width: 150px">Ingere bebidas alcoólicas?</span><input disabled="disabled" class="checkbox" type="radio" <?($value['IDBEBE'] == 'S') ? print 'checked="checked"' : "";?> name="bebida" value="S">Sim
                                        <input class="checkbox" style="margin: 0 0 0 30px" disabled="disabled" type="radio" <?($value['IDBEBE'] == 'N') ? print 'checked="checked"' : "";?> name="bebida" value="N">Não
                                    <p><span style="width: 150px">Fuma?</span><input disabled="disabled" class="checkbox" type="radio" <?($value['IDFUMA'] == 'S') ? print 'checked="checked"' : "";?> name="fuma" value="S">Sim
                                        <input class="checkbox" style="margin: 0 0 0 30px"  disabled="disabled" type="radio" <?($value['IDFUMA'] == 'N') ? print 'checked="checked"' : "";?> name="fuma" value="N">Não</p>
                                    <p><span style="width: 130px">Vícios:</span><textarea rows="5" cols="50" disabled="disabled"
                                                                                          name="vicios"><?=$value['NMVICIOS']?></textarea></p>

                                    <p><span style="width: 130px">Grau de instrução:</span> <input
                                            style="width: 150px;" disabled="disabled" type="text" name="escolaridade"
                                            value="<?$value['GRAUPARENTESCO']?>"/></p>

                                    <p><span style="width: 130px">Profissão:</span> <input disabled="disabled" style="width: 200px;"
                                                                                            type="text" name="profissao" value="<?=$value['PROFISSAO']?>"/></p>

                                    <p><span style="width: 130px">Possui filhos:</span></p><input disabled="disabled" class="checkbox" type="radio" <?($value['IDFILHOS'] == 'S') ? print 'checked="checked"' : "";?> name="filho" value="S" onclick="$('.qtdfilhos').css('display', '');"">Sim
                                    <input disabled="disabled" class="checkbox" style="margin: 0 0 0 30px" type="radio" <?($value['IDFILHOS'] == 'N') ? print 'checked="checked"' : "";?> name="filho" value="N" onclick="$('.qtdfilhos').css('display', 'none');">Não
                                    <p class="qtdfilhos" <?($value['IDFILHOS'] == 'N') ? print 'style="display: none"' : "";?> ><span style="width: 130px">Quantos:</span><input type="text" disabled="disabled" style="width: 50px" name="quantindade_fi" value="<?=$value['QTDFILHOS'];?>"></p>

                                    <p>
                                        <span style="width: 130px">Estado Civil:</span>
                                        <select style="width: 110px;" name="civil" disabled="disabled">
                                            <option <?($value['ESTADOCIVIL'] == 'S') ? print 'selected="selected"' : "";?> value="S"><span>Solteiro(a)</span></option>
                                            <option <?($value['ESTADOCIVIL'] == 'C') ? print 'selected="selected"' : "";?> value="C"><span>Casado(a)</span></option>
                                            <option <?($value['ESTADOCIVIL'] == 'V') ? print 'selected="selected"' : "";?> value="V"><span>Viuvo(a)</span></option>
                                            <option <?($value['ESTADOCIVIL'] == 'D') ? print 'selected="selected"' : "";?> value="D"><span>Divorciado(a)</span></option>
                                        </select>
                                    </p>
                                    <p><span style="width: 130px">Avaliação Médica:</span><textarea rows="5" cols="50" disabled="disabled"
                                                                                                    name="avaliacao"><?$value['AVALIACAOMEDICA']?></textarea></p>
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