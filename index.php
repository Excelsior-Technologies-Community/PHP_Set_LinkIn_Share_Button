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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        let count = parseInt(localStorage.getItem("shareCount")) || 0;

        document.getElementById("shareCount").innerHTML = count;

        updateProgress();

        window.onload = function () {

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

        window.onload = function () {

            document.getElementById("downloadQR").href =
                document.getElementById("qrCode").src;

            renderHistory(); // 👈 load saved history
        };

        function toggleMode() {

            document.body.classList.toggle("dark-mode");

        }

    </script>

</body>

</html>