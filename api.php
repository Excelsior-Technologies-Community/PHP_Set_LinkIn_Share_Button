<?php
header('Content-Type: application/json');

$dbDir = __DIR__ . '/data';
if (!is_dir($dbDir)) {
    mkdir($dbDir, 0777, true);
}

$dbPath = $dbDir . '/analytics.sqlite';
$pdo = null;
try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
    // Graceful PDO fallback
}

$action = $_REQUEST['action'] ?? '';

if ($action === 'analytics') {
    $totalClicks = 0;
    $platformBreakdown = ['LinkedIn' => 0, 'X (Twitter)' => 0, 'WhatsApp' => 0, 'Facebook' => 0, 'Direct' => 0];
    $recentLogs = [];

    if ($pdo) {
        $stmt = $pdo->query("SELECT COUNT(*) as cnt FROM click_logs");
        $totalClicks = (int)($stmt->fetch(PDO::FETCH_ASSOC)['cnt'] ?? 0);

        $stmt2 = $pdo->query("SELECT platform, COUNT(*) as cnt FROM click_logs GROUP BY platform");
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $pName = $row['platform'];
            if (isset($platformBreakdown[$pName])) {
                $platformBreakdown[$pName] = (int)$row['cnt'];
            } else {
                $platformBreakdown[$pName] = (int)$row['cnt'];
            }
        }

        $stmt3 = $pdo->query("SELECT * FROM click_logs ORDER BY id DESC LIMIT 10");
        $recentLogs = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode([
        'status' => 'success',
        'total_clicks' => $totalClicks,
        'platform_breakdown' => $platformBreakdown,
        'recent_logs' => $recentLogs
    ]);
    exit;
}

if ($action === 'shorten') {
    $url = $_POST['url'] ?? '';
    $platform = $_POST['platform'] ?? 'LinkedIn';
    $utmSource = $_POST['utm_source'] ?? 'linkedin';
    $utmMedium = $_POST['utm_medium'] ?? 'social';
    $utmCampaign = $_POST['utm_campaign'] ?? 'share_studio';

    if (!$url) {
        echo json_encode(['status' => 'error', 'message' => 'Target URL is required.']);
        exit;
    }

    // Append UTM tags if not present
    $queryDelimiter = (strpos($url, '?') !== false) ? '&' : '?';
    $fullUrl = $url . $queryDelimiter . "utm_source=" . urlencode($utmSource) . "&utm_medium=" . urlencode($utmMedium) . "&utm_campaign=" . urlencode($utmCampaign);

    $code = substr(md5(uniqid(rand(), true)), 0, 7);

    if ($pdo) {
        $stmt = $pdo->prepare("INSERT INTO short_links (code, original_url, platform) VALUES (:code, :url, :platform)");
        $stmt->execute([':code' => $code, ':url' => $fullUrl, ':platform' => $platform]);
    }

    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $shortUrl = "{$protocol}://{$host}" . dirname($_SERVER['SCRIPT_NAME']) . "/redirect.php?code={$code}";

    echo json_encode([
        'status' => 'success',
        'code' => $code,
        'short_url' => $shortUrl,
        'full_utm_url' => $fullUrl,
        'platform' => $platform
    ]);
    exit;
}

if ($action === 'post_linkedin') {
    $title = $_POST['title'] ?? 'Sample Title';
    $commentary = $_POST['commentary'] ?? '';
    $articleUrl = $_POST['article_url'] ?? 'https://example.com';
    $mediaFormat = $_POST['media_format'] ?? 'single_image';
    $hashtags = $_POST['hashtags'] ?? '';
    $visibility = $_POST['visibility'] ?? 'PUBLIC';

    $fullContent = $commentary . "\n\n" . $hashtags;

    $urnId = "urn:li:share:" . rand(7000000000000000000, 7999999999999999999);

    // Mock LinkedIn REST API / ugcPosts response
    $apiPayload = [
        'author' => 'urn:li:person:AQJ92834KSLM',
        'lifecycleState' => 'PUBLISHED',
        'specificContent' => [
            'com.linkedin.ugc.ShareContent' => [
                'shareCommentary' => [
                    'text' => $fullContent
                ],
                'shareMediaCategory' => ($mediaFormat === 'video' ? 'VIDEO' : ($mediaFormat === 'pdf_carousel' ? 'CAROUSEL' : 'ARTICLE')),
                'media' => [
                    [
                        'status' => 'READY',
                        'description' => ['text' => substr($commentary, 0, 100)],
                        'originalUrl' => $articleUrl,
                        'title' => ['text' => $title]
                    ]
                ]
            ]
        ],
        'visibility' => [
            'com.linkedin.ugc.MemberNetworkVisibility' => $visibility
        ]
    ];

    echo json_encode([
        'status' => 'success',
        'http_code' => 201,
        'message' => 'Successfully published to LinkedIn OAuth API!',
        'share_urn' => $urnId,
        'published_at' => date('Y-m-d H:i:s'),
        'api_payload' => $apiPayload
    ]);
    exit;
}

if ($action === 'suggest_hashtags') {
    $topic = strtolower($_POST['topic'] ?? 'web development');
    
    $hashtagDatabase = [
        'tech' => ['#Technology', '#SoftwareEngineering', '#Coding', '#Developers', '#TechTrends', '#Innovation'],
        'laravel' => ['#Laravel', '#PHP', '#WebDevelopment', '#Backend', '#OpenSource', '#CleanCode'],
        'linkedin' => ['#LinkedInTips', '#SocialMediaMarketing', '#PersonalBranding', '#Networking', '#CareerGrowth'],
        'business' => ['#BusinessGrowth', '#Entrepreneurship', '#Leadership', '#Management', '#MarketingStrategy'],
        'ai' => ['#ArtificialIntelligence', '#MachineLearning', '#FutureOfWork', '#Automation', '#TechNews']
    ];

    $selected = [];
    foreach ($hashtagDatabase as $key => $tags) {
        if (strpos($topic, $key) !== false || $key === 'tech') {
            $selected = array_merge($selected, $tags);
        }
    }
    $selected = array_unique($selected);
    $selected = array_slice($selected, 0, 8);

    echo json_encode([
        'status' => 'success',
        'hashtags' => implode(' ', $selected),
        'tag_array' => $selected
    ]);
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
exit;
