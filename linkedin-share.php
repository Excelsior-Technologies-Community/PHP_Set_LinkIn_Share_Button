<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LinkedIn Share Integration & OAuth API Demo</title>

    <meta name="description" content="This is an enterprise sample page demonstrating LinkedIn Sharing, OAuth API Payload, and Dynamic Open Graph tags.">
    <meta property="og:title" content="LinkedIn Share & OAuth Integration Demo">
    <meta property="og:description" content="Learn how to add LinkedIn share buttons, UTM tracking, and dynamic OG banners to your PHP application.">
    <meta property="og:image" content="generate_og.php?title=LinkedIn+Share+Demo&style=blue">

    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 850px;
            margin: 40px auto;
            background: #ffffff;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            color: #0a66c2;
            margin-bottom: 10px;
        }

        h2 {
            margin-top: 30px;
            color: #333;
            font-size: 18px;
        }

        p {
            color: #555;
            line-height: 1.6;
        }

        .linkedin-share-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #0077B5;
            color: #fff;
            padding: 12px 22px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 10px;
            transition: background 0.3s ease;
        }

        .linkedin-share-btn:hover {
            background-color: #005582;
        }

        .studio-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #1e293b;
            color: #fff;
            padding: 12px 22px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 10px;
        }

        .note {
            background: #eef6fc;
            padding: 15px;
            border-left: 4px solid #0077B5;
            border-radius: 4px;
            margin-top: 25px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>PHP LinkedIn Share & OAuth Enterprise App</h1>
    <p>
        This page demonstrates basic social sharing as well as direct link redirection to our <strong>Enterprise Social Marketing Studio</strong>.
    </p>

    <?php
        $pageUrl = urlencode("https://" . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ($_SERVER['REQUEST_URI'] ?? ''));
    ?>

    <!-- Method 1 -->
    <h2>Method 1: Basic Share URL</h2>
    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $pageUrl; ?>" 
       target="_blank" 
       class="linkedin-share-btn">
        Share on LinkedIn
    </a>
    <a href="index.php" class="studio-btn">
        Open Full Studio Dashboard
    </a>

    <!-- Method 2 -->
    <h2>Method 2: Official LinkedIn Button SDK</h2>
    <script src="https://platform.linkedin.com/in.js" type="text/javascript">
        lang: en_US
    </script>
    <script type="IN/Share" data-url="<?php echo "https://" . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ($_SERVER['REQUEST_URI'] ?? ''); ?>"></script>

    <div class="note">
        ✔ Includes Dynamic PHP GD Open Graph image generation  
        ✔ Supports LinkedIn OAuth 2.0 UGC API payload builder  
        ✔ Built-in SQLite real-time click tracking & UTM builder
    </div>
</div>

</body>
</html>
