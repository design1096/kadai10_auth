<?php
session_start();
include("funcs.php");

//1. POSTデータ取得
$name      = filter_input( INPUT_POST, "name" );
$lid       = filter_input( INPUT_POST, "lid" );
$lpw       = filter_input( INPUT_POST, "lpw" );
$lpw       = password_hash($lpw, PASSWORD_DEFAULT);   //パスワードハッシュ化

//2. DB接続します
$pdo = db_conn_local();

//３．データ登録SQL作成
$sql = "INSERT INTO gs_user_table(name,lid,lpw,life_flg)VALUES(:name,:lid,:lpw,0)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    echo "<script>alert('ユーザ登録が完了しました。');</script>";
    echo "<script>window.location = 'login.php';</script>";
    exit();
}
