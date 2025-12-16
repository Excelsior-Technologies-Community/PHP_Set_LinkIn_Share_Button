<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LinkedIn Share Button Example</title>

    <meta name="description" content="This is a sample page to demonstrate LinkedIn sharing.">
    <meta property="og:title" content="LinkedIn Share Example">
    <meta property="og:description" content="Learn how to add LinkedIn share buttons to your PHP website.">
    <meta property="og:image" content="https://yourwebsite.com/image.jpg">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            color: #222;
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
            padding: 10px 18px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 10px;
            transition: background 0.3s ease;
        }

        .linkedin-share-btn:hover {
            background-color: #005582;
        }

        .note {
            background: #f1f7fb;
            padding: 12px;
            border-left: 4px solid #0077B5;
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>My PHP Website</h1>
    <p>
        This is some amazing content you might want to share on LinkedIn.
    </p>

    <?php
        $pageUrl = urlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    ?>

    <!-- Method 1 -->
    <h2>Method 1: Basic Share URL</h2>
    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $pageUrl; ?>" 
       target="_blank" 
       class="linkedin-share-btn">
        Share on LinkedIn
    </a>

    <!-- Method 2 -->
    <h2>Method 2: Official LinkedIn Button</h2>
    <script src="https://platform.linkedin.com/in.js" type="text/javascript">
        lang: en_US
    </script>
    <script type="IN/Share" data-url="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"></script>

    <div class="note">
        ✔ Uses Open Graph meta tags for better LinkedIn preview  
        ✔ Clean layout suitable for demos & interviews
    </div>
</div>

</body>
</html>
