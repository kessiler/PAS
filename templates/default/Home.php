<?
$Error = new Error();
if (isset($_SESSION[SESSION_NAME])): ?>
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
        <div id="sidebar_container">
            <div class="gallery">
                <ul class="images">
                    <li class="show"><img width="450" height="450" src="images/slide1.jpg" alt="1"/></li>
                    <li><img width="450" height="450" src="images/slide2.jpg" alt="2"/></li>
                    <li><img width="450" height="450" src="images/slide3.jpg" alt="3"/></li>
                    <li><img width="450" height="450" src="images/slide4.jpg" alt="4"/></li>
                    <li><img width="450" height="450" src="images/slide5.jpg" alt="5"/></li>
                </ul>
            </div>
        </div>
        <div id="content" style="text-align: left; float: left; width: 440px;">
            <h1>Seja bem vindo - Asilo Nossa Senhora da Piedade, também conhecido como "Lar da Vovó".</h1>

            <p>Há 40 anos o Asilo Nossa Senhora da Piedade, mais conhecido como Lar da Vovó, surgiu do sonho de mudar a
                realidade de abandono de muitos idosos brasileiros. Em março de 1969, o casal Geraldo de Almeida e
                Dávila de Freitas Almeida resolveu colocar em prática esse sonho e fundaram o Lar da Vovó.

            <p> Foram muitos anos de luta, obras, busca de parceiros e verbas, mas em setembro de 1987 o Asilo pôde
                finalmente abrir suas portas e receber suas primeiras moradoras. Até então, o Lar da Vovó prestava
                assistência domiciliar à vários idosos doando-lhes cestas básicas, medicamentos, roupas e ajudando-os no
                que fosse necessário e possível.

            <p> Em 1987 houve a concretização de um projeto que não se encerrava, mas sim iniciava em toda sua
                plenitude. De lá para cá, ampliou-se o número de dormitórios, funcionários e amigos que conheceram e
                abraçaram a causa do Lar da Vovó. Inúmeras idosas foram assistidas pelo Lar da Vovó e deixaram saudades,
                outras continuam a nos presentear a cada dia com seus ensinamentos e sorrisos. Sabemos que muitas outras
                passarão e deixarão suas marcas na história do Lar da Vovó, pois, infelizmente, a realidade de abandono
                dos idosos não se modificou. Contudo, sabemos que o Lar da Vovó tem feito sua parte, transformado a vida
                de pelo menos algumas dezenas de idosas, dando-lhes carinho e respeito, além de um lar digno composto
                por salas, dormitórios, lavanderia e cozinha industrial, capela, sala de fisioterapia, ambulatório
                médico, sala para a realização de trabalhos manuais, dentre outras dependências de simples acabamentos,
                primadas pela higiene e pela limpeza.
        </div>
    </div>
</div>
<? else:
    $Error->setError('É preciso estar logado para acessar a página!');
    $Error->ShowDie();
endif;
?>