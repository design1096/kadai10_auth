<?php
session_start();
include("funcs.php");

//1.ログインチェック
sschk();
$id = $_SESSION["id"];

//2. ログインユーザ情報取得SQL作成
$pdo = db_conn_local();
$sql = "SELECT name,lid FROM gs_user_table WHERE id=:id;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$values = "";
if ($status==false) {
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}

//4. 全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

//5. lid取得
$lid = "";
foreach ($values as $value) {
    $lid = $value['lid'];
}

//6. ユーザプレイリスト情報取得SQL作成
$playlist_sql = "SELECT video_id FROM playlist_user WHERE lid=:lid;";
$playlist_stmt = $pdo->prepare($playlist_sql);
$playlist_stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$playlist_status = $playlist_stmt->execute();

//7. データ表示
$playlist_values = "";
if ($playlist_status==false) {
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}

//8. 全データ取得
$playlist_values =  $playlist_stmt->fetchAll(PDO::FETCH_ASSOC);
$playlist_json = json_encode($playlist_values,JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style_select.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Let's make a playlist!</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li class="menu" id="greet"></li>
            </ul>
            <ul class="logout">
                <li><a href="logout.php">ログアウト</a></li> 
            </ul>
        </nav>
    </header>
    <main>
        <div id="player"></div>
    </main>
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        // JavaScriptのコードを即時関数でラップする
        (function() {
            let player; // プレーヤーオブジェクトをグローバルに宣言

            // YouTubeプレーヤーを作成する関数
            function onYouTubeIframeAPIReady() {
                player = new YT.Player('player', {
                    height: '730px',
                    width: '100%',
                    playerVars: {
                        'autoplay': 0,  // 自動再生を無効にする
                        'controls': 1,  // コントロールバーを表示する
                        'modestbranding': 1,  // YouTubeロゴを非表示にする
                        'rel': 0  // 関連動画を非表示にする
                    },
                    events: {
                        'onReady': onPlayerReady // プレーヤーが準備完了したときに呼び出される関数を指定
                    }
                });
            }

            // プレーヤーが準備完了したときに呼び出される関数
            function onPlayerReady(event) {
                // プレーヤーが準備完了したら、再生を開始する
                const playlist = '<?php echo $playlist_json; ?>';
                const playlist_obj = JSON.parse(playlist);
                let videoId_list = playlist_obj.map(item => item.video_id);
                if (videoId_list.length > 0) {
                    playVideos(videoId_list);
                }
            }

            // 複数の動画を再生する関数
            function playVideos(videoIds) {
                console.log("再生します。");
                player.cuePlaylist(videoIds);
            }

            // ユーザ情報取得
            const list = '<?php echo $json; ?>';
            const list_obj = JSON.parse(list);
            const greet_str = 'こんにちは、' + list_obj[0].name + ' さん';
            $('#greet').html('');
            $('#greet').html(greet_str);

            // YouTube APIの読み込みとYouTubeプレーヤーの初期化
            onYouTubeIframeAPIReady();
        })();
    </script>
</body>
</html>