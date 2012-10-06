<div id="main">
    <header>
        <div id="logo">
            <div id="logo_text">
                <h1><a href="/">Lar da<span class="logo_colour"> Vovó</span></a></h1>
                <h2>Asilo Nossa Senhora da Piedade.</h2>
            </div>
        </div>
        <nav>
        </nav>
    </header>
    <div id="site_content">
        <div id="content">
            <div class="form_settings" style="width:350px;margin: 0 auto; padding-top:10px">
                <form id="login" method="post" action="">
                    <p><span>Usuário</span><input class="validate[required] text-input" type="text" name="name" value=""/></p>
                    <p><span>Senha</span><input class="validate[required] text-input" type="password" name="senha" value=""/></p>
                    <input class="submit" type="submit" name="login_submit" value="Login"/></p>
                </form>
            </div>
        </div>
    </div>
</div>
<?
if(isset($_POST['login_submit'])) {
    $Login = new Login($_POST['name'], $_POST['senha']);
    $Login->start();
}
?>