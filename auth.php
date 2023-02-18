<?php
header("Content-Type: text/plain; charset=UTF-8");
// данные от лаунчера
$login    = addslashes($_GET['username']);
$password = addslashes($_GET['password']);
//print "$login $password";
// получаем данные настройки соединения из config.php
$db_port= '3307';
$db_host= "10.211.24.2";
$db_name= 'minepanel';
$db_login='minepanel';
$db_passw='minepanel';

$link = mysqli_connect("$db_host:$db_port", $db_login, $db_passw, $db_name) or die("Ошибка ".mysqli_error($link));
$query = "SELECT role_id, name, password FROM users WHERE (name='{$login}' OR email='{$login}') LIMIT 1";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if($result) {
    $rows = mysqli_num_rows($result);
    if ($rows==1) {
        $row = mysqli_fetch_row($result);
        $perm=$row[0];
        switch ($row[0]) {
            case '2':
                $perm = 3;
                break;
            case '6':
                $perm = 2;
                break;
            default:
                $perm = 0;
                break;
        }

        $reallogin=$row[1];
        $pass_hash=$row[2];
        if (password_verify($password,$pass_hash)){
            print("OK:$reallogin:$perm");
        }
        else {
            print("incorrect password \n");
        }
    }
    else {
        echo("Incorrect login or password 2 \n");
    }
}
else {
    echo("Incorrect login or password 1 \n");
}

mysqli_close($link);

