<?php

require_once __DIR__ . '/config.php';

function connectDb()
{
    try {
        return new PDO (
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function findtaskBystatus($status)
{
    $dbh = connectDb();
    
    $sql = <<<EOM
    SELECT
        *
    FROM
        tasks
    WHERE
        status = :status;
    EOM;

    // プリペアー度ステイトメントの準備
    $stmt = $dbh->prepare($sql);

    // バインドするパラメータの準備
    $status = 'notyet';

    // パラメータのバインド
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);

    // プリペアドステートメントの実行
    $stmt->execute();

    // 結果の取得
    $notyet_tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

}