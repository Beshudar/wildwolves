<?php
//print "$login $password";
// получаем данные настройки соединения из config.php

$fileshabl='/var/www/minepanel/storage/app/public/skins/%id%.png';
$filefail= '/var/www/minepanel/storage/app/public/skins/steve.png';
$db_port= '3307';
$db_host= "10.211.24.2";
$db_name= 'minepanel';
$db_login='minepanel';
$db_passw='minepanel';

$login    = addslashes($_GET['username']);
$act      = addslashes($_GET['act']);

$link = mysqli_connect("$db_host:$db_port", $db_login, $db_passw, $db_name) or die("Ошибка ".mysqli_error($link));


function query($sql) {
    global $link;
    print $sql;
    return mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
}

switch ($act) {
    case 'auto':
    $password = addslashes($_GET['password']);
    $result = query("SELECT role_id, name, password FROM users WHERE (name='{$login}' OR email='{$login}') LIMIT 1");
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
                header("Content-Type: text/plain; charset=UTF-8");
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
    break;

    case 'skin':

    $result = query("SELECT id FROM users WHERE (name='{$login}' OR email='{$login}') LIMIT 1");
    if($result) {
        $rows = mysqli_num_rows($result);
        if ($rows==1) {
            $row = mysqli_fetch_row($result);
            $id=$row[0];
        }
        else {
            $id="";
        }
    }
    else {
        print (" ai ai ");

        $id="";
    }
    $file=str_replace('%id%',$id,$fileshabl);
    if (file_exists($file)) {
        header("Content-Type: image/png");
        print file_get_contents($file);
    }
    else {
        print "Not skin";
        //print file_get_contents($filefail);
    }
    mysqli_close($link);
    break;

}

