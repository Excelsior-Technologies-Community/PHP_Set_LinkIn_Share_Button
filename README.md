## PHP_Set_LinkIn_Share_Button

A simple PHP example demonstrating how to add a LinkedIn share button to a PHP website using both a basic share URL and the official LinkedIn share script.

## Overview

This project explains multiple ways to integrate LinkedIn sharing functionality into a PHP-based website. It focuses on simplicity, clarity, and real-world usage with dynamic URLs and Open Graph meta tags.

## Features

* Share the current page on LinkedIn
* Dynamic URL generation using PHP
* Open Graph meta tags for better link previews
* Two implementation methods (basic and official)
* Clean and minimal HTML/CSS
* Easy to customize and extend

## Requirements

* PHP 7.4 or higher
* A web server (Apache, Nginx, or PHP built-in server)
* Internet connection (for LinkedIn share functionality)

## Project Files

```
php-linkedin-share/
├── linkedin-share.php
└── README.md
```

## Method 1: Basic LinkedIn Share URL

This is the simplest and most reliable method. It opens LinkedIn's share dialog in a new tab.

### How It Works

* The current page URL is dynamically generated using PHP
* The URL is passed to LinkedIn's share endpoint

### Example Code

```php
$pageUrl = urlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
```

```html
<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $pageUrl; ?>" target="_blank">
    Share on LinkedIn
</a>
```

## Method 2: Official LinkedIn Share Button

This method uses LinkedIn’s official JavaScript SDK to render a share button.

### Example Code

```html
<script src="https://platform.linkedin.com/in.js" type="text/javascript">
    lang: en_US
</script>

<script type="IN/Share" data-url="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"></script>
```

## Open Graph Meta Tags

For proper preview when sharing on LinkedIn, include Open Graph meta tags in the page header.

```html
<meta property="og:title" content="LinkedIn Share Example">
<meta property="og:description" content="Learn how to add LinkedIn share buttons to your PHP website.">
<meta property="og:image" content="https://yourwebsite.com/image.jpg">
```

## Running the Project

1. Place the `linkedin-share.php` file in your project directory
2. Start a local server if needed:

```bash
php -S localhost:8000
```

3. Open the browser and visit:

```
http://localhost:8000/linkedin-share.php
```

## Customization

* Update the Open Graph tags to match your website content
* Style the button using CSS
* Use a fixed URL instead of the current page URL if needed

## Common Issues

* Preview image not updating: Clear LinkedIn cache using LinkedIn Post Inspector
* Share dialog not opening: Ensure the URL is publicly accessible
* Incorrect preview content: Verify Open Graph meta tags

## Learning Purpose

This project is useful for:

* PHP beginners
* Social media integration examples
* Interview demonstrationsM
* Practical web development tasks
*
* ## screenshot

* <img width="1146" height="583" alt="image" src="https://github.com/user-attachments/assets/5aaaad26-7ae4-4c6f-9838-cf73b95fa28a" />

* <img width="1838" height="944" alt="image" src="https://github.com/user-attachments/assets/f17d9231-a9d1-4038-bb63-865fe2170771" />

* <img width="1252" height="879" alt="image" src="https://github.com/user-attachments/assets/e0c6b8ee-fa35-46af-8074-1094d446fa04" />



