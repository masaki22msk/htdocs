<?php
session_start();
$_SESSION = array();//セッションの中身をすべて削除
session_destroy();//セッションを破壊
echo"ログアウトしました。";
header('refresh:0;http://localhost/kame/popup_logout.html');
    exit();
?>

