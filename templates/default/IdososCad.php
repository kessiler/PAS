<?
$Error = new Error();
if (isset($_SESSION[SESSION_NAME])):
    $Clientes = new Clientes();
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
            <h1>Cadastro de Idosos</h1>
            <?
            if (isset($_POST['cadastraridoso'])) :
                $Clientes->setNome($_POST['nome'])
                    ->setNascimento($_POST['nascimento'])
                    ->setResponsavel($_POST['responsavel'])
                    ->setParentesco($_POST['parentesco'])
                    ->setConvenio($_POST['convenio'])
                    ->setBebe($_POST['alcool'])
                    ->setFuma($_POST['fuma'])
                    ->setVicio($_POST['vicio'])
                    ->setEscolaridade($_POST['escolaridade'])
                    ->setProfissao($_POST['prifissão'])
                    ->setCivil($_POST['civil'])
                    ->setFilhos($_POST['filho'])
                    ->setQTfilhos($_POST['quantindade_fi'])
                    ->insert();
                unset($_POST['cadastraridoso']);
                ?>
                <div class="back"><a onclick="history.go(-2);">Voltar</a></div>
                <? else:
                ?>
                <div class="form_settings" id="cadastro">
                    <form id="cadastro_vovo" method="post" action="">
                        <p><span>Nome Completo:</span><input class="validate[required] text-input" style="width: 350px;"
                                                             type="text" name="nome" value=""/></p>

                        <p><span>Data de nascimento:</span><input class="validate[required] text-input"
                                                                  style="width: 75px;" type="text" name="nascimento"
                                                                  value=""/></p>

                        <p><span>Nome do responsavel:</span><input class="validate[required] text-input"
                                                                   style="width: 350px;" type="text" name="responsavel"
                                                                   value=""/></p>

                        <p><span>Grau de parentesco:</span><input class="validate[required] text-input"
                                                                  style="width: 150px;" type="text" name="parentesco"
                                                                  value=""/></p>

                        <p><span>Convenio medico:</span> <input class="validate[required] text-input"
                                                                style="width: 200px;"
                                                                type="text" name="convenio" value=""/></p>

                        <p><input style="width:1px;" type=checkbox name=alcool><span>Ingere bebidas alcoólicas</span>
                        </p>

                        <p><input style="width:1px;" type=checkbox name=fuma><span>Fuma</span></p>

                        <p><input style="width:1px;" type=checkbox name=vicio><span>Possui algum vicio </span></p>

                        <p><span>Grau de instrução:</span> <input class="validate[required] text-input"
                                                                  style="width: 150px;" type="text" name="escolaridade"
                                                                  value=""/></p>

                        <p><span>Profissão:</span> <input class="validate[required] text-input" style="width: 200px;"
                                                          type="text" name="prifissão" value=""/></p>

                        <p><span>Possui filhos:</span></p><input style="width:60px;" type="radio" name="filho">Sim
                        <input style="width:60px;" type="radio" name="filho">Não

                        <p><span>Quantos:</span> <input type="text" name="quantindade_fi" value=" "></p>

                        <p>
                            <span>Estado Civil:</span>
                            <select style="width: 110px;" name="civil">
                                <option value="Solteira">Solteiro(a)</option>
                                <option value="Casada">Casado(a)</option>
                                <option value="Viuva">Viuvo(a)</option>
                                <option value="Divorciada">Divorciado(a)</option>
                            </select>
                        </p>
                        <input class="submit" type="submit" name="cadastraridoso" style="margin: 20px 0 0 80px;" value="Cadastrar"/>
                        <input class="submit" type="reset" value="Limpar" style="margin: 0 0 0 20px;"/>
                        <input class="submit" type="button" onclick="history.go(-1);" value="Cancelar" style="margin: 0 0 0 20px;"/>
                    </form>
                </div>
                <? endif;?>
        </div>
    </div>
</div>
<? else:
    $Error->setError('É preciso estar logado para acessar a página!');
    $Error->ShowDie();
endif;
?>