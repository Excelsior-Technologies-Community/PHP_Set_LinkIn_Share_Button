<?php
// Dynamic GD Open Graph Banner Image Generator (1200x630)
header('Content-Type: image/png');
header('Cache-Control: no-cache, no-store, must-revalidate');

$title = isset($_GET['title']) && trim($_GET['title']) !== '' ? trim($_GET['title']) : 'Professional LinkedIn Share Studio';
$subtitle = isset($_GET['subtitle']) ? trim($_GET['subtitle']) : 'Boost Social Engagement with Open Graph Tags';
$badge = isset($_GET['badge']) ? trim($_GET['badge']) : 'LinkedIn Verified Share';
$style = isset($_GET['style']) ? $_GET['style'] : 'blue';

$width = 1200;
$height = 630;

$image = imagecreatetruecolor($width, $height);

// Color schemes
if ($style === 'dark') {
    $bgStart = [24, 32, 47];
    $bgEnd = [15, 23, 42];
    $textColor = imagecolorallocate($image, 255, 255, 255);
    $accentColor = imagecolorallocate($image, 56, 189, 248);
    $subColor = imagecolorallocate($image, 148, 163, 184);
} elseif ($style === 'purple') {
    $bgStart = [76, 29, 149];
    $bgEnd = [124, 58, 237];
    $textColor = imagecolorallocate($image, 255, 255, 255);
    $accentColor = imagecolorallocate($image, 251, 191, 36);
    $subColor = imagecolorallocate($image, 221, 214, 254);
} elseif ($style === 'emerald') {
    $bgStart = [6, 78, 59];
    $bgEnd = [16, 185, 129];
    $textColor = imagecolorallocate($image, 255, 255, 255);
    $accentColor = imagecolorallocate($image, 167, 243, 208);
    $subColor = imagecolorallocate($image, 209, 250, 229);
} else {
    // Default LinkedIn Blue
    $bgStart = [10, 102, 194];
    $bgEnd = [2, 56, 110];
    $textColor = imagecolorallocate($image, 255, 255, 255);
    $accentColor = imagecolorallocate($image, 254, 240, 138);
    $subColor = imagecolorallocate($image, 224, 242, 254);
}

// Draw Vertical Gradient Background
for ($i = 0; $i < $height; $i++) {
    $r = (int)($bgStart[0] + ($bgEnd[0] - $bgStart[0]) * ($i / $height));
    $g = (int)($bgStart[1] + ($bgEnd[1] - $bgStart[1]) * ($i / $height));
    $b = (int)($bgStart[2] + ($bgEnd[2] - $bgStart[2]) * ($i / $height));
    $color = imagecolorallocate($image, $r, $g, $b);
    imageline($image, 0, $i, $width, $i, $color);
}

// Decorative Card Overlay Box
$cardBg = imagecolorallocatealpha($image, 255, 255, 255, 115);
imagefilledrectangle($image, 60, 60, $width - 60, $height - 60, $cardBg);

// Badge Box
$badgeBg = imagecolorallocate($image, 255, 255, 255);
$badgeTextCol = imagecolorallocate($image, 10, 102, 194);
imagefilledrectangle($image, 100, 100, 360, 140, $badgeBg);
imagestring($image, 5, 120, 112, strtoupper($badge), $badgeTextCol);

// Draw Text Content using built-in font sizing
$cleanTitle = substr(mb_strtoupper($title), 0, 55);
imagestring($image, 5, 100, 180, "TITLE: " . $cleanTitle, $textColor);

// Title word wrap handling
$lines = explode("\n", wordwrap($title, 40, "\n"));
$y = 240;
foreach ($lines as $line) {
    imagestring($image, 5, 100, $y, $line, $accentColor);
    $y += 35;
}

// Subtitle
imagestring($image, 4, 100, $y + 20, $subtitle, $subColor);

// Footer Branding
imagestring($image, 5, 100, $height - 110, "POWERED BY LINKEDIN SHARE STUDIO", $textColor);
imagestring($image, 3, $width - 320, $height - 100, "1200x630 HIGH RES OG BANNER", $accentColor);

imagepng($image);
imagedestroy($image);
