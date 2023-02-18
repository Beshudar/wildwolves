<?php

//$test=password_hash("25602560",PASSWORD_DEFAULT,array('BCRYPT_ROUNDS' => 10) );
$test=password_hash("25602560",PASSWORD_DEFAULT,array('salt' => "10") );
//$test=password_hash("25602560",PASSWORD_DEFAULT);
//$test=password_hash("25602560",PASSWORD_ARGON2I);
print ($test);
print ("\n\n");
print (password_verify("q25602560",'$2y$10$B4BOp54mcL9JbN52lop/IuSEyKUd1F.S0m1EjxmM70VWDljHlrL/i') ? "да они совпали":"Нет они не совпали" );
print ("\n\n");
print (password_verify("25602560",'$2y$10$B4BOp54mcL9JbN52lop/IuSEyKUd1F.S0m1EjxmM70VWDljHlrL/i') ? "да они совпали":"Нет они не совпали" );
//$2y$10$B4BOp54mcL9JbN52lop/IuSEyKUd1F.S0m1EBCRYPT_ROUNDS', 10jxmM70VWDljHlrL/i");
print ("\n\n");
