<?
$Error = new Error();
if (isset($_SESSION[SESSION_NAME])):
    $Clientes = new Clientes();
    $row = $Clientes->getIdodosById($_GET['id']);
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
            <h1>Alteração do Cadastro de Idosos</h1>
            <?
            if (isset($_POST['alterarcliente'])) :
                $Clientes->setNome($_POST['nome'])
                    ->setNascimento($_POST['nascimento'])
                    ->setResponsavel($_POST['responsavel'])
                    ->setParentesco($_POST['parentesco'])
                    ->setConvenio($_POST['convenio'])
                    ->setBebe($_POST['bebida'])
                    ->setFuma($_POST['fuma'])
                    ->setVicio($_POST['vicios'])
                    ->setEscolaridade($_POST['escolaridade'])
                    ->setProfissao($_POST['profissao'])
                    ->setCivil($_POST['civil'])
                    ->setFilhos($_POST['filho'])
                    ->setQTfilhos($_POST['quantindade_fi'])
                    ->setAvaliacao($_POST['avaliacao'])
                    ->setId($_POST['Id'])
                    ->update();
                unset($_POST['alterarcliente']);
                $row = $Clientes->getIdodosById($_GET['id']);
            ?>
            <div class="back"><a href="?page=Idosos">Voltar</a></div>
            <?endif;?>
            <div class="form_settings" id="cadastro">
                <form id="cadastro_vovo" method="post" action="">
                    <p><span style="width: 120px">Nome Completo:</span><input class="validate[required] text-input"
                                                                              style="width: 350px;"
                                                                              type="text" name="nome" value="<?=$row['NMCLIENTE'];?>"/></p>

                    <p><span style="width: 120px">Data de Nascimento:</span><input class="validate[required] text-input"
                                                                                   style="width: 100px;" id="dtnascimento" type="text" name="nascimento"
                                                                                   value="<?=date('d/m/Y', strtotime($row['DTNASCIMENTO']));?>" onfocus="datePicker('#dtnascimento');" onkeypress="mask(this, event,  '??/??/????');"/></p>

                    <p><span style="width: 120px">Nome do Responsável:</span><input
                            style="width: 350px;" type="text" name="responsavel"
                            value="<?=$row['NMRESPONSAVEL']?>"/></p>

                    <p><span style="width: 120px">Grau de Parentesco: </span><input
                            style="width: 150px;" type="text" name="parentesco"
                            value="<?=$row['GRAUPARENTESCO']?>"/></p>

                    <p><span style="width: 120px">Convênio médico:</span> <input
                            style="width: 200px;"
                            type="text" name="convenio" value="<?=$row['CONVENIOS']?>"/></p>

                    <p><span style="width: 150px">Ingere bebidas alcoólicas?</span><input class="checkbox" type="radio" <?($row['IDBEBE'] == 'S') ? print 'checked="checked"' : "";?> name="bebida" value="S">Sim
                        <input class="checkbox" style="margin: 0 0 0 30px" type="radio" <?($row['IDBEBE'] == 'N') ? print 'checked="checked"' : "";?> name="bebida" value="N">Não
                    <p><span style="width: 150px">Fuma?</span><input class="checkbox" type="radio" <?($row['IDFUMA'] == 'S') ? print 'checked="checked"' : "";?> name="fuma" value="S">Sim
                        <input class="checkbox" style="margin: 0 0 0 30px" type="radio" <?($row['IDFUMA'] == 'N') ? print 'checked="checked"' : "";?> name="fuma" value="N">Não</p>
                    <p><span style="width: 120px">Vícios:</span><textarea rows="5" cols="50"
                                                                          name="vicios"><?=$row['NMVICIOS']?></textarea></p>

                    <p><span style="width: 120px">Grau de instrução:</span> <input
                            style="width: 150px;" type="text" name="escolaridade"
                            value="<?$row['GRAUPARENTESCO']?>"/></p>

                    <p><span style="width: 120px">Profissão:</span> <input  style="width: 200px;"
                                                                            type="text" name="profissao" value="<?=$row['PROFISSAO']?>"/></p>

                    <p><span style="width: 120px">Possui filhos:</span></p><input class="checkbox" type="radio" <?($row['IDFILHOS'] == 'S') ? print 'checked="checked"' : "";?> name="filho" value="S" onclick="$('.qtdfilhos').css('display', '');"">Sim
                    <input class="checkbox" style="margin: 0 0 0 30px" type="radio" <?($row['IDFILHOS'] == 'N') ? print 'checked="checked"' : "";?> name="filho" value="N" onclick="$('.qtdfilhos').css('display', 'none');">Não
                    <p class="qtdfilhos" <?($row['IDFILHOS'] == 'N') ? print 'style="display: none"' : "";?> ><span style="width: 120px">Quantos:</span><input type="text" style="width: 50px" name="quantindade_fi" value="<?=$row['QTDFILHOS'];?>"></p>

                    <p>
                        <span style="width: 120px">Estado Civil:</span>
                        <select style="width: 110px;" name="civil">
                            <option <?($row['ESTADOCIVIL'] == 'S') ? print 'selected="selected"' : "";?> value="S"><span>Solteiro(a)</span></option>
                            <option <?($row['ESTADOCIVIL'] == 'C') ? print 'selected="selected"' : "";?> value="C"><span>Casado(a)</span></option>
                            <option <?($row['ESTADOCIVIL'] == 'V') ? print 'selected="selected"' : "";?> value="V"><span>Viuvo(a)</span></option>
                            <option <?($row['ESTADOCIVIL'] == 'D') ? print 'selected="selected"' : "";?> value="D"><span>Divorciado(a)</span></option>
                        </select>
                    </p>
                    <p><span style="width: 120px">Avaliação Médica:</span><textarea rows="5" cols="50"
                                                                                    name="avaliacao"><?$row['AVALIACAOMEDICA']?></textarea></p>
                    <hr>
					<input name="Id" type="hidden" value="<?php echo $_GET['id'];?>"/>
					<input class="submit" type="submit" name="alterarcliente" style="margin: 10px 0 0 0;"  value="Alterar"/>
                    <input class="submit" type="button" onclick="history.go(-1);" value="Cancelar" style="margin: 0 0 0 10px;"/>
						
                </form>
            </div>
        </div>
    </div>
<? else:
    $Error->setError('� preciso estar logado para acessar a p�gina!');
    $Error->ShowDie();
endif;
?>