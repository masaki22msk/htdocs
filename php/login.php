<?php
session_start();
$mail = $_POST['mail'];
try {
    $pdo = new PDO('mysql:dbname=KASEDASABA;host=localhost;charset=utf8','kame','kame');
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

if( filter_var( $mail,FILTER_VALIDATE_EMAIL) ){
    $sql = "SELECT * FROM user WHERE mail = :mail";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':mail', $mail);
    $stm->execute();
    $member = $stm->fetch();
    //指定したハッシュがパスワードにマッチしているかチェック
    if (password_verify($_POST['password'], $member['password'])) {
        //DBのユーザー情報をセッションに保存
        $_SESSION['mail'] = $member['mail'];
        $_SESSION['name'] = $member['name'];
        $_SESSION['id'] = $member['id'];
        echo'ログインしました。';
        // $link = '<a href="mein.php">ホーム</a>';
        header('refresh:0;../popup_login.html');
        exit();
    } else {
        header('refresh:0;../popup_login3.html');
    }
}else{
    header('refresh:0;../popup_login2.html');
}

?>
