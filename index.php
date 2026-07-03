<?php
$currentUrl = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$pageUrl = urlencode($currentUrl);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Professional LinkedIn Share Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f8;
            font-family: Arial, Helvetica, sans-serif;
            transition: .3s;
        }

        .dark-mode {
            background: #1f2937;
            color: white;
        }

        .card-stat {
            border: none;
            border-radius: 15px;
        }

        .share-btn {
            margin: 5px;
        }

        #pageUrl {
            font-weight: bold;
        }

        .progress {
            height: 22px;
        }

        #history {
            max-height: 220px;
            overflow: auto;
        }

        img {
            border-radius: 10px;
            border: 1px solid #ddd;
        }
    </style>

</head>

<body>

    <div class="container py-5">

        <div class="text-center mb-4">

            <h2 class="fw-bold">
                <i class="fab fa-linkedin text-primary"></i>
                LinkedIn Share Dashboard
            </h2>

            <p class="text-muted">
                Professional PHP LinkedIn Share Application
            </p>

        </div>

        <div class="row g-3 mb-4">

            <div class="col-md-3">

                <div class="card card-stat shadow text-center">

                    <div class="card-body">

                        <h2 id="shareCount">0</h2>

                        <p>Total Shares</p>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card card-stat shadow text-center">

                    <div class="card-body">

                        <h2>4</h2>

                        <p>Share Buttons</p>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card card-stat shadow text-center">

                    <div class="card-body">

                        <h2>100%</h2>

                        <p>Responsive</p>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card card-stat shadow text-center">

                    <div class="card-body">

                        <button class="btn btn-dark" onclick="toggleMode()">

                            <i class="fa fa-moon"></i>

                            Dark Mode

                        </button>

                    </div>

                </div>

            </div>

        </div>

        <div class="card shadow">

            <div class="card-body">

                <h4 class="mb-3">

                    Current Page URL

                </h4>

                <input class="form-control mb-3" id="pageUrl" value="<?php echo $currentUrl; ?>" readonly>



                <div class="mb-3">

                    <a class="btn btn-primary share-btn"
                        href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $pageUrl; ?>"
                        target="_blank" onclick="increaseShare()">

                        <i class="fab fa-linkedin"></i>

                        LinkedIn

                    </a>

                    <a class="btn btn-dark share-btn"
                        href="https://twitter.com/intent/tweet?url=<?php echo $pageUrl; ?>" target="_blank"
                        onclick="increaseShare()">

                        <i class="fab fa-x-twitter"></i>

                        X

                    </a>

                    <a class="btn btn-success share-btn" href="https://wa.me/?text=<?php echo $pageUrl; ?>"
                        target="_blank" onclick="increaseShare()">

                        <i class="fab fa-whatsapp"></i>

                        WhatsApp

                    </a>

                    <a class="btn btn-primary share-btn"
                        href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $pageUrl; ?>" target="_blank"
                        onclick="increaseShare()">

                        <i class="fab fa-facebook"></i>

                        Facebook

                    </a>

                    <button class="btn btn-secondary share-btn" onclick="copyLink()">

                        <i class="fa fa-copy"></i>

                        Copy Link

                    </button>

                </div>

                <hr>

                <h4>

                    QR Code

                </h4>

                <img id="qrCode"
                    src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=<?php echo $pageUrl; ?>">

                <br><br>

                <a id="downloadQR" download="linkedin-qr.png" class="btn btn-warning" onclick="downloadQR()">

                    <i class="fa fa-download"></i>
                    Download QR
                </a>

                <!-- Download Toast -->
                <div class="position-fixed bottom-0 end-0 p-3">

                    <div id="downloadToast" class="toast align-items-center text-bg-primary border-0" role="alert">

                        <div class="d-flex">

                            <div class="toast-body">
                                <i class="fa fa-check"></i>
                                QR Code downloaded successfully!
                            </div>

                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast">
                            </button>

                        </div>

                    </div>

                </div>

                <hr>

                <h4>

                    Share Progress

                </h4>

                <div class="progress mb-4">

                    <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated"
                        style="width:0%">

                        0%

                    </div>

                </div>

                <h4 class="mb-3">
                    <i class="fa fa-history"></i> Recent Activity
                </h4>

                <ul id="history" class="list-group mb-4">
                </ul>

                <hr class="my-5">

                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0">
                            <i class="fa-solid fa-code me-2"></i>
                            Open Graph Meta Tag Generator
                        </h4>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Website Title
                                </label>

                                <input
                                    type="text"
                                    id="ogTitle"
                                    class="form-control"
                                    value="Professional LinkedIn Share Dashboard">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Website URL
                                </label>

                                <input
                                    type="url"
                                    id="ogUrl"
                                    class="form-control"
                                    value="<?php echo $currentUrl; ?>">
                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Description
                            </label>

                            <textarea
                                id="ogDescription"
                                class="form-control"
                                rows="3">Share your website professionally using LinkedIn with Open Graph support.</textarea>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Image URL
                            </label>

                            <input
                                type="url"
                                id="ogImage"
                                class="form-control"
                                value="https://placehold.co/1200x630/0A66C2/FFFFFF?text=LinkedIn+Preview">

                        </div>

                        <div class="d-flex flex-wrap gap-2">

                            <button
                                class="btn btn-success"
                                id="generateBtn">

                                <i class="fa-solid fa-gears me-1"></i>

                                Generate Meta Tags

                            </button>

                            <button
                                class="btn btn-secondary"
                                id="copyMetaBtn">

                                <i class="fa-regular fa-copy me-1"></i>

                                Copy Tags

                            </button>

                        </div>

                        <!-- Open Graph Validation Message -->

                        <div
                            id="validationMessage"
                            class="alert alert-danger mt-3 d-none"
                            role="alert">

                            <i class="fa-solid fa-circle-exclamation me-2"></i>

                            Please fill in all required fields correctly.

                        </div>

                        <div class="mt-4">

                            <label class="form-label fw-semibold">
                                Generated Open Graph Tags
                            </label>

                            <textarea
                                id="generatedTags"
                                class="form-control font-monospace"
                                rows="10"
                                readonly></textarea>

                        </div>

                        <hr class="my-5">

                        <h4 class="mb-4">
                            <i class="fa-solid fa-eye text-primary me-2"></i>
                            Live Share Preview
                        </h4>

                        <div class="card shadow-sm border rounded-4 overflow-hidden" id="previewCard">

                            <img
                                id="previewImage"
                                src="https://placehold.co/1200x630/0A66C2/FFFFFF?text=LinkedIn+Preview"
                                class="card-img-top"
                                style="height:240px; object-fit:cover;">

                            <div class="card-body">

                                <small class="text-muted text-uppercase" id="previewDomain">
                                    <?php echo parse_url($currentUrl, PHP_URL_HOST); ?>
                                </small>

                                <h5
                                    class="card-title fw-bold mt-2"
                                    id="previewTitle">
                                    Your Website Title
                                </h5>

                                <p
                                    class="card-text text-muted"
                                    id="previewDescription">
                                    Your website description will appear here.
                                </p>

                                <a
                                    href="#"
                                    id="previewUrl"
                                    class="text-decoration-none small">
                                    <?php echo $currentUrl; ?>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- Toast Notification -->

    <div class="position-fixed bottom-0 end-0 p-3">

        <div id="copyToast" class="toast align-items-center text-bg-success border-0" role="alert">

            <div class="d-flex">

                <div class="toast-body">

                    <i class="fa fa-circle-check"></i>

                    Link copied successfully!

                </div>

                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast">
                </button>

            </div>

        </div>

    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index:11;">

        <div id="metaToast"
            class="toast align-items-center text-bg-success border-0"
            role="alert">

            <div class="d-flex">

                <div class="toast-body">

                    <i class="fa-solid fa-circle-check me-2"></i>

                    Meta tags copied successfully!

                </div>

                <button
                    type="button"
                    class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast">

                </button>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let count = parseInt(localStorage.getItem("shareCount")) || 0;

        document.getElementById("shareCount").innerHTML = count;

        updateProgress();

        window.onload = function() {

            document.getElementById("downloadQR").href =
                document.getElementById("qrCode").src;

        };

        function increaseShare() {

            count++;
            localStorage.setItem("shareCount", count);
            document.getElementById("shareCount").innerHTML = count;

            updateProgress();

            /* GET OLD HISTORY */
            let history = JSON.parse(localStorage.getItem("shareHistory")) || [];

            /* ADD NEW ENTRY */
            let time = new Date().toLocaleString();
            history.unshift("Shared at : " + time);

            /* SAVE BACK */
            localStorage.setItem("shareHistory", JSON.stringify(history));

            renderHistory();
        }

        function renderHistory() {

            let history = JSON.parse(localStorage.getItem("shareHistory")) || [];

            document.getElementById("history").innerHTML = "";

            history.forEach(item => {

                let li = document.createElement("li");
                li.className = "list-group-item";
                li.innerHTML = "<i class='fa fa-share text-success'></i> " + item;

                document.getElementById("history").appendChild(li);

            });

        }

        function updateProgress() {

            let percent = count * 10;

            if (percent > 100) {

                percent = 100;

            }

            document.getElementById("progressBar").style.width = percent + "%";

            document.getElementById("progressBar").innerHTML = percent + "%";

        }

        function downloadQR() {

            let qrImg = document.getElementById("qrCode").src;

            let link = document.createElement("a");
            link.href = qrImg;
            link.download = "linkedin-qr.png";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // show toast
            let toast = new bootstrap.Toast(
                document.getElementById("downloadToast")
            );

            toast.show();
        }

        function copyLink() {

            navigator.clipboard.writeText(

                document.getElementById("pageUrl").value

            );

            let toast = new bootstrap.Toast(

                document.getElementById("copyToast")

            );

            toast.show();

        }

        window.onload = function() {

            document.getElementById("downloadQR").href =
                document.getElementById("qrCode").src;

            renderHistory(); // 👈 load saved history
        };

        function toggleMode() {

            document.body.classList.toggle("dark-mode");

        }

        const titleInput = document.getElementById("ogTitle");
        const descriptionInput = document.getElementById("ogDescription");
        const imageInput = document.getElementById("ogImage");
        const urlInput = document.getElementById("ogUrl");

        function isValidUrl(value) {

            try {

                new URL(value);

                return true;

            } catch {

                return false;

            }

        }

        function updatePreview() {

            document.getElementById("previewTitle").innerText =
                titleInput.value || "Professional LinkedIn Share Dashboard";

            document.getElementById("previewDescription").innerText =
                descriptionInput.value || "Share your website professionally using LinkedIn with Open Graph support.";

            document.getElementById("previewUrl").innerText =
                urlInput.value;

            document.getElementById("previewUrl").href =
                urlInput.value;

            try {

                let domain = new URL(urlInput.value);

                document.getElementById("previewDomain").innerText =
                    domain.hostname;

            } catch {

                document.getElementById("previewDomain").innerText =
                    "yourwebsite.com";

            }

            if (imageInput.value.trim() !== "") {

                document.getElementById("previewImage").src =
                    imageInput.value;

            } else {

                document.getElementById("previewImage").src =
                    "https://placehold.co/1200x630/0A66C2/FFFFFF?text=LinkedIn+Preview";

            }

        }

        titleInput.addEventListener("input", updatePreview);
        descriptionInput.addEventListener("input", updatePreview);
        imageInput.addEventListener("input", updatePreview);
        urlInput.addEventListener("input", updatePreview);

        updatePreview();

        /* =====================================
           GENERATE OPEN GRAPH META TAGS
           ===================================== */

        document.getElementById("generateBtn").addEventListener("click", function() {

            const title = titleInput.value.trim();
            const description = descriptionInput.value.trim();
            const image = imageInput.value.trim();
            const url = urlInput.value.trim();

            const validationBox = document.getElementById("validationMessage");

            // Remove previous validation styles
            [titleInput, descriptionInput, imageInput, urlInput].forEach(field => {
                field.classList.remove("is-invalid");
            });

            // Validation
            let valid = true;

            if (title === "") {
                titleInput.classList.add("is-invalid");
                valid = false;
            }

            if (description === "") {
                descriptionInput.classList.add("is-invalid");
                valid = false;
            }

            // Validate Image URL

            if (image === "" || !isValidUrl(image)) {
                imageInput.classList.add("is-invalid");
                valid = false;
            }

            // Validate Website URL

            if (url === "" || !isValidUrl(url)) {
                urlInput.classList.add("is-invalid");
                valid = false;
            }

            // If validation fails
            if (!valid) {

                validationBox.classList.remove("d-none");
                validationBox.classList.remove("alert-success");
                validationBox.classList.add("alert-danger");

                validationBox.innerHTML =
                    `<i class="fa-solid fa-circle-exclamation me-2"></i>
                    Please enter a valid title, description, website URL and image URL before generating Open Graph tags.`;

                return;
            }

            // Generate Open Graph tags
            const metaTags = `<meta property="og:title" content="${title}">
<meta property="og:description" content="${description}">
<meta property="og:image" content="${image}">
<meta property="og:url" content="${url}">
<meta property="og:type" content="website">`;

            document.getElementById("generatedTags").value = metaTags;

            // Show success message
            validationBox.classList.remove("d-none");
            validationBox.classList.remove("alert-danger");
            validationBox.classList.add("alert-success");

            validationBox.innerHTML = `
<i class="fa-solid fa-circle-check me-2"></i>
Open Graph meta tags generated successfully!
`;

        });

        /* =====================================
           COPY GENERATED META TAGS
           ===================================== */

        document.getElementById("copyMetaBtn").addEventListener("click", function() {

            const generatedTags = document.getElementById("generatedTags");

            if (generatedTags.value.trim() === "") {

                alert("Please generate the meta tags first.");

                return;

            }

            navigator.clipboard.writeText(generatedTags.value);

            let toast = new bootstrap.Toast(
                document.getElementById("metaToast")
            );

            toast.show();

        });
    </script>

</body>

</html>