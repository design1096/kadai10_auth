<?php
//1. GETデータ取得
$id     = $_GET["id"];

//2. DB接続
include("funcs.php");
$pdo = db_conn_local();

//３．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM free_bgm WHERE id=:id");
$stmt->bindValue(':id',    $id,    PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status==false) {
    sql_error($stmt);
} else {
    redirect("select.php");
}
?>