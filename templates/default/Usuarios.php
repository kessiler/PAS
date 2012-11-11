<?
    $Error = new Error();
    if (isset($_SESSION[SESSION_NAME])):
        $Usuario = new Usuario();
        $arrValue = $Usuario->ListarUsuario();
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
            <h1>Usuários</h1>

            <div class="form_settings">
                <table>
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Login</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?
                        if (!empty($arrValue)):
                            foreach ($arrValue as $value):
                                ?>
                            <tr>
                                <th><?=$value['CDUSUARIO']?></th>
                                <td><?=$value['NMLOGIN']?></td>
                                <td><?=$value['CDNOME']?></td>
                                <td><?=$Usuario->mask($value['CDCPF'], true)?></td>
                                <td><?=$Usuario->getStatusColor($value['IDATIVO'])?></td>
                                <th class="update" id="AlterUsuarios"><a
                                        href="?page=UsuariosAlter&id=<?=$value['CDUSUARIO']?>"
                                        style="text-decoration: none; color: #FFFFFF;">Alterar</a></th>
                                <th class="delete" id="ExclUsuarios"><a
                                        href="?page=UsuariosExcl&id=<?=$value['CDUSUARIO']?>"
                                        style="text-decoration: none; color: #FFFFFF;">Excluir</a></th>
                            </tr>
                                <?

                            endforeach;
                        endif;
                        ?>
                    <tr>
                        <th class="insert" id="InsUsuarios"><a href="?page=UsuariosCad"
                                                            style="text-decoration: none; color: #FFFFFF;">Incluir</a>
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<? else:
        $Error->setError('É preciso estar logado para acessar a página!');
        $Error->ShowDie();
    endif;
?>