<?php
$currentUrl = "https://" . ($_SERVER["HTTP_HOST"] ?? "localhost") . ($_SERVER["REQUEST_URI"] ?? "");
$pageUrl = urlencode($currentUrl);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Professional LinkedIn Share & Social Marketing Studio</title>

    <!-- Open Graph Tags -->
    <meta property="og:title" content="Professional LinkedIn Share Studio">
    <meta property="og:description" content="Advanced LinkedIn OAuth Publishing, Real-Time Analytics & OG Banner Generator Studio">
    <meta property="og:image" content="generate_og.php?title=LinkedIn+Share+Studio&style=blue">
    <meta property="og:url" content="<?php echo $currentUrl; ?>">
    <meta property="og:type" content="website">

    <!-- Bootstrap 5 & FontAwesome 6 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --linkedin-blue: #0a66c2;
            --linkedin-hover: #004182;
            --bg-light: #f3f6f8;
            --card-radius: 16px;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: #1b2733;
            transition: all 0.3s ease;
        }

        body.dark-mode {
            background-color: #0f172a;
            color: #f8fafc;
        }

        body.dark-mode .card,
        body.dark-mode .modal-content {
            background-color: #1e293b;
            color: #f8fafc;
            border-color: #334155;
        }

        body.dark-mode .bg-light,
        body.dark-mode .list-group-item {
            background-color: #334155 !important;
            color: #f8fafc !important;
            border-color: #475569;
        }

        .studio-card {
            border: none;
            border-radius: var(--card-radius);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .nav-pills .nav-link {
            border-radius: 50rem;
            padding: 10px 22px;
            font-weight: 600;
            color: #475569;
            transition: all 0.3s;
        }

        .nav-pills .nav-link.active {
            background-color: var(--linkedin-blue);
            box-shadow: 0 4px 12px rgba(10, 102, 194, 0.35);
        }

        .share-btn-custom {
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 18px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .linkedin-card-preview {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            background: #fff;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        }

        .grid-2x2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4px;
            background: #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .grid-2x2 img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .code-box {
            background: #0f172a;
            color: #38bdf8;
            font-family: 'Fira Code', 'Courier New', monospace;
            border-radius: 10px;
            padding: 15px;
            font-size: 0.88rem;
        }
    </style>
</head>

<body>

    <div class="container py-4">

        <!-- Top Header & Brand Navbar -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h2 class="fw-bold m-0 text-primary">
                    <i class="fab fa-linkedin text-primary me-2"></i>LinkedIn Share & Social Marketing Studio
                </h2>
                <p class="text-muted small m-0">Enterprise Social Media Integration, OAuth API Publishing, Analytics & OG Banner Designer</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                    <i class="fa-solid fa-circle-check me-1"></i>LinkedIn API Ready
                </span>
                <button class="btn btn-outline-dark rounded-pill px-3" onclick="toggleDarkMode()">
                    <i class="fa-solid fa-moon me-1"></i> <span id="themeText">Dark Mode</span>
                </button>
            </div>
        </div>

        <!-- Main Studio Navigation Tabs -->
        <ul class="nav nav-pills mb-4 bg-white p-2 studio-card d-flex gap-2" id="studioTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="quick-share-tab" data-bs-toggle="pill" data-bs-target="#quick-share" type="button" role="tab">
                    <i class="fa-solid fa-share-nodes me-2"></i>Quick Share & OG Generator
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="oauth-studio-tab" data-bs-toggle="pill" data-bs-target="#oauth-studio" type="button" role="tab">
                    <i class="fa-solid fa-cloud-arrow-up me-2"></i>Module 1: LinkedIn OAuth & Post Builder
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="analytics-studio-tab" data-bs-toggle="pill" data-bs-target="#analytics-studio" type="button" role="tab" onclick="loadAnalytics()">
                    <i class="fa-solid fa-chart-line me-2"></i>Module 2: Analytics & UTM Studio
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="banner-studio-tab" data-bs-toggle="pill" data-bs-target="#banner-studio" type="button" role="tab">
                    <i class="fa-solid fa-palette me-2"></i>Module 3: OG Banner & Exporter Studio
                </button>
            </li>
        </ul>

        <!-- Tab Content Containers -->
        <div class="tab-content" id="studioTabsContent">

            <!-- TAB 0: QUICK SHARE & BASE META GENERATOR -->
            <div class="tab-pane fade show active" id="quick-share" role="tabpanel">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="card studio-card p-4 h-100">
                            <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-link me-2"></i>Current Page Share Controls</h4>
                            <label class="form-label text-muted small fw-semibold">Target URL to Share</label>
                            <input class="form-control mb-3 font-monospace" id="pageUrl" value="<?php echo $currentUrl; ?>" readonly>

                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <a class="btn btn-primary share-btn-custom" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $pageUrl; ?>" target="_blank" onclick="recordShare('LinkedIn')">
                                    <i class="fab fa-linkedin fs-5"></i> Share on LinkedIn
                                </a>
                                <a class="btn btn-dark share-btn-custom" href="https://twitter.com/intent/tweet?url=<?php echo $pageUrl; ?>" target="_blank" onclick="recordShare('X (Twitter)')">
                                    <i class="fab fa-x-twitter fs-5"></i> X (Twitter)
                                </a>
                                <a class="btn btn-success share-btn-custom" href="https://wa.me/?text=<?php echo $pageUrl; ?>" target="_blank" onclick="recordShare('WhatsApp')">
                                    <i class="fab fa-whatsapp fs-5"></i> WhatsApp
                                </a>
                                <a class="btn btn-primary share-btn-custom" style="background:#1877F2; border:none;" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $pageUrl; ?>" target="_blank" onclick="recordShare('Facebook')">
                                    <i class="fab fa-facebook fs-5"></i> Facebook
                                </a>
                                <button class="btn btn-secondary share-btn-custom" onclick="copyShareLink()">
                                    <i class="fa-regular fa-copy fs-5"></i> Copy URL
                                </button>
                            </div>

                            <hr>

                            <h5 class="fw-bold mb-3"><i class="fa-solid fa-qrcode me-2 text-warning"></i>Instant QR Code Generator</h5>
                            <div class="d-flex align-items-center gap-4">
                                <img id="qrCode" src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=<?php echo $pageUrl; ?>" class="rounded border p-2 bg-white shadow-sm" alt="QR Code">
                                <div>
                                    <p class="text-muted small mb-3">Scan this QR code to quickly open the shared URL on mobile devices or download for print media.</p>
                                    <a id="downloadQR" class="btn btn-warning rounded-pill px-4 fw-bold" onclick="downloadQRCode()">
                                        <i class="fa-solid fa-download me-1"></i> Download QR Image
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card studio-card p-4 h-100">
                            <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-chart-pie me-2"></i>Quick Share Stats & History</h4>
                            <div class="row text-center g-3 mb-3">
                                <div class="col-6">
                                    <div class="p-3 bg-light rounded-4 border">
                                        <h2 class="fw-bold text-primary m-0" id="totalShareCount">0</h2>
                                        <small class="text-muted fw-semibold">Local Shares</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 bg-light rounded-4 border">
                                        <h2 class="fw-bold text-success m-0" id="totalClickCount">0</h2>
                                        <small class="text-muted fw-semibold">Short Link Clicks</small>
                                    </div>
                                </div>
                            </div>

                            <h6 class="fw-bold text-muted mb-2"><i class="fa-solid fa-clock-rotate-left me-1"></i>Recent Share Session Activity</h6>
                            <ul id="localHistory" class="list-group list-group-flush border rounded-3 overflow-auto" style="max-height: 220px;">
                                <li class="list-group-item text-muted small text-center py-3">No recent sharing activity logged.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODULE 1: LINKEDIN OAUTH & RICH MEDIA POST BUILDER STUDIO -->
            <div class="tab-pane fade" id="oauth-studio" role="tabpanel">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="card studio-card p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="fw-bold text-primary m-0"><i class="fa-solid fa-cloud-arrow-up me-2"></i>LinkedIn OAuth 2.0 API Payload Creator</h4>
                                <span class="badge bg-primary rounded-pill px-3 py-2"><i class="fab fa-linkedin me-1"></i>v2 UGC Posts API</span>
                            </div>

                            <form id="linkedInPostForm" onsubmit="publishLinkedInPost(event)">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Post Title / Article Headline</label>
                                    <input type="text" id="apiPostTitle" class="form-control" value="Accelerating Enterprise Web Applications with Modern PHP 8.4" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Post Commentary & Narrative</label>
                                    <textarea id="apiPostCommentary" class="form-control" rows="4" placeholder="Write your post content here..." required>🚀 Excited to announce our latest open-source PHP & LinkedIn integration suite! Explore automated Open Graph tag generation, OAuth 2.0 UGC API payload creation, and real-time click tracking analytics.</textarea>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Article Target URL</label>
                                        <input type="url" id="apiArticleUrl" class="form-control" value="<?php echo $currentUrl; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Visibility Network</label>
                                        <select id="apiVisibility" class="select form-select">
                                            <option value="PUBLIC">🌐 Public (All LinkedIn Members)</option>
                                            <option value="CONNECTIONS_ONLY">👥 Connections Only</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Rich Media & Format Switcher -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Rich Media & Post Format Switcher</label>
                                    <div class="btn-group w-100" role="group" id="mediaFormatSelector">
                                        <input type="radio" class="btn-check" name="mediaFormat" id="fmtSingle" value="single_image" checked onchange="updateRichMediaPreview()">
                                        <label class="btn btn-outline-primary" for="fmtSingle"><i class="fa-regular fa-image me-1"></i> Single Image</label>

                                        <input type="radio" class="btn-check" name="mediaFormat" id="fmtGrid" value="multi_grid" onchange="updateRichMediaPreview()">
                                        <label class="btn btn-outline-primary" for="fmtGrid"><i class="fa-solid fa-border-all me-1"></i> Multi-Grid (2x2)</label>

                                        <input type="radio" class="btn-check" name="mediaFormat" id="fmtPdf" value="pdf_carousel" onchange="updateRichMediaPreview()">
                                        <label class="btn btn-outline-primary" for="fmtPdf"><i class="fa-solid fa-file-pdf me-1"></i> PDF Carousel</label>

                                        <input type="radio" class="btn-check" name="mediaFormat" id="fmtVideo" value="video" onchange="updateRichMediaPreview()">
                                        <label class="btn btn-outline-primary" for="fmtVideo"><i class="fa-solid fa-video me-1"></i> Video Embed</label>
                                    </div>
                                </div>

                                <!-- AI Hashtag Generator & Content Assistant -->
                                <div class="p-3 bg-light rounded-4 border mb-4">
                                    <label class="form-label fw-semibold text-primary"><i class="fa-solid fa-wand-magic-sparkles me-2"></i>AI Hashtag Generator & Content Assistant</label>
                                    <div class="input-group mb-2">
                                        <input type="text" id="hashtagTopic" class="form-control" placeholder="Enter topic (e.g. laravel, tech, linkedin, business)">
                                        <button class="btn btn-primary" type="button" onclick="generateHashtags()">
                                            <i class="fa-solid fa-sparkles me-1"></i> Suggest Hashtags
                                        </button>
                                    </div>
                                    <input type="text" id="apiHashtags" class="form-control font-monospace" value="#PHP #WebDevelopment #LinkedInShare #TechInnovation">
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold shadow">
                                    <i class="fa-solid fa-paper-plane me-2"></i>Publish via Direct LinkedIn OAuth API
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Right Column: Live Rich Media Preview & API Output -->
                    <div class="col-lg-5">
                        <div class="card studio-card p-4 mb-4">
                            <h5 class="fw-bold text-primary mb-3"><i class="fa-solid fa-mobile-screen-button me-2"></i>LinkedIn Feed Card Live Preview</h5>
                            
                            <div class="linkedin-card-preview p-3">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 42px; height: 42px;">IN</div>
                                    <div>
                                        <h6 class="fw-bold m-0 small">Verified LinkedIn Publisher</h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">1m • Promoted <i class="fa-solid fa-earth-americas ms-1"></i></small>
                                    </div>
                                </div>

                                <p class="small text-dark mb-3" id="prevCommentary">🚀 Excited to announce our latest open-source PHP & LinkedIn integration suite!</p>

                                <div id="previewMediaContainer" class="mb-3 rounded overflow-hidden border">
                                    <img src="generate_og.php?title=Enterprise+PHP+LinkedIn+Studio&style=blue" class="img-fluid w-100" alt="Preview">
                                </div>

                                <div class="border-top pt-2 d-flex justify-content-around text-muted small fw-semibold">
                                    <span><i class="fa-regular fa-thumbs-up me-1"></i> Like</span>
                                    <span><i class="fa-regular fa-comment me-1"></i> Comment</span>
                                    <span><i class="fa-solid fa-arrows-rotate me-1"></i> Repost</span>
                                    <span><i class="fa-solid fa-paper-plane me-1"></i> Send</span>
                                </div>
                            </div>
                        </div>

                        <!-- LinkedIn API Response JSON Payload Box -->
                        <div class="card studio-card p-4">
                            <h5 class="fw-bold text-success mb-2"><i class="fa-solid fa-code-commit me-2"></i>API Response & UGC Payload</h5>
                            <small class="text-muted mb-3 d-block">REST API JSON Output (HTTP Status 201 Created)</small>
                            <pre class="code-box m-0" id="apiResponseLog" style="max-height: 250px; overflow-y: auto;">// Click 'Publish via Direct LinkedIn OAuth API' to execute API payload.</pre>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODULE 2: REAL-TIME ANALYTICS, CLICK TRACKING & UTM STUDIO -->
            <div class="tab-pane fade" id="analytics-studio" role="tabpanel">
                <div class="row g-4 mb-4">
                    <!-- UTM & Short URL Creator Card -->
                    <div class="col-lg-5">
                        <div class="card studio-card p-4 h-100">
                            <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-filter me-2"></i>UTM Builder & Short URL Generator</h4>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Quick Preset Selector</label>
                                <select class="form-select" onchange="applyUtmPreset(this.value)">
                                    <option value="linkedin">💙 LinkedIn Official Share</option>
                                    <option value="newsletter">📧 Weekly Newsletter Campaign</option>
                                    <option value="launch">🚀 Product Launch Campaign</option>
                                    <option value="viral">🔥 Social Viral Promo</option>
                                </select>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label small fw-semibold">UTM Source</label>
                                    <input type="text" id="utmSource" class="form-control form-control-sm" value="linkedin">
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-semibold">UTM Medium</label>
                                    <input type="text" id="utmMedium" class="form-control form-control-sm" value="social">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">UTM Campaign Name</label>
                                    <input type="text" id="utmCampaign" class="form-control form-control-sm" value="linkedin_share_studio">
                                </div>
                            </div>

                            <button class="btn btn-success w-100 rounded-pill fw-bold mb-3" onclick="generateShortUrl()">
                                <i class="fa-solid fa-bolt me-1"></i> Generate Short Link & Track Clicks
                            </button>

                            <div id="shortUrlResult" class="p-3 bg-light rounded-4 border d-none">
                                <label class="form-label small fw-bold text-success"><i class="fa-solid fa-check-circle me-1"></i> Generated Tracking Short URL</label>
                                <input type="text" id="shortUrlOutput" class="form-control font-monospace mb-2" readonly>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-primary btn-sm rounded-pill flex-grow-1" onclick="copyShortUrl()">
                                        <i class="fa-regular fa-copy me-1"></i> Copy Short Link
                                    </button>
                                    <a id="testShortUrl" href="#" target="_blank" class="btn btn-outline-success btn-sm rounded-pill">
                                        <i class="fa-solid fa-up-right-from-square me-1"></i> Test Link
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chart.js Live Social Analytics Dashboard -->
                    <div class="col-lg-7">
                        <div class="card studio-card p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="fw-bold text-primary m-0"><i class="fa-solid fa-chart-column me-2"></i>Social Performance & Click Analytics</h4>
                                <button class="btn btn-sm btn-outline-secondary rounded-pill" onclick="loadAnalytics()">
                                    <i class="fa-solid fa-rotate me-1"></i> Refresh Data
                                </button>
                            </div>

                            <div style="height: 280px;">
                                <canvas id="analyticsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SQLite Live Click Log Table -->
                <div class="card studio-card p-4">
                    <h5 class="fw-bold text-primary mb-3"><i class="fa-solid fa-list-check me-2"></i>SQLite Live Click Logs & Visitor Telemetry</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th># ID</th>
                                    <th>Short Code</th>
                                    <th>Platform</th>
                                    <th>IP Address</th>
                                    <th>Browser</th>
                                    <th>Referrer</th>
                                    <th>Click Timestamp</th>
                                </tr>
                            </thead>
                            <tbody id="clickLogsTable">
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Loading click telemetry data...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- MODULE 3: CUSTOM OG BANNER DESIGNER & MULTI-PLATFORM EXPORTER STUDIO -->
            <div class="tab-pane fade" id="banner-studio" role="tabpanel">
                <div class="row g-4 mb-4">
                    <!-- Banner Customizer Controls -->
                    <div class="col-lg-5">
                        <div class="card studio-card p-4">
                            <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-wand-magic-sparkles me-2"></i>OG Banner Designer</h4>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Banner Headline Title</label>
                                <input type="text" id="ogBannerTitle" class="form-control" value="Supercharge Your LinkedIn Presence" oninput="renderOgCanvas()">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Subtitle Description</label>
                                <input type="text" id="ogBannerSubtitle" class="form-control" value="Generated with Open Graph Canvas Studio" oninput="renderOgCanvas()">
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label small fw-semibold">Badge Text</label>
                                    <input type="text" id="ogBannerBadge" class="form-control" value="LINKEDIN VERIFIED" oninput="renderOgCanvas()">
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-semibold">Gradient Style</label>
                                    <select id="ogBannerStyle" class="form-select" onchange="renderOgCanvas()">
                                        <option value="blue">💙 LinkedIn Blue</option>
                                        <option value="dark">🖤 Dark Cyber</option>
                                        <option value="purple">💜 Royal Purple</option>
                                        <option value="emerald">💚 Emerald Green</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-primary rounded-pill flex-grow-1 fw-bold" onclick="downloadOgCanvas()">
                                    <i class="fa-solid fa-download me-1"></i> Download Banner (1200x630)
                                </button>
                                <a id="gdDirectUrl" href="generate_og.php?title=Supercharge+LinkedIn&style=blue" target="_blank" class="btn btn-outline-dark rounded-pill">
                                    <i class="fa-solid fa-image me-1"></i> GD PNG
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Canvas Live Interactive Render -->
                    <div class="col-lg-7">
                        <div class="card studio-card p-4">
                            <h5 class="fw-bold text-primary mb-3"><i class="fa-solid fa-eye me-2"></i>1200x630 HTML5 Canvas Real-Time Render</h5>
                            <div class="ratio ratio-16x9 rounded overflow-hidden border shadow-sm">
                                <canvas id="ogCanvas" width="1200" height="630"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Multi-Platform Preview Switcher & Code Exporter -->
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="card studio-card p-4">
                            <h5 class="fw-bold text-primary mb-3"><i class="fa-solid fa-mobile-retro me-2"></i>Multi-Platform Live Preview Switcher</h5>
                            
                            <ul class="nav nav-tabs mb-3" id="platformPreviewTabs" role="tablist">
                                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pv-linkedin">LinkedIn</button></li>
                                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pv-twitter">X (Twitter)</button></li>
                                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pv-facebook">Facebook</button></li>
                                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pv-slack">Slack</button></li>
                                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#pv-whatsapp">WhatsApp</button></li>
                            </ul>

                            <div class="tab-content" id="platformPreviewContent">
                                <div class="tab-pane fade show active" id="pv-linkedin">
                                    <div class="border rounded-3 p-3 bg-white">
                                        <span class="badge bg-primary mb-2">LinkedIn Feed Card</span>
                                        <div class="fw-bold text-dark mb-1" id="pvLnTitle">Supercharge Your LinkedIn Presence</div>
                                        <p class="small text-muted mb-2" id="pvLnSub">Generated with Open Graph Canvas Studio</p>
                                        <small class="text-primary font-monospace"><?php echo parse_url($currentUrl, PHP_URL_HOST); ?></small>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pv-twitter">
                                    <div class="border rounded-3 p-3 bg-black text-white">
                                        <span class="badge bg-secondary mb-2">X Summary Large Image Card</span>
                                        <div class="fw-bold mb-1" id="pvTwTitle">Supercharge Your LinkedIn Presence</div>
                                        <p class="small text-gray-400 mb-2" id="pvTwSub">Generated with Open Graph Canvas Studio</p>
                                        <small class="text-muted font-monospace">🔗 <?php echo parse_url($currentUrl, PHP_URL_HOST); ?></small>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pv-facebook">
                                    <div class="border rounded-3 p-3 bg-light">
                                        <span class="badge bg-primary mb-2">Facebook Post Link</span>
                                        <div class="fw-bold text-primary mb-1" id="pvFbTitle">Supercharge Your LinkedIn Presence</div>
                                        <p class="small text-muted mb-2" id="pvFbSub">Generated with Open Graph Canvas Studio</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pv-slack">
                                    <div class="border-start border-4 border-warning ps-3 py-2 bg-white">
                                        <span class="badge bg-warning text-dark mb-1">Slack Unfurl Card</span>
                                        <div class="fw-bold text-dark" id="pvSlTitle">Supercharge Your LinkedIn Presence</div>
                                        <small class="text-muted" id="pvSlSub">Generated with Open Graph Canvas Studio</small>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pv-whatsapp">
                                    <div class="border rounded-3 p-3" style="background: #e5ddd5;">
                                        <div class="bg-white p-2 rounded border-start border-4 border-success">
                                            <small class="fw-bold text-success">WhatsApp Link Attachment</small>
                                            <div class="fw-bold small text-dark" id="pvWaTitle">Supercharge Your LinkedIn Presence</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Multi-Framework Code Snippet Exporter -->
                    <div class="col-lg-6">
                        <div class="card studio-card p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold text-primary m-0"><i class="fa-solid fa-code me-2"></i>Multi-Framework Code Snippet Exporter</h5>
                                <button class="btn btn-sm btn-outline-secondary rounded-pill" onclick="copySnippetCode()">
                                    <i class="fa-regular fa-copy me-1"></i> Copy Code
                                </button>
                            </div>

                            <ul class="nav nav-tabs mb-3" id="snippetTabs" role="tablist">
                                <li class="nav-item"><button class="nav-link active" onclick="switchSnippet('html')">HTML Tags</button></li>
                                <li class="nav-item"><button class="nav-link" onclick="switchSnippet('php')">Native PHP</button></li>
                                <li class="nav-item"><button class="nav-link" onclick="switchSnippet('blade')">Laravel Blade</button></li>
                                <li class="nav-item"><button class="nav-link" onclick="switchSnippet('wordpress')">WordPress Hook</button></li>
                            </ul>

                            <textarea id="snippetOutput" class="code-box w-100" rows="8" readonly></textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap Toast Notifications -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
        <div id="studioToast" class="toast align-items-center text-bg-primary border-0 rounded-4 shadow" role="alert">
            <div class="d-flex">
                <div class="toast-body" id="toastMessage">
                    <i class="fa-solid fa-circle-check me-2"></i> Action performed successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let analyticsChart = null;

        document.addEventListener('DOMContentLoaded', function() {
            renderHistory();
            renderOgCanvas();
            updateSnippetCode('html');
            initAnalyticsChart();
        });

        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            document.getElementById('themeText').innerText = isDark ? 'Light Mode' : 'Dark Mode';
        }

        function showToast(msg, bgClass = 'text-bg-primary') {
            const toastEl = document.getElementById('studioToast');
            toastEl.className = `toast align-items-center ${bgClass} border-0 rounded-4 shadow`;
            document.getElementById('toastMessage').innerHTML = `<i class="fa-solid fa-circle-check me-2"></i> ${msg}`;
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }

        function recordShare(platform) {
            let count = parseInt(localStorage.getItem('shareCount') || '0') + 1;
            localStorage.setItem('shareCount', count);
            document.getElementById('totalShareCount').innerText = count;

            let history = JSON.parse(localStorage.getItem('shareHistory') || '[]');
            history.unshift({ platform: platform, time: new Date().toLocaleTimeString() });
            localStorage.setItem('shareHistory', JSON.stringify(history.slice(0, 10)));
            renderHistory();
        }

        function renderHistory() {
            let count = parseInt(localStorage.getItem('shareCount') || '0');
            document.getElementById('totalShareCount').innerText = count;

            let history = JSON.parse(localStorage.getItem('shareHistory') || '[]');
            let list = document.getElementById('localHistory');
            list.innerHTML = '';
            if (history.length === 0) {
                list.innerHTML = '<li class="list-group-item text-muted small text-center py-3">No recent sharing activity logged.</li>';
                return;
            }
            history.forEach(item => {
                let li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center small';
                li.innerHTML = `<span><i class="fa-solid fa-share text-primary me-2"></i>Shared via <strong>${item.platform}</strong></span><span class="text-muted">${item.time}</span>`;
                list.appendChild(li);
            });
        }

        function copyShareLink() {
            navigator.clipboard.writeText(document.getElementById('pageUrl').value);
            showToast('Page URL copied to clipboard!');
        }

        function downloadQRCode() {
            let qrImg = document.getElementById('qrCode').src;
            let a = document.createElement('a');
            a.href = qrImg;
            a.download = 'linkedin-share-qr.png';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            showToast('QR Code download started!', 'text-bg-warning');
        }

        // Module 1: LinkedIn OAuth & Post Builder Functions
        function updateRichMediaPreview() {
            const fmt = document.querySelector('input[name="mediaFormat"]:checked').value;
            const container = document.getElementById('previewMediaContainer');
            const title = document.getElementById('apiPostTitle').value;
            const style = document.getElementById('ogBannerStyle')?.value || 'blue';

            if (fmt === 'single_image') {
                container.innerHTML = `<img src="generate_og.php?title=${encodeURIComponent(title)}&style=${style}" class="img-fluid w-100" alt="Preview">`;
            } else if (fmt === 'multi_grid') {
                container.innerHTML = `
                    <div class="grid-2x2">
                        <img src="generate_og.php?title=Grid+1&style=blue">
                        <img src="generate_og.php?title=Grid+2&style=dark">
                        <img src="generate_og.php?title=Grid+3&style=purple">
                        <img src="generate_og.php?title=Grid+4&style=emerald">
                    </div>`;
            } else if (fmt === 'pdf_carousel') {
                container.innerHTML = `
                    <div class="bg-dark text-white p-4 text-center">
                        <i class="fa-solid fa-file-pdf fs-1 text-danger mb-2"></i>
                        <div class="fw-bold">${title} (PDF Document)</div>
                        <small class="text-muted">Swipe 1 of 8 slides • PDF Presentation</small>
                    </div>`;
            } else if (fmt === 'video') {
                container.innerHTML = `
                    <div class="bg-black text-white p-5 text-center position-relative">
                        <i class="fa-solid fa-circle-play fs-1 text-primary"></i>
                        <div class="mt-2 small fw-bold">Watch LinkedIn Video Stream</div>
                    </div>`;
            }
        }

        function generateHashtags() {
            const topic = document.getElementById('hashtagTopic').value || 'tech';
            fetch(`api.php?action=suggest_hashtags&topic=${encodeURIComponent(topic)}`)
                .then(res => res.json())
                .then(data => {
                    if (data.hashtags) {
                        document.getElementById('apiHashtags').value = data.hashtags;
                        showToast('Suggested hashtags generated!');
                    }
                });
        }

        function publishLinkedInPost(e) {
            e.preventDefault();
            const formData = new FormData();
            formData.append('action', 'post_linkedin');
            formData.append('title', document.getElementById('apiPostTitle').value);
            formData.append('commentary', document.getElementById('apiPostCommentary').value);
            formData.append('article_url', document.getElementById('apiArticleUrl').value);
            formData.append('visibility', document.getElementById('apiVisibility').value);
            formData.append('media_format', document.querySelector('input[name="mediaFormat"]:checked').value);
            formData.append('hashtags', document.getElementById('apiHashtags').value);

            fetch('api.php', { method: 'POST', body: formData })
                .then(res => res.json())
                .then(data => {
                    document.getElementById('apiResponseLog').innerText = JSON.stringify(data, null, 2);
                    showToast('Successfully published via LinkedIn OAuth API!', 'text-bg-success');
                });
        }

        // Module 2: Analytics & UTM Studio Functions
        function applyUtmPreset(type) {
            if (type === 'linkedin') {
                document.getElementById('utmSource').value = 'linkedin';
                document.getElementById('utmMedium').value = 'social';
                document.getElementById('utmCampaign').value = 'official_share';
            } else if (type === 'newsletter') {
                document.getElementById('utmSource').value = 'newsletter';
                document.getElementById('utmMedium').value = 'email';
                document.getElementById('utmCampaign').value = 'weekly_digest';
            } else if (type === 'launch') {
                document.getElementById('utmSource').value = 'linkedin';
                document.getElementById('utmMedium').value = 'cpc';
                document.getElementById('utmCampaign').value = 'product_launch_v1';
            } else if (type === 'viral') {
                document.getElementById('utmSource').value = 'social';
                document.getElementById('utmMedium').value = 'viral_share';
                document.getElementById('utmCampaign').value = 'promo_2026';
            }
        }

        function generateShortUrl() {
            const formData = new FormData();
            formData.append('action', 'shorten');
            formData.append('url', document.getElementById('pageUrl').value);
            formData.append('utm_source', document.getElementById('utmSource').value);
            formData.append('utm_medium', document.getElementById('utmMedium').value);
            formData.append('utm_campaign', document.getElementById('utmCampaign').value);

            fetch('api.php', { method: 'POST', body: formData })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.getElementById('shortUrlOutput').value = data.short_url;
                        document.getElementById('testShortUrl').href = data.short_url;
                        document.getElementById('shortUrlResult').classList.remove('d-none');
                        showToast('Short tracking URL generated!');
                        loadAnalytics();
                    }
                });
        }

        function copyShortUrl() {
            navigator.clipboard.writeText(document.getElementById('shortUrlOutput').value);
            showToast('Short link copied to clipboard!');
        }

        function initAnalyticsChart() {
            const ctx = document.getElementById('analyticsChart').getContext('2d');
            analyticsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['LinkedIn', 'X (Twitter)', 'WhatsApp', 'Facebook', 'Direct'],
                    datasets: [{
                        label: 'Click-Throughs',
                        data: [12, 5, 8, 3, 7],
                        backgroundColor: ['#0a66c2', '#0f172a', '#25D366', '#1877F2', '#64748b'],
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } }
                }
            });
        }

        function loadAnalytics() {
            fetch('api.php?action=analytics')
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.getElementById('totalClickCount').innerText = data.total_clicks;
                        if (analyticsChart && data.platform_breakdown) {
                            analyticsChart.data.datasets[0].data = [
                                data.platform_breakdown['LinkedIn'] || 0,
                                data.platform_breakdown['X (Twitter)'] || 0,
                                data.platform_breakdown['WhatsApp'] || 0,
                                data.platform_breakdown['Facebook'] || 0,
                                data.platform_breakdown['Direct'] || 0
                            ];
                            analyticsChart.update();
                        }

                        let tbody = document.getElementById('clickLogsTable');
                        tbody.innerHTML = '';
                        if (!data.recent_logs || data.recent_logs.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-muted">No visitor click logs recorded yet.</td></tr>';
                            return;
                        }

                        data.recent_logs.forEach(row => {
                            let tr = document.createElement('tr');
                            tr.innerHTML = `
                                <td class="fw-bold">#${row.id}</td>
                                <td><span class="badge bg-light text-dark font-monospace">${row.code}</span></td>
                                <td><span class="badge bg-primary-subtle text-primary">${row.platform}</span></td>
                                <td class="font-monospace small">${row.ip_address}</td>
                                <td><i class="fa-solid fa-globe me-1"></i>${row.browser}</td>
                                <td class="small text-muted">${row.referrer}</td>
                                <td class="small">${row.clicked_at}</td>`;
                            tbody.appendChild(tr);
                        });
                    }
                });
        }

        // Module 3: OG Banner Canvas Designer & Exporter Functions
        function renderOgCanvas() {
            const canvas = document.getElementById('ogCanvas');
            const ctx = canvas.getContext('2d');
            const title = document.getElementById('ogBannerTitle').value || 'Title';
            const sub = document.getElementById('ogBannerSubtitle').value || 'Subtitle';
            const badge = document.getElementById('ogBannerBadge').value || 'VERIFIED';
            const style = document.getElementById('ogBannerStyle').value || 'blue';

            // Background gradient
            let grad = ctx.createLinearGradient(0, 0, 0, 630);
            if (style === 'dark') {
                grad.addColorStop(0, '#1e293b'); grad.addColorStop(1, '#0f172a');
            } else if (style === 'purple') {
                grad.addColorStop(0, '#4c1d95'); grad.addColorStop(1, '#7c3aed');
            } else if (style === 'emerald') {
                grad.addColorStop(0, '#064e3b'); grad.addColorStop(1, '#10b981');
            } else {
                grad.addColorStop(0, '#0a66c2'); grad.addColorStop(1, '#02386e');
            }

            ctx.fillStyle = grad;
            ctx.fillRect(0, 0, 1200, 630);

            // Card Overlay
            ctx.fillStyle = 'rgba(255, 255, 255, 0.12)';
            ctx.roundRect(60, 60, 1080, 510, 24);
            ctx.fill();

            // Badge Box
            ctx.fillStyle = '#ffffff';
            ctx.roundRect(100, 100, 260, 48, 12);
            ctx.fill();
            ctx.fillStyle = '#0a66c2';
            ctx.font = 'bold 20px Segoe UI, sans-serif';
            ctx.fillText(badge.toUpperCase(), 125, 132);

            // Headline Title
            ctx.fillStyle = '#ffffff';
            ctx.font = 'bold 52px Segoe UI, sans-serif';
            ctx.fillText(title, 100, 260);

            // Subtitle
            ctx.fillStyle = '#e2e8f0';
            ctx.font = '28px Segoe UI, sans-serif';
            ctx.fillText(sub, 100, 330);

            // Footer Brand
            ctx.fillStyle = '#38bdf8';
            ctx.font = 'bold 24px Segoe UI, sans-serif';
            ctx.fillText('POWERED BY LINKEDIN SHARE STUDIO • 1200x630', 100, 510);

            // Sync Live Previews Text
            document.querySelectorAll('#pvLnTitle, #pvTwTitle, #pvFbTitle, #pvSlTitle, #pvWaTitle').forEach(el => el.innerText = title);
            document.querySelectorAll('#pvLnSub, #pvTwSub, #pvFbSub, #pvSlSub').forEach(el => el.innerText = sub);

            // Sync GD Direct URL
            document.getElementById('gdDirectUrl').href = `generate_og.php?title=${encodeURIComponent(title)}&style=${style}`;

            updateRichMediaPreview();
        }

        function downloadOgCanvas() {
            const canvas = document.getElementById('ogCanvas');
            const link = document.createElement('a');
            link.download = 'linkedin-og-banner.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
            showToast('OG Banner image downloaded!');
        }

        let currentSnippetType = 'html';
        function switchSnippet(type) {
            currentSnippetType = type;
            updateSnippetCode(type);
        }

        function updateSnippetCode(type) {
            const title = document.getElementById('ogBannerTitle')?.value || 'Professional LinkedIn Share';
            const url = document.getElementById('pageUrl').value;
            const img = `${url}generate_og.php?title=${encodeURIComponent(title)}&style=blue`;

            let code = '';
            if (type === 'html') {
                code = `<meta property="og:title" content="${title}">\n<meta property="og:description" content="Generated via Open Graph Studio">\n<meta property="og:image" content="${img}">\n<meta property="og:url" content="${url}">\n<meta property="og:type" content="website">`;
            } else if (type === 'php') {
                code = `<?php\n$ogTitle = "${title}";\n$ogUrl = "${url}";\n$ogImg = "${img}";\n?>\n<meta property="og:title" content="<?php echo $ogTitle; ?>">\n<meta property="og:image" content="<?php echo $ogImg; ?>">\n<meta property="og:url" content="<?php echo $ogUrl; ?>">\n`;
            } else if (type === 'blade') {
                code = `@push('meta')\n<meta property="og:title" content="{{ $title ?? '${title}' }}">\n<meta property="og:image" content="{{ asset('generate_og.php?title=' . urlencode($title)) }}">\n<meta property="og:url" content="{{ url()->current() }}">\n@endpush`;
            } else if (type === 'wordpress') {
                code = `add_action('wp_head', function() {\n    echo '<meta property="og:title" content="${title}" />';\n    echo '<meta property="og:image" content="${img}" />';\n});`;
            }
            document.getElementById('snippetOutput').value = code;
        }

        function copySnippetCode() {
            navigator.clipboard.writeText(document.getElementById('snippetOutput').value);
            showToast('Code snippet copied to clipboard!');
        }
    </script>
</body>

</html>