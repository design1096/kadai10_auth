<?php
//1. POSTデータ取得
$id     = $_POST["id"];
$title  = $_POST["title"];
$url    = $_POST["url"];

//2. DB接続
include("funcs.php");
$pdo = db_conn_local();

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE free_bgm SET title=:title,url=:url WHERE id=:id");
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':url',   $url,   PDO::PARAM_STR);
$stmt->bindValue(':id',    $id,    PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status==false) {
    sql_error($stmt);
} else {
    redirect("select.php");
}
?>