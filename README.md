# PHP_Set_LinkIn_Share_Button

A simple PHP example demonstrating how to add a **LinkedIn Share Button** to a PHP website using both a basic share URL and the official LinkedIn share script.

This project is designed to be **simple, practical, and beginner-friendly**, focusing on real‑world usage with dynamic URLs and proper Open Graph meta tags.

---

## Project Overview

This repository demonstrates **multiple ways to integrate LinkedIn sharing functionality** into a PHP-based website. It explains:

* How LinkedIn sharing works
* How to dynamically share the current page URL
* How to use LinkedIn’s official share button
* How to optimize link previews using Open Graph tags

This project is suitable for:

* PHP beginners
* Social media integration demos
* Interview preparation
* Practical web development examples

---

## Features

* Share the current page on LinkedIn
* Dynamic URL generation using PHP
* Open Graph meta tags for rich previews
* Two implementation methods (basic & official)
* Clean and minimal HTML/CSS
* Easy to customize and extend

---

## Requirements

* PHP 7.4 or higher
* Web server (Apache, Nginx, or PHP built‑in server)
* Internet connection (required for LinkedIn sharing)

---

## Project Structure

```
php-linkedin-share/
├── linkedin-share.php
└── README.md
```

---

## Method 1: Basic LinkedIn Share URL (Recommended)

This is the **simplest and most reliable method**. It opens LinkedIn’s share dialog in a new browser tab.

### How It Works

* The current page URL is dynamically generated using PHP
* The URL is passed to LinkedIn’s official share endpoint

### PHP Code (Dynamic URL)

```php
<?php
$pageUrl = urlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
?>
```

### HTML Share Button

```html
<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $pageUrl; ?>" target="_blank">
    Share on LinkedIn
</a>
```

---

## Method 2: Official LinkedIn Share Button

This method uses LinkedIn’s official JavaScript SDK to render a share button.

### HTML Code

```html
<script src="https://platform.linkedin.com/in.js" type="text/javascript">
    lang: en_US
</script>

<script type="IN/Share" data-url="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"></script>
```

Note: LinkedIn may update or deprecate official widgets. The **basic share URL method is more future‑proof**.

---

## Open Graph Meta Tags (Important)

To ensure proper preview (title, description, image) when sharing on LinkedIn, include Open Graph meta tags inside the `<head>` section.

```html
<meta property="og:title" content="LinkedIn Share Example">
<meta property="og:description" content="Learn how to add LinkedIn share buttons to your PHP website.">
<meta property="og:image" content="https://yourwebsite.com/image.jpg">
<meta property="og:url" content="https://yourwebsite.com/page-url">
<meta property="og:type" content="website">
```

---

## Running the Project

1. Place `linkedin-share.php` in your project directory
2. Start PHP’s built‑in server (optional):

```bash
php -S localhost:8000
```

3. Open your browser and visit:

```
http://localhost:8000/linkedin-share.php
```

---

## Customization

* Replace Open Graph tags with your own content
* Style the button using CSS or Bootstrap
* Use a fixed URL instead of the current page URL if needed
* Add icons or branding if required

---

## Common Issues & Solutions

**Preview image not updating**
Clear LinkedIn cache using the LinkedIn Post Inspector

**Share dialog not opening**
Ensure the page URL is valid and publicly accessible

**Incorrect preview data**
Verify Open Graph meta tags and image URLs

---

## Learning Purpose

This project is useful for:

* PHP beginners
* Social media integration demos
* Interview explanations
* Practical PHP mini‑projects

---

## Screenshots

<img width="1146" height="583" alt="image" src="https://github.com/user-attachments/assets/5aaaad26-7ae4-4c6f-9838-cf73b95fa28a" />

<img width="1838" height="944" alt="image" src="https://github.com/user-attachments/assets/f17d9231-a9d1-4038-bb63-865fe2170771" />

<img width="1252" height="879" alt="image" src="https://github.com/user-attachments/assets/e0c6b8ee-fa35-46af-8074-1094d446fa04" />

---
