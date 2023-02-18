<?php


//$login = "rimuru";
//$password = "ri";
$login=["rimuru"]="ri";
if(isset($_SERVER['PHP_AUTH_USER']) && ($login[$_SERVER['PHP_AUTH_USER']]==$_SERVER['PHP_AUTH_PW'])){
//($_SERVER['PHP_AUTH_PW']==$password) && (strtolower($_SERVER['PHP_AUTH_USER'])==$login)){
    // авторизован успешно
    echo 'Success auth!';
} else {
    // если ошибка при авторизации, выводим соответствующие заголовки и сообщение
    header('WWW-Authenticate: Basic realm="Brevno and Co"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Обратитесь к римуру он выдаст вам пароль';
}

