<?php
try {
    // SQLiteデータベースに接続
    $pdo = new PDO('sqlite:database/database.sqlite');
    
    // エラー発生時に例外をスローするよう設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // chirpsテーブルから全てのレコードを取得
    $stmt = $pdo->query('SELECT * FROM chirps');
    
    // 取得したデータを表示
    $chirps = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($chirps) {
        foreach ($chirps as $chirp) {
            echo "ID: " . $chirp['id'] . "\n";
            echo "User ID: " . $chirp['user_id'] . "\n";
            echo "Message: " . $chirp['message'] . "\n";
            echo "Created At: " . $chirp['created_at'] . "\n";
            echo "Updated At: " . $chirp['updated_at'] . "\n";
            echo "-----------------------------------\n";
        }
    } else {
        echo "No records found in the chirps table.\n";
    }
} catch (PDOException $e) {
    // エラーメッセージを表示
    echo 'Connection failed: ' . $e->getMessage();
}
?>

