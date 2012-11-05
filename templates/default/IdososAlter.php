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
            <h1>Alteração do Cadastro de Idosos</h1>
            <?
            if (isset($_POST['alteridoso'])) :
					$Clientes->setNome($_POST['nome'])
						 ->setNascimento($_POST['nascimento'])
						 ->setResponsavel($_POST['responsavel'])
						 ->setParentesco($_POST['parentesco'])
						 ->setConvenio($_POST['medico'])
						 ->setBebe($_POST['alcool'])
						 ->setFuma($_POST['fuma'])
						 ->setVicio($_POST['vicio'])
						 ->setEscolaridade($_POST['escolaridade'])
						 ->setProfissao($_POST['prifissao'])
						 ->setCivil($_POST['civil'])
						 ->setFilhos($_POST['filho'])
						 ->setQTfilhos($_POST['quantindade_fi'])
                    ->update();
                unset($_POST['alteridoso']);
                $row = $Clientes->getIdodosById($_GET['id']);
            ?>
            <div class="back"><a href="?page=Idosos">Voltar</a></div>
            <?endif;?>
            <div class="form_settings";>   
				<form id="cadastro_vovo" method="post" action="" >
					<p><span>Nome Completo:</span> <input class="validate[required] text-input" style="width: 350px;"type="text" name="nome" value="<?=$row['NMCLIENTE'];?>"/></p>
					</br>
					<p><span>Data de nascimento:</span> <input class="validate[required] text-input" style="width: 75px; type="text" name="nascimento" value="<?=$row['DTNASCIMENTO'];?>"/></p>
					</br>
					<p><span>Nome do responsavel:</span> <input class="validate[required] text-input"style="width: 350px;" type="text" name="responsavel" value="<?=$row['NMRESPONSAVEL'];?>"/></p>
					</br>
					<p><span>Grau de parentesco:</span> <input class="validate[required] text-input" style="width: 150px;"type="text" name="parentesco" value="<?=$row['GRAUPARENTESCO'];?>"/></p>
					</br>
					<p><span>Convenio medico:</span> <input class="validate[required] text-input" style="width: 200px;"type="text" name="convenio" value="<?=$row['CONVENIOS'];?>"/></p>
					</br>
					<p><input style="width:1px;" type=checkbox name=alcool><span>Ingere bebidas alcoólicas</span></p>
					</br>
					<p><input style="width:1px;" type=checkbox name=fuma><span>Fuma</span></p>
					</br>
					<p><input style="width:1px;" type=checkbox name=vicio><span>Possui algum vicio </span></p>
					</br>
					<p><span>Grau de instrução:</span> <input class="validate[required] text-input" style="width: 150px;"type="text" name="escolaridade" value="<?=$row['ESCOLARIDADE'];?>"/></p>
					</br>
					<p><span>Profissão:</span> <input class="validate[required] text-input" style="width: 200px;"type="text" name="prifiss�o" value="<?=$row['PROFISSAO'];?>"/></p>
					</br>			
					<p><span>Possui filhos:</span></p>
					</br>					
					<p><span>Sim</span><input style="width:1px;"TYPE=RADIO NAME="filho" CHECKED></p>
					<p><span>Não</span><input style="width:1px;"TYPE=RADIO NAME="filho" CHECKED></p>
					</br>				
					<p><span>Quantos:</span> <input type="text" name="quantindade_fi" value="<?=$row['QTDFILHOS'];?> "></p>
					</br>
					<p>
					<span>Estado Civil:</span>
					<SELECT style="width: 75px;" name="civil" value="<?=$row['ESTADOCIVIL'];?>">	
						<option></option>
						<option value="Solteira"><span>Solteira</span></option>
						<option value="Casada"><span>Casada</span></option>
						<option value="Viuva"><span>Viuva</span></option>
					</SELECT>
					</p>					
						<BR></BR>
					<input name="Id" type="hidden" value="<?php echo $_GET['id'];?>"/>
					<input class="submit" type="submit" name="alterardieta" style="margin: 0 0 0 100px;" value="Alterar"/>
                    <input class="submit" type="button" onclick="history.go(-1);" value="Cancelar" style="margin: 0 0 0 100px;"/>
						
                </form>
            </div>
        </div>
    </div>
<? else:
    $Error->setError('� preciso estar logado para acessar a p�gina!');
    $Error->ShowDie();
endif;
?>