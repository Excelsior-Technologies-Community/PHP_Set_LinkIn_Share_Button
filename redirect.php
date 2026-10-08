<?php
// Short URL Redirector & Click Analytics Tracker
$dbDir = __DIR__ . '/data';
if (!is_dir($dbDir)) {
    mkdir($dbDir, 0777, true);
}

$dbPath = $dbDir . '/analytics.sqlite';
try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create tables if not exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS short_links (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        code TEXT UNIQUE,
        original_url TEXT,
        platform TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS click_logs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        code TEXT,
        platform TEXT,
        ip_address TEXT,
        user_agent TEXT,
        browser TEXT,
        referrer TEXT,
        clicked_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
} catch (Exception $e) {
    // Fallback if SQLite fails
    $pdo = null;
}

$code = isset($_GET['code']) ? trim($_GET['code']) : '';
if (!$code) {
    header("Location: index.php");
    exit;
}

$targetUrl = "index.php";
$platform = "Direct";

if ($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM short_links WHERE code = :code");
    $stmt->execute([':code' => $code]);
    $link = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($link) {
        $targetUrl = $link['original_url'];
        $platform = $link['platform'] ?: 'Direct';

        // Parse user agent
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
        $browser = 'Other';
        if (strpos($ua, 'Chrome') !== false) $browser = 'Chrome';
        elseif (strpos($ua, 'Firefox') !== false) $browser = 'Firefox';
        elseif (strpos($ua, 'Safari') !== false) $browser = 'Safari';
        elseif (strpos($ua, 'Edge') !== false) $browser = 'Edge';

        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        $referrer = $_SERVER['HTTP_REFERER'] ?? 'Direct Access';

        $logStmt = $pdo->prepare("INSERT INTO click_logs (code, platform, ip_address, user_agent, browser, referrer) VALUES (:code, :platform, :ip, :ua, :browser, :ref)");
        $logStmt->execute([
            ':code' => $code,
            ':platform' => $platform,
            ':ip' => $ip,
            ':ua' => substr($ua, 0, 250),
            ':browser' => $browser,
            ':ref' => substr($referrer, 0, 250)
        ]);
    }
}

header("Location: " . $targetUrl);
exit;
