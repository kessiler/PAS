<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KESSILER
 * Date: 16/09/12
 * Time: 15:34
 * To change this template use File | Settings | File Templates.
 */


if (!class_exists('Application')) {

    class Application
    {

        public function __construct()
        {
            $this->Security = new Security();
        }

        public function run()
        {
            $pg = empty($_GET['page']) ? null : $_GET['page'];
            switch ($pg) {
                case 'Home':
                    return $this->view($pg);
                    break;
                case 'Login':
                    return $this->view($pg);
                case 'User':
                    return $this->view($pg);
                case 'Idosos':
                    return $this->view($pg);
                case 'Produtos':
                    return $this->view($pg);
                case 'Dietas':
                    return $this->view($pg);
                case 'DietasCad':
                    return $this->view($pg);
                case 'DietasAlter':
                    return $this->view($pg);
                case 'DietasExcl':
                    return $this->view($pg);
                case 'EntradaAtivos':
                    return $this->view($pg);
                case 'SaidaAtivos':
                    return $this->view($pg);
                case 'RelacaoDietas':
                    return $this->view($pg);
                case 'RelacaoMedicamentos':
                    return $this->view($pg);
                case 'Logout':
                    session_destroy();
                    header('location: ?');
                default:
                    if (empty($pg)) {
                        if (!isset($_SESSION[SESSION_NAME])) {
                            return $this->view('Login');
                        } else {
                            return $this->view('Home');
                        }
                    } else {
                        return $this->view('404.html');
                    }
                    break;
            }
        }


        private function view($page)
        {
            ob_start();
            $pgext = pathinfo($page, PATHINFO_EXTENSION);
            $page = (empty($pgext) ? $page . '.php' : $page);
            include('templates/' . TEMPLATE . 'header.php');
            $this->_header = ob_get_contents();
            include('templates/' . TEMPLATE . $page);
            include('templates/' . TEMPLATE . 'footer.php');
            $this->_footer = ob_get_contents();
            ob_end_flush();
        }
    }

}

?>