<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KESSILER
 * Date: 16/09/12
 * Time: 16:22
 * To change this template use File | Settings | File Templates.
 */
if (!class_exists('Security')) {

    class Security
    {
        public function __construct()
        {
            $this->loadSessionProtect();
            foreach ($_POST as $key => $Send) {
                $_POST[$key] = $this->RemoveCharacters($Send);
            }
            foreach ($_GET as $key => $Send) {
                $_GET[$key] = $this->RemoveCharacters($Send);
            }
            foreach ($_REQUEST as $key => $Send) {
                $_REQUEST[$key] = $this->RemoveCharacters($Send);
            }
        }

        private function RemoveCharacters($string)
        {
            $this->badwords = array("'", ";", "--");
            return str_replace($this->badwords, NULL, $string);
        }

        private function loadSessionProtect()
        {
            session_regenerate_id();
            if (array_key_exists("HTTP_USER_AGENT", $GLOBALS['_SESSION'])) {
                if ($GLOBALS['_SESSION']['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])) {
                    session_destroy();
                    exit("<script>location.href='?'</script>");
                }
            } else {
                $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
            }
        }
    }


}
?>
